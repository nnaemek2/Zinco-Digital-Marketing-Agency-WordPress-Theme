<?php
/**
 * Taxonomy term meta box module based on Redux Framework.
 * Requires Redux::setArgs() to be called.
 *
 * @package eFramework
 * @since 1.0
 *
 * @version 1.0
 */

defined('ABSPATH') or exit();

if (class_exists('CMS_Taxonomy_Meta')) {
    return;
}

class CMS_Taxonomy_Meta
{
    /**
     * Version
     * @var string
     */
    protected static $version = '1.0.0';

    /**
     * Store panel for each taxonomy
     *
     * @since 1.0
     * @access protected
     * @var string
     */
    protected $panels = array();

    /**
     * Store all field ids for each taxonomy
     *
     * @since 1.0
     * @access protected
     * @var string
     */
    protected $field_ids = array();

    /**
     * Store all affected taxonomies
     *
     * @since 1.0
     * @access protected
     * @var string
     */
    protected $taxonomies = array();

    /**
     * Store args from ReduxFramework options, we will alter this to fit.
     *
     * @since 1.0
     * @access protected
     * @var string
     */
    protected $default_args = array();

    /**
     * Notices if save/update values return errors/warnings
     *
     * @since 1.0
     * @access protected
     * @var array
     */
    protected $notices = array();

    /**
     * Localize scripts for better UX
     *
     * @since 1.0
     * @access protected
     * @var array
     */
    protected $localize_script = array(
        'errors'   => array(),
        'warnings' => array()
    );

    /**
     * Constructor
     *
     * @param ReduxFramework $redux
     */
    function __construct()
    {
        $this->default_args = [];
        $this->optimize_default_args();

        do_action('cms_taxonomy_meta_register', $this);
        if (empty($this->taxonomies) || empty($this->panels)) {
            return;
        }

        add_action('admin_init', array($this, 'admin_init'));
        add_action('created_term', array($this, 'created_term'), 10, 3);
        add_action('edited_term', array($this, 'edited_term'), 10, 3);
        add_action('wp_head', array($this, 'enqueue_output'), 160);
        add_action('admin_notices', array($this, 'admin_notices'));
    }

    /**
     * Generate fields on admin_init - 10
     *
     * @since 1.0
     * @access public
     */
    function admin_init()
    {
        global $pagenow;

        if ('term.php' == $pagenow) {
            $this->notices = get_transient('cms-taxonomy-meta-transients');

            // If the transient exists then we override it with an empty value
            if (false !== $this->notices) {
                set_transient('cms-taxonomy-meta-transients', '');
            } else {
                $this->notices = maybe_unserialize($this->notices);
            }

            if (!empty($this->notices) && is_array($this->notices)) {
                if (!empty($this->notices['errors']) && is_array($this->notices['errors'])) {
                    $this->localize_script['errors'] = array();

                    foreach ($this->notices['errors'] as $fk => $field) {
                        if (empty($field['id']) || empty($field['msg'])) {
                            continue;
                        }
                        $this->localize_script['errors'][$field['id']] = $field['msg'];
                    }
                }

                if (!empty($this->notices['warnings']) && is_array($this->notices['warnings'])) {
                    $this->localize_script['warnings'] = array();

                    foreach ($this->notices['warnings'] as $fk => $field) {
                        if (empty($field['id']) || empty($field['msg'])) {
                            continue;
                        }
                        $this->localize_script['warnings'][$field['id']] = $field['msg'];
                    }
                }
            }
        }

        foreach ($this->panels as $taxonomy => $tax_panel) {
            if (empty($tax_panel['args']['opt_name'])) {
                continue;
            }
            add_action("{$taxonomy}_add_form_fields", array($this, 'add_form_fields'));
            add_action("{$taxonomy}_edit_form_fields", array($this, 'edit_form_fields'), 10, 2);

            add_action("redux/page/{$tax_panel['args']['opt_name']}/enqueue", array($this, 'panel_scripts'));
            add_filter("redux/{$tax_panel['args']['opt_name']}/panel/templates_path", array($this, 'panel_template'));
            add_filter("redux/options/{$tax_panel['args']['opt_name']}/options", array($this, 'get_values'));
            Redux::init($tax_panel['args']['opt_name']);
        }
    }

