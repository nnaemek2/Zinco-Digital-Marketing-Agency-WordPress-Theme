<?php
vc_map(array(
    'name' => 'Accordion',
    'base' => 'ct_accordion',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Collapsible content panels', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' =>esc_html__('Active section', 'zinco'),
            'param_name' => 'active_section',
            'description' => 'Enter active section number (Note: to have all sections closed on initial load enter non-existing number).',
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Accordion Items', 'zinco' ),
            'param_name' => 'ct_accordion',
            'description' => esc_html__( 'Enter values for accordion item', 'zinco' ),
            'value' => '',
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'zinco'),
                    'param_name' => 'ac_title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea',
                    'heading' =>esc_html__('Content', 'zinco'),
                    'param_name' => 'ac_content',
                ),
            ),
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
            'group'            => esc_html__('Extra', 'zinco')
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

class WPBakeryShortCode_ct_accordion extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}
?>