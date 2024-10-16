<?php

if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('EFramework_menu_handle')) {
    class EFramework_menu_handle
    {
        /**
         * EFramework_menu_handle->theme_name
         * private
         * @var string
         */
        protected $theme_name = '';

        /**
         * EFramework_menu_handle->theme_text_domain
         * private
         * @var string
         */
        protected $theme_text_domain = '';

        public function __construct()
        {
            $current_theme = wp_get_theme();
            $this->theme_name = $current_theme->get('Name');
            $this->theme_text_domain = $current_theme->get('TextDomain');

            add_action('admin_menu', array($this, 'cms_add_menu'));

            add_action('admin_bar_menu', array($this, 'cms_add_admin_bar_menu'), 100);

        }

        public function cms_add_menu()
        {
            add_menu_page($this->theme_name, $this->theme_name, 'manage_options', $this->theme_text_domain, array($this, 'cms_create_theme_dashboard'), 'dashicons-admin-generic', 3);

            add_submenu_page($this->theme_text_domain, $this->theme_name, esc_html__('Dashboard', CMS_TEXT_DOMAIN), 'manage_options', $this->theme_text_domain, array($this, 'cms_create_theme_dashboard'));

        }

        public function cms_create_theme_dashboard()
        {
            $docs_link = apply_filters('cms_documentation_link', '#');
            $ticket_link = apply_filters('cms_ticket_link', array('type' => 'url', 'link' => '#'));
            $video_link = apply_filters('cms_video_tutorial_link','#');
            include_once casethemescore()->path('APP_DIR', 'templates/dashboard/dashboard.php');
        }

        function cms_add_admin_bar_menu($wp_admin_bar)
        {
            $theme = wp_get_theme();
            /**
             * Add "Theme Name" parent node
             */
            $args = array(
                'id'    => $theme->get("TextDomain"),
                'title' => '<span class="ab-icon dashicons-smiley"></span>' . $theme->get("Name"),
                'href'  => admin_url('admin.php?page=' . $theme->get("TextDomain")),
                'meta'  => array(
                    'class' => 'dashicons dashicons-admin-generic',
                    'title' => $theme->get("TextDomain"),
                )
            );
            $wp_admin_bar->add_node($args);
            /**
             * Add Dashboard children node
             */
            $args = array(
                'id'     => 'dashboard',
                'title'  => esc_html__('Dashboard', CMS_TEXT_DOMAIN),
                'href'   => admin_url('admin.php?page=' . $theme->get("TextDomain")),
                'parent' => $theme->get("TextDomain"),
                'meta'   => array(
                    'class' => '',
                    'title' => esc_html__('Dashboard', CMS_TEXT_DOMAIN),
                )
            );
            $wp_admin_bar->add_node($args);

            /**
             * Add Import Export children node
             */
            if (class_exists('SWA_Import_Export')) {
                $args = array(
                    'id'     => 'swa-import',
                    'title'  => esc_html__('Import Demo', CMS_TEXT_DOMAIN),
                    'href'   => admin_url('admin.php?page=swa-import'),
                    'parent' => $theme->get("TextDomain"),
                    'meta'   => array(
                        'class' => '',
                        'title' => esc_html__('Import Demo', CMS_TEXT_DOMAIN),
                    )
                );
                $wp_admin_bar->add_node($args);
            }
            /**
             * Add Theme options children node
             */
            if (class_exists('ReduxFramework')) {
                $args = array(
                    'id'     => 'theme-options',
                    'title'  => esc_html__('Theme Options', CMS_TEXT_DOMAIN),
                    'href'   => admin_url('admin.php?page=theme-options'),
                    'parent' => $theme->get("TextDomain"),
                    'meta'   => array(
                        'class' => '',
                        'title' => esc_html__('Import Demos', CMS_TEXT_DOMAIN),
                    )
                );
                $wp_admin_bar->add_node($args);
            }


        }
    }
}
new EFramework_menu_handle();