<?php
/**
 * @Template: extra-functions.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 27-Nov-17
 */
if (!defined('ABSPATH')) {
    die();
}
if (!function_exists('ct_ie_export_demo_info')) {
    function ct_ie_export_demo_info($file, $demo_info = array())
    {
        if (!empty($demo_info)) {
            global $wp_filesystem;
            $file_contents = json_encode($demo_info);
            $wp_filesystem->put_contents($file, $file_contents, FS_CHMOD_FILE);
        }
    }
}

if (!function_exists('ct_ie_extra_options_export')) {
    /**
     * @function theme_core_ie_extra_options_export
     * @param $file
     * @param array $options
     */
    function ct_ie_extra_options_export($file, $options = array())
    {
        if (!empty($options)) {
            global $wp_filesystem;
            $file_contents = array();

            foreach ($options as $option_name) {
                $file_contents[$option_name] = get_option($option_name);
            }

            if ($file_contents !== false) {
                $file_contents = json_encode($file_contents);
                $wp_filesystem->put_contents($file, $file_contents, FS_CHMOD_FILE);
            }
        }
    }
}

if (!function_exists('ct_ie_extra_options_import')) {
    /**
     * @function theme_core_ie_extra_options_import
     * @param $file
     * @param array $options
     */
    function ct_ie_extra_options_import($file)
    {
        global $import_result;
        if (file_exists($file)) {
            $file_contents = json_decode(file_get_contents($file), true);
            foreach ($file_contents as $option_name => $option_values) {
                update_option($option_name, $option_values);
                $import_result[] = 'Import values to option key "' . $option_name . '" successfully!';
            }
        }
    }
}


/**
 * check and create folder.
 *
 * @param $folder_name
 * @return string folder dir
 */
function ct_ie_process_demo_folder($folder_name)
{

    if (!is_dir(swa_ie()->theme_dir . $folder_name))
        wp_mkdir_p(swa_ie()->theme_dir . $folder_name);

    return trailingslashit(swa_ie()->theme_dir . $folder_name);
}