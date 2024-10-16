<?php
/**
 * @Template: revslider.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 28-Nov-17
 */
if(!defined('ABSPATH')){
    die();
}

function ct_ie_revslider_import($folder)
{

    global $import_result;
    /* if class RevSlider does not exists. */
    if (!class_exists('RevSlider'))
        return;

    $folder = trailingslashit($folder . '/revslider/');

    if(is_dir($folder)){
        $slider = new RevSliderSliderImport();

        $files = scandir($folder);

        $files = array_diff($files, array('..', '.'));

        foreach ($files as $_f){

            $_FILES["import_file"]["tmp_name"] = $folder . $_f;
            $_FILES['import_file']['error'] = '';

            ob_start();

            $slider->import_slider();

            $log[] = ob_get_clean();
            $import_result = $log;
        }
    }

}

function ct_ie_revslider_export($folder){
    global $wp_filesystem;

    if(class_exists('RevSliderSlider')){
        if(!is_dir($folder . '/revslider/'))
            wp_mkdir_p($folder . '/revslider/');

        $slider = new RevSliderSlider();
        $arrSliders = $slider->get_sliders();

        if ( $arrSliders ) {
            foreach ( $arrSliders as $slider ) {
                ct_ie_revslider_export_slider($slider, $folder);
            }
        }
    }
}

/**
 * export slider from data, output a file for download
 * RevSliderSliderExport::export_slider()
 */
function ct_ie_revslider_export_slider($slider, $folder){
    $id = $slider->id;
    $slider_export = new RevSliderSliderExport();

    //slider needs to be initialized :)
    if($id > 0){
        $slider_export->init_by_id($id);
    }
    
    //check if an update is needed
    if(version_compare($slider_export->get_param(array('settings', 'version')), get_option('revslider_update_revision', '6.0.0'), '<')){
        $upd = new RevSliderPluginUpdate();
        $upd->upgrade_slider_to_latest($slider_export);
        $slider_export->init_by_id($id);
    }
    
    $slider_export->set_parameters();
    $slider_export->remove_image_ids();
    $slider_export->remove_background_image();
    
    $slider_export->add_used_images();
    $slider_export->add_used_videos();
    $slider_export->add_used_navigations();
    $slider_export->add_used_svg();
    $slider_export->modify_used_data();
    
    $slider_export->serialize_export_data();
    $slider_export->serialize_navigation_data();
    $slider_export->prepare_caption_css();
    $slider_export->serialize_animation_data();
    
    $slider_export->create_export_zip();
    $slider_export->add_svg_to_zip();
    $slider_export->add_images_videos_to_zip();
    $slider_export->add_slider_export_to_zip();
    $slider_export->add_animations_to_zip();
    $slider_export->add_styles_to_zip();
    $slider_export->add_navigation_to_zip();
    $slider_export->add_static_styles_to_zip();
    $slider_export->add_info_to_zip();
    $slider_export->close_export_zip();
    // $slider_export->push_zip_to_client();
    rename($slider_export->export_path_zip, $folder . '/revslider/' . $slider->get_alias() . '.zip');
    $slider_export->delete_export_zip();

    return $slider_export->export_path_zip;
}

function old_ct_ie_revslider_export($folder){
    global $wp_filesystem;

    if(class_exists('RevSlider')){
        if(!is_dir($folder . '/revslider/'))
            wp_mkdir_p($folder . '/revslider/');

        $slider = new RevSlider();

        $arrSliders = $slider->getArrSliders();

        $slider_class = new RevSliderSlider();

        if ( $arrSliders ) {

            foreach ( $arrSliders as $slider ) {

                $slider_class->initByID($slider->getID());

                $rev_file = ct_ie_revslider_export_slider($slider_class, $slider->getAlias(), $slider->getParams());

                rename($rev_file, $folder . '/revslider/' . $slider->getAlias() . '.zip');
            }
        }
    }

}

/**
 *
 * export slider from data, output a file for download
 */
