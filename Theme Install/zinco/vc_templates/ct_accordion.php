<?php
extract(shortcode_atts(array(
    'ct_accordion' => '',
    'active_section' => '1',
    'el_title' => '',
    'el_content' => '',
    'style' => 'style1',
    'el_class' => '',
    'animation' => '',
), $atts));

$accordion = array();
$accordion = (array) vc_param_group_parse_atts($ct_accordion);
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$html_id = cmsHtmlID('ct-accordion');
$key_id = cmsHtmlID('key');
if(!empty($accordion)) : ?>
    <div id="<?php echo esc_attr($html_id); ?>" class="ct-accordion-layout1 <?php echo esc_attr($style.' '.$el_class.' '.$animation_classes); ?>">
        <div class="ct-accordion-body">
            <?php foreach ($accordion as $key => $value) {
                $ac_title = isset($value['ac_title']) ? $value['ac_title'] : '';
                $ac_content = isset($value['ac_content']) ? $value['ac_content'] : '';
                ?>
                <div class="card">
                    <div class="card-header" id="heading-<?php echo esc_attr($key_id.$key) ?>">
                        <h3 class="card-title">
                            <a data-toggle="collapse" data-target="#collapse-<?php echo esc_attr($key_id.$key) ?>" aria-expanded="<?php if($key == ($active_section - 1)) { echo 'true'; } else { echo 'false'; } ?>" aria-controls="collapse-<?php echo esc_attr($key_id.$key) ?>">
                              <?php echo esc_attr($ac_title); ?>
                              <i class="far fac-eye"></i>
                            </a>
                        </h3>
                    </div>
                    <div id="collapse-<?php echo esc_attr($key_id.$key) ?>" class="collapse  <?php if($key == ($active_section - 1)) { echo 'show'; } ?>" aria-labelledby="heading-<?php echo esc_attr($key_id.$key) ?>" data-parent="#<?php echo esc_attr($html_id); ?>">
                        <div class="card-body">
                            <?php echo wp_kses_post($ac_content); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php endif; ?>