    /**
     * Check if args for the taxonomy isset or not
     *
     * @since 1.0
     * @access public
     * @param  string $taxonomy
     * @return boolean
     */
    public function isset_args($taxonomy)
    {
        if (!array_key_exists($taxonomy, $this->panels) || empty($this->panels[$taxonomy]['args'])) {
            return false;
        }

        return true;
    }

    /**
     * Set Redux Framework agruments for a taxonomy. Default args are taken from ReduxFramework instance
     * with some modified key to fit with the metabox and to be sure that the metabox won't generate
     * admin menu or any other unused/messed things to avoid conflict with the options instance.
     *
     * @param array $args Optional. ReduxFramework args. If not set, default args will be used
     * @param string $taxonomy Required
     */
    public function set_args($taxonomy, $args = array())
    {
        if (empty($taxonomy)) {
            return;
        }

        $this->check_add_taxonomy($taxonomy);

        if (!$this->isset_args($taxonomy)) {
            $args = wp_parse_args($args, $this->default_args);
            $args['opt_name'] = isset($args['opt_name']) ? $args['opt_name'] : '';

            if ($args['opt_name'] == $this->default_args['opt_name']) {
                $args['opt_name'] = $this->default_args['opt_name'] . '_taxterm' . $taxonomy;
            }

            $this->panels[$taxonomy]['args'] = $args;
        }
    }

    /**
     * Alter ReduxFramework options instance args to fit.
     *
     * @since 1.0
     * @access protected
     */
    protected function optimize_default_args()
    {
        $this->default_args['opt_name'] = isset($this->default_args['opt_name']) ? $this->default_args['opt_name'] . '_taxonomy_metabox' : 'cms_taxonomy_metabox';
        $this->default_args['display_name'] = esc_html__('Settings', CMS_TEXT_DOMAIN);
        $this->default_args['open_expanded'] = true;
        $this->default_args['footer_credit'] = '';
        $this->default_args['admin_bar'] = false;
        $this->default_args['show_import_export'] = false;
        $this->default_args['show_options_object'] = false;
        $this->default_args['ajax_save'] = false;
        $this->default_args['admin_bar_links'] = array();
        $this->default_args['share_icons'] = array();
        $this->default_args['intro_text'] = '';
        $this->default_args['footer_text'] = '';
        $this->default_args['dev_mode'] = false;
        $this->default_args['output'] = true;
        $this->default_args['output_tag'] = true;
        $this->default_args['global_variable'] = '';
    }

    /**
     * Add section to the panel for taxonomy
     *
     * @since 1.0
     * @access public
     * @param string $taxonomy
     * @param array $section
     */
    function add_section($taxonomy, $section = array())
    {
        if (empty($taxonomy) || empty($section) || empty($section['id']) || empty($section['fields'])) {
            return;
        }

        if (!isset($this->field_ids[$taxonomy])) {
            $this->field_ids[$taxonomy] = array();
        }

        $this->check_add_taxonomy($taxonomy);

        // Store all the field ids, also unset fields from section which are aready registered for the taxonomy
        foreach ($section['fields'] as $fkey => $field) {
            if (empty($field) || empty($field['id'])) {
                continue;
            }

            if (in_array($field['id'], $this->field_ids[$taxonomy])) {
                trigger_error(sprintf(esc_html__('The field with id %1$s for taxonomy %2$s is already registered.', CMS_TEXT_DOMAIN), esc_html($field['id'], ETCTEXT_DOMAIN), esc_html($taxonomy, ETCTEXT_DOMAIN)));
                unset($section['fields'][$fkey]);
                continue;
            }

            $this->field_ids[$taxonomy][] = $field['id'];
        }

        if (!isset($this->panels[$taxonomy]['sections'])) {
            $this->panels[$taxonomy]['sections'] = array();
        }

        if (!empty($section['id'])) {
            if ($this->section_exist($section['id'], $taxonomy)) {
                trigger_error(sprintf(esc_html__('Section %1$s for taxonomy %2$s is already exist.', CMS_TEXT_DOMAIN), esc_html($field['id']), esc_html($taxonomy)));
                return;
            } else {
                //$this->panels[$taxonomy]['sections'][$section['id']] = $section;
                $this->panels[$taxonomy]['sections'][] = $section;
            }
        } else {
            $this->panels[$taxonomy]['sections'][] = $section;
        }
    }

