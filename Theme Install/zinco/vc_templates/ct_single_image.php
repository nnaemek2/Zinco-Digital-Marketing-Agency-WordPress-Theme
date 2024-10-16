<?php
$primary_color = zinco_get_opt( 'primary_color', '#ff7200' );
extract(shortcode_atts(array(                                  
    'image' => '',                                          
    'img_size' => 'full',                                       
    'image_link' => '',                                       
    'block_revealers' => 'no',                                        
    'direction' => 'lr',                                        
    'overlay_color' => $primary_color,                                        
    'el_class' => '',                                        
    'animation' => '',                                        
), $atts));
$html_id = cmsHtmlID('ct-single-image');
$atts['html_id'] = $html_id;

$link = vc_build_link($image_link);
$a_href = '';
$a_target = '';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
}

$img = wpb_getImageBySize( array(
    'attach_id'  => $image,
    'thumb_size' => $img_size,
    'class'      => '',
));
$thumbnail = $img['thumbnail'];
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );

if($block_revealers == 'yes') {
	wp_enqueue_script( 'animate-image', get_template_directory_uri() . '/assets/js/animate.min.js', array( 'jquery' ), 'all', true );
	wp_enqueue_script( 'animate-scroll-monitor', get_template_directory_uri() . '/assets/js/animate-scroll-monitor.js', array( 'jquery' ), 'all', true );
	wp_enqueue_script( 'animate-main', get_template_directory_uri() . '/assets/js/animate-main.js', array( 'jquery' ), 'all', true );
} ?>

<div id="<?php echo esc_attr($atts['html_id']);?>" class="ct-single-image <?php if($block_revealers == 'yes') { echo 'image-block-revealers'; } ?> <?php echo esc_attr($el_class.' '.$animation_classes); ?>" <?php if($block_revealers == 'yes') : ?> data-color="<?php echo esc_attr($overlay_color); ?>" data-direction="<?php echo esc_attr($direction); ?>" <?php endif; ?>>
	<?php if(!empty($a_href)) : ?><a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>"><?php endif; ?>
		<?php echo wp_kses_post($thumbnail); ?>
	<?php if(!empty($a_href)) : ?></a><?php endif; ?>
</div>