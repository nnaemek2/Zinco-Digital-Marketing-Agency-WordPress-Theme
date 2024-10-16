<?php
extract(shortcode_atts(array(

    'title'         => '',
    'title_color'         => '',
    'grouping'         => '0',
    'separator'         => '',
    'digit'         => '',
    'digit_color'         => '',
    'prefix'         => '',
    'suffix'         => '',

    'icon_type' => 'icon',
    'icon_list' => 'fontawesome',
    'icon_fontawesome' => '',
    'icon_fontawesome5' => '',
    'icon_material_design' => '',
    'icon_flaticon' => '',
    'icon_etline' => '',
    'icon_image' => '',
    'icon_color' => '',
    'icon_weight' => '',

    'el_class'         => '',
    'animation'         => '',

), $atts));
wp_enqueue_script( 'waypoints' );
wp_enqueue_script( 'zinco-counter-lib' );
wp_enqueue_script( 'zinco-counter' );
$icon_image_url = '';
if (!empty($icon_image)) {
    $attachment_image = wp_get_attachment_image_src($icon_image, 'full');
    $icon_image_url = $attachment_image[0];
}
$icon_name = "icon_" . $icon_list;
$icon_class = isset(${$icon_name}) ? ${$icon_name} : '';
$html_id = cmsHtmlID('ct-counter');
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
?>
<div id="<?php echo esc_attr($html_id);?>" class="ct-counter ct-counter-default <?php echo esc_attr( $animation_classes.' '.$el_class ); ?>">
    <div class="ct-counter-align">
        <div class="ct-counter-inner">
            <?php if(!empty($icon_image_url) && $icon_type == 'image' ) { ?>
                <div class="ct-counter-icon">
                    <img class="icon-main" src="<?php echo esc_url( $icon_image_url ); ?>" alt="<?php echo esc_attr( $title ); ?>"/>
                </div>
            <?php } else { ?>
                <?php if($icon_class):?>
                    <div class="ct-counter-icon">
                        <i class="<?php echo esc_attr($icon_class); ?> <?php if($icon_list == 'fontawesome5' && !empty($icon_weight)) { echo esc_attr($icon_weight); } ?>" style="<?php if(!empty($icon_color)) { echo 'color:'.esc_attr($icon_color).';'; } ?>"></i>
                    </div>
                <?php endif;?>
            <?php } ?>
            <div class="ct-counter-holder">
                <span id="<?php echo esc_attr($html_id);?>-digit" class="ct-counter-digit" data-type="random" data-grouping="<?php echo esc_attr($grouping); ?>" data-separator="<?php echo esc_attr($separator); ?>" data-digit="<?php echo esc_attr($digit);?>" data-prefix="<?php echo esc_attr($prefix);?>" data-suffix="<?php echo esc_attr($suffix);?>" style="<?php if(!empty($digit_color)) { echo 'color:'.esc_attr($digit_color).';'; } ?>"></span>
                <?php if(!empty($title)) : ?>
                    <div class="ct-counter-title" style="<?php if(!empty($title_color)) { echo 'color:'.esc_attr($title_color).';'; } ?>">
                        <?php echo apply_filters('the_title', $title);?>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>