    /**
     * Remove section by its id from taxonomy
     *
     * @since 1.0
     * @access public
     * @param  string $section_id
     * @param  string $taxonomy
     */
    function remove_section($section_id, $taxonomy)
    {
        if (!$this->section_exist($section_id, $taxonomy)) {
            return;
        }

        unset($this->panels[$taxonomy]['sections'][$section_id]);

        $this->check_remove_taxonomy($taxonomy);
    }

    /**
     * Check if a section for taxonomy exist.
     *
     * @since 1.0
     * @access public
     * @param  string $section_id
     * @param  string $taxonomy
     */
    function section_exist($section_id, $taxonomy)
    {
        if (empty($this->panels[$taxonomy]) || empty($this->panels[$taxonomy]['sections'])) {
            return false;
        }

        if (array_key_exists($section_id, $this->panels[$taxonomy]['sections'])) {
            return true;
        }

        return false;
    }

    /**
     * Check whenever we need to add taxonomy to our storage. If addable then we will add it.
     *
     * @since 1.0
     * @access protected
     * @param  string $taxonomy
     */
    protected function check_add_taxonomy($taxonomy)
    {
        if (!in_array($taxonomy, $this->taxonomies)) {
            $this->taxonomies[] = $taxonomy;
        }
    }

    /**
     * Check whenever we need to remove panel from taxonomy.
     *
     * @since 1.0
     * @access protected
     * @param  string $taxonomy
     */
    protected function check_remove_taxonomy($taxonomy)
    {
        if (isset($this->panels[$taxonomy])) {
            if (empty($this->panels[$taxonomy]['args']) || empty($this->panels[$taxonomy]['sections'])) {
                unset($this->panels[$taxonomy]);
            }
        }
    }

    /**
     * Generate Redux panel for taxonomy term.
     *
     * @param  array $sections
     * @param  array $args
     */
    protected function generate_panel($sections, $args)
    {
        wp_nonce_field('cms_taxonomy_metabox_nonce_action', 'cms_taxonomy_metabox_nonce');
        
        $redux = new ReduxFramework($sections, $args);
        $redux->options_class->register();
        $redux->enqueue_class->init();
        $redux->render_class->generate_panel(); 
    }

    /**
     * Add panel to new term screen. Hooked: {$tax}_add_form_fields - 10
     *
     * @since 1.0
     * @access public
     * @param string $taxonomy
     */
    function add_form_fields($taxonomy)
    {
        if (empty($this->panels[$taxonomy]['args']) || empty($this->panels[$taxonomy]['sections'])) {
            return;
        }
        $display_name = $this->panels[$taxonomy]['args']['display_name'];

        echo '<div class="form-field term-rc-custom-wrap">';
        $this->generate_panel($this->panels[$taxonomy]['sections'], $this->panels[$taxonomy]['args']);
        echo '</div>';
    }

    /**
     * Add panel on edit term screen. Hooked: {$tax}_edit_form_fields - 10
     *
     * @since 1.0
     * @access public
     * @param  object $term
     * @param  string $taxonomy
     */
    function edit_form_fields($term, $taxonomy)
    {
        if (empty($this->panels[$taxonomy]['args']) || empty($this->panels[$taxonomy]['sections'])) {
            return;
        }
        $display_name = $this->panels[$taxonomy]['args']['display_name'];

        echo '<tr class="form-field tr-ef-term-postbox">';
        echo '<th scope="row"><label>' . esc_html($display_name) . '</label></th>';
        echo '<td><div class="ef-postbox ef-taxonomy-postbox">';
        $this->generate_panel($this->panels[$taxonomy]['sections'], $this->panels[$taxonomy]['args']);
        echo '</div></td></tr>';
    }

    /**
     * Enqueue extra scripts/styles for the panel
     *
     * @since 1.0
     * @access public
     */
    function panel_scripts()
    {
        global $pagenow;

        if ('edit-tags.php' !== $pagenow && 'term.php' !== $pagenow) {
            return;
        }

        wp_enqueue_style('cms-metabox', CMS_URL . '/assets/css/metabox' . Redux_Functions::isMin() . '.css', array(), self::$version, 'all');
        wp_enqueue_script('cms-metabox', CMS_URL . '/assets/js/metabox' . Redux_Functions::isMin() . '.js', array('jquery', 'redux-js'), self::$version, 'all');

        if ('term.php' == $pagenow) {
            wp_localize_script(
                'cms-metabox',
                'EFrameworkMetaboxLocalize',
                $this->localize_script
            );
        }
    }

