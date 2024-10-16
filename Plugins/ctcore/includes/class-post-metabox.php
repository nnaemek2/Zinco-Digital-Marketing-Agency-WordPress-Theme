<?php
/**
 * Post meta box module based on Redux Framework.
 * Supports only one meta box.
 * Requires Redux::setArgs() to be called.
 *
 * @package eFramework
 * @since 1.0
 *
 * @version 1.0
 */

defined('ABSPATH') or exit();

class CMS_Post_Metabox
{
    /**
     * Version
     * @var string
     */
    protected static $version = '1.0.0';

    /**
     * Store panel for each post type
     *
     * @since 1.0
     * @access protected
     * @var string
     */
    protected $panels = array();

    protected $list_screen = array();

    /**
     * Store all field ids for each post type
     *
     * @since 1.0
     * @access protected
     * @var string
     */
    protected $field_ids = array();

    /**
     * Store all affected post types
     *
     * @since 1.0
     * @access protected
     * @var string
     */
    protected $post_types = array();


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
        'errors' => array(),
        'warnings' => array()
    );

    /**
     * Constructor.
     * This class is loaded as a Redux Framework Extension through loader.
     *
     * @param ReduxFramework $redux
     */
    function __construct()
    {
        $this->default_args = [];
        $this->optimize_default_args();
        do_action('cms_post_metabox_register', $this);

        if (empty($this->post_types) || empty($this->panels)) {
            return;
        }

        if (!empty($this->panels)) {
            add_action('admin_init', array($this, 'admin_init'));
            add_action('add_meta_boxes', array($this, 'add_meta_boxes'));
            add_action('save_post', array($this, 'save_meta_boxes'), 5, 2);
            add_action('admin_notices', array($this, 'admin_notices'));
            add_action('wp_head', array($this, 'enqueue_output'), 160);
            add_action('hidden_meta_boxes', array($this, 'cms_set_user_metaboxes'));
        }
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

        if ('post.php' == $pagenow) {
            $this->notices = get_transient('cms-post-metabox-transients');

            // If the transient exists then we override it with an empty value
            if (false !== $this->notices) {
                set_transient('cms-post-metabox-transients', '');
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
    }


    /**
     * Check if args for the post type isset or not
     *
     * @since 1.0
     * @access public
     *
     * @param  string $post_type
     *
     * @return boolean
     */
    public function isset_args($post_type)
    {
        if (!array_key_exists($post_type, $this->panels) || empty($this->panels[$post_type]['args'])) {
            return false;
        }

        return true;
    }

    /**
     * Set Redux Framework agruments for a post type. Default args are taken from ReduxFramework instance
     * with some modified key to fit with the metabox and to be sure that the metabox won't generate
     * admin menu or any other unused/messed things to avoid conflict with the options instance.
     *
     * @param string $post_type Required
     * @param array $args Optional. ReduxFramework args. If not set, default args will be used
     * @param array $metabox_args {
     *
     * @var string $context Default 'advanced'. Similar to add_meta_box context.
     * @var string $priority Default 'default'. Similar to add_meta_box context.
     * }
     */
    public function set_args($post_type, $args = array(), $metabox_args = array())
    {
        if (empty($post_type)) {
            return;
        }

        $this->check_add_post_type($post_type);

        if (!$this->isset_args($post_type)) {
            $args = wp_parse_args($args, $this->default_args);
            $args['opt_name'] = isset($args['opt_name']) ? $args['opt_name'] : '';

            if ($args['opt_name'] == $this->default_args['opt_name']) {
                $args['opt_name'] = $this->default_args['opt_name'] . '_postmeta_' . $post_type;
            }

            $metabox_args = wp_parse_args($metabox_args, array(
                'context' => 'advanced',
                'priority' => 'default'
            ));

            if (!in_array($metabox_args['context'], array('normal', 'advanced', 'side'))) {
                $metabox_args['context'] = 'advanced';
            }

            if (!in_array($metabox_args['priority'], array('high', 'core', 'default', 'low'))) {
                $metabox_args['priority'] = 'default';
            }

            $args['metabox_context'] = $metabox_args['context'];
            $args['metabox_priority'] = $metabox_args['priority'];

            $this->panels[$post_type]['args'] = $args;
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
        $this->default_args['opt_name'] = isset($this->default_args['opt_name']) ? $this->default_args['opt_name'] . '_post_metabox' : 'cms_post_metabox';
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
     * Add section to the panel for post type
     *
     * @since 1.0
     * @access public
     *
     * @param string $post_type
     * @param array $section
     */
    function add_section($post_type, $section = array())
    {
        if (empty($post_type) || empty($section) || empty($section['fields'])) {
            return;
        }

        if (!isset($this->field_ids[$post_type])) {
            $this->field_ids[$post_type] = array();
        }

        $this->check_add_post_type($post_type);

        // Store all the field ids, also unset fields from section which are aready registered for the post type
        foreach ($section['fields'] as $fkey => $field) {
            if (empty($field) || empty($field['id'])) {
                continue;
            }

            if (in_array($field['id'], $this->field_ids[$post_type])) {
                trigger_error(esc_html__('The field with id', CMS_TEXT_DOMAIN) . ' ' . esc_html($field['id']) . ' ' . esc_html__('for post type', CMS_TEXT_DOMAIN) . ' ' . esc_html($post_type) . ' ' . esc_html__('is already registered.', CMS_TEXT_DOMAIN));
                unset($section['fields'][$fkey]);
                continue;
            }

            $this->field_ids[$post_type][] = $field['id'];
        }

        if (!isset($this->panels[$post_type]['sections'])) {
            $this->panels[$post_type]['sections'] = array();
        }

        if (!empty($section['id'])) {
            if ($this->section_exist($section['id'], $post_type)) {
                trigger_error(esc_html__('Section', CMS_TEXT_DOMAIN) . ' ' . esc_html($field['id']) . ' ' . esc_html__('for post type', CMS_TEXT_DOMAIN) . ' ' . esc_html($post_type) . ' ' . esc_html__('is already registered.', CMS_TEXT_DOMAIN));

                return;
            } else {
                $this->panels[$post_type]['sections'][$section['id']] = $section;
            }
        } else {
            $this->panels[$post_type]['sections'][] = $section;
        }
    }

    /**
     * Remove section by its id from post type
     *
     * @since 1.0
     * @access public
     *
     * @param  string $section_id
     * @param  string $post_type
     */
    function remove_section($section_id, $post_type)
    {
        if (!$this->section_exist($section_id, $post_type)) {
            return;
        }

        unset($this->panels[$post_type]['sections'][$section_id]);

        $this->check_remove_post_type($post_type);
    }

    /**
     * Check if a section for post type exist.
     *
     * @since 1.0
     * @access public
     *
     * @param  string $section_id
     * @param  string $post_type
     */
    function section_exist($section_id, $post_type)
    {
        if (empty($this->panels[$post_type]) || empty($this->panels[$post_type]['sections'])) {
            return false;
        }

        if (array_key_exists($section_id, $this->panels[$post_type]['sections'])) {
            return true;
        }

        return false;
    }

    /**
     * Check whenever we need to add post type to our storage. If addable then we will add it.
     *
     * @since 1.0
     * @access protected
     *
     * @param  string $post_type
     */
    protected function check_add_post_type($post_type)
    {
        if (!in_array($post_type, $this->post_types)) {
            $this->post_types[] = $post_type;
        }
    }

    /**
     * Check whenever we need to remove panel from post type.
     *
     * @since 1.0
     * @access protected
     *
     * @param  string $post_type
     */
    protected function check_remove_post_type($post_type)
    {
        if (isset($this->panels[$post_type])) {
            if (empty($this->panels[$post_type]['args']) || empty($this->panels[$post_type]['sections'])) {
                unset($this->panels[$post_type]);
            }
        }
    }

    /**
     * Hooked into add_meta_boxes - 10
     *
     * @since 1.0
     * @access public
     */
    function add_meta_boxes()
    {
        $post_formats = array();
        $post_formats_list = get_theme_support('post-formats');
        if ($post_formats_list !== false) {
            $post_formats = $post_formats_list[0];
        }
        foreach ($this->panels as $post_type => $panel) {
            if ($post_type !== 'post') {
                if (empty($panel['args']) || empty($panel['sections'])) {
                    continue;
                }
                $priority = 'default';
                $new_post_type = $post_type;
                if (in_array(str_replace('cms_pf_', '', $new_post_type), $post_formats) !== false) {
                    $new_post_type = 'post';
                    $priority = 'core';
                }
                add_meta_box(
                    $panel['args']['opt_name'],
                    $panel['args']['display_name'],
                    array($this, 'generate_panel'),
                    $new_post_type,
                    'advanced',
                    $priority,
                    array('p' => $post_type)
                );
                update_option($panel['args']['opt_name'], $this->get_values());
                $this->list_screen[] = $panel['args']['opt_name'];
                add_filter("postbox_classes_{$post_type}_{$panel['args']['opt_name']}", array(
                    $this,
                    'meta_box_class'
                ));
                add_action("redux/page/{$panel['args']['opt_name']}/enqueue", array($this, 'panel_scripts'));
                add_filter("redux/{$panel['args']['opt_name']}/panel/templates_path", array(
                    $this,
                    'panel_template'
                ));
                add_filter("redux/options/{$panel['args']['opt_name']}/options", array($this, 'get_values'));
                Redux::init($panel['args']['opt_name']);
                add_filter("redux/{$panel['args']['opt_name']}/localize", [$this, 'redux_localize_filter_data']);
            }
        }
        $new_post_type = 'post';
        $panel = !empty($this->panels[$new_post_type]) ? $this->panels[$new_post_type] : array();
        if (isset($this->panels[$new_post_type]) && !empty($panel['args']) && !empty($panel['sections'])) {
            add_meta_box(
                $panel['args']['opt_name'],
                $panel['args']['display_name'],
                array($this, 'generate_panel'),
                $new_post_type,
                'advanced',
                'default',
                array('p' => $new_post_type)
            );
            update_option($panel['args']['opt_name'], $this->get_values());
            $this->list_screen[] = $panel['args']['opt_name'];
            add_filter("postbox_classes_{$new_post_type}_{$panel['args']['opt_name']}", array(
                $this,
                'meta_box_class'
            ));
            add_action("redux/page/{$panel['args']['opt_name']}/enqueue", array($this, 'panel_scripts'));
            add_filter("redux/{$panel['args']['opt_name']}/panel/templates_path", array($this, 'panel_template'));
            add_filter("redux/options/{$panel['args']['opt_name']}/options", array($this, 'get_values'));
            Redux::init($panel['args']['opt_name']);
            add_filter("redux/{$panel['args']['opt_name']}/localize", array($this, 'redux_localize_filter_data'));
        }
    }

    protected $used_localize = array();

    function redux_localize_filter_data1($data)
    {
        if (!empty($this->used_localize)) {
            foreach ($data as $key => $value) {
                $this->used_localize[$key] = array_replace_recursive($this->used_localize[$key], $data[$key]);
            }
        } else {
            $this->used_localize = $data;
        }

        return $this->used_localize;
    }

    function redux_localize_filter_data($data)
    {
        if (!empty($data['required'])) {
            $this->used_localize = $data;

            return $data;
        }
        if (!empty($this->used_localize)) {
            return $this->used_localize;
        }

        return $data;
    }

    function cms_set_user_metaboxes($hidden)
    {
        foreach ($this->list_screen as $post_fm) {
            if (($key = array_search($post_fm, $hidden)) !== false) {
                unset($hidden[$key]);
            }
        }
        return $hidden;
    }

    /**
     * Generate Redux panel for post. Render callback for add_meta_box
     *
     * @since 1.0
     * @access public
     *
     * @param  array $sections
     * @param  array $args
     */
    function generate_panel($post, $args)
    {
        $post_type = (isset($args['args']['p'])) ? $args['args']['p'] : $post->post_type;
        wp_nonce_field('srfmetabox_post_nonce_action', 'srfmetabox_post_nonce');
        $redux = new ReduxFramework($this->panels[$post_type]['sections'], $this->panels[$post_type]['args']);

        $redux->options_class->register(); 
        $redux->enqueue_class->init(); 
        $redux->render_class->generate_panel();
    }

    /**
     * Add extra classes to the metabox for easier styling and scripting.
     * Hooked: postbox_classes_{$post_type}_{$metabox_id] - 10
     *
     * @since 1.0
     * @access public
     *
     * @param  array $classes
     *
     * @return array
     */
    function meta_box_class($classes)
    {
        $classes[] = 'cms-postbox';

        return $classes;
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
        if ('post.php' !== $pagenow && 'post-new.php' !== $pagenow) {
            return;
        }

//        if ( ! in_array( $this->get_current_post_type(), $this->post_types ) )
//        {
//            return;
//        }
//        die();

        wp_enqueue_style('cms-metabox', CMS_URL . '/assets/css/metabox' . Redux_Functions::isMin() . '.css', array(), self::$version, 'all');
        wp_enqueue_script('cms-metabox', CMS_URL . '/assets/js/metabox' . Redux_Functions::isMin() . '.js', array(
            'jquery',
            'redux-js'
        ), self::$version, 'all');

        wp_localize_script(
            'cms-metabox',
            'EFrameworkMetaboxLocalize',
            $this->localize_script
        );
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
     *
     * @param  array $options The original option values
     *
     * @return array
     */
    function get_values($options = [])
    {
        $data = $this->get_metadata();

        if (empty($data)) {
            return array();
        }

        return $data;
    }

    /**
     * Get meta data from post based on post_id.
     *
     * @since 1.0
     * @access public
     *
     * @param  int $post_id
     *
     * @return array
     */
    protected
    function get_metadata(
        $post_id = null
    )
    {
        global $post, $pagenow;
        $data = array();

        if (!isset($post_id)) {
            if (is_admin()) {
                if (!$post || empty($post->ID) || !$pagenow || ('post.php' != $pagenow && 'post-new.php' != $pagenow)) {
                    return $data;
                }

                $post_id = $post->ID;
            } else {
                if (!is_singular()) {
                    return $data;
                }

                $term = get_queried_object();

                if (!$term) {
                    return $data;
                }

                $term_id = $term->term_id;
            }
        }

        $_custom = get_post_custom($post_id);

        if (empty($_custom)) {
            return $data;
        }

        foreach ($_custom as $key => $value) {
            $data[$key] = maybe_unserialize($value[0]);
        }

        return $data;
    }

    /**
     * Get all default value of registered fields for the post type
     *
     * @since 1.0
     * @access protected
     *
     * @param  string $post_type
     *
     * @return array
     */
    protected
    function get_opt_defaults(
        $post_type
    )
    {
        if (!array_key_exists($post_type, $this->panels) || empty($this->panels[$post_type]['sections'])) {
            return array();
        }

        $opts = array();

        foreach ($this->panels[$post_type]['sections'] as $sid => $section) {
            if (empty($section['fields'])) {
                continue;
            }

            foreach ($section['fields'] as $fkey => $field) {
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
     * Get current post type.
     *
     * @since 1.0
     * @access protected
     * @return string
     */
    protected
    function get_current_post_type()
    {
        global $pagenow;

        $post_type = null;

        if (!is_admin()) {
            if (is_singular()) {
                $post_type = get_post_type();
            }
        } elseif ('post.php' === $pagenow || 'post-new.php' === $pagenow) {
            if (function_exists('get_current_screen') && $screen = get_current_screen()) {
                $post_type = $screen->post_type;
            } else {
                $post_id = isset($_GET['post']) ? (int)$_GET['post'] : 0;

                if ($post_id) {
                    $post_type = get_post_type($post_id);
                } elseif (isset($_GET['post_type'])) {
                    $post_type = sanitize_text_field(wp_unslash($_GET['post_type']));
                } else {
                    $post_type = 'post';
                }
            }
        }

        return $post_type;
    }

    /**
     * Get all registered sections of the post type
     *
     * @since 1.0
     * @access protected
     *
     * @param  string $post_type
     *
     * @return array
     */
    protected
    function get_opt_sections(
        $post_type
    )
    {
        if (array_key_exists($post_type, $this->panels) && !empty($this->panels[$post_type]['sections'])) {
            return $this->panels[$post_type]['sections'];
        }

        return array();
    }

    /**
     * Get registered args of the post type
     *
     * @since 1.0
     * @access protected
     *
     * @param  string $post_type
     *
     * @return array
     */
    protected
    function get_opt_args(
        $post_type
    )
    {
        if ($this->isset_args($post_type)) {
            return $this->panels[$post_type]['args'];
        }

        return array();
    }

    /**
     * Save post hook - 10
     *
     * @since 1.0
     * @access public
     *
     * @param  int $post_id
     * @param  WP_Post $post
     */
    function save_meta_boxes($post_id, $post)
    {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        // Check the user's permissions.
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        do_action('cms_pre_save_post');

        if (!isset($_POST['srfmetabox_post_nonce']) || !wp_verify_nonce(sanitize_key(wp_unslash($_POST['srfmetabox_post_nonce'])), 'srfmetabox_post_nonce_action')) {
            return;
        }

        $opt_name = '';
        $data_to_save = [];

        $post_type = sanitize_text_field(wp_unslash($_POST['post_type']));
        if (in_array($post_type, $this->post_types) && !empty($_POST[$this->panels[$post_type]['args']['opt_name']])) {

            $opt_name = $this->panels[$post_type]['args']['opt_name'];

            $sections = $this->get_opt_sections($post_type);
            $args = $this->get_opt_args($post_type);
            $data_to_save = array();
            $data_to_compare = $this->get_opt_defaults($post_type);
            if (empty($sections) || empty($args)) {
                return;
            }
            foreach ($_POST[$args['opt_name']] as $key => $data) {
                if (is_array($data)) {
                    foreach ($data as $dindex => $value) {
                        if (!is_array($value)) {
                            $data[$dindex] = stripslashes($value);
                        }
                    }
                }

                $data_to_save[$key] = $data;
            }

            $redux = new ReduxFramework($sections, $args);
            $validate = $redux->_validate_values($data_to_save, $data_to_compare, $sections);

            // Validate field value. Just in case, bypass invalid values.
            // Also check if field id is registered or not.
            foreach ($data_to_save as $key => $value) {
                if (isset($validate[$key])) {
                    if ($validate[$key] != $data_to_save[$key]) {
                        $data_to_save[$key] = $validate[$key];
                    }
                } else {
                    unset($data_to_save[$key]);
                }

                $prev_value = isset($prev_data[$post_id][$key]) ? $prev_data[$post_id][$key] : '';

                // Only use registered field ids.
                if (array_key_exists($key, $data_to_compare)) {
                    // If it is validated, save it.
                    if (isset($data_to_save[$key])) {
                        update_post_meta($post_id, $key, $data_to_save[$key], $prev_value = '');
                    }
                }
            }

            //Delete post meta is empty
            foreach ($data_to_compare as $key => $value) {
                if (!array_key_exists($key, $data_to_save)) {
                    delete_post_meta($post_id, $key);
                }
            }
        }

        /**
         * Save post format data
         */
        $post_format = !empty($_REQUEST['post_format']) ? $_REQUEST['post_format'] : '';
        if (!empty($post_format)) {
            $cms_pf_panel = 'cms_pf_' . $post_format;
            $post_format_type = !empty($_POST['post_format_' . $post_format]) ? $_POST['post_format_' . $post_format] : '';
            if (in_array($cms_pf_panel, $this->post_types) && !empty($_POST[$this->panels[$cms_pf_panel]['args']['opt_name']]) && !empty($post_format_type)) {
                $sections_post_format = $this->get_opt_sections($cms_pf_panel);
                $args_post_format = $this->get_opt_args($cms_pf_panel);
                $data_to_save_pfm = array();
                $data_to_compare_pfm = $this->get_opt_defaults($cms_pf_panel);
                foreach ($_POST[$args_post_format['opt_name']] as $key => $data) {
                    if (is_array($data)) {
                        foreach ($data as $dindex => $value) {
                            if (!is_array($value)) {
                                $data[$dindex] = stripslashes($value);
                            }
                        }
                    }

                    $data_to_save_pfm[$key] = $data;
                }

                $redux = new ReduxFramework($sections_post_format, $args_post_format);
                $validate_pfm = $redux->_validate_values($data_to_save_pfm, $data_to_compare_pfm, $sections_post_format);

                foreach ($data_to_save_pfm as $key => $value) {
                    if (isset($validate_pfm[$key])) {
                        if ($validate_pfm[$key] != $data_to_save_pfm[$key]) {
                            $data_to_save_pfm[$key] = $validate_pfm[$key];
                        }
                    } else {
                        unset($data_to_save_pfm[$key]);
                    }

                    $prev_value = isset($prev_data[$post_id][$key]) ? $prev_data[$post_id][$key] : '';

                    // Only use registered field ids.
                    if (array_key_exists($key, $data_to_compare_pfm)) {
                        // If it is validated, save it.
                        if (isset($data_to_save_pfm[$key])) {
                            update_post_meta($post_id, $key, $data_to_save_pfm[$key], $prev_value = '');
                        }
                    }
                }

                $data_to_save = $data_to_save_pfm;
            }
        }
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

            set_transient('cms-post-metabox-transients', $notices);
        }

        // save option with opt_name
        if(!empty($opt_name)){
            update_option($opt_name, $data_to_save);
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
        if (empty($this->notices) || !is_array($this->notices)) {
            return;
        }

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
     * Enqueue output css generated by Redux. Hooked into wp_head
     *
     * @since 1.0
     * @access public
     */
    function enqueue_output()
    {
        global $post;
        if (is_admin()) {
            return;
        }
        if (!is_singular()) {
            if (!is_archive() && is_home() && !is_front_page()) {
                $page_for_posts = get_option('page_for_posts');
                $id = $page_for_posts;
            } else {
                return;
            }
        } else {
            $id = $post->ID;
        }
        if (!isset($post->post_type) || !in_array($post->post_type, $this->post_types)) {
            return;
        }
        $this->generate_output_css(get_post($id), $this->get_metadata($id));
    }

    /**
     * Render css output
     *
     * @since  1.0
     * @access protected
     */
    protected function generate_output_css( $post, $options ){
        $redux = new ReduxFramework([], [
            'opt_name'             => $post->post_type . '_generate_output_css',
        ]);
        $redux->sections = $this->get_opt_sections($post->post_type);
        $redux->options = $options;
        if (array_key_exists($post->post_type, $this->panels) && !empty($this->panels[$post->post_type]['args'])) {
            $redux->args = $this->panels[$post->post_type]['args'];
        }
        $redux->output_class->enqueue();

        if (!$redux->outputCSS) {
            return;
        }

        printf(
            '<style id="%1$s" data-type="redux-output-css">%2$s</style>',
            esc_attr('cms-' . $post->post_type . '-dynamic-css'),
            $redux->outputCSS
        );
    }
}