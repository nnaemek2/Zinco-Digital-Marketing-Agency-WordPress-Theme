<?php
/**
 * @Template: wp-reset.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 28-Feb-18
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed this file directly
}

if (is_admin() && !class_exists('SWA_Reset')) {

    class SWA_Reset
    {

        public function __construct()
        {
            add_action('admin_init', array($this, 'swa_reset_init'));
        }

        function swa_reset_init()
        {
            global $current_user;
            /**
             * Remove demo data
             */
            if (!empty($_REQUEST['swa-ie-id']) && isset($_POST['_wp_nonce']) && wp_verify_nonce($_POST['_wp_nonce'], 'swa-reset') && $_REQUEST['action'] === 'swa-reset') {
                require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

                $blogname = get_option('blogname');
                $blog_public = get_option('blog_public');

                if ($current_user->user_login != 'admin')
                    $user = get_user_by('login', 'admin');

                if (empty($user->user_level) || $user->user_level < 10)
                    $user = $current_user;

                global $wpdb;

                $prefix = str_replace('_', '\_', $wpdb->prefix);
                $tables = $wpdb->get_col("SHOW TABLES LIKE '{$prefix}%'");
                foreach ($tables as $table) {
                    $wpdb->query("DROP TABLE $table");
                }

                $result = wp_install($blogname, $user->user_login, $user->user_email, $blog_public);
                extract($result, EXTR_SKIP);

                $query = $wpdb->prepare("UPDATE $wpdb->users SET user_pass = '" . $user->user_pass . "', user_activation_key = '' WHERE ID =  '" . $user_id . "' ");
                $wpdb->query($query);

                $get_user_meta = function_exists('get_user_meta') ? 'get_user_meta' : 'get_usermeta';
                $update_user_meta = function_exists('update_user_meta') ? 'update_user_meta' : 'update_usermeta';

                if ($get_user_meta($user_id, 'default_password_nag'))
                    $update_user_meta($user_id, 'default_password_nag', false);

                if ($get_user_meta($user_id, $wpdb->prefix . 'default_password_nag'))
                    $update_user_meta($user_id, $wpdb->prefix . 'default_password_nag', false);

                wp_clear_auth_cookie();

                wp_set_auth_cookie($user_id);

                wp_redirect(admin_url());

                exit();
            }
        }
    }

    new SWA_Reset();
}