<?php
/**
 * @Template: attachments.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions: Import and export media handle
 * @create: 17-Nov-17
 */

if (!defined('ABSPATH')) {
    die();
}
function ct_ie_media_export($folder_dir)
{
    global $wp_filesystem;

    $upload_dir = wp_upload_dir();

    $media_backup = $upload_dir['basedir'] . '/ct-attachment-tmp/';

    $query = array(
        'post_type'      => 'attachment',
        'posts_per_page' => -1,
        'post_status'    => 'inherit',
    );

    $media = new WP_Query($query);

    if (!$media->have_posts())
        return 0;

    while ($media->have_posts()) : $media->the_post();

        /* get file dir */
        $attached_file = (get_attached_file(get_the_ID()));

        if (!file_exists($attached_file))
            continue;

        /* get file name. */
        $attached_name = basename($attached_file);

        /* get file dir */
        $attached_dir = dirname($attached_file);

        /* get date folder. */
        $folder_date = str_replace($upload_dir['basedir'], '', $attached_dir);

        if (strpos($folder_date, 'revslider'))
            continue;

        /* new file. */
        $new_file = $media_backup . $folder_date . '/' . $attached_name;

        /* create date folder. */
        if (!is_dir($media_backup . $folder_date))
            wp_mkdir_p($media_backup . $folder_date);

        copy($attached_file, $new_file);

    endwhile;

    /* zip */
    if (class_exists('ZipArchive')){
        $zip = new ZipArchive;
        $zip->open($upload_dir['basedir'] . '/ct-attachment-tmp.zip', ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE);
        ct_ie_zip_folder($media_backup, $zip);

        $zip->close();

        /* media */
        if (!is_dir($folder_dir . 'content')) wp_mkdir_p($folder_dir . 'content');
        $attachment = ct_ie_export_wp(array('content' => 'attachment'));
        $wp_filesystem->put_contents($folder_dir . 'content/attachment-data.xml', $attachment, FS_CHMOD_FILE);
    }
}

function ct_ie_media_import($options, $folder_dir)
{
    global $import_result;
    if (empty($options['attachment'])) {
        $import_result[] = 'Media file not found!';
    } else {
        $upload_dir = wp_upload_dir();

        /* download & unzip. */
        $_cache = trailingslashit($upload_dir['basedir'] . '/ct-demo');

        if (!is_dir($_cache))
            wp_mkdir_p($_cache);

        wp_safe_remote_get($options['attachment'], array('timeout' => 3000, 'stream' => true, 'filename' => $_cache . 'ct-attachment-tmp.zip'));

        unzip_file($_cache . 'ct-attachment-tmp.zip', $upload_dir['basedir']);

        $wp_import = new WP_Import();
        /* import files. */
        $wp_import->import($folder_dir . 'content/attachment-data.xml', null);

        $import_result[] = 'Import media successfully!';
    }

}