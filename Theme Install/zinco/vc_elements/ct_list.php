<?php
vc_map(array(
    'name' => 'List',
    'base' => 'ct_list',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Lists Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Layout', 'zinco'),
            'param_name' => 'layout',
            'value' => array(
                'Layout 1' => 'layout1',
                'Layout 2' => 'layout2',
            ),
        ),

        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Lists', 'zinco' ),
            'value' => '',
            'param_name' => 'lists',
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
            'dependency' => array(
                'element'=>'layout',
                'value'=>array(
                    'layout1',
                )
            ),
        ),

        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Lists', 'zinco' ),
            'value' => '',
            'param_name' => 'lists2',
            'description' => esc_html__( 'Set content for each item.', 'zinco' ),
            'params' => array(
                array(
                    'type' => 'textarea',
                    'heading' => esc_html__('Content', 'zinco'),
                    'param_name' => 'content',
                    'description' => 'Enter content.',
                    'admin_label' => true,
                ),
            ),
            'dependency' => array(
                'element'=>'layout',
                'value'=>array(
                    'layout2',
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
            'group' => esc_html__('Extra', 'zinco'),
        ),
    )
));

class WPBakeryShortCode_ct_list extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>