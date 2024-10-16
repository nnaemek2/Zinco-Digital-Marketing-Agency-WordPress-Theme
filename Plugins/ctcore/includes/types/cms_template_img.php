<?php
vc_add_shortcode_param('cms_template_img', 'cms_shortcode_template_img');

function cms_shortcode_template_img($settings, $value) {
    $shortcode = $settings['shortcode'];
    $theme_dir = get_template_directory() . '/vc_templates';
    $reg = "/^({$shortcode}\.php|{$shortcode}--.*\.php)/";
    $files = cmsFileScanDirectory($theme_dir, $reg);
    $files = array_merge(cmsFileScanDirectory(CMS_TEMPLATES, $reg), $files);
    $output = "";
    $output .= "<select style=\"display:none;\" id=\"".$shortcode."-select-param\" name=\"" . esc_attr($settings['param_name']) . "\" class=\"wpb_vc_param_value\">";
    foreach ($files as $key => $file) {
        if ($key == esc_attr($value)) {
            $output .= "<option value=\"{$key}\" selected>{$key}</option>";
        } else {
            $output .= "<option value=\"{$key}\">{$key}</option>";
        }
    }
    $output .= "</select>";
    $output .= "<div id=\"".$shortcode."-cms-img-select\">";
    foreach ($files as $key => $file) {
        $img = get_template_directory_uri().'/vc_elements/image_layout/'.$shortcode.'/'.basename($key,'.php').'.jpg';
        if ($key == esc_attr($value)) {
            $output .= "<div class='cms-img-select-item'><img src=\"".$img."\" data-value=\"".$key."\" class=\"cms-img-select selected\" /></div>";
        } else {
            $output .= "<div class='cms-img-select-item'><img src=\"".$img."\" data-value=\"".$key."\" class=\"cms-img-select\" /></div>";
        }
    }
    $output .= "</div>";
    $script = '
    <script type="text/javascript">
        jQuery(\'button.vc_panel-btn-save[data-save=true]\').click(function(){
            jQuery(\'.cms_custom_param.vc_dependent-hidden\').remove();
        });
        jQuery(document).ready(function($){
            $("#'.$shortcode.'-cms-img-select").find("img.cms-img-select").click(function(){
                var $this = $(this);
                $("#'.$shortcode.'-cms-img-select").find("img.cms-img-select").removeClass("selected");
                $this.addClass("selected");console.log($(":hidden#'.$shortcode.'-select-param"));
                $(":hidden#'.$shortcode.'-select-param").val($this.data("value")).change();
            });
            
            if($("select[name=\'filter_styles\']").length > 0){      
                _filter_templates($("select[name=\'filter_styles\']").val());
            }
             
            $("body").on("change","select[name=\'filter_styles\']", function(){
                _filter_templates($(this).val());
            });
                    
            function _filter_templates(_tem){
                 $("#'.$shortcode.'-cms-img-select").find("img").each(function(){
                    if($(this).data("value").indexOf(_tem) >= 0){
                        $(this).css("display","");
                    } else {
                        $(this).css("display","none");
                    }
                });
            }
        });           
    </script>';
    return $output.$script;
}
?>