<?php
extract(shortcode_atts(array(

    'fancybox_item' => '',
    'el_class' => '',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'zinco-carousel' );
$html_id = cmsHtmlID('ct-fancybox-carousel-carousel');
extract(zinco_get_param_carousel($atts));
$fancybox_item = (array) vc_param_group_parse_atts($fancybox_item);
wp_enqueue_script( 'waypoints' );
wp_enqueue_style( 'animate-css' );
if(!empty($fancybox_item)) : ?>

    <div id="<?php echo esc_attr($html_id);?>" class="ct-fancybox-carousel-layout1 owl-carousel <?php echo esc_attr( $el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?>>
        <?php foreach ($fancybox_item as $key => $value) {
            $title = isset($value['title']) ? $value['title'] : '';
            $icon_fontawesome5 = isset($value['icon_fontawesome5']) ? $value['icon_fontawesome5'] : '';
            $icon_weight = isset($value['icon_weight']) ? $value['icon_weight'] : '';
            $link_item = isset($value['link_item']) ? $value['link_item'] : '';
            $link = vc_build_link($link_item);
            $a_href = '';
            $a_target = '';
            if ( strlen( $link['url'] ) > 0 ) {
                $a_href = $link['url'];
                $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
            }
            ?>
            <div class="ct-fancybox-carousel-item">
                <div class="ct-fancybox-inner">
                    <div class="ct-fancybox-meta">
                        <?php if($icon_fontawesome5):?>
                            <div class="ct-fancybox-icon">
                                <?php if(!empty($a_href)) : ?><a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>"><?php endif; ?>
                                    <i class="<?php echo esc_attr($icon_fontawesome5); ?> <?php if(!empty($icon_weight)) { echo esc_attr($icon_weight); } ?>"></i>
                                <?php if(!empty($a_href)) : ?></a><?php endif;?>
                            </div>
                        <?php endif;?>

                        <?php if(!empty($title)) : ?>
                            <h3 class="ct-fancybox-title">
                                <?php if(!empty($a_href)) : ?><a href="<?php echo esc_url($a_href);?>" target="<?php  echo esc_attr($a_target); ?>"><?php endif; ?>
                                    <?php echo wp_kses_post( $title ); ?>
                                <?php if(!empty($a_href)) : ?></a><?php endif;?>
                            </h3>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php endif;?>