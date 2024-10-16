<?php
/**
 * @Template: widgets.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 17-Nov-17
 */
function theme_core_ie_widgets_generate_export_data()
{

    // Get all available widgets site supports
    $available_widgets = theme_core_ie_available_widgets();

    // Get all widget instances for each widget
    $widget_instances = array();
    foreach ($available_widgets as $widget_data) {

        // Get all instances for this ID base
        $instances = get_option('widget_' . $widget_data['id_base']);

        // Have instances
        if (!empty($instances)) {

            // Loop instances
            foreach ($instances as $instance_id => $instance_data) {

                // Key is ID (not _multiwidget)
                if (is_numeric($instance_id)) {
                    $unique_instance_id = $widget_data['id_base'] . '-' . $instance_id;
                    $widget_instances[$unique_instance_id] = $instance_data;
                }

            }

        }

    }

    // Gather sidebars with their widget instances
    $sidebars_widgets = get_option('sidebars_widgets'); // get sidebars and their unique widgets IDs
    $sidebars_widget_instances = array();
    $data = array();
    foreach ($sidebars_widgets as $sidebar_id => $widget_ids) {

        // Skip inactive widgets
        if ('wp_inactive_widgets' == $sidebar_id) {
            continue;
        }

        // Skip if no data or not an array (array_version)
        if (!is_array($widget_ids) || empty($widget_ids)) {
            continue;
        }

        // Loop widget IDs for this sidebar
        foreach ($widget_ids as $widget_id) {

            // Is there an instance for this widget ID?
            if (isset($widget_instances[$widget_id])) {

                // Add to array
                $sidebars_widget_instances[$sidebar_id][$widget_id] = $widget_instances[$widget_id];

                if (strpos($widget_id, 'nav_menu-') !== false) {
                    $menu = wp_get_nav_menu_object($widget_instances[$widget_id]['nav_menu']);
                    if (!empty($menu->slug)) {
                        $data['nav_menu'][$widget_id] = $menu->slug;
                    }
                }

            }

        }

    }

    // Filter pre-encoded data
    $data['sidebars'] = apply_filters('theme_core_ie_unencoded_export_data', $sidebars_widget_instances);

    // Return contents
    return apply_filters('theme_core_ie_generate_export_data', $data);

}

/**
 * Send export file to user
 *
 * Triggered by URL like /wp-admin/tools.php?page=widget-importer-exporter&export=1
 *
 * The data is JSON with .wie extension in order not to confuse export files with other plugins.
 *
 * @since 0.1
 */
function ct_ie_widgets_save_export_file($part)
{
    global $wp_filesystem;

    // Generate export file contents
    $file_contents = theme_core_ie_widgets_generate_export_data();
    if (isset($file_contents['nav_menu'])) {
        $wp_filesystem->put_contents($part . 'widgets.json', json_encode($file_contents['nav_menu']), FS_CHMOD_FILE);
    }
    if (isset($file_contents['sidebars'])) {
        $wp_filesystem->put_contents($part . 'widgets.wie', json_encode($file_contents['sidebars']), FS_CHMOD_FILE);
    }
}

/**
 * Import..........
 */
/**
 * Process import file
 *
 * This parses a file and triggers importation of its widgets.
 *
 * @since 0.3
 * @param string $file Path to .wie file uploaded
 * @global string $theme_core_ie_import_results
 */
function ct_ie_widgets_process_import_file($part)
{

    global $wie_import_results;

    // File exists?
    if (!file_exists($part . 'widgets.wie')) {
        return false;
    }

    $data = array('nav_menu' => array());
    // Get file contents and decode
    $data['sidebars'] = json_decode(file_get_contents($part . 'widgets.wie'));

    if (file_exists($part . 'widgets.json')) {
        $data['nav_menu'] = json_decode(file_get_contents($part . 'widgets.json'));
    }

    // Import the widget data
    // Make results available for display on import/export page
    $wie_import_results = ct_ie_widgets_import_data($data);

}

/**
 * Import widget JSON data
 *
 * @since 0.4
 * @global array $wp_registered_sidebars
 * @param object $data JSON widget data from .wie file
 * @return array Results array
 */
