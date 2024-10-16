<?php
vc_map(array(
    'name' => 'Counter Grid',
    'base' => 'ct_counter_grid',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Counter Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        array(
            'type' => 'textfield',
            'heading' => esc_html__('Element Title', 'zinco'),
            'param_name' => 'el_title',
            'description' => 'Enter element title.',
            'admin_label' => true,
        ),

        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Counters', 'zinco' ),
            'value' => '',
            'param_name' => 'counters',
            'description' => esc_html__( 'Set content for each item.', 'zinco' ),
            'params' => array(
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Title', 'zinco'),
                    'param_name' => 'title',
                    'description' => 'Enter title.',
                    'group' => esc_html__('Title', 'zinco'),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Digit', 'zinco'),
                    'param_name' => 'digit',
                    'description' => 'Enter digit.',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Prefix', 'zinco'),
                    'param_name' => 'prefix',
                    'description' => 'Enter prefix.',
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_html__('Suffix', 'zinco'),
                    'param_name' => 'suffix',
                    'description' => 'Enter suffix.',
                ),
                array(
                    'type' => 'iconpicker',
                    'heading' => esc_html__( 'Icon FontAwesome 5', 'zinco' ),
                    'param_name' => 'icon_fontawesome5',
                    'value' => '',
                    'settings' => array(
                        'emptyIcon' => true,
                        'type' => 'awesome5',
                        'iconsPerPage' => 200,
                    ),
                    'description' => esc_html__( 'Select icon from library.', 'zinco' ),
                ), 
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__('Icon Weight', 'zinco'),
                    'param_name' => 'icon_weight',
                    'value' => array(
                        'Solid' => '',
                        'Regular' => 'icon-far',
                        'Light' => 'icon-fal',
                        'Brands' => 'icon-fab',
                    ),
                ),
            ),
        ),

        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns XS', 'zinco'),
            'param_name'       => 'col_xs',
            'edit_field_class' => 'vc_col-sm-1/5 vc_column',
            'value'            => array(1, 2, 3, 4),
            'std'              => 1,
            'group'            => esc_html__('Grid Settings', 'zinco')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns SM', 'zinco'),
            'param_name'       => 'col_sm',
            'edit_field_class' => 'vc_col-sm-1/5 vc_column',
            'value'            => array(1, 2, 3, 4),
            'std'              => 2,
            'group'            => esc_html__('Grid Settings', 'zinco')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns MD', 'zinco'),
            'param_name'       => 'col_md',
            'edit_field_class' => 'vc_col-sm-1/5 vc_column',
            'value'            => array(1, 2, 3, 4),
            'std'              => 2,
            'group'            => esc_html__('Grid Settings', 'zinco')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns LG', 'zinco'),
            'param_name'       => 'col_lg',
            'edit_field_class' => 'vc_col-sm-1/5 vc_column',
            'value'            => array(1, 2, 3, 4),
            'std'              => 4,
            'group'            => esc_html__('Grid Settings', 'zinco')
        ),
        array(
            'type'             => 'dropdown',
            'heading'          => esc_html__('Columns XL', 'zinco'),
            'param_name'       => 'col_xl',
            'edit_field_class' => 'vc_col-sm-1/5 vc_column',
            'value'            => array(1, 2, 3, 4),
            'std'              => 4,
            'group'            => esc_html__('Grid Settings', 'zinco')
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

class WPBakeryShortCode_ct_counter_grid extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>