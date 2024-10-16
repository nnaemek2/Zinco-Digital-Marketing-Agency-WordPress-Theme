<?php
/**
 * Class EFramework_enqueue_scripts
 * @author: CaseThemes
 * Version: 1.0.0
 * Create: 11 November, 2017
 */
if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('EFramework_enqueue_scripts')) {
    class EFramework_enqueue_scripts
    {
        public function __construct()
        {
            add_action('admin_enqueue_scripts', array($this, 'cms_admin_enqueue_scripts'));
            add_action('wp_enqueue_scripts', array($this, 'cms_front_enqueue_scripts'));
        }

        public function cms_admin_enqueue_scripts()
        {
            global $pagenow;
            if (!empty($pagenow) && ($pagenow === 'post.php' && !empty($_REQUEST['post'])) || $pagenow === 'post-new.php') {
                $post_format = '';
                if (!empty($_REQUEST['post'])) {
                    $id = esc_attr(wp_unslash(intval($_REQUEST['post'])));
                    $post_format = get_post_format($id);
                }
                wp_enqueue_script('post-format.js', casethemescore()->path('APP_URL') . '/assets/js/post-format' . casethemescore()->is_min() . '.js', '', 'all', true);
                if(!empty($post_format)){
                    wp_localize_script('post-format.js', 'post_format', $post_format);
                }
            }
            wp_register_script('cms_google_map_api', 'https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBj8MHRhbOnyMVrmuCLj-06J31W8fvKKW8', array(), true);
            wp_enqueue_script('cms_google_map_api');
        }

        public function cms_front_enqueue_scripts(){
            wp_enqueue_script('ct-front-js',casethemescore()->path('APP_URL') . '/assets/js/ct-front.js',array('jquery'),'all',true );
        }

    }
}
new EFramework_enqueue_scripts();