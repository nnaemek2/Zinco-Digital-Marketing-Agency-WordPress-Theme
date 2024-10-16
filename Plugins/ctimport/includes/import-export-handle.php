<?php
/**
 * @template: import-export-handle.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @create: 16-Nov-17
 */
if (!defined('ABSPATH')) {
    die();
}
if (!class_exists('CT_Import_handle')) {
    class CT_Import_handle
    {
        public function __construct()
        {
            add_action('init', array($this, 'ct_ie_template_redirect'), 30);
        }

        public function ct_ie_template_redirect()
        {
            if (!isset($_REQUEST['page']) || $_REQUEST['page'] !== 'swa-import') {
                return;
            }
            /**
             * Export handle
             *
             */
            if (!empty($_REQUEST['action']) && $_REQUEST['action'] === 'swa-export' && !empty($_REQUEST['swa-ie-id']) && !empty($_REQUEST['swa-ie-data-type'])) {

                $folder_name = sanitize_title($_REQUEST['swa-ie-id']);
                $folder_dir = ct_ie_process_demo_folder($folder_name);
                $this->ct_ie_get_screen_shot($folder_name);
                do_action('swa-ie-export-start', $folder_dir);
                $this->ct_ie_export_start($folder_dir);
                /**
                 * Hook swa-ie-extra-options
                 * Export and import extra options
                 * Return $options ( array( $option_key1 , $option_key1 , $option_key3....) )
                 */
                $options = array();
                $options = apply_filters('ct_ie_extra_options', $options);
                $demo_info = array(
                    'name' => $_REQUEST['swa-ie-id'],
                    'link' => !empty($_REQUEST['swa-ie-link']) ? $_REQUEST['swa-ie-link'] : '#'
                );

                /**
                 * Export demo information
                 */
                ct_ie_export_demo_info($folder_dir . 'demo-info.json', $demo_info);

                /**
                 * Export extra options
                 */
                ct_ie_extra_options_export($folder_dir . 'extra-options.json', $options);

                /**
                 * Export main
                 */
                foreach ($_REQUEST['swa-ie-data-type'] as $type) {
                    switch ($type) {
                        case 'attachment':
                            ct_ie_media_export($folder_dir);
                            break;
                        case 'widgets':
                            ct_ie_widgets_save_export_file($folder_dir);
                            break;
                        case 'settings':
                            ct_ie_setting_export($folder_dir . 'settings.json');
                            break;
                        case 'options':
                            ct_ie_options_export($folder_dir . 'options.json');
                            break;
                        case 'content':
                            ct_ie_content_export($folder_dir);
                            break;
                        case 'revslider':
                            ct_ie_revslider_export($folder_dir);
                            break;
                    }
                }
                swa_term_meta_export($folder_dir . 'term-meta.json');

                /**
                 * Clear temp
                 */
                ct_ie_clear_tmp();

                /**
                 * Git sync
                 */
                swa_git_shell();
            }

            /**
             * Import handle
             *
             */
            if (!empty($_REQUEST['action']) && $_REQUEST['action'] === 'swa-import' && !empty($_REQUEST['swa-ie-id'])) {
                $GLOBALS['import_result'] = array();

                $folder_name = sanitize_title($_REQUEST['swa-ie-id']);
                $folder_dir = ct_ie_process_demo_folder($folder_name);
                $options = array();
                if (file_exists($folder_dir . 'options.json')) {
                    $options = json_decode(file_get_contents($folder_dir . 'options.json'), true);
                }
                $options['folder'] = $folder_dir;
                do_action('swa-ie-export-start', $folder_dir);
                $this->ct_ie_import_start($folder_dir);

                //attachment
                ct_ie_media_import($options, $folder_dir);

                //content
                ct_ie_content_import($options);

                //settings
                ct_ie_setting_import($folder_dir . 'settings.json');

                //options
                ct_ie_options_import($options);

                //widgets
                ct_ie_widgets_process_import_file($folder_dir);

                //extra options
                ct_ie_extra_options_import($folder_dir . 'extra-options.json');

                //revslider
                ct_ie_revslider_import($folder_dir);

                $this->ct_ie_crop_images();

                swa_term_meta_import($folder_dir . 'term-meta.json');
                /**
                 * Save demo id installed
                 */
                ct_ie_import_finish($_REQUEST['swa-ie-id']);


                /**
                 * Clear tmp:
                 * $upload_dir['basedir'] . '/ct-attachment-tmp
                 * $upload_dir['basedir'] . '/swa-ie-demo
                 */
                ct_ie_clear_tmp();
            }

            /**
             * Download zip file of all demo data
             */
            if (!empty($_REQUEST['swa-ie-download']) && $_REQUEST['swa-ie-download'] === 'swa' && !empty($_REQUEST['action']) && $_REQUEST['action'] === 'swa-export') {
                $zip_file = ct_ie_download_demo_zip();
                header("Content-type: application/zip");
                header("Content-Disposition: attachment; filename=demo-data.zip");
                header("Pragma: no-cache");
                header("Expires: 0");
                readfile($zip_file);

                @unlink($zip_file); //delete file after sending it to user

                exit();
            }

        }


        /**
         * Copy screen_shot of demo
         * @param $folder_name
         */
        function ct_ie_get_screen_shot($folder_name)
        {

            if (is_file(swa_ie()->theme_dir . $folder_name . '/screenshot.png'))
                return;

            if (!is_file(get_template_directory() . '/screenshot.png'))
                return;

            copy(get_template_directory() . '/screenshot.png', swa_ie()->theme_dir . $folder_name . '/screenshot.png');
        }


        function ct_ie_export_start($part)
        {
            $css_file = get_template_directory() . '/assets/css/static.css';

            if (file_exists($css_file)) {
                copy($css_file, $part . 'static.css');
            }
        }

        function ct_ie_import_start($part)
        {
            $css = get_template_directory() . '/assets/css/static.css';

            if (file_exists($part . 'static.css')) {
                copy($part . 'static.css', $css);
            }
        }

        function ct_ie_crop_images()
        {
            global $import_result;

            /**
             * Crop image
             */
            $query = array(
                'post_type'      => 'attachment',
                'posts_per_page' => -1,
                'post_status'    => 'inherit',
            );

            $media = new WP_Query($query);
            if ($media->have_posts()) {
                foreach ($media->posts as $image) {
                    if (strpos($image->post_mime_type, 'image/') !== false) {
                        $image_path = get_attached_file($image->ID);
                        $metadata = wp_generate_attachment_metadata($image->ID, $image_path);
                        wp_update_attachment_metadata($image->ID, $metadata);
                    }
                }
                $import_result[] = esc_html__('Crop images successfully!', SWA_TEXT_DOMAIN);
            }
        }
    }
}