<?php
vc_map(
    array(
        'name'     => esc_html__('Testimonial Grid', 'zinco'),
        'base'     => 'ct_testimonial_grid',
        'class'    => 'ct-icon-element',
        'description' => esc_html__( 'Testimonial Displayed', 'zinco' ),
        'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
        'params'   => array(
            array(
                'type' => 'cms_template_img',
                'param_name' => 'cms_template',
                'shortcode' => 'ct_testimonial_grid',
                'heading' => esc_html__('Shortcode Template', 'zinco'),
                'admin_label' => true,
                'std' => 'ct_testimonial_grid.php',
                'group' => esc_html__('Template', 'zinco'),
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
                'heading' => esc_html__( 'Content', 'zinco' ),
                'param_name' => 'content_list',
                'description' => esc_html__( 'Enter values for team item', 'zinco' ),
                'value' => '',
                'group' => esc_html__('Source Settings', 'zinco'),
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Title', 'zinco'),
                        'param_name' => 'title',
                        'admin_label' => true,
                        'group' => esc_html__('Source Settings', 'zinco'),
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => esc_html__('Content', 'zinco'),
                        'param_name' => 'content',
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Position', 'zinco'),
                        'param_name' => 'position',
                        'admin_label' => true,
                        'group' => esc_html__('Source Settings', 'zinco'),
                    ),
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Title Color', 'zinco'),
                'param_name' => 'title_color',
                'value' => '',
                'group' => esc_html__('Source Settings', 'zinco'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Content Color', 'zinco'),
                'param_name' => 'content_color',
                'value' => '',
                'group' => esc_html__('Source Settings', 'zinco'),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Position Color', 'zinco'),
                'param_name' => 'position_color',
                'value' => '',
                'group' => esc_html__('Source Settings', 'zinco'),
            ),
            array(
                "type"             => "dropdown",
                "heading"          => esc_html__( "Columns XS", 'zinco' ),
                "param_name"       => "col_xs",
                "edit_field_class" => "ct-col-5",
                "value"            => array( 1, 2, 3, 4 ),
                "std"              => 1,
                "group"            => 'Column Settings',
            ),
            array(
                "type"             => "dropdown",
                "heading"          => esc_html__( "Columns SM", 'zinco' ),
                "param_name"       => "col_sm",
                "edit_field_class" => "ct-col-5",
                "value"            => array( 1, 2, 3, 4 ),
                "std"              => 2,
                "group"            => 'Column Settings',
            ),
            array(
                "type"             => "dropdown",
                "heading"          => esc_html__( "Columns MD", 'zinco' ),
                "param_name"       => "col_md",
                "edit_field_class" => "ct-col-5",
                "value"            => array( 1, 2, 3, 4, 5 ),
                "std"              => 3,
                "group"            => 'Column Settings',
            ),
            array(
                "type"             => "dropdown",
                "heading"          => esc_html__( "Columns LG", 'zinco' ),
                "param_name"       => "col_lg",
                "edit_field_class" => "ct-col-5",
                "value"            => array( 1, 2, 3, 4, 5, 6 ),
                "std"              => 4,
                "group"            => 'Column Settings',
            ),
            array(
                "type"             => "dropdown",
                "heading"          => esc_html__( "Columns XL", 'zinco' ),
                "param_name"       => "col_xl",
                "edit_field_class" => "ct-col-5",
                "value"            => array( 1, 2, 3, 4, 5, 6 ),
                "std"              => 4,
                "group"            => 'Column Settings',
            ),
        )
    )
);

class WPBakeryShortCode_ct_testimonial_grid extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        $html_id = cmsHtmlID('ct-testimonial-grid');
        $atts['html_id'] = $html_id;
        return parent::content($atts, $content);
    }
}

?>