function old_ct_ie_revslider_export_slider($slider, $alias, $sliderParams, $useDummy = false){

    $arrSlides = $slider->getSlidesForExport($useDummy);
    $arrStaticSlide = $slider->getStaticSlideForExport($useDummy);

    $usedCaptions = array();
    $usedAnimations = array();
    $usedImages = array();
    $usedSVG = array();
    $usedVideos = array();
    $usedNavigations = array();

    $cfw = array();
    if(!empty($arrSlides) && count($arrSlides) > 0) $cfw = array_merge($cfw, $arrSlides);
    if(!empty($arrStaticSlide) && count($arrStaticSlide) > 0) $cfw = array_merge($cfw, $arrStaticSlide);


    //remove image_id as it is not needed in export
    if(!empty($arrSlides)){
        foreach($arrSlides as $k => $s){
            if(isset($arrSlides[$k]['params']['image_id'])) unset($arrSlides[$k]['params']['image_id']);
        }
    }
    if(!empty($arrStaticSlide)){
        foreach($arrStaticSlide as $k => $s){
            if(isset($arrStaticSlide[$k]['params']['image_id'])) unset($arrStaticSlide[$k]['params']['image_id']);
        }
    }

    if(!empty($cfw) && count($cfw) > 0){
        foreach($cfw as $key => $slide){
            if(isset($slide['params']['image']) && $slide['params']['image'] != '') $usedImages[$slide['params']['image']] = true; //['params']['image'] background url
            if(isset($slide['params']['background_image']) && $slide['params']['background_image'] != '') $usedImages[$slide['params']['background_image']] = true; //['params']['image'] background url
            if(isset($slide['params']['slide_thumb']) && $slide['params']['slide_thumb'] != '') $usedImages[$slide['params']['slide_thumb']] = true; //['params']['image'] background url

            //html5 video
            if(isset($slide['params']['background_type']) && $slide['params']['background_type'] == 'html5'){
                if(isset($slide['params']['slide_bg_html_mpeg']) && $slide['params']['slide_bg_html_mpeg'] != '') $usedVideos[$slide['params']['slide_bg_html_mpeg']] = true;
                if(isset($slide['params']['slide_bg_html_webm']) && $slide['params']['slide_bg_html_webm'] != '') $usedVideos[$slide['params']['slide_bg_html_webm']] = true;
                if(isset($slide['params']['slide_bg_html_ogv']) && $slide['params']['slide_bg_html_ogv'] != '') $usedVideos[$slide['params']['slide_bg_html_ogv']] = true;
            }else{
                if(isset($slide['params']['slide_bg_html_mpeg']) && $slide['params']['slide_bg_html_mpeg'] != '') $slide['params']['slide_bg_html_mpeg'] = '';
                if(isset($slide['params']['slide_bg_html_webm']) && $slide['params']['slide_bg_html_webm'] != '') $slide['params']['slide_bg_html_webm'] = '';
                if(isset($slide['params']['slide_bg_html_ogv']) && $slide['params']['slide_bg_html_ogv'] != '') $slide['params']['slide_bg_html_ogv'] = '';
            }

            //image thumbnail
            if(isset($slide['layers']) && !empty($slide['layers']) && count($slide['layers']) > 0){
                foreach($slide['layers'] as $lKey => $layer){
                    if(isset($layer['style']) && $layer['style'] != '') $usedCaptions[$layer['style']] = true;
                    if(isset($layer['animation']) && $layer['animation'] != '' && strpos($layer['animation'], 'customin') !== false) $usedAnimations[str_replace('customin-', '', $layer['animation'])] = true;
                    if(isset($layer['endanimation']) && $layer['endanimation'] != '' && strpos($layer['endanimation'], 'customout') !== false) $usedAnimations[str_replace('customout-', '', $layer['endanimation'])] = true;
                    if(isset($layer['image_url']) && $layer['image_url'] != '') $usedImages[$layer['image_url']] = true; //image_url if image caption

                    if(isset($layer['type']) && ($layer['type'] == 'video' || $layer['type'] == 'audio')){

                        $video_data = (isset($layer['video_data'])) ? (array) $layer['video_data'] : array();

                        if(!empty($video_data) && isset($video_data['video_type']) && $video_data['video_type'] == 'html5'){

                            if(isset($video_data['urlPoster']) && $video_data['urlPoster'] != '') $usedImages[$video_data['urlPoster']] = true;

                            if(isset($video_data['urlMp4']) && $video_data['urlMp4'] != '') $usedVideos[$video_data['urlMp4']] = true;
                            if(isset($video_data['urlWebm']) && $video_data['urlWebm'] != '') $usedVideos[$video_data['urlWebm']] = true;
                            if(isset($video_data['urlOgv']) && $video_data['urlOgv'] != '') $usedVideos[$video_data['urlOgv']] = true;

                        }elseif(!empty($video_data) && isset($video_data['video_type']) && $video_data['video_type'] != 'html5'){ //video cover image
                            if($video_data['video_type'] == 'audio'){
                                if(isset($video_data['urlAudio']) && $video_data['urlAudio'] != '') $usedVideos[$video_data['urlAudio']] = true;
                            }else{
                                if(isset($video_data['previewimage']) && $video_data['previewimage'] != '') $usedImages[$video_data['previewimage']] = true;
                            }
                        }

                        if($video_data['video_type'] != 'html5'){
                            $video_data['urlMp4'] = '';
                            $video_data['urlWebm'] = '';
                            $video_data['urlOgv'] = '';
                        }
                        if($video_data['video_type'] != 'audio'){
                            $video_data['urlAudio'] = '';
                        }
                    }

                    if(isset($layer['type']) && $layer['type'] == 'svg'){
                        if(isset($layer['svg']) && isset($layer['svg']->src)){
                            $usedSVG[$layer['svg']->src] = true;
                        }
                    }
                }
            }
        }
    }


    $arrSliderExport = array("params"=>$sliderParams,"slides"=>$arrSlides);
    if(!empty($arrStaticSlide))
        $arrSliderExport['static_slides'] = $arrStaticSlide;

    $strExport = serialize($arrSliderExport);

    //$strExportAnim = serialize(RevSliderOperations::getFullCustomAnimations());

    $exportname = (!empty($alias)) ? $alias.'.zip' : "slider_export.zip";

    //add navigations if not default animation
    if(isset($sliderParams['navigation_arrow_style'])) $usedNavigations[$sliderParams['navigation_arrow_style']] = true;
    if(isset($sliderParams['navigation_bullets_style'])) $usedNavigations[$sliderParams['navigation_bullets_style']] = true;
    if(isset($sliderParams['thumbnails_style'])) $usedNavigations[$sliderParams['thumbnails_style']] = true;
    if(isset($sliderParams['tabs_style'])) $usedNavigations[$sliderParams['tabs_style']] = true;
    $navs = false;
    if(!empty($usedNavigations)){
        $navs = RevSliderNavigation::export_navigation($usedNavigations);
        if($navs !== false) $navs = serialize($navs);
    }


    $styles = '';
    if(!empty($usedCaptions)){
        $captions = array();
        foreach($usedCaptions as $class => $val){
            $cap = RevSliderOperations::getCaptionsContentArray($class);
            //set also advanced styles here...
            if(!empty($cap))
                $captions[] = $cap;
        }
        $styles = RevSliderCssParser::parseArrayToCss($captions, "\n", true);
    }

    $animations = '';
    if(!empty($usedAnimations)){
        $animation = array();
        foreach($usedAnimations as $anim => $val){
            $anima = RevSliderOperations::getFullCustomAnimationByID($anim);
            if($anima !== false) $animation[] = $anima;

        }
        if(!empty($animation)) $animations = serialize($animation);
    }

    $usedImages = array_merge($usedImages, $usedVideos);

    $usepcl = false;
    if(class_exists('ZipArchive')){
        $zip = new ZipArchive;
        $success = $zip->open(RevSliderGlobals::$uploadsUrlExportZip, ZIPARCHIVE::CREATE | ZipArchive::OVERWRITE);

        if($success !== true)
            throwError("Can't create zip file: ".RevSliderGlobals::$uploadsUrlExportZip);

    }else{
        //fallback to pclzip
        require_once(ABSPATH . 'wp-admin/includes/class-pclzip.php');

        $pclzip = new PclZip(RevSliderGlobals::$uploadsUrlExportZip);

        //either the function uses die() or all is cool
        $usepcl = true;
    }

    //add svg to the zip
    if(!empty($usedSVG)){
        $content_url = content_url();
        $content_path = ABSPATH . 'wp-content';
        foreach($usedSVG as $file => $val){
            if(strpos($file, 'http') !== false){ //remove all up to wp-content folder
                $checkpath = str_replace($content_url, '', $file);

                if(is_file($content_path.$checkpath)){
                    /*if(!$usepcl){
                        $zip->addFile($content_path.$checkpath, 'svg/'.$checkpath);
                    }else{
                        $v_list = $pclzip->add($content_path.$checkpath, PCLZIP_OPT_REMOVE_PATH, $content_path, PCLZIP_OPT_ADD_PATH, 'svg/');
                    }*/
                    $strExport = str_replace($file, $checkpath, $strExport);
                }
            }
        }
    }

    //add images to zip
    if(!empty($usedImages)){
        $upload_dir = RevSliderFunctionsWP::getPathUploads();
        $upload_dir_multisiteless = wp_upload_dir();
        $cont_url = $upload_dir_multisiteless['baseurl'];
        $cont_url_no_www = str_replace('www.', '', $upload_dir_multisiteless['baseurl']);
        $upload_dir_multisiteless = $upload_dir_multisiteless['basedir'].'/';

        foreach($usedImages as $file => $val){
            if($useDummy == "true"){ //only use dummy images

            }else{ //use the real images
                if(strpos($file, 'http') !== false){
                    $remove = false;
                    $checkpath = str_replace(array($cont_url, $cont_url_no_www), '', $file);

                    if(is_file($upload_dir.$checkpath)){
                        if(!$usepcl){
                            $zip->addFile($upload_dir.$checkpath, 'images/'.$checkpath);
                        }else{
                            $v_list = $pclzip->add($upload_dir.$checkpath, PCLZIP_OPT_REMOVE_PATH, $upload_dir, PCLZIP_OPT_ADD_PATH, 'images/');
                        }
                        $remove = true;
                    }elseif(is_file($upload_dir_multisiteless.$checkpath)){
                        if(!$usepcl){
                            $zip->addFile($upload_dir_multisiteless.$checkpath, 'images/'.$checkpath);
                        }else{
                            $v_list = $pclzip->add($upload_dir_multisiteless.$checkpath, PCLZIP_OPT_REMOVE_PATH, $upload_dir_multisiteless, PCLZIP_OPT_ADD_PATH, 'images/');
                        }
                        $remove = true;
                    }

                    if($remove){ //as its http, remove this from strexport
                        $strExport = str_replace(array($cont_url.$checkpath, $cont_url_no_www.$checkpath), $checkpath, $strExport);
                    }
                }else{
                    if(is_file($upload_dir.$file)){
                        if(!$usepcl){
                            $zip->addFile($upload_dir.$file, 'images/'.$file);
                        }else{
                            $v_list = $pclzip->add($upload_dir.$file, PCLZIP_OPT_REMOVE_PATH, $upload_dir, PCLZIP_OPT_ADD_PATH, 'images/');
                        }
                    }elseif(is_file($upload_dir_multisiteless.$file)){
                        if(!$usepcl){
                            $zip->addFile($upload_dir_multisiteless.$file, 'images/'.$file);
                        }else{
                            $v_list = $pclzip->add($upload_dir_multisiteless.$file, PCLZIP_OPT_REMOVE_PATH, $upload_dir_multisiteless, PCLZIP_OPT_ADD_PATH, 'images/');
                        }
                    }
                }
            }
        }
    }

    if(!$usepcl){
        $zip->addFromString("slider_export.txt", $strExport); //add slider settings
    }else{
        $list = $pclzip->add(array(array( PCLZIP_ATT_FILE_NAME => 'slider_export.txt',PCLZIP_ATT_FILE_CONTENT => $strExport)));
        if ($list == 0) { die("ERROR : '".$pclzip->errorInfo(true)."'"); }

    }
    if(strlen(trim($animations)) > 0){
        if(!$usepcl){
            $zip->addFromString("custom_animations.txt", $animations); //add custom animations
        }else{
            $list = $pclzip->add(array(array( PCLZIP_ATT_FILE_NAME => 'custom_animations.txt',PCLZIP_ATT_FILE_CONTENT => $animations)));
            if ($list == 0) { die("ERROR : '".$pclzip->errorInfo(true)."'"); }
        }
    }
    if(strlen(trim($styles)) > 0){
        if(!$usepcl){
            $zip->addFromString("dynamic-captions.css", $styles); //add dynamic styles
        }else{
            $list = $pclzip->add(array(array( PCLZIP_ATT_FILE_NAME => 'dynamic-captions.css',PCLZIP_ATT_FILE_CONTENT => $styles)));
            if ($list == 0) { die("ERROR : '".$pclzip->errorInfo(true)."'"); }
        }
    }
    if(strlen(trim($navs)) > 0){
        if(!$usepcl){
            $zip->addFromString("navigation.txt", $navs); //add dynamic styles
        }else{
            $list = $pclzip->add(array(array( PCLZIP_ATT_FILE_NAME => 'navigation.txt',PCLZIP_ATT_FILE_CONTENT => $navs)));
            if ($list == 0) { die("ERROR : '".$pclzip->errorInfo(true)."'"); }
        }
    }

    $static_css = RevSliderOperations::getStaticCss();
    if(trim($static_css) !== ''){
        if(!$usepcl){
            $zip->addFromString("static-captions.css", $static_css); //add slider settings
        }else{
            $list = $pclzip->add(array(array( PCLZIP_ATT_FILE_NAME => 'static-captions.css',PCLZIP_ATT_FILE_CONTENT => $static_css)));
            if ($list == 0) { die("ERROR : '".$pclzip->errorInfo(true)."'"); }
        }
    }
    $enable_slider_pack = apply_filters('revslider_slider_pack_export', false);

    if($enable_slider_pack){ //allow for slider packs the automatic creation of the info.cfg
        if(!$usepcl){
            $zip->addFromString('info.cfg', md5($alias)); //add slider settings
        }else{
            $list = $pclzip->add(array(array( PCLZIP_ATT_FILE_NAME => 'info.cfg',PCLZIP_ATT_FILE_CONTENT => md5($alias))));
            if ($list == 0) { die("ERROR : '".$pclzip->errorInfo(true)."'"); }
        }
    }

    if(!$usepcl){
        $zip->close();
    }else{
        //do nothing
    }

    return RevSliderGlobals::$uploadsUrlExportZip;
}