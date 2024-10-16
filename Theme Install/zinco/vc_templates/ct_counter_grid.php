<?php
extract(shortcode_atts(array(

    'el_title'         => '',
    'counters'         => '',
    'el_class'         => '',
    'animation'         => '',

    'col_xl'               => 4,
    'col_lg'               => 4,
    'col_md'               => 2,
    'col_sm'               => 2,
    'col_xs'               => 1,

), $atts));
$col_xl = 12 / $col_xl;
$col_lg = 12 / $col_lg;
$col_md = 12 / $col_md;
$col_sm = 12 / $col_sm;
$col_xs = 12 / $col_xs;
$grid_item = "col-xl-{$col_xl} col-lg-{$col_lg} col-md-{$col_md} col-sm-{$col_sm} col-{$col_xs}";

wp_enqueue_script( 'zinco-counter-lib' );
wp_enqueue_script( 'zinco-counter' );
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$counters = (array) vc_param_group_parse_atts($counters);
?>
<div class="ct-counter-grid">
    <div class="row">
        <?php foreach ($counters as $key => $value) { 
            $title = isset($value['title']) ? $value['title'] : ''; 
            $digit = isset($value['digit']) ? $value['digit'] : '';
            $prefix = isset($value['prefix']) ? $value['prefix'] : '';
            $suffix = isset($value['suffix']) ? $value['suffix'] : '';
            $icon_fontawesome5 = isset($value['icon_fontawesome5']) ? $value['icon_fontawesome5'] : '';
            $icon_weight = isset($value['icon_weight']) ? $value['icon_weight'] : '';
            $grouping = isset($value['grouping']) ? $value['grouping'] : '0';
            $separator = isset($value['separator']) ? $value['separator'] : '';
            ?>
            <div class="ct-counter-item <?php echo esc_attr($grid_item); ?>">
                <div id="ct-counter-<?php echo esc_attr($key);?>" class="ct-counter ct-counter-default <?php echo esc_attr( $animation_classes.' '.$el_class ); ?>">
                    <div class="ct-counter-align">
                        <div class="ct-counter-inner">
                            <?php if($icon_fontawesome5):?>
                                <div class="ct-counter-icon">
                                    <i class="<?php echo esc_attr($icon_fontawesome5); ?> <?php if(!empty($icon_weight)) { echo esc_attr($icon_weight); } ?>"></i>
                                </div>
                            <?php endif;?>
                            <div class="ct-counter-holder">
                                <span id="ct-counter-<?php echo esc_attr($key);?>-digit" class="ct-counter-digit" data-type="random" data-grouping="<?php echo esc_attr($grouping); ?>" data-separator="<?php echo esc_attr($separator); ?>" data-digit="<?php echo esc_attr($digit);?>" data-prefix="<?php echo esc_attr($prefix);?>" data-suffix="<?php echo esc_attr($suffix);?>"></span>
                                <?php if(!empty($title)) : ?>
                                    <div class="ct-counter-title">
                                        <?php echo apply_filters('the_title', $title);?>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php if(!empty($el_title)) : ?>
        <h3 class="el-title"><?php echo esc_attr($el_title); ?></h3>
    <?php endif; ?>
</div>