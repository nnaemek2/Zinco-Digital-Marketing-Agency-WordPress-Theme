<?php
extract(shortcode_atts(array(   

    'date_count_down'  => '', 
    'el_class'         => '',  
    'animation'        => '',   

), $atts));
$date_count_down = !empty($date_count_down) ? $date_count_down : '2020/03/10';
$animation_tmp = isset($animation) ? $animation : '';
$animation_classes = $this->getCSSAnimation( $animation_tmp );
$month = esc_html__('Month', 'zinco');
$months = esc_html__('Months', 'zinco');
$day = esc_html__('Day', 'zinco');
$days = esc_html__('Days', 'zinco');
$hour = esc_html__('Hour', 'zinco');
$hours = esc_html__('Hours', 'zinco');
$minute = esc_html__('Minute', 'zinco');
$minutes = esc_html__('Minutes', 'zinco');
$second = esc_html__('Second', 'zinco');
$seconds = esc_html__('Seconds', 'zinco'); ?>
<div class="ct-countdown-wrap">
	<div class="ct-countdown <?php echo esc_attr( $animation_classes.' '.$el_class ); ?>" 
		data-month="<?php echo esc_attr($month) ?>"
		data-months="<?php echo esc_attr($months) ?>"
		data-day="<?php echo esc_attr($day) ?>"
		data-days="<?php echo esc_attr($days) ?>"
		data-hour="<?php echo esc_attr($hour) ?>"
		data-hours="<?php echo esc_attr($hours) ?>"
		data-minute="<?php echo esc_attr($minute) ?>"
		data-minutes="<?php echo esc_attr($minutes) ?>"
		data-second="<?php echo esc_attr($second) ?>"
		data-seconds="<?php echo esc_attr($seconds) ?>">
		<div class="ct-countdown-inner" data-count-down="<?php echo esc_attr($date_count_down);?>"></div>
	</div>
</div>