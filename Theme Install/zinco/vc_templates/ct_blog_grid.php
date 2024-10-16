<?php
$atts_extra = shortcode_atts(array(
    'source'               => '',
    'orderby'              => 'date',
    'order'                => 'DESC',
    'limit'                => '6',
    'gap'                  => '30',
    'post_ids'             => '',
    'col_xl'               => 4,
    'col_lg'               => 4,
    'col_md'               => 3,
    'col_sm'               => 2,
    'col_xs'               => 1,
    'layout'               => 'masonry',
    'pagination_type'      => 'pagination',
    'filter'               => 'false',
    'filter_default_title' => 'All',
    'el_class'             => '',
    'img_size'             => '600x438',
    'length_excerpt'             => '18',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);
$tax = array();
extract(cms_get_posts_of_grid('post', $atts));
$filter_default_title = !empty($filter_default_title) ? $filter_default_title : 'All';
$col_xl = 12 / $col_xl;
$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

$gap_item = intval($gap / 2);

$grid_class = '';
if ($layout == 'masonry') {
    wp_enqueue_script('isotope');
    wp_enqueue_script('imagesloaded');
    wp_enqueue_script('zinco-isotope', get_template_directory_uri() . '/assets/js/isotope.ct.js', array('jquery'), '1.0.0', true);
    $grid_class = 'ct-grid-inner ct-grid-masonry row';
    if($pagination_type == 'loadmore' || $pagination_type === 'pagination') {
        $html_id = str_replace('-', '_', $html_id);
        wp_enqueue_script('ct-loadmore-grid', get_template_directory_uri() . '/assets/js/ct-loadmore-grid.js', array('jquery'), 'all', true);
        wp_localize_script('ct-loadmore-grid', 'ct_load_more_' . $html_id, array(
            'startPage' => $paged,
            'maxPages'  => $max,
            'total'     => $total,
            'perpage'   => $limit,
            'nextLink'  => $next_link,
            'layout'    => $layout
        ));
    }
} else {
    $grid_class = 'ct-grid-inner row';
}
wp_enqueue_script( 'waypoints' );
wp_enqueue_style( 'animate-css' );
if (is_rtl()) {
    $carousel_rtl = 'true';
} else {
    $carousel_rtl = 'false';
}
$html_id_el = '#'.$html_id;
?>
<div class="ct-inline-css"  data-css="
    <?php echo esc_attr($html_id_el); ?> .ct-grid-inner {
        margin: 0 -<?php echo esc_attr($gap_item); ?>px;
    }
    <?php echo esc_attr($html_id_el); ?> .ct-grid-inner .grid-item, <?php echo esc_attr($html_id_el); ?> .ct-grid-inner .grid-sizer {
        padding: <?php echo esc_attr($gap_item); ?>px;
    }
"></div>

<div id="<?php echo esc_attr($html_id) ?>" class="ct-grid ct-grid-blog-layout1 <?php echo esc_attr($el_class); ?>">

    <?php if ($filter == "true" and $layout == 'masonry'): ?>
        <div class="grid-filter-wrap align-center">
            <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
            <?php foreach ($categories as $category): ?>
                <?php $category_arr = explode('|', $category); ?>
                <?php $tax[] = $category_arr[1]; ?>
                <?php $term = get_term_by('slug',$category_arr[0], $category_arr[1]); ?>

                <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="<?php echo esc_attr($grid_class); ?>" data-gutter="<?php echo esc_attr($gap_item); ?>">
        <?php if ($layout == 'masonry') : ?>
            <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php endif; ?>
        <?php
        if (is_array($posts)):
            $sizes = explode(',',$img_size);
            $i = 0;
            foreach ($posts as $key => $post) {
                the_post();
                $default_size = end($sizes);
                if(!empty($sizes[$i])){
                    $default_size = $sizes[$i];
                }
                $img_id = get_post_thumbnail_id($post->ID);
                $img = wpb_getImageBySize( array(
                    'attach_id'  => $img_id,
                    'thumb_size' => $default_size,
                    'class'      => '',
                ));
                $thumbnail = $img['thumbnail'];
                $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
                $filter_class = cms_get_term_of_post_to_class($post->ID, array_unique($tax));
                $video_url = zinco_get_post_format_value('post-video-url', '');
                ?>
                    <div class="<?php echo esc_attr($item_class . ' ' . $filter_class); ?>">
                        <div class="grid-item-inner">
                            <?php if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) { ?>
                                <div class="item-featured">
                                    <a  href="<?php echo esc_url(get_permalink( $post->ID )); ?>">
                                        <?php echo wp_kses_post($thumbnail); ?>
                                    </a>
                                    <?php
                                    if(has_post_format('video') && !empty($video_url)) : ?>
                                        <a class="btn-video" href="<?php echo esc_url($video_url); ?>"><i class="fa fa-play"></i></a>
                                    <?php endif; ?>
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
                <?php $i++;
            }
        endif; ?>
    </div>
    <?php if ($layout == 'masonry' && $pagination_type == 'pagination') { ?>
        <div class="ct-grid-pagination">
            <?php zinco_posts_pagination(); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $layout == 'masonry' && $pagination_type == 'loadmore') { ?>
        <div class="ct-load-more">
           <span class="btn">
                <i class=""></i>
                <?php echo esc_html__('More News', 'zinco') ?>
            </span>
        </div>
    <?php } ?>
</div>