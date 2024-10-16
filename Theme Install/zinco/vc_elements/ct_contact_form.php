<?php
    if(class_exists('WPCF7')) {
        $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

        $contact_forms = array();
        if ( $cf7 ) {
            foreach ( $cf7 as $cform ) {
                $contact_forms[ $cform->post_title ] = $cform->ID;
            }
        } else {
            $contact_forms[ esc_html__( 'No contact forms found', 'zinco' ) ] = 0;
        }

        vc_map(array(
            'name' => 'Contact Form',
            'base' => 'ct_contact_form',
            'class'    => 'ct-icon-element',
            'description' => esc_html__( 'Contact Form 7', 'zinco' ),
            'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
            'params' => array(

                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Select Contact Form', 'zinco' ),
                    'param_name' => 'id',
                    'value' => $contact_forms,
                    'save_always' => true,
                    'admin_label' => true,
                    'description' => esc_html__( 'Choose previously created contact form from the drop down list.', 'zinco' ),
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Styles', 'zinco'),
                    'param_name' => 'style',
                    'value' => array(
                        'Style 1' => 'style1',
                        'Style 2' => 'style2',
                    ),
                ),
                /* Extra */
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__( 'Extra class name', 'zinco' ),
                    'param_name' => 'el_class',
                    'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'zinco' ),
                    'group'      => esc_html__('Extra', 'zinco'),
                ),
                array(
                    'type' => 'animation_style',
                    'heading' => esc_html__( 'Animation Style', 'zinco' ),
                    'param_name' => 'animation',
                    'description' => esc_html__( 'Choose your animation style', 'zinco' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => esc_html__('Extra', 'zinco'),
                ),
            )
        ));

        class WPBakeryShortCode_ct_contact_form extends CmsShortCode
        {

            protected function content($atts, $content = null)
            {
                return parent::content($atts, $content);
            }
        }
    }
?>