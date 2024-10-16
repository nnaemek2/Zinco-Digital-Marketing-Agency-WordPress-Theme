<?php
$atts_extra = shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'el_class'             => '',
    'img_size_lg'             => '570x415',
    'img_size_md'             => '500x455',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
$tax = array();
extract(cms_get_posts_of_grid('post', $atts));
?>

<div id="<?php echo esc_attr($html_id) ?>" class="ct-grid ct-grid-blog-layout2 <?php echo esc_attr($el_class); ?>">

    <div class="ct-grid-inner row">
        <?php if (is_array($posts)):
            $numItems = count($posts);
            $count = 0;
            ?>
            <?php foreach ($posts as $key => $post) {
                the_post();
                $img_id = get_post_thumbnail_id($post->ID);
                $img = wpb_getImageBySize( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $img_size_lg,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail']; 

                $img_id_md = get_post_thumbnail_id($post->ID);
                $img_md = wpb_getImageBySize( array(
                    'attach_id'  => $img_id_md,
                    'thumb_size' => $img_size_md,
                    'class'      => '',
                ));
                $thumbnail_md = $img_md['thumbnail']; 

                if($key == 0) { ?>
                    <div class="ct-grid-left">
                        <div class="grid-item">
                            <div class="grid-item-inner">
                                <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) { ?>
                                    <div class="item-featured">
                                        <a  href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </a>
                                    </div>
                                <?php } ?>
                                <div class="item-body">
                                    <ul class="item-meta">
                                        <li class="item-date">
                                            <i class="fal fac-calendar-alt"></i><?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?>
                                        </li>
                                        <li class="item-author">
                                            <i class="fa fa-user-o"></i><?php echo esc_html__( 'By', 'zinco' ) ?>
                                            <?php the_author_posts_link(); ?>
                                        </li>
                                        <li>
                                            <i class="far fac-comments"></i><a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_attr__('No Comments', 'zinco'),esc_attr__('1 Comment', 'zinco'),esc_attr__('% Comments', 'zinco')); ?></a>
                                        </li>
                                    </ul>
                                    <h3 class="item-title">
                                        <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                    </h3>
                                    <div class="item-content">
                                        <?php echo wp_trim_words( $post->post_excerpt, $num_words = 30, $more = null ); ?>
                                    </div>
                                </div>
                                <div class="item-footer">
                                    <a class="btn btn-aylen" href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php if(!empty($readmore_text)) { echo esc_attr($readmore_text); } else { echo esc_html__('Read More', 'zinco'); }  ?><i class="far fac-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ct-grid-right">
                        <div class="ct-grid-right-inner">
                <?php } else { ?>
                    <div class="grid-item">
                        <div class="grid-item-inner">
                            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) { ?>
                                <div class="item-featured">
                                    <a  href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        <?php echo wp_kses_post($thumbnail_md); ?>
                                    </a>
                                </div>
                            <?php } ?>
                            <div class="item-body">
                                <ul class="item-meta">
                                    <li class="item-date">
                                        <i class="fal fac-calendar-alt"></i><?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?>
                                    </li>
                                    <li>
                                        <i class="far fac-comments"></i><a href="<?php the_permalink(); ?>"><?php echo comments_number(esc_attr('(0)'),esc_attr('(1)'),esc_attr('(%)')); ?></a>
                                    </li>
                                </ul>
                                <h3 class="item-title">
                                    <a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a>
                                </h3>
                                <div class="item-content">
                                    <?php echo wp_trim_words( $post->post_excerpt, $num_words = 8, $more = null ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if(++$count === $numItems) {
                    echo "</div></div>";
                }
            } ?>
        <?php endif; ?>
    </div>

</div>