<?php
vc_add_shortcode_param('img', 'img_types');

function img_types($settings, $value) {
    $output ='
    <div class="img-select">
        <ul>';
            foreach ( $settings['value'] as $index => $data ){
                $active = ($index == $value)? 'active' : '' ;
                $output .= '
                    <li data-value="'.esc_attr($index).'" class="'.esc_attr($active).'"><img alt="" src="'.esc_url($data).'"></li>
                ';
            }
    $output.='
        </ul>
        <select style="display:none;" name="'.esc_attr($settings['param_name']).'" class=" wpb_vc_param_value wpb-input wpb-select '
               . $settings['param_name']
               . ' ' . $settings['type']
               . '" >';
           foreach ( $settings['value'] as $index => $data ){
                $selected = ($index == $value)? ' selected="" ' : '' ;
                $output .= '
                    <option value="'.esc_attr($index).'" '.$selected.' >'.esc_attr($index).'</option>
                ';
            }
    $output .= '</select>
    </div>
    ';
    $script = '
        <script type="text/javascript">
            jQuery(".img-select").each(function(){
                var $_this = jQuery(this);
                $_this.on("click","li",function(){
                    $_this.find("li").removeClass("active");
                    jQuery(this).addClass("active");
                    var value = jQuery(this).data("value");
                    $_this.find("select").val(value);
                    $_this.find("select").change();
                })
            })
        </script>
    ';
    return $output.$script;
}
?>