<?php
vc_map(array(
    'name' => 'Counter',
    'base' => 'ct_counter',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Counter Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        /* Title */
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Title', 'zinco'),
            'param_name' => 'title',
            'description' => 'Enter title.',
            'group' => esc_html__('Title', 'zinco'),
            'admin_label' => true,
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'zinco'),
            'param_name' => 'title_color',
            'value' => '',
            'group' => esc_html__('Title', 'zinco'),
        ),

        /* Digit */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Digit', 'zinco'),
            'param_name' => 'digit',
            'description' => 'Enter digit.',
            'group' => esc_html__('Digit', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Prefix', 'zinco'),
            'param_name' => 'prefix',
            'description' => 'Enter prefix.',
            'group' => esc_html__('Digit', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Suffix', 'zinco'),
            'param_name' => 'suffix',
            'description' => 'Enter suffix.',
            'group' => esc_html__('Digit', 'zinco'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Color', 'zinco'),
            'param_name' => 'digit_color',
            'value' => '',
            'group' => esc_html__('Digit', 'zinco'),
        ),

        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Use Grouping', 'zinco'),
            'param_name' => 'grouping',
            'value' => array(
                'No' => '0',
                'Yes' => '1',
            ),
            'group' => esc_html__('Digit', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Separator', 'zinco'),
            'param_name' => 'separator',
            'group' => esc_html__('Digit', 'zinco'),
            'dependency' => array(
                'element'=>'grouping',
                'value'=>array(
                    '1',
                )
            ),
        ),

        /* Icon */
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Icon Type', 'zinco'),
            'param_name' => 'icon_type',
            'value' => array(
                'Icon' => 'icon',
                'Image' => 'image',
            ),
            'group' => esc_html__('Icon', 'zinco'),
            'dependency' => array(
                'element'=>'cms_template',
                'value'=>array(
                    'ct_fancybox.php',
                )
            ),
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__( 'Icon Image', 'zinco' ),
            'param_name' => 'icon_image',
            'value' => '',
            'description' => esc_html__( 'Select icon image from media library.', 'zinco' ),
            'dependency' => array(
                'element'=>'icon_type',
                'value'=>array(
                    'image',
                )
            ),
            'group' => esc_html__('Icon', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Library', 'zinco' ),
            'value' => array(
                esc_html__( 'Font Awesome 4', 'zinco' ) => 'fontawesome',
                esc_html__( 'Font Awesome 5', 'zinco' ) => 'fontawesome5',
                esc_html__( 'Material Design', 'zinco' ) => 'material_design',
                esc_html__( 'Flaticon', 'zinco' ) => 'flaticon',
                esc_html__( 'ET Line', 'zinco' ) => 'etline',
            ),
            'param_name' => 'icon_list',
            'description' => esc_html__( 'Select icon library.', 'zinco' ),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'icon',
            ),
            'group' => esc_html__('Icon', 'zinco'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon Material', 'zinco' ),
            'param_name' => 'icon_material_design',
            'settings' => array(
                'emptyIcon' => true,
                'type' => 'material-design',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'material_design',
            ),
            'description' => esc_html__( 'Select icon from library.', 'zinco' ),
            'group' => esc_html__('Icon', 'zinco'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon FontAwesome 4', 'zinco' ),
            'param_name' => 'icon_fontawesome',
            'value' => '',
            'settings' => array(
                'emptyIcon' => true,
                'type' => 'fontawesome',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'fontawesome',
            ),
            'description' => esc_html__( 'Select icon from library.', 'zinco' ),
            'group' => esc_html__('Icon', 'zinco'),
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
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'fontawesome5',
            ),
            'description' => esc_html__( 'Select icon from library.', 'zinco' ),
            'group' => esc_html__('Icon', 'zinco'),
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
            'group' => esc_html__('Icon', 'zinco'),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'fontawesome5',
            ),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Flaticon', 'zinco' ),
            'param_name' => 'icon_flaticon',
            'settings' => array(
                'emptyIcon' => true,
                'type' => 'flaticon',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'flaticon',
            ),
            'description' => esc_html__( 'Select icon from library.', 'zinco' ),
            'group' => esc_html__('Icon', 'zinco'),
        ),
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon ET Line', 'zinco' ),
            'param_name' => 'icon_etline',
            'settings' => array(
                'emptyIcon' => true,
                'type' => 'etline',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'etline',
            ),
            'description' => esc_html__( 'Select icon from library.', 'zinco' ),
            'group' => esc_html__('Icon', 'zinco'),
        ),
        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Icon Color', 'zinco'),
            'param_name' => 'icon_color',
            'value' => '',
            'group' => esc_html__('Icon', 'zinco'),
            'dependency' => array(
                'element' => 'icon_type',
                'value' => 'icon',
            ),
            'edit_field_class' => 'vc_col-sm-6 vc_column',
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

class WPBakeryShortCode_ct_counter extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>