<?php
extract(shortcode_atts(array(

    'testimonial_item2' => '',
    'title_color' => '',
    'content_color' => '',
    'position_color' => '',
    'el_class' => '',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'zinco-carousel' );
$html_id = cmsHtmlID('ct-testimonial-carousel');
extract(zinco_get_param_carousel($atts));
$testimonials = (array) vc_param_group_parse_atts($testimonial_item2);
wp_enqueue_script( 'waypoints' );
wp_enqueue_style( 'animate-css' );
if(!empty($testimonials)) : ?>

    <div id="<?php echo esc_attr($html_id);?>" class="ct-testimonial-layout2 owl-carousel <?php echo esc_attr( $el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?>>
        <?php foreach ($testimonials as $key => $value) {
            $title = isset($value['title']) ? $value['title'] : '';
            $content = isset($value['content']) ? $value['content'] : '';
            $position = isset($value['position']) ? $value['position'] : '';
            ?>
            <div class="ct-testimonial-item">
                <div class="grid-item-inner">
                    <div class="item-content" style="<?php if(!empty($content_color)) { echo 'color:'.esc_attr($content_color).';'; } ?>">
                        <?php echo wp_kses_post($content); ?>
                    </div>
                    <div class="item-holder">
                        <h3 class="item-title" style="<?php if(!empty($title_color)) { echo 'color:'.esc_attr($title_color).';'; } ?>">
                            <?php echo esc_attr($title); ?>
                        </h3>
                        <div class="item-position" style="<?php if(!empty($position_color)) { echo 'color:'.esc_attr($position_color).';'; } ?>">
                            <?php echo esc_attr($position); ?>
                        </div>
                    </div>
                    <div class="item-icon"><i class="fal fac-quote-right"></i></div>
                </div>
            </div>
        <?php } ?>
    </div>

<?php endif;?>