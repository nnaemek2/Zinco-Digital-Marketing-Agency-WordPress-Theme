<?php
$atts_extra = shortcode_atts(array(
    'content_list'                  => '',
    'title_color'             => '',
    'content_color'             => '',
    'position_color'             => '',
    'col_xl'               => 4,
    'col_lg'               => 4,
    'col_md'               => 3,
    'col_sm'               => 2,
    'col_xs'               => 1,
    'el_class'             => '',
    'img_size'             => '370x416',
), $atts);
$atts = array_merge($atts_extra, $atts);
extract($atts);

$col_xl = 12 / $col_xl;
$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$grid_sizer = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
wp_enqueue_script('isotope');
wp_enqueue_script('imagesloaded');
wp_enqueue_script('zinco-isotope', get_template_directory_uri() . '/assets/js/isotope.ct.js', array('jquery'), '1.0.0', true);
$team_content_list = (array) vc_param_group_parse_atts( $content_list );
wp_enqueue_script( 'waypoints' );
wp_enqueue_style( 'animate-css' );
?>

<div id="<?php echo esc_attr($html_id) ?>" class="ct-grid ct-grid-testimonial1 <?php echo esc_attr($el_class); ?>">

    <div class="ct-grid-inner ct-grid-masonry row animation-time" data-gutter="15">
        <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        <?php foreach ($team_content_list as $key => $value) {
            $title = isset($value['title']) ? $value['title'] : '';
            $position = isset($value['position']) ? $value['position'] : '';
            $content = isset($value['content']) ? $value['content'] : '';
            $item_class = "grid-item col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";
            ?>
            <div class="<?php echo esc_attr($item_class); ?>">
                <div class="grid-item-inner wpb_animate_when_almost_visible wpb_fadeInUp fadeInUp">
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

</div>