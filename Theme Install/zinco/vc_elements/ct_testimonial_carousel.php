<?php
$args = array(
    'name' => 'Testimonial Carousel',
    'base' => 'ct_testimonial_carousel',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Testimonial Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'ct_testimonial_carousel',
            'heading' => esc_html__('Shortcode Template', 'zinco'),
            'admin_label' => true,
            'group' => esc_html__('Template', 'zinco'),
            'std' => 'ct_testimonial_carousel.php'
        ),
        
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'zinco' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'zinco' ),
            'group'            => esc_html__('Template', 'zinco')
        ),

        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Testimonial Item', 'zinco' ),
            'value' => '',
            'param_name' => 'testimonial_item',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'ct_testimonial_carousel.php',
                    'ct_testimonial_carousel--layout3.php',
                )
            ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'zinco'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Position', 'zinco'),
                    'param_name' => 'position',

                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Content', 'zinco'),
                    'param_name' => 'content',
                ),
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'zinco' ),
                    'param_name' => 'image',
                    'value' => '',
                    'description' => esc_html__( 'Select image from media library.', 'zinco' ),
                ),
            ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Carousel Row', 'zinco'),
            'param_name' => 'display_row',
            'value' => array(
                'One' => '',
                'Two' => 'two',
            ),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'ct_testimonial_carousel--layout3.php',
                )
            ),
        ),

        /* Layout */
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Testimonial Item', 'zinco' ),
            'value' => '',
            'param_name' => 'testimonial_item2',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'ct_testimonial_carousel--layout2.php',
                )
            ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Title', 'zinco'),
                    'param_name' => 'title',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' =>esc_html__('Position', 'zinco'),
                    'param_name' => 'position',

                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Content', 'zinco'),
                    'param_name' => 'content',
                ),
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Title Color', 'zinco'),
            'param_name' => 'title_color',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'ct_testimonial_carousel--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Content Color', 'zinco'),
            'param_name' => 'content_color',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'ct_testimonial_carousel--layout2.php',
                )
            ),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Position Color', 'zinco'),
            'param_name' => 'position_color',
            'value' => '',
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'ct_testimonial_carousel--layout2.php',
                )
            ),
        ),

    ));

$args = zinco_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_ct_testimonial_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>