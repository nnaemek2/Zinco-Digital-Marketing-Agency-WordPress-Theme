<?php
vc_map(array(
    'name' => 'Contact Info',
    'base' => 'ct_contact_info',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Contact Info Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
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
            'heading' =>esc_html__('Content', 'zinco'),
            'param_name' => 'content_info',
        ),

        array(
            'type' => 'colorpicker',
            'heading' => esc_html__('Content Color', 'zinco'),
            'param_name' => 'content_color',
            'value' => '',
        ),

        /* Icon */
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Library', 'zinco' ),
            'value' => array(
                esc_html__( 'Font Awesome', 'zinco' ) => 'fontawesome',
                esc_html__( 'Font Awesome 5', 'zinco' ) => 'fontawesome5',
                esc_html__( 'Material Design', 'zinco' ) => 'material_design',
                esc_html__( 'Flaticon', 'zinco' ) => 'flaticon',
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

        /* Extra */
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'zinco' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'zinco' ),
            'group'            => esc_html__('Extra', 'zinco')
        ),
    )
));

class WPBakeryShortCode_ct_contact_info extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>