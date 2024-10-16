<?php
$args = array(
    'name' => 'Fancy Box Carousel',
    'base' => 'ct_fancybox_carousel',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Fancy Box Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        /* Template */
        array(
            'type' => 'cms_template_img',
            'param_name' => 'cms_template',
            'shortcode' => 'ct_fancybox_carousel',
            'heading' => esc_html__('Shortcode Template', 'zinco'),
            'admin_label' => true,
            'group' => esc_html__('Template', 'zinco'),
            'std' => 'ct_fancybox_carousel.php'
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
            'heading' => esc_html__( 'Fancybox Item', 'zinco' ),
            'value' => '',
            'param_name' => 'fancybox_item',
            'params' => array(
                array(
                    'type' => 'textarea',
                    'heading' =>esc_html__('Title', 'zinco'),
                    'param_name' => 'title',
                    'admin_label' => true,
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
                array(
                    'type' => 'vc_link',
                    'heading' => __ ( 'Link', 'zinco' ),
                    'param_name' => 'link_item',
                    'value' => '',
                ),
            ),
        ),

    ));

$args = zinco_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_ct_fancybox_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>