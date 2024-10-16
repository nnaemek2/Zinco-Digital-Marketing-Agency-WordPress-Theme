<?php
extract(shortcode_atts(array(
    'api' => 'AIzaSyC5zxiC0OBsrygF1NMiUojKxNwP9zHYBfo',
    'address' => 'New York, United States',
    'infoclick' => '',
    'coordinate' => '',
    'markercoordinate' => '',
    'markertitle' => '',
    'markerdesc' => '',
    'markerlist' => '',
    'markericon' => '',
    'infowidth' => '200',
    'width' => 'auto',
    'height' => '350px',
    'type' => 'ROADMAP',
    'style' => '',
    'zoom' => '13',
    'scrollwheel' => '',
    'pancontrol' => '',
    'zoomcontrol' => '',
    'scalecontrol' => '',
    'maptypecontrol' => '',
    'streetviewcontrol' => '',
    'overviewmapcontrol' => '',
    'el_class' => '',
), $atts));

/* load scripts. */
$api_js = "//maps.googleapis.com/maps/api/js?sensor=false&key=".$api;
wp_enqueue_script('maps-googleapis', $api_js, array(), '3.0.0', true);
wp_enqueue_script('cms.googlemap', get_template_directory_uri() . '/assets/js/ct-googlemap.js', array('maps-googleapis'), '3.0.0', true);

/* style defualt */
$map_styles = array(
    'light-monochrome'=>'[{"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]},{"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},{"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},{"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},{"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]}]',
    'blue-water'=>'[{"featureType":"water","stylers":[{"color":"#46bcec"},{"visibility":"on"}]},{"featureType":"landscape","stylers":[{"color":"#f2f2f2"}]},{"featureType":"road","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"transit","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]}]',
    'midnight-commander'=>'[{"featureType":"water","stylers":[{"color":"#021019"}]},{"featureType":"landscape","stylers":[{"color":"#08304b"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#0c4152"},{"lightness":5}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#0b434f"},{"lightness":25}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#0b3d51"},{"lightness":16}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"}]},{"elementType":"labels.text.fill","stylers":[{"color":"#ffffff"}]},{"elementType":"labels.text.stroke","stylers":[{"color":"#000000"},{"lightness":13}]},{"featureType":"transit","stylers":[{"color":"#146474"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#144b53"},{"lightness":14},{"weight":1.4}]}]',
    'paper'=>'[{"featureType":"administrative","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"visibility":"simplified"}]},{"featureType":"road","stylers":[{"visibility":"simplified"}]},{"featureType":"water","stylers":[{"visibility":"simplified"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"landscape","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"visibility":"off"}]},{"featureType":"road.local","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","stylers":[{"visibility":"off"}]},{"featureType":"water","stylers":[{"color":"#5f94ff"},{"lightness":26},{"gamma":5.86}]},{},{"featureType":"road.highway","stylers":[{"weight":0.6},{"saturation":-85},{"lightness":61}]},{"featureType":"road"},{},{"featureType":"landscape","stylers":[{"hue":"#0066ff"},{"saturation":74},{"lightness":100}]}]',
    'red-hues'=>'[{"stylers":[{"hue":"#dd0d0d"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]}]',
    'hot-pink'=>'[{"stylers":[{"hue":"#ff61a6"},{"visibility":"on"},{"invert_lightness":true},{"saturation":40},{"lightness":10}]}]',
);

/* Select Template */
$map_template = '';
switch ($style){
    case '':
        break;
    case 'custom':
        if($content){
            $map_template = $content;
        }
        break;
    default:
        $map_template = rawurlencode($map_styles[$style]);
        break;
}

/* marker render */
$marker = new stdClass();
if($markercoordinate){
    $marker->markercoordinate = $markercoordinate;
    if($markerdesc || $markertitle){
        $marker->markerdesc =   '<div class="info-content">'.
            '<h5>'.$markertitle.'</h5>'.
            '<span>'.$markerdesc.'</span>'.
            '</div>';
    }
    if($markericon){
        $marker->markericon = wp_get_attachment_url($markericon);
    }
}

if($markerlist){
    $marker->markerlist = $markerlist;
}

$marker = rawurlencode(json_encode($marker));

$marker_css = new stdClass();
    if($markericon){
        $marker_css->markericon = '<span></span>';
    }
$marker_css = rawurlencode(json_encode($marker_css));

/* control render */
$controls = new stdClass();
if($scrollwheel == true){ $controls->scrollwheel = 1; } else { $controls->scrollwheel = 0; }
if($pancontrol == true){ $controls->pancontrol = true; } else { $controls->pancontrol = false; }
if($zoomcontrol == true){ $controls->zoomcontrol = true; } else { $controls->zoomcontrol = false; }
if($scalecontrol == true){ $controls->scalecontrol = true; } else { $controls->scalecontrol = false; }
if($maptypecontrol == true){ $controls->maptypecontrol = true; } else { $controls->maptypecontrol = false; }
if($streetviewcontrol == true){ $controls->streetviewcontrol = true; } else { $controls->streetviewcontrol = false; }
if($overviewmapcontrol == true){ $controls->overviewmapcontrol = true; } else { $controls->overviewmapcontrol = false; }
if($infoclick == true){ $controls->infoclick = true; } else { $controls->infoclick = false; }
$controls->infowidth = $infowidth;
$controls->style = $style;

$controls = rawurlencode(json_encode($controls));

/* data render */
$setting = array(
    "data-address='$address'",
    "data-marker='$marker'",
    "data-loader='$marker_css'",
    "data-coordinate='$coordinate'",
    "data-type='$type'",
    "data-zoom='$zoom'",
    "data-template='$map_template'",
    "data-controls='$controls'"
);

?>

<div class="ct-google-map">
    <div class="map-render <?php echo esc_attr( $el_class ); ?>" <?php echo implode(' ', $setting); ?> style="width:<?php echo esc_attr($width); ?>;height: <?php echo esc_attr($height); ?>"></div>
</div>