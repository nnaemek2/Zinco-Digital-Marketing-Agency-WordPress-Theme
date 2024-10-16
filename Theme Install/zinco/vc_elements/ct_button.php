<?php
vc_map(array(
    'name' => 'Button',
    'base' => 'ct_button',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Button Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text', 'zinco' ),
            'param_name' => 'button_text',
            'value' => '',
            'admin_label' => true,
            'group' => esc_html__('Button Settings', 'zinco')
        ),
        array(
            'type' => 'vc_link',
            'class' => '',
            'heading' => esc_html__('Link', 'zinco'),
            'param_name' => 'button_link',
            'value' => '',
            'group' => esc_html__('Button Settings', 'zinco')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button Style', 'zinco'),
            'param_name' => 'button_style',
            'value' => array(
                'Primary' => 'btn-default',
                'Secondary' => 'btn-secondary',
                'Aylen' => 'btn-aylen',
                'Moema' => 'btn-moema',
                'Modern White' => 'btn-default btn-modern-white',
            ),
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Button Size', 'zinco'),
            'param_name' => 'button_size',
            'value' => array(
                'Default' => 'size-default',
                'Large' => 'size-lg',
            ),
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Large', 'zinco'),
            'param_name' => 'align_lg',
            'value' => array(
                'Left' => 'align-left',
                'Center' => 'align-center',
                'Right' => 'align-right',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Medium', 'zinco'),
            'param_name' => 'align_md',
            'value' => array(
                'Left' => 'align-left-md',
                'Center' => 'align-center-md',
                'Right' => 'align-right-md',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Small', 'zinco'),
            'param_name' => 'align_sm',
            'value' => array(
                'Left' => 'align-left-sm',
                'Center' => 'align-center-sm',
                'Right' => 'align-right-sm',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Align Mini', 'zinco'),
            'param_name' => 'align_xs',
            'value' => array(
                'Left' => 'align-left-xs',
                'Center' => 'align-center-xs',
                'Right' => 'align-right-xs',
            ),
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        /* Padding */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Top', 'zinco'),
            'param_name' => 'padding_top',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Right', 'zinco'),
            'param_name' => 'padding_right',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Bottom', 'zinco'),
            'param_name' => 'padding_bottom',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Padding Left', 'zinco'),
            'param_name' => 'padding_left',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        /* Border radius */
        /* Padding */
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Top', 'zinco'),
            'param_name' => 'br_top',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Right', 'zinco'),
            'param_name' => 'br_right',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Bottom', 'zinco'),
            'param_name' => 'br_bottom',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Border Radius Left', 'zinco'),
            'param_name' => 'br_left',
            'description' => 'Enter number.',
            'edit_field_class' => 'vc_col-sm-3 vc_column',
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Library', 'zinco' ),
            'value' => array(
                esc_html__( 'Font Awesome 4', 'zinco' ) => 'fontawesome',
                esc_html__( 'Font Awesome 5', 'zinco' ) => 'fontawesome5',
                esc_html__( 'Material Design', 'zinco' ) => 'material_design',
                esc_html__( 'ET Line', 'zinco' ) => 'etline',
                esc_html__( 'Themify', 'zinco' ) => 'themify',
            ),
            'param_name' => 'icon_list',
            'description' => esc_html__( 'Select icon library.', 'zinco' ),
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
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon Themify', 'zinco' ),
            'param_name' => 'icon_themify',
            'settings' => array(
                'emptyIcon' => true,
                'type' => 'themify',
                'iconsPerPage' => 200,
            ),
            'dependency' => array(
                'element' => 'icon_list',
                'value' => 'themify',
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
            'type' => 'textfield',
            'heading' => esc_html__( 'Icon Font Size', 'zinco' ),
            'param_name' => 'icon_font_size',
            'description' => esc_html__( 'Enter number.', 'zinco' ),
            'group' => esc_html__('Icon', 'zinco'),
        ),      
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'zinco' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'zinco' ),
            'group'            => esc_html__('Button Settings', 'zinco')
        ),
        array(
            'type' => 'animation_style',
            'heading' => esc_html__( 'Animation Style', 'zinco' ),
            'param_name' => 'animation',
            'description' => esc_html__( 'Choose your animation style', 'zinco' ),
            'admin_label' => false,
            'weight' => 0,
            'group' => esc_html__('Button Settings', 'zinco'),
        ),
    )
));

class WPBakeryShortCode_ct_button extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>