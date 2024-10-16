<?php
vc_map(array(
    'name' => 'Pricing',
    'base' => 'ct_pricing',
    'class' => 'ct-icon-element',
    'description' => esc_html__( 'Pricing Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        /* Layout Classic */
        array(
            'type' => 'textfield',
            'heading' => __ ( 'Title', 'zinco' ),
            'param_name' => 'title',
            'value' => '',
            'group' => esc_html__('Source Settings', 'zinco'),
            'admin_label' => true,
        ),
        array(
            'type' => 'textfield',
            'heading' => __ ( 'Price', 'zinco' ),
            'param_name' => 'price',
            'value' => '',
            'group' => esc_html__('Source Settings', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => __ ( 'Time', 'zinco' ),
            'param_name' => 'pricing_time',
            'value' => '',
            'group' => esc_html__('Source Settings', 'zinco'),
        ),
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Description', 'zinco' ),
            'param_name' => 'description',
            'value' => '',
            'group' => esc_html__('Source Settings', 'zinco'),
            'params' => array(
                array(
                    "type" => "textfield",
                    "heading" =>esc_html__("Item", 'zinco'),
                    "param_name" => "description_item",
                    'admin_label' => true,
                ),
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => __ ( 'Text Button', 'zinco' ),
            'param_name' => 'text_button',
            'value' => '',
            'group' => esc_html__('Source Settings', 'zinco'),
        ),
        array(
            'type' => 'vc_link',
            'heading' => __ ( 'Link Button', 'zinco' ),
            'param_name' => 'link_button',
            'value' => '',
            'group' => esc_html__('Source Settings', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Featured', 'zinco'),
            'param_name' => 'featured',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes',
            ),
            'group' => esc_html__('Source Settings', 'zinco'),
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

class WPBakeryShortCode_ct_pricing extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>