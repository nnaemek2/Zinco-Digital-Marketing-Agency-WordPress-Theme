<?php
vc_map(
    array(
        'name'     => esc_html__('Portfolio Details', 'zinco'),
        'base'     => 'ct_portfolio_details',
        'class'    => 'ct-icon-element',
        'description' => esc_html__( 'Portfolio Details', 'zinco' ),
        'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
        'params'   => array(
            
            array(
                'type' => 'param_group',
                'heading' => esc_html__( 'Detail List', 'zinco' ),
                'value' => '',
                'param_name' => 'detail_list',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Label', 'zinco'),
                        'param_name' => 'label',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'textfield',
                        'heading' =>esc_html__('Content', 'zinco'),
                        'param_name' => 'content',
                        'admin_label' => true,
                    ),
                    array(
                        'type' => 'dropdown',
                        'heading' => esc_html__('Content Type', 'zinco'),
                        'param_name' => 'content_type',
                        'admin_label' => true,
                        'value' => array(
                            'Text' => 'text',
                            'Date' => 'date',
                            'Category' => 'category',
                            'Link' => 'link',
                        ),
                    ),
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
        )
    )
);

class WPBakeryShortCode_ct_portfolio_details extends CmsShortCode
{
    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>