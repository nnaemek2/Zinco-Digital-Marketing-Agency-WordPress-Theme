<?php
extract(shortcode_atts(array(
    'timeline' => '',
    'animation' => '',
    'el_class' => '',
), $atts));

$timeline = (array) vc_param_group_parse_atts($timeline);
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
?>
<div class="ct-timeline <?php echo esc_attr($el_class); ?>">
    <div class="timeline-icon"></div>
    <div class="ct-timeline-inner">
        <?php foreach ($timeline as $key => $value) { 
            $content = isset($value['content']) ? $value['content'] : ''; 
            $title = isset($value['title']) ? $value['title'] : '';
            if(!empty($title) || !empty($content)) :?>
                <div class="ct-timeline-item item-<?php echo esc_attr($key); ?>-columns <?php echo esc_attr($animation_classes); ?>">
                    <div class="ct-timeline-content">
                        <h3><?php echo esc_attr( $title ); ?></h3>
                        <p><?php echo wp_kses_post( $content ); ?></p>
                        <div class="ct-timeline-icon"></div>
                    </div>
                </div>
        <?php endif; } ?>
    </div>
</div>