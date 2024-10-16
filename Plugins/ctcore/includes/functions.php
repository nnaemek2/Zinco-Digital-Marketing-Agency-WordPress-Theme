<?php

global $cms_html_id;

if (empty($cms_html_id)) {
    $cms_html_id = array();
}
/**
 * Require libraries if needed.
 *
 * @access public
 *
 */
function cmsResizeLib()
{
    //check if lib exists
    if (!function_exists('mr_image_resize')) {
        require_once(CMS_LIBRARIES . 'mr-image-resize.php');
    }
    return;
}

function cmsGetCategoriesByPostID($post_ID = null, $taxo = 'category')
{
    $term_cats = array();
    $categories = get_the_terms($post_ID, $taxo);
    if ($categories) {
        foreach ($categories as $category) {
            $term_cats[] = get_term($category, $taxo);
        }
    }
    return $term_cats;
}

/**
 * Generator unique html id
 * @param type $id : string
 */
function cmsHtmlID($id)
{
    global $cms_html_id;
    $id = str_replace(array('_'), '-', $id);
    if (isset($cms_html_id[$id])) {
        $count = count($cms_html_id[$id]);
        $cms_html_id[$id][$count] = 1;
        $count++;
        return $id . '-' . $count;
    } else {
        $cms_html_id[$id] = array(1);
        return $id;
    }
}

function cmsFileScanDirectory($dir, $mask, $options = array(), $depth = 0)
{
    $options += array(
        'nomask'    => '/(\.\.?|CSV)$/',
        'callback'  => 0,
        'recurse'   => TRUE,
        'key'       => 'uri',
        'min_depth' => 0,
    );

    $options['key'] = in_array($options['key'], array('uri', 'filename', 'name')) ? $options['key'] : 'uri';
    $files = array();
    if (is_dir($dir) && $handle = opendir($dir)) {
        while (FALSE !== ($filename = readdir($handle))) {
            if (!preg_match($options['nomask'], $filename) && $filename[0] != '.') {
                $uri = "$dir/$filename";
                if (is_dir($uri) && $options['recurse']) {
                    // Give priority to files in this folder by merging them in after any subdirectory files.
                    $files = array_merge(cmsFileScanDirectory($uri, $mask, $options, $depth + 1), $files);
                } elseif ($depth >= $options['min_depth'] && preg_match($mask, $filename)) {
                    // Always use this match over anything already set in $files with the
                    // same $$options['key'].
                    $file = new stdClass();
                    $file->uri = $uri;
                    $file->filename = $filename;
                    $file->name = pathinfo($filename, PATHINFO_FILENAME);
                    $files[$filename] = $file;
                }
            }
        }
        closedir($handle);
    }
    return $files;
}

function cms_require_folder($foldername,$path)
{
    $dir = $path . DIRECTORY_SEPARATOR . $foldername;
    if (!is_dir($dir)) {
        return;
    }
    $files = array_diff(scandir($dir), array('..', '.'));
    foreach ($files as $file) {
        $patch = $dir . DIRECTORY_SEPARATOR . $file;
        if (file_exists($patch) && strpos($file, ".php") !== false) {
            include_once $patch;
        }
    }
}

function cms_get_template_file__($template, $data = array())
{
    extract($data);
    $template_file = cms_get_template_file($template);
    if ($template_file !== false) {
        ob_start();
        include $template_file;
        return ob_get_clean();
    }
    return false;
}

function cms_get_template_file($template, $dir = null)
{

    if ($dir === null) {
        $dir = 'vc_templates';
    }

    $template_file = get_template_directory() . DIRECTORY_SEPARATOR . $dir  .DIRECTORY_SEPARATOR. $template;

    if (file_exists($template_file)) {
        return $template_file;
    } else {
        $template_file = casethemescore()->path('APP_DIR', 'templates/shortcodes') . DIRECTORY_SEPARATOR . $template;
        if (file_exists($template_file)) {
            return $template_file;
        }
    }
    return false;
}

function cms_do_the_content( $content, $autop = true ) {

    if ( $autop ) {
        $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }

    return do_shortcode( shortcode_unautop( $content ) );
}

function cms_allow_embed( $content ) {
	echo do_shortcode( $content );
}

function cms_allow_html( $content ) {
	echo $content;
}

function cms_crop_images()
{
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
	}
}

function ct_allow_RegisterWidget($class)
{
    register_widget($class);
}

?>