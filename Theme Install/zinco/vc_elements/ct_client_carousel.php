<?php
$args = array(
    'name' => 'Client Carousel',
    'base' => 'ct_client_carousel',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Clients Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(

        /* Template */
        array(
            'type' => 'param_group',
            'heading' => esc_html__( 'Client Item', 'zinco' ),
            'value' => '',
            'param_name' => 'client_item',
            'params' => array(
                array(
                    'type' => 'attach_image',
                    'heading' => esc_html__( 'Image', 'zinco' ),
                    'param_name' => 'image',
                    'value' => '',
                    'description' => esc_html__( 'Select image from media library.', 'zinco' ),
                    'admin_label' => true,
                ),
                array(
                    'type' => 'vc_link',
                    'heading' => esc_html__( 'Link', 'zinco' ),
                    'param_name' => 'link',
                    'value' => '',
                    'admin_label' => true,
                ),
            ),
        ),

    ));

$args =zinco_add_vc_extra_param($args);
vc_map($args);

class WPBakeryShortCode_ct_client_carousel extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>