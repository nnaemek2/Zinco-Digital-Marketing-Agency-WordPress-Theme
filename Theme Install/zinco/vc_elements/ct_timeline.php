<?php
vc_map(array(
    'name' => 'Timeline',
    'base' => 'ct_timeline',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Timeline Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Timeline', 'zinco' ),
            'value' => '',
            'param_name' => 'timeline',
            'description' => esc_html__( 'Set content for each item.', 'zinco' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'zinco'),
                    'param_name' => 'title',
                    'description' => 'Enter title.',
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Content', 'zinco'),
                    'param_name' => 'content',
                    'description' => 'Enter content.',
                ),
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

class WPBakeryShortCode_ct_timeline extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>