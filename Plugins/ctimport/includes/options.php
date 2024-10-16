<?php
/**
 * @Template: options.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 16-Nov-17
 */

if (!defined('ABSPATH')) die();

/**
 * theme_core_ie_options_export
 * @descriptions: Export options data of WP Settings
 * @param: $file
 */
function ct_ie_options_export($file)
{
    global $wp_filesystem;

    $upload_dir = wp_upload_dir();

    $options = array();

    /* default. */
    $options['home'] = theme_core_ie_options_get_home_page();
    $options['menus'] = theme_core_ie_options_get_menus();
    $options['opt-name'] = ct_ie_setting_get_opt_name($file);
    $options['export'] = !empty($_POST['abcore-ie-data-type']) ? $_POST['abcore-ie-data-type'] : array();

    /* wp options */
    $options['wp-options'] = theme_core_ie_options_get_wp_options(apply_filters('theme_core_ie_options_wp_options', array()));

    /* attachment */
    if (file_exists($upload_dir['basedir'] . '/ct-attachment-tmp.zip'))
        $options['attachment'] = $upload_dir['baseurl'] . '/ct-attachment-tmp.zip';

    $wp_filesystem->put_contents($file, json_encode($options), FS_CHMOD_FILE);
}

function theme_core_ie_options_get_home_page()
{

    $home_id = get_option('page_on_front');

    if (!$home_id)
        return null;

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'page_id' => $home_id));

    if (!$page->post)
        return null;

    return $page->post->post_name;
}

function theme_core_ie_options_get_menus()
{

    $theme_locations = get_nav_menu_locations();

    if (empty($theme_locations))
        return null;

    foreach ($theme_locations as $key => $id) {
        $menu_object = wp_get_nav_menu_object($id);
        $theme_locations[$key] = $menu_object->slug;
    }

    return $theme_locations;
}

function theme_core_ie_options_get_wp_options($options = array())
{
    if (empty($options))
        return $options;

    $_options = array();

    foreach ($options as $key) {
        $_options[$key] = get_option($key);
    }

    return $_options;
}


/**
 * Import wp options functions
 * @param $options
 */
function ct_ie_options_import($options)
{
    global $import_result;
    foreach ($options as $key => $option) {
        switch ($key) {
            case 'home':
                ct_ie_options_set_home_page($option);
                $import_result[] = esc_html__('Set home page successfully!', 'swa-ie');
                break;
            case 'menus':
                ct_ie_options_set_menus($option);
                $import_result[] = esc_html__('Import menus successfully!', SWA_TEXT_DOMAIN);
                break;
            case 'wp-options':
                ct_ie_options_set_wp_options($option);
                $import_result[] = esc_html__('Import wp options successfully!', SWA_TEXT_DOMAIN);
                break;
        }
    }
}

function ct_ie_options_set_home_page($slug)
{

    $page = new WP_Query(array('post_type' => 'page', 'posts_per_page' => 1, 'name' => $slug));

    if (!$page->post)
        return null;

    update_option('show_on_front', 'page');
    update_option('page_on_front', $page->post->ID);
}

function ct_ie_options_set_menus($menus)
{
    if (!empty($menus)) {
        $new_setting = array();
        foreach ($menus as $key => $menu) {

            $_menu = get_term_by('slug', $menu, 'nav_menu');
            if ($_menu !== false) {
                $new_setting[$key] = $_menu->term_id;
            }
        }

        set_theme_mod('nav_menu_locations', $new_setting);

    }
}

function ct_ie_options_set_wp_options($options = array())
{
    if (empty($options))
        return;

    foreach ($options as $key => $value) {
        update_option($key, $value);
    }
}
