<?php
$atts_extra = shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'post_ids'             => '',
    'img_size'             => '470x343',
    'el_class'             => '',
    'length_excerpt'             => '18',
    'readmore_text'             => '',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
extract(cms_get_posts_of_grid('post', $atts));
extract(zinco_get_param_carousel($atts));
wp_enqueue_script( 'owl-carousel' );
wp_enqueue_script( 'zinco-carousel' );
wp_enqueue_script( 'waypoints' );
wp_enqueue_style( 'animate-css' );
?>

<div id="<?php echo esc_attr($html_id) ?>" class="ct-grid ct-grid-blog-layout1 owl-carousel <?php echo esc_attr($el_class); ?>" <?php echo !empty($carousel_data) ?  esc_attr($carousel_data) : '' ?>>

    <?php
    if (is_array($posts)):
        foreach ($posts as $key => $post) {
            the_post(); 
            $img_id = get_post_thumbnail_id($post->ID);
            $img = wpb_getImageBySize( array(
                'attach_id'  => $img_id,
                'thumb_size' => $img_size,
                'class'      => '',
            ));
            $thumbnail = $img['thumbnail'];
            ?>
            <div class="ct-carousel-item">
                <div class="grid-item-inner ct-fade-in">
                    <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) { ?>
                        <div class="item-featured">
                            <a  href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                <?php echo wp_kses_post($thumbnail); ?>
                            </a>
                        </div>
                    <?php } ?>
                    <div class="item-body">
                        <div class="item-date">
                            <i class="fal fac-calendar-alt"></i><?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?>
                        </div>
                        <h3 class="item-title" style="<?php if(!empty($item_title_color)) { echo 'color:'.esc_attr($item_title_color).';'; } ?>">
                            <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                        </h3>
                        <ul class="item-meta">
                            <li class="item-author">
                                <i class="fa fa-user-o"></i><?php echo esc_html__( 'By', 'zinco' ) ?>
                                <?php the_author_posts_link(); ?>
                            </li>
                            <li>
                                <i class="far fac-comments"></i><a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_attr__('No Comments', 'zinco'),esc_attr__('1 Comment', 'zinco'),esc_attr__('% Comments', 'zinco')); ?></a>
                            </li>
                        </ul>
                        <div class="item-content">
                            <?php echo wp_trim_words( $post->post_excerpt, $num_words = $length_excerpt, $more = null ); ?>
                        </div>
                    </div>
                    <div class="item-footer">
                        <a class="btn btn-aylen" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php if(!empty($readmore_text)) { echo esc_attr($readmore_text); } else { echo esc_html__('Read More', 'zinco'); }  ?><i class="far fac-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        <?php }
    endif; ?>
    
</div>