    /**
     * Modify ReduxFramework Panel templates
     *
     * @since 1.0
     * @access public
     * @return string Templates Folter path
     */
    function panel_template()
    {
        return CMS_DIR . '/templates/panel-post-meta';
    }

    /**
     * Filter ReduxFramework instance options.
     *
     * @since 1.0
     * @access public
     * @param  array $options The original option values
     * @return array
     */
    function get_values($options)
    {
        $data = $this->get_metadata();

        if (empty($data)) {
            return array();
        }

        return $data;
    }

    /**
     * Get meta data from post based on term_id.
     *
     * @since 1.0
     * @access public
     * @param  int $term_id
     * @return array
     */
    protected function get_metadata($term_id = null)
    {
        global $tag, $pagenow;
        $data = array();

        if (!isset($term_id)) {
            if (is_admin()) {
                if (!$tag || empty($tag->term_id) || !$pagenow || 'term.php' != $pagenow) {
                    return $data;
                }

                $term_id = $tag->term_id;
            } else {
                if (!is_tax() && !is_category() || !is_tag()) {
                    return $data;
                }

                $term = get_queried_object();

                if (!$term) {
                    return $data;
                }

                $term_id = $term->term_id;
            }
        }

        $_custom = get_term_meta($term_id);

        if (empty($_custom)) {
            return $data;
        }

        foreach ($_custom as $key => $value) {
            $data[$key] = maybe_unserialize($value[0]);
        }

        return $data;
    }

    /**
     * Get all default value of registered fields for the taxonomy
     *
     * @since 1.0
     * @access protected
     * @param  string $taxonomy
     * @return array
     */
    protected function get_opt_defaults($taxonomy)
    {
        if (empty($this->panels[$taxonomy]['sections'])) {
            return array();
        }

        $opts = array();

        foreach ($this->panels[$taxonomy]['sections'] as $sid => $section) {
            if (empty($section['fields'])) {
                continue;
            }

            foreach ($section['fields'] as $field) {
                if (!isset($field['id'])) {
                    continue;
                }

                if (isset($field['default'])) {
                    $opts[$field['id']] = $field['default'];
                } else {
                    $opts[$field['id']] = null;
                }
            }
        }

        return $opts;
    }

    /**
     * Fires after a new term is created, and after the term cache has been cleaned.
     *
     *
     * @param int $term_id Term ID.
     * @param int $tt_id Term taxonomy ID.
     * @param string $taxonomy Taxonomy slug.
     */
    function created_term($term_id, $tt_id, $taxonomy)
    {
        $this->save_term_meta($term_id, $tt_id, $taxonomy, false);
    }

    /**
     * Fires after a term has been updated, and the term cache has been cleaned.
     *
     * @param int $term_id Term ID.
     * @param int $tt_id Term taxonomy ID.
     * @param string $taxonomy Taxonomy slug.
     */
    function edited_term($term_id, $tt_id, $taxonomy)
    {
        $this->save_term_meta($term_id, $tt_id, $taxonomy, true);
    }

    /**
     * Fires after a new term is created, and after the term cache has been cleaned.
     *
     * @param int $term_id Term ID.
     * @param int $tt_id Term taxonomy ID.
     * @param string $taxonomy Taxonomy slug.
     * @param boolean $transient Set transient or not. We'll use this to notices user if any errors/warnings are found.
     */
    protected function save_term_meta($term_id, $tt_id, $taxonomy, $transient = false)
    {
        if (!isset($this->panels[$taxonomy]['args']['opt_name'])) {
            return;
        }

        $opt_name = $this->panels[$taxonomy]['args']['opt_name'];

        if (empty($_POST[$opt_name]) || empty($_POST['cms_taxonomy_metabox_nonce']) || !wp_verify_nonce($_POST['cms_taxonomy_metabox_nonce'], 'cms_taxonomy_metabox_nonce_action')) {
            return;
        }

        $data_to_save = array();
        $data_to_compare = $this->get_opt_defaults($taxonomy);

        foreach ($_POST[$opt_name] as $key => $data) {
            if (is_array($data)) {
                foreach ($data as $dindex => $value) {
                    if (!is_array($value)) {
                        $data[$dindex] = stripslashes($value);
                    }
                }
            }

            $data_to_save[$key] = $data;
        }

        $redux = new ReduxFramework($this->panels[$taxonomy]['sections'], $this->panels[$taxonomy]['args']);
        $validate = $redux->_validate_values($data_to_save, $data_to_compare, $this->panels[$taxonomy]['sections']);

        // Validate field values. Bypass invalid values.
        foreach ($data_to_save as $key => $value) {
            if (isset($validate[$key])) {
                if ($validate[$key] != $data_to_save[$key]) {
                    $data_to_save[$key] = $validate[$key];
                }
            } else {
                unset($data_to_save[$key]);
            }
        }

        foreach ($data_to_save as $key => $value) {
            update_term_meta($term_id, $key, $value);
        }

        if ($transient) {
            $notices = array();

            if (!empty($redux->errors) || !empty($redux->warnings)) {
                if (!empty($redux->errors)) {
                    $notices['errors'] = $redux->errors;
                } else {
                    $notices['errors'] = array();
                }

                if (!empty($redux->warnings)) {
                    $notices['warnings'] = $redux->warnings;
                } else {
                    $notices['warnings'] = array();
                }

                set_transient('cms-taxonomy-metabox-transients', $notices);
            }
        }
    }