function ct_ie_widgets_import_data($data)
{

    global $wp_registered_sidebars;

    // Have valid data?
    // If no data or could not decode
    if (empty($data)) {
        return false;
    }

    // Hook before import
//    do_action('theme_core_ie_before_import');
//    $data = apply_filters('theme_core_ie_import_data', $data);

    // Get all available widgets site supports
    $available_widgets = theme_core_ie_available_widgets();

    // Get all existing widget instances
    $widget_instances = array();
    foreach ($available_widgets as $widget_data) {
        $widget_instances[$widget_data['id_base']] = get_option('widget_' . $widget_data['id_base']);
    }

    // Begin results
    $results = array();
    // Loop import data's sidebars
    foreach ($data['sidebars'] as $sidebar_id => $widgets) {

        // Skip inactive widgets
        // (should not be in export file)
        if ('wp_inactive_widgets' == $sidebar_id) {
            continue;
        }

        // Check if sidebar is available on this site
        // Otherwise add widgets to inactive, and say so
        if (isset($wp_registered_sidebars[$sidebar_id])) {
            $sidebar_available = true;
            $use_sidebar_id = $sidebar_id;
            $sidebar_message_type = 'success';
            $sidebar_message = '';
        } else {
            $sidebar_available = false;
            $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
            $sidebar_message_type = 'error';
            $sidebar_message = __('Sidebar does not exist in theme (using Inactive)', 'widget-importer-exporter');
        }

        // Result for sidebar
        $results[$sidebar_id]['name'] = !empty($wp_registered_sidebars[$sidebar_id]['name']) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
        $results[$sidebar_id]['message_type'] = $sidebar_message_type;
        $results[$sidebar_id]['message'] = $sidebar_message;
        $results[$sidebar_id]['widgets'] = array();

        // Loop widgets
        foreach ($widgets as $widget_instance_id => $widget) {

            $fail = false;

            // Get id_base (remove -# from end) and instance ID number
            $id_base = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
            $instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);

            // Does site support this widget?
            if (!$fail && !isset($available_widgets[$id_base])) {
                $fail = true;
                $widget_message_type = 'error';
                $widget_message = __('Site does not support widget', 'widget-importer-exporter'); // explain why widget not imported
            }

            // Filter to modify settings object before conversion to array and import
            // Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
            // Ideally the newer theme_core_ie_widget_settings_array below will be used instead of this
            $widget = apply_filters('theme_core_ie_widget_settings', $widget); // object

            // Convert multidimensional objects to multidimensional arrays
            // Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
            // Without this, they are imported as objects and cause fatal error on Widgets page
            // If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
            // It is probably much more likely that arrays are used than objects, however
            $widget = json_decode(json_encode($widget), true);

            // Filter to modify settings array
            // This is preferred over the older theme_core_ie_widget_settings filter above
            // Do before identical check because changes may make it identical to end result (such as URL replacements)
            $widget = apply_filters('theme_core_ie_widget_settings_array', $widget);

            // Does widget with identical settings already exist in same sidebar?
            if (!$fail && isset($widget_instances[$id_base])) {

                // Get existing widgets in this sidebar
                $sidebars_widgets = get_option('sidebars_widgets');
                $sidebar_widgets = isset($sidebars_widgets[$use_sidebar_id]) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

                // Loop widgets with ID base
                $single_widget_instances = !empty($widget_instances[$id_base]) ? $widget_instances[$id_base] : array();
                foreach ($single_widget_instances as $check_id => $check_widget) {

                    // Is widget in same sidebar and has identical settings?
                    if (in_array("$id_base-$check_id", $sidebar_widgets) && (array)$widget == $check_widget) {

                        $fail = true;
                        $widget_message_type = 'warning';
                        $widget_message = __('Widget already exists', 'widget-importer-exporter'); // explain why widget not imported

                        break;

                    }

                }

            }

            // No failure
            if (!$fail) {

                if (strpos($widget_instance_id, 'nav_menu-') !== false && isset($data['nav_menu']->{$widget_instance_id})) {
                    $menu = wp_get_nav_menu_object($data['nav_menu']->{$widget_instance_id});
                    $widget['nav_menu'] = $menu->term_id;
                }

                // Add widget instance
                $single_widget_instances = get_option('widget_' . $id_base); // all instances for that widget ID base, get fresh every time
                $single_widget_instances = !empty($single_widget_instances) ? $single_widget_instances : array('_multiwidget' => 1); // start fresh if have to
                $single_widget_instances[] = $widget; // add it

                // Get the key it was given
                end($single_widget_instances);
                $new_instance_id_number = key($single_widget_instances);

                // If key is 0, make it 1
                // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                if ('0' === strval($new_instance_id_number)) {
                    $new_instance_id_number = 1;
                    $single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
                    unset($single_widget_instances[0]);
                }

                // Move _multiwidget to end of array for uniformity
                if (isset($single_widget_instances['_multiwidget'])) {
                    $multiwidget = $single_widget_instances['_multiwidget'];
                    unset($single_widget_instances['_multiwidget']);
                    $single_widget_instances['_multiwidget'] = $multiwidget;
                }

                // Update option with new widget
                update_option('widget_' . $id_base, $single_widget_instances);

                // Assign widget instance to sidebar
                $sidebars_widgets = get_option('sidebars_widgets'); // which sidebars have which widgets, get fresh every time
                $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
                $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
                update_option('sidebars_widgets', $sidebars_widgets); // save the amended data

                // After widget import action
                $after_widget_import = array(
                    'sidebar'           => $use_sidebar_id,
                    'sidebar_old'       => $sidebar_id,
                    'widget'            => $widget,
                    'widget_type'       => $id_base,
                    'widget_id'         => $new_instance_id,
                    'widget_id_old'     => $widget_instance_id,
                    'widget_id_num'     => $new_instance_id_number,
                    'widget_id_num_old' => $instance_id_number
                );
                do_action('theme_core_ie_after_widget_import', $after_widget_import);

                // Success message
                if ($sidebar_available) {
                    $widget_message_type = 'success';
                    $widget_message = __('Imported', 'widget-importer-exporter');
                } else {
                    $widget_message_type = 'warning';
                    $widget_message = __('Imported to Inactive', 'widget-importer-exporter');
                }

            }

            // Result for widget instance
            $results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset($available_widgets[$id_base]['name']) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
            $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = !empty($widget['title']) ? $widget['title'] : __('No Title', 'widget-importer-exporter'); // show "No Title" if widget instance is untitled
            $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
            $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;

        }

    }

    // Hook after import
    do_action('theme_core_ie_after_import');
    global $import_result;
    $import_result[] = esc_html__('Import widget successfully!','swa-ie');

}

/**
 * Available widgets
 *
 * Gather site's widgets into array with ID base, name, etc.
 * Used by export and import functions.
 *
 * @since 1.0.0
 * @global array $wp_registered_widget_updates
 * @return array Widget information
 */
function theme_core_ie_available_widgets()
{

    global $wp_registered_widget_controls;

    $widget_controls = $wp_registered_widget_controls;

    $available_widgets = array();

    foreach ($widget_controls as $widget) {

        if (!empty($widget['id_base']) && !isset($available_widgets[$widget['id_base']])) { // no dupes

            $available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
            $available_widgets[$widget['id_base']]['name'] = $widget['name'];

        }

    }

    return $available_widgets;

}
