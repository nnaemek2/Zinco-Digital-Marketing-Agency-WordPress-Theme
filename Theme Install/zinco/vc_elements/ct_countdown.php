<?php
	if(class_exists('CmsShortCode')){
		vc_map(
			array(
				'name' => esc_html__('Countdown', 'zinco'),
			    'base' => 'ct_countdown',
			    'class'    => 'ct-icon-element',
            	'description' => esc_html__( 'Countdown Displayed', 'zinco' ),
			    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
			    'params' => array(
			        array(
			            'type' => 'textfield',
			            'heading' => esc_html__('Date count down', 'zinco'),
			            'param_name' => 'date_count_down',
			            'value' => '',
			            'description' => esc_html__('Set date count down (Date format: yy/mm/dd)', 'zinco'),
			        ),
			        array(
			            'type' => 'textfield',
			            'heading' => esc_html__( 'Extra class name', 'zinco' ),
			            'param_name' => 'el_class',
			            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'zinco' ),
			        	'group' => esc_html__('Extra', 'zinco'),
			        ),
			        array(
			            'type' => 'animation_style',
			            'heading' => esc_html__( 'Animation Style', 'zinco' ),
			            'param_name' => 'animation',
			            'description' => esc_html__( 'Choose your animation style', 'zinco' ),
			            'admin_label' => false,
			            'weight' => 0,
			            'group' => esc_html__('Extra', 'zinco'),
			        )
			    )
			)
		);
		class WPBakeryShortCode_ct_countdown extends CmsShortCode{
			protected function content($atts, $content = null){
				wp_enqueue_script('ct-countdown-config', get_template_directory_uri() . '/assets/js/ct-countdown.js', array( 'jquery' ), 'all', true);
				return parent::content($atts, $content);
			}
		}
	}
?>