<?php
vc_map(array(
    "name" => 'Single Image',
    "base" => "ct_single_image",
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Single Image', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    "params" => array(

        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Image', 'zinco' ),
            'param_name' => 'image',
            'value' => '',
            'description' => esc_html__( 'Select image from media library.', 'zinco' ),
        ),

        array(
            "type" => "vc_link",
            "class" => "",
            "heading" => esc_html__("Link", 'zinco'),
            "param_name" => "image_link",
            "value" => '',
        ),

        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Image size', 'zinco' ),
            'param_name' => 'img_size',
            'value' => '',
            'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'zinco' ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Image Block Revealers', 'zinco'),
            'param_name' => 'block_revealers',
            'value' => array(
                'No' => 'no',
                'Yes' => 'yes',
            ),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Direction', 'zinco'),
            'param_name' => 'direction',
            'value' => array(
                'Left to Right' => 'lr',
                'Right to Left' => 'rl',
                'Top to Bottom' => 'tb',
                'Bottom to Top' => 'bt',
            ),
            'dependency' => array(
                'element'=>'block_revealers',
                'value'=>array(
                    'yes',
                )
            ),
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Overlay Color', 'zinco'),
            'param_name' => 'overlay_color',
            'value' => '',
            'dependency' => array(
                'element'=>'block_revealers',
                'value'=>array(
                    'yes',
                )
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
            "group" => esc_html__("Extra", 'zinco'),
        ),
    )
));

class WPBakeryShortCode_ct_single_image extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>