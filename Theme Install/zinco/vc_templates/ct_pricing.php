<?php
extract(shortcode_atts(array(
    'title' => '',
    'price' => '',
    'pricing_time' => '',
    'description' => '',
    'text_button' => '',
    'link_button' => '',
    'item_link' => '',
    'el_class' => '',
    'animation' => '',
    'featured' => 'no',
), $atts));
$link = vc_build_link($link_button);
$a_href = '';
$a_target = '_self';
if ( strlen( $link['url'] ) > 0 ) {
    $a_href = $link['url'];
    $a_target = strlen( $link['target'] ) > 0 ? $link['target'] : '_self';
} 
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$description = (array) vc_param_group_parse_atts($description);
?>

<div class="ct-pricing-layout1 <?php if($featured == 'yes') { echo 'is-featured'; } ?> <?php echo esc_attr($el_class.' '.$animation_classes); ?>">
    <div class="ct-pricing-inner">
        <div class="ct-pricing-header">
            <?php if(!empty($title)) : ?>
                <h3 class="ct-pricing-title"><?php echo wp_kses_post($title);?></h3> 
            <?php endif;?>
            <div class="ct-pricing-meta">
                <span class="ct-pricing-price">
                    <?php echo esc_attr($price);?>
                    <span>/</span>
                </span>
                <span class="ct-pricing-time">
                    <?php echo esc_attr($pricing_time);?>  
                </span>
            </div>
        </div>
        <div class="ct-pricing-body">
            <?php if(!empty($description)) : ?>
                <ul class="ct-pricing-content">
                    <?php foreach ($description as $key => $value) { 
                        $description_item = isset($value['description_item']) ? $value['description_item'] : '';
                        ?>
                        <li><i class="far fac-check"></i><?php echo esc_html($description_item); ?></li>
                    <?php } ?>
                </ul>
            <?php endif;?>
            <?php if(!empty($text_button)) : ?>
                <div class="ct-pricing-button">
                    <a class="btn btn-aylen" href="<?php echo esc_url($a_href);?>" target="<?php echo esc_attr( $a_target ); ?>">
                        <?php echo esc_attr($text_button); ?>
                        <i class="far fac-chevron-right"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>