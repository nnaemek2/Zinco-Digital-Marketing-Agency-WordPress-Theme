<?php
extract(shortcode_atts(array(

    'testimonial_item' => '',
    'display_row' => '',
    'el_class' => '',

), $atts));

wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'zinco-carousel' );
$html_id = cmsHtmlID('ct-testimonial-carousel');
extract(zinco_get_param_carousel($atts));
$testimonials = (array) vc_param_group_parse_atts($testimonial_item);
wp_enqueue_script( 'waypoints' );
wp_enqueue_style( 'animate-css' );
if(!empty($testimonials)) : ?>

    <div id="<?php echo esc_attr($html_id);?>" class="ct-testimonial-layout3 owl-carousel <?php echo esc_attr( $el_class ); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?>>
        <?php 
        $item = 0;
        $count = 0;
        foreach ($testimonials as $key => $value) {
            $title = isset($value['title']) ? $value['title'] : '';
            $content = isset($value['content']) ? $value['content'] : '';
            $position = isset($value['position']) ? $value['position'] : '';
            $image = isset($value['image']) ? $value['image'] : '';
            $img_size = isset($value['img_size']) ? $value['img_size'] : '300x300';
            $img = wpb_getImageBySize( array(
                'attach_id'  => $image,
                'thumb_size' => $img_size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            if($display_row == "two") {
                if ($item == 0) {
                    echo '<div class="ct-carousel-item">';
                }
            }
            $count++;
            ?>
            <div class="ct-testimonial-item">
                <div class="grid-item-inner">
                    <div class="item-holder">
                        <div class="item-content"><?php echo wp_kses_post( $content ); ?></div>
                        <h4 class="item-title">
                            <?php echo esc_attr($title); ?>
                        </h4>
                        <div class="item-position">
                            <?php echo esc_attr($position); ?>
                        </div>
                        <div class="item-icon"><i class="fal fac-quote-right"></i></div>
                    </div>
                    <?php if(!empty($image)) : ?>
                        <div class="item-featured">
                            <?php echo wp_kses_post($thumbnail); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($display_row == "two") {
                if ($item == 1 || ($count == count($testimonials))) {
                    echo '</div>';
                    $item = 0;
                } else {
                    $item++;
                }
            }
        } ?>
    </div>

<?php endif;?>