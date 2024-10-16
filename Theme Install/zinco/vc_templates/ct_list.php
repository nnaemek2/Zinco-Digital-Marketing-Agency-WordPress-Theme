<?php
extract(shortcode_atts(array(
    'layout' => 'layout1',
    'lists' => '',
    'lists2' => '',
    'animation' => '',
    'el_class' => '',
), $atts));

$lists = (array) vc_param_group_parse_atts($lists);
$lists2 = (array) vc_param_group_parse_atts($lists2);
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
?>
<div class="ct-list <?php echo esc_attr($layout.' '.$el_class); ?>">
    <?php if($layout == 'layout1') : ?>
        <?php foreach ($lists as $key => $value) { 
            $content = isset($value['content']) ? $value['content'] : ''; 
            $title = isset($value['title']) ? $value['title'] : '';
            if(!empty($title) || !empty($content)) :?>
                <div class="ct-list-item<?php echo esc_attr($animation_classes); ?>">
                    <div class="ct-list-icon"><i class="far fac-check"></i></div>
                    <div class="ct-list-content">
                        <h3><?php echo esc_attr( $title ); ?></h3>
                        <p><?php echo wp_kses_post( $content ); ?></p>
                    </div>
                </div>
        <?php endif; } ?>
    <?php endif; ?>

    <?php if($layout == 'layout2') : ?>
        <?php foreach ($lists2 as $key => $value) { 
            $content = isset($value['content']) ? $value['content'] : ''; 
            if(!empty($content)) :?>
                <div class="ct-list-item<?php echo esc_attr($animation_classes); ?>">
                    <i class="far fac-check"></i>
                    <div class="ct-list-content">
                        <?php echo wp_kses_post( $content ); ?>
                    </div>
                </div>
        <?php endif; } ?>
    <?php endif; ?>
</div>