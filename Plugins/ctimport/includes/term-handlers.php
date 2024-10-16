<?php
/**
 * @Template: term-handlers.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 27-Feb-18
 */

if (!function_exists('swa_term_meta_export')) {
    function swa_term_meta_export($file)
    {
        global $wp_filesystem;
        $post_types = apply_filters('swa_post_types', array());
        $taxonomies_data = array();
        foreach ($post_types as $post_type) {
            $taxonomies = get_object_taxonomies($post_type);
            foreach ($taxonomies as $tax) {
                $terms = get_terms(array('taxonomy' => $tax, "hide_empty" => false));
                foreach ($terms as $term) {
                    $taxonomies_data[$tax][$term->slug] = get_term_meta($term->term_id);
                }
            }
        }
        $file_contents = json_encode($taxonomies_data);
        $wp_filesystem->put_contents($file, $file_contents, FS_CHMOD_FILE); // Save it
    }
}
if (!function_exists('swa_term_meta_import')) {
    function swa_term_meta_import($file)
    {
        // File exists?
        if (file_exists($file)) {
            // Get file contents and decode
            $data = file_get_contents($file);
            $taxonomies_data = json_decode($data, true);
            foreach ($taxonomies_data as $tax_name => $terms) {
                foreach ($terms as $term_slug => $term_metas) {
                    $term = get_term_by('slug', $term_slug, $tax_name);
                    foreach ($term_metas as $key => $value) {
                        if (maybe_unserialize($value[0]) !== false && strpos($value[0], 'http') !== false && is_array(maybe_unserialize($value[0]))) {
                            $str_data = json_encode(maybe_unserialize($value[0]));
                            $index_start = strpos($str_data,'http');
                            $length = strpos($str_data, 'wp-content') - $index_start;
                            $old_site = substr($str_data,$index_start,$length);
                            $new_data = str_replace($old_site,site_url().'/',$str_data);
                            $new_data = json_decode($new_data,true);
                        } else {
                            $new_data = maybe_unserialize($value[0]) !== false ? maybe_unserialize($value[0]): $value[0];
                        }
                        update_term_meta($term->term_id, $key, $new_data );
                    }
                }
            }
            global $import_result;
            $import_result[] = 'Import term meta successfully!';
        }
    }
}