    /**
     * Notice user if there is any errors, warning. Hooked into admin_notices
     *
     * @since 1.0
     * @access public
     */
    function admin_notices()
    {
        global $pagenow;

//        if ('edit-tags.php' !== $pagenow && 'term.php' !== $pagenow) {
//            echo '<div class="notice notice-warning is-dismissible">';
//            echo '<p>';
//            esc_html_e('All invalid custom field values for newly created term or existing term will not be saved, if you are missing something, please check field descriptions for instructions how to input valid values.', ETCTEXT_DOMAIN);
//            echo '</p>';
//            printf('<button type="button" class="notice-dismiss"><span class="screen-reader-text">%s</span></button>', esc_html__('Dismiss this notice.', ETCTEXT_DOMAIN));
//            echo '</div>';
//        }

        if (!empty($this->notices['errors'])) {
            echo '<div class="error"><p>';
            printf(
                '<strong>%1$s %2$s</strong> %3$s',
                esc_html(count($this->notices['errors'])),
                esc_html__('error(s)', CMS_TEXT_DOMAIN),
                esc_html__('were found! Some data might not be saved.', CMS_TEXT_DOMAIN)
            );
            echo '</p></div>';
        }

        if (!empty($this->notices['warnings'])) {
            echo '<div class="notice notice-warning is-dismissible">';
            echo '<p>';
            printf(
                '<strong>%1$s %2$s</strong> %3$s',
                esc_html(count($this->notices['warnings'])),
                esc_html__('warning(s)', CMS_TEXT_DOMAIN),
                esc_html__('were found! Some data might not be saved.', CMS_TEXT_DOMAIN)
            );

            echo '</p>';
            printf('<button type="button" class="notice-dismiss"><span class="screen-reader-text">%s</span></button>', esc_html__('Dismiss this notice.', CMS_TEXT_DOMAIN));
            echo '</div>';
        }
    }

    /**
     * Enqueue output if users are viewing term archive page
     *
     * @since  1.0
     * @access public
     */
    function enqueue_output()
    {
        if (!is_tax() && !is_category() && !is_tag()) {
            return;
        }

        if ((is_category() && empty($this->panels['category']))
            || (is_tag() && empty($this->panels['post_tag']))) {
            return;
        }

        $queried_object = get_queried_object();

        $taxonomy = isset($queried_object->taxonomy) ? $queried_object->taxonomy : null;

        if (!$taxonomy) {
            return;
        }

        if (empty($this->panels[$taxonomy]) || empty($this->panels[$taxonomy]['args']) || empty($this->panels[$taxonomy]['sections'])) {
            return;
        }

        $this->generate_output_css($taxonomy, $this->get_metadata($queried_object->term_id));
    }

    /**
     * Render css output
     *
     * @since  1.0
     * @access protected
     */
    protected function generate_output_css($taxonomy, $options)
    {
        $redux = new ReduxFramework($this->panels[$taxonomy]['sections'], $this->panels[$taxonomy]['args']);
        $redux->options = $options;

        $redux->output_class->enqueue();

        if (!$redux->outputCSS) {
            return;
        }

        echo '<style id="cms-' . $taxonomy . '-dynamic-css" data-type="redux-output-css">' . $redux->outputCSS . '</style>';
    }
}
