<?php
vc_map(array(
    'name' => 'Google Map',
    'base' => 'ct_googlemap',
    'class'    => 'ct-icon-element',
    'description' => esc_html__( 'Google Map Displayed', 'zinco' ),
    'category' => esc_html__('CaseThemes Shortcodes', 'zinco'),
    'params' => array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__('API Key', 'zinco'),
            'param_name' => 'api',
            'value' => '',
            'description' => esc_html__('Enter you api key of map, get key from (//console.developers.google.com)', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Address', 'zinco'),
            'param_name' => 'address',
            'value' => 'New York, United States',
            'description' => esc_html__('Enter address of Map', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Coordinate', 'zinco'),
            'param_name' => 'coordinate',
            'value' => '',
            'description' => esc_html__('Enter coordinate of Map, format input (latitude, longitude)', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Click Show Info window', 'zinco'),
            'param_name' => 'infoclick',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('Click a marker and show info window (Default Show).', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Marker Coordinate', 'zinco'),
            'param_name' => 'markercoordinate',
            'value' => '',
            'description' => esc_html__('Enter marker coordinate of Map, format input (latitude, longitude)', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Marker Title', 'zinco'),
            'param_name' => 'markertitle',
            'value' => '',
            'description' => esc_html__('Enter Title Info windows for marker', 'zinco')
        ),
        array(
            'type' => 'textarea',
            'heading' => esc_html__('Marker Description', 'zinco'),
            'param_name' => 'markerdesc',
            'value' => '',
            'description' => esc_html__('Enter Description Info windows for marker', 'zinco')
        ),
        array(
            'type' => 'attach_image',
            'heading' => esc_html__('Marker Icon', 'zinco'),
            'param_name' => 'markericon',
            'value' => '',
            'description' => esc_html__('Select image icon for marker', 'zinco')
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__('Marker List', 'zinco'),
            'param_name' => 'markerlist',
            'value' => '',
            'description' => esc_html__('[{"coordinate":"41.058846,-73.539423","icon":"","title":"title demo 1","desc":"desc demo 1"},{"coordinate":"40.975699,-73.717636","icon":"","title":"title demo 2","desc":"desc demo 2"},{"coordinate":"41.082606,-73.469718","icon":"","title":"title demo 3","desc":"desc demo 3"}]', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Info Window Max Width', 'zinco'),
            'param_name' => 'infowidth',
            'value' => '200',
            'description' => esc_html__('Set max width for info window', 'zinco')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Map Type', 'zinco'),
            'param_name' => 'type',
            'value' => array(
                'ROADMAP' => 'ROADMAP',
                'HYBRID' => 'HYBRID',
                'SATELLITE' => 'SATELLITE',
                'TERRAIN' => 'TERRAIN'
            ),
            'description' => esc_html__('Select the map type.', 'zinco')
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__('Style Template', 'zinco'),
            'param_name' => 'style',
            'value' => array(
                'Default' => '',
                'Custom' => 'custom',
                'Light Monochrome' => 'light-monochrome',
                'Blue water' => 'blue-water',
                'Midnight Commander' => 'midnight-commander',
                'Paper' => 'paper',
                'Red Hues' => 'red-hues',
                'Hot Pink' => 'hot-pink'
            ),
            'description' => 'Select your heading size for title.'
        ),
        array(
            'type' => 'textarea_raw_html',
            'heading' => esc_html__('Custom Template', 'zinco'),
            'param_name' => 'content',
            'value' => '',
            'description' => esc_html__('Get template from //snazzymaps.com', 'zinco'),
            'dependency' => array(
                'element'=>'style',
                'value'=>array(
                    'custom',
                )
            ),
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Zoom', 'zinco'),
            'param_name' => 'zoom',
            'value' => '13',
            'description' => esc_html__('zoom level of map, default is 13', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Width', 'zinco'),
            'param_name' => 'width',
            'value' => 'auto',
            'description' => esc_html__('Width of map without pixel, default is auto', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__('Height', 'zinco'),
            'param_name' => 'height',
            'value' => '350px',
            'description' => esc_html__('Height of map without pixel, default is 350px', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Scroll Wheel', 'zinco'),
            'param_name' => 'scrollwheel',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('If false, disables scrollwheel zooming on the map. The scrollwheel is disable by default.', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Pan Control', 'zinco'),
            'param_name' => 'pancontrol',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('Show or hide Pan control.', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Zoom Control', 'zinco'),
            'param_name' => 'zoomcontrol',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('Show or hide Zoom Control.', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Scale Control', 'zinco'),
            'param_name' => 'scalecontrol',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('Show or hide Scale Control.', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Map Type Control', 'zinco'),
            'param_name' => 'maptypecontrol',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('Show or hide Map Type Control.', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Street View Control', 'zinco'),
            'param_name' => 'streetviewcontrol',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('Show or hide Street View Control.', 'zinco')
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__('Over View Map Control', 'zinco'),
            'param_name' => 'overviewmapcontrol',
            'value' => array(
                esc_html__('Yes, please', 'zinco') => true
            ),
            'description' => esc_html__('Show or hide Over View Map Control.', 'zinco')
        ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'zinco' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in Custom CSS.', 'zinco' ),
        ),
    )
));

class WPBakeryShortCode_ct_googlemap extends CmsShortCode
{

    protected function content($atts, $content = null)
    {
        return parent::content($atts, $content);
    }
}

?>