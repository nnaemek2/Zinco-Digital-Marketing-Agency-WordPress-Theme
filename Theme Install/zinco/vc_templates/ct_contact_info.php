<?php
extract(shortcode_atts(array(
    'title' => '',
    'content_info' => '',
    'content_color' => '',
    'icon_list' => 'fontawesome',
    'icon_fontawesome' => '',
    'icon_fontawesome5' => '',
    'icon_material_design' => '',
    'icon_flaticon' => '',
    'icon_color' => '',
    'icon_weight' => '',
    'el_class' => '',
), $atts));
$icon_name = "icon_" . $icon_list;
$icon_class = isset(${$icon_name}) ? ${$icon_name} : '';
?>
<div class="ct-contact-info1 <?php echo esc_attr($el_class); ?>">
	<div class="contact-info-inner">
        <?php if($icon_class):?>
            <div class="ct-contact-info-icon <?php if(!empty($icon_color)) { echo 'colored'; } ?>">
                <i class="<?php echo esc_attr($icon_class); ?> <?php if($icon_list == 'fontawesome5' && !empty($icon_weight)) { echo esc_attr($icon_weight); } ?>" style="<?php if(!empty($icon_color)) { echo 'color:'.esc_attr($icon_color).';'; } ?>"></i>
            </div>
        <?php endif;?>
        <div class="ct-contact-info-holder">
            <h3><?php echo esc_attr($title); ?></h3>
            <div class="ct-contact-info-content" style="<?php if(!empty($content_color)) { echo 'color:'.esc_attr($content_color).';'; } ?>">
                 <?php echo wp_kses_post( $content_info ); ?>
            </div>
        </div>
	</div>
</div>