<?php
/**
 * @Template: class-user-meta.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 29-Jan-18
 */
if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('CMS_User_Meta')) {
    class CMS_User_Meta
    {
        protected $default_args = array();

        protected $box_name = array();

        protected $panels = array();

        protected $field_ids = array();

        public function __construct($redux)
        {
            $this->optimize_default_args();
            do_action('cms_user_meta', $this);
            if (empty($this->box_name) || empty($this->panels)) {
                return;
            }
            add_action('admin_init', array($this, 'admin_init'));

        }

        function admin_init()
        {
            foreach ($this->panels as $taxonomy => $user_panel) {
                if (empty($user_panel['args']['opt_name'])) {
                    continue;
                }
                echo '<pre>';
                var_dump($user_panel);
                echo '</pre>';
//                add_action('user_new_form', array($this, 'cms_add_profile_fields'));
//                add_action('user_register', array($this, 'cms_save_new_profile_fields'));
//                add_action('show_user_profile', array($this, 'cms_add_profile_fields'));
//                add_action('edit_user_profile', array($this, 'cms_add_profile_fields'));
//                add_action('personal_options_update', array($this, 'cms_save_profile_fields'));
//                add_action('edit_user_profile_update', array($this, 'cms_save_profile_fields'));
//
                add_action("redux/page/{$user_panel['args']['opt_name']}/enqueue", array($this, 'panel_scripts'));
                add_filter("redux/{$user_panel['args']['opt_name']}/panel/templates_path", array($this, 'panel_template'));
                add_filter("redux/options/{$user_panel['args']['opt_name']}/options", array($this, 'get_values'));
            }
        }


        protected function optimize_default_args()
        {
            $this->default_args = array(
                'opt_name'             => 'cms_user_meta_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'         => esc_html__('Extended Profile', CMS_TEXT_DOMAIN),
                // Name that appears at the top of your panel
                'display_version'      => '1.0.0',
                // Version that appears at the top of your panel
                'menu_type'            => 'submenu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'       => true,
                // Show the sections below the admin menu item or not
                'menu_title'           => __('Settings', CMS_TEXT_DOMAIN),
                'page_title'           => __('Settings', CMS_TEXT_DOMAIN),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'       => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography'     => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'            => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon'       => 'dashicons-admin-generic',
                // Choose an icon for the admin bar menu
                'admin_bar_priority'   => 50,
                // Choose an priority for the admin bar menu
                'global_variable'      => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'             => false,
                // Show the time the page took to load, etc
                'update_notice'        => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer'           => true,
                // Enable basic customizer support
                'open_expanded'        => false,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'        => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'          => '',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'     => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'            => '',
                // Specify a custom URL to an icon
                'last_tab'             => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'            => '',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'            => 'cms-user-meta-settings',
                // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
                'save_defaults'        => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'         => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'         => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export'   => false,
                // Shows the Import/Export panel when not used as a field.
                'show_options_object'  => true,
                // CAREFUL -> These options are for advanced use only
                'transient_time'       => 60 * MINUTE_IN_SECONDS,
                'output'               => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'           => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'             => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'use_cdn'              => true,
                // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
                'templates_path'       => casethemescore()->path('APP_DIR') . '/templates/panel-post-meta'
            );
        }

        public function set_args($box_name, $args = array())
        {
            if (empty($box_name)) {
                return;
            }

            if (!in_array($box_name, $this->box_name)) {
                $this->box_name[] = $box_name;
            }

            if (!$this->isset_args($box_name)) {
                $args = wp_parse_args($args, $this->default_args);
                $args['opt_name'] = isset($args['opt_name']) ? $args['opt_name'] : '';

                if ($args['opt_name'] == $this->default_args['opt_name']) {
                    $args['opt_name'] = $this->default_args['opt_name'] . '_usermeta_' . $box_name;
                }

                $this->panels[$box_name]['args'] = $args;
            }
        }

        public function isset_args($box_name)
        {
            if (!array_key_exists($box_name, $this->panels) || empty($this->panels[$box_name]['args'])) {
                return false;
            }

            return true;
        }

        public function add_section($box_name, $section = array())
        {
            if (empty($box_name) || empty($section) || empty($section['id']) || empty($section['fields'])) {
                return;
            }

            if (!isset($this->field_ids[$box_name])) {
                $this->field_ids[$box_name] = array();
            }
            foreach ($section['fields'] as $fkey => $field) {
                if (empty($field) || empty($field['id'])) {
                    continue;
                }

                if (in_array($field['id'], $this->field_ids[$box_name])) {
                    trigger_error(sprintf(esc_html__('The field with id %1$s for user metabox %2$s is already registered.', CMS_TEXT_DOMAIN), esc_html($field['id'], CMS_TEXT_DOMAIN), esc_html($box_name, CMS_TEXT_DOMAIN)));
                    unset($section['fields'][$fkey]);
                    continue;
                }

                $this->field_ids[$box_name][] = $field['id'];
            }

            if (!isset($this->panels[$box_name]['sections'])) {
                $this->panels[$box_name]['sections'] = array();
            }

            if (!empty($section['id'])) {
                if ($this->section_exist($section['id'], $box_name)) {
                    trigger_error(sprintf(esc_html__('Section %1$s for for user metabox %2$s is already exist.', CMS_TEXT_DOMAIN), esc_html($field['id']), esc_html($box_name)));
                    return;
                } else {
                    $this->panels[$box_name]['sections'][$section['id']] = $section;
                }
            } else {
                $this->panels[$box_name]['sections'][] = $section;
            }
        }

        function section_exist($section_id, $box_name)
        {
            if (empty($this->panels[$box_name]) || empty($this->panels[$box_name]['sections'])) {
                return false;
            }

            if (array_key_exists($section_id, $this->panels[$box_name]['sections'])) {
                return true;
            }

            return false;
        }

        function panel_scripts()
        {
            global $pagenow;

            if ('user-new.php' !== $pagenow && 'profile.php' !== $pagenow) {
                return;
            }

            wp_enqueue_style('cms-metabox', casethemescore()->path('APP_URL') . '/assets/css/metabox' . Redux_Functions::isMin() . '.css', array(), 'all');
            wp_enqueue_script('cms-metabox', casethemescore()->path('APP_URL') . '/assets/js/metabox' . Redux_Functions::isMin() . '.js', array('jquery', 'redux-js'), 'all', true);
        }

        function panel_template()
        {
            return casethemescore()->path('APP_DIR') . '/templates/panel-post-meta';
        }

        function get_values($options)
        {
            $data = $this->get_metadata();

            if (empty($data)) {
                return array();
            }

            return $data;
        }

        function cms_add_profile_fields($user = null)
        {
            if (empty($user->ID)) {
                return;
            }
            ?>
            <h3><?php echo esc_html__('Extra profile information', 'property') ?></h3>
            <table class="form-table">
                <tr>
                    <th><label for="pp_user_phone">Phone</label></th>
                    <td>
                        <input type="text" name="pp_user_phone" id="pp_user_phone"
                               value="<?php echo !empty($user->ID) ? esc_attr(get_user_meta($user->ID, 'pp_user_phone', true)) : ""; ?>"
                               class="regular-text"/><br/>
                        <span class="description">Please enter your phone.</span>
                    </td>
                </tr>
                <tr>
                    <th><label for="pp_user_address">Address</label></th>
                    <td>
                        <input type="text" name="pp_user_address" id="pp_user_address"
                               value="<?php echo !empty($user->ID) ? esc_attr(get_user_meta($user->ID, 'pp_user_address', true)) : ""; ?>"
                               class="regular-text"/><br/>
                        <span class="description">Please enter your location.</span>
                    </td>
                    <script>
                        var input = document.getElementById('pp_user_address');
                        var autocomplete = new google.maps.places.Autocomplete(input);
                    </script>
                </tr>
                <tr>
                    <th><label for="pp_user_logo">Logo</label></th>
                    <td>
                        <div class="thumbnails">

                            <div class="thumbnails_button materialize">
                                <a class="btn btn-success waves-effect button_thumbnail"
                                   data-title="<?php esc_html_e('Choose or Upload Image', 'property') ?>"
                                   data-button="<?php esc_html_e('Use this image', 'property') ?>"
                                   data-multiple="false"> <i class="dashicons dashicons-plus"
                                                             style="top:0px;vertical-align:middle;"></i> <?php esc_html_e('Add logo', 'property') ?>
                                </a>
                            </div>
                            <div class="thumbnails_images_container">
                                <ul class="thumbnails_images">
                                    <?php if (!empty($logo)): ?>
                                        <li class="image" data-attachment_id="<?php echo $logo; ?>">
                                            <div class="picture"><?php echo wp_get_attachment_image($logo, array(78, 78)); ?></div>
                                            <img src="<?php echo property()->plugin_url . 'assets/images/close_red.png' ?>"
                                                 class="remove_button" style="">
                                        </li>
                                    <?php
                                    endif
                                    ?>
                                </ul>
                                <input type="hidden" name="pp_user_logo" class="image_id"
                                       value="<?php echo esc_attr($logo) ?>"/>
                            </div>
                            <div class="clearfix"></div>
                            <div class="sample" style="display:none">
                                <li class="image" data-attachment_id="">
                                    <div class="picture"><img src="" alt=""></div>
                                    <img src="<?php echo property()->plugin_url . 'assets/images/close_red.png' ?>"
                                         class="remove_button" style="">
                                </li>
                            </div>
                        </div>
                        <span class="description">Please select your logo.</span>
                    </td>
                </tr>
            </table>
            <?php
        }
    }
}