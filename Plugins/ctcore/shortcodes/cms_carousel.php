<?php
/**
 * @Template: cms_carousel.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 01-Feb-18
 */

if (!defined('ABSPATH')) exit;

if (!class_exists('CMS_Carousel')) {
    class CMS_Carousel
    {
        public function __construct()
        {
            add_action('init', array($this, 'add_shortcode'));
            add_action('vc_before_init', array($this, 'add_param'));
        }

        function add_shortcode()
        {
            $enable_cms_carousel = apply_filters('enable_cms_carousel', false);
            if ($enable_cms_carousel) {
                add_shortcode('cms_carousel', array($this, 'add_shortcode_cms_carousel'));
            }
        }

        function add_shortcode_cms_carousel($atts, $contents = '')
        {
            wp_enqueue_script('owl-carousel');
            $atts = shortcode_atts(array(
                'xsmall_items' => 1,
                'small_items'  => 2,
                'medium_items' => 3,
                'large_items'  => 4,
                'margin'       => 10,
                'loop'         => 'true',
                'mousedrag'    => 'true',
                'nav'          => 'false',
                'dots'         => 'false',
                'autoplay'     => 'false',
                'el_class'     => '',
            ), $atts);
            $contents = $this->cms_columnize_content($contents);
            if($contents[count($contents)-1] === ""){
                array_pop($contents);
            }
            return cms_get_template_file__('cms_carousel.php', array('atts' => $atts, 'contents' => $contents));
        }

        function add_param()
        {
            $enable_cms_carousel = apply_filters('enable_cms_carousel', false);
            if ($enable_cms_carousel) {
                vc_map(array(
                        "name"                    => esc_html__("CMS Carousel", CMS_TEXT_DOMAIN),
                        "base"                    => "cms_carousel",
                        "class"                   => "cms_carousel",
                        "content_element"         => true,
                        "show_settings_on_create" => false,
                        "is_container"            => true,
                        "controls"                => "full",
                        "category"                => esc_html__('CmsSuperheroes Shortcodes', CMS_TEXT_DOMAIN),
                        "description"             => esc_html__("", CMS_TEXT_DOMAIN),
                        "as_parent"               => array(
                            'except' => 'cms_carousel'
                        ),
                        "params"                  => array(
                            array(
                                "type"             => "dropdown",
                                "heading"          => __("Mini Devices", CMS_TEXT_DOMAIN),
                                "param_name"       => "xsmall_items",
                                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                                "value"            => array(1, 2, 3, 4, 5, 6),
                                "std"              => 1,
                                "group"            => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"             => "dropdown",
                                "heading"          => __("Small Devices", CMS_TEXT_DOMAIN),
                                "param_name"       => "small_items",
                                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                                "value"            => array(1, 2, 3, 4, 5, 6),
                                "std"              => 2,
                                "group"            => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"             => "dropdown",
                                "heading"          => __("Medium Devices", CMS_TEXT_DOMAIN),
                                "param_name"       => "medium_items",
                                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                                "value"            => array(1, 2, 3, 4, 5, 6),
                                "std"              => 3,
                                "group"            => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"             => "dropdown",
                                "heading"          => __("Large Devices", CMS_TEXT_DOMAIN),
                                "param_name"       => "large_items",
                                "edit_field_class" => "vc_col-sm-3 vc_carousel_item",
                                "value"            => array(1, 2, 3, 4, 5, 6),
                                "std"              => 4,
                                "group"            => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"        => "textfield",
                                "heading"     => __("Margin Items", CMS_TEXT_DOMAIN),
                                "param_name"  => "margin",
                                "value"       => "10",
                                "description" => __("", CMS_TEXT_DOMAIN),
                                "group"       => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => __("Loop Items", CMS_TEXT_DOMAIN),
                                "param_name" => "loop",
                                "value"      => array(
                                    "True"  => "true",
                                    "False" => "false"
                                ),
                                "group"      => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => __("Mouse Drag", CMS_TEXT_DOMAIN),
                                "param_name" => "mousedrag",
                                "value"      => array(
                                    "True"  => "true",
                                    "False" => "false"
                                ),
                                "group"      => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => __("Show Navigation", CMS_TEXT_DOMAIN),
                                "param_name" => "nav",
                                "value"      => array(
                                    "False" => "false",
                                    "True"  => "true",
                                ),
                                "std"        => false,
                                "group"      => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => __("Show Dots", CMS_TEXT_DOMAIN),
                                "param_name" => "dots",
                                "value"      => array(
                                    "False" => "false",
                                    "True"  => "true",
                                ),
                                "std"        => false,
                                "group"      => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"       => "dropdown",
                                "heading"    => __("Auto Play", CMS_TEXT_DOMAIN),
                                "param_name" => "autoplay",
                                "value"      => array(
                                    "False" => "false",
                                    "True"  => "true",
                                ),
                                "group"      => __("Carousel Settings", CMS_TEXT_DOMAIN)
                            ),
                            array(
                                "type"        => "textfield",
                                "heading"     => esc_html__("Extra class name", CMS_TEXT_DOMAIN),
                                "param_name"  => "el_class",
                                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", CMS_TEXT_DOMAIN),
                                "group"      => __("Extra", CMS_TEXT_DOMAIN)
                            ),
                        ),
                        "js_view"                 => 'VcColumnView'
                    )
                );
            }
        }

        protected function cms_columnize_content(&$content)
        {
            global $shortcode_tags;
            preg_match_all('@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches);
            $tagnames = array_intersect(array_keys($shortcode_tags), $matches[1]);
            $pattern = get_shortcode_regex();
            foreach ($tagnames as $tag) {
                $start = "[$tag";
                $end = "[/$tag]";

                if (strpos($content, $end) !== false) {
                    $content = str_replace($start, '' . $start, $content);
                    $content = str_replace($end, $end . '|cms|', $content);
                }
                $content = str_replace('][', ']|cms|[', $content);

            }
            return explode('|cms|', $content);

        }
    }

    new CMS_Carousel();

    if (class_exists('WPBakeryShortCodesContainer') && !class_exists('CMS_ShortcodeContainer')) {

        /**
         * Shortcode COntainer class
         */
        class CMS_ShortcodeContainer extends WPBakeryShortCodesContainer
        {

            /**
             * [$controls_css_settings description]
             * @var string
             */
            protected $controls_css_settings = 'out-tc vc_controls-content-widget';

            /**
             * [$controls_list description]
             * @var array
             */
            protected $controls_list = array('add', 'edit', 'delete');

            /**
             * @param $width
             * @param $i
             *
             * @return string
             */
            public function mainHtmlBlockParams($width, $i)
            {
                $sortable = (vc_user_access_check_shortcode_all('cms_carousel') ? 'wpb_sortable' : 'vc-non-draggable');

                return 'data-element_type="' . 'cms_carousel' . '" class="cms-content-holder wpb_' . 'cms_carousel' . ' ' . $sortable . ' wpb_content_holder vc_shortcodes_container"' . $this->customAdminBlockParams();
            }

            public function getColumnControls($controls = 'full', $extended_css = '')
            {

                $column_controls = $this->getColumnControlsModular();

                $column_controls = str_replace('vc_element-move"', 'vc_element-move" data-vc-control="move"', $column_controls);
                $column_controls = str_replace('vc_edit"', 'vc_edit" data-vc-control="add"', $column_controls);
                $column_controls = str_replace('vc_control-btn-edit"', 'vc_control-btn-edit" data-vc-control="edit"', $column_controls);
//                $column_controls = str_replace( 'vc_control-btn-clone"', 'vc_control-btn-clone" data-vc-control="clone"', $column_controls );
                $column_controls = str_replace('vc_control-btn-delete"', 'vc_control-btn-delete" data-vc-control="delete"', $column_controls);

                return $column_controls;
            }

            public function contentAdmin($atts, $content = null)
            {

                $width = $el_class = '';

                $atts = shortcode_atts($this->predefined_atts, $atts);
                extract($atts);
                $this->atts = $atts;
                $output = '';

                for ($i = 0; $i < count($width); $i++) {

                    $output .= '<div ' . $this->mainHtmlBlockParams($width, $i) . '>';

                    if ($this->backened_editor_prepend_controls) {
                        $output .= $this->getColumnControls('full', 'vc_controls-out-tc vc_controls-content-widget');
                    }


                    $output .= '<div class="cms-param-holder">';

                    $output .= $this->paramsHtmlHolders($atts);

                    $output .= '</div>';

                    $output .= '<div class="wpb_element_wrapper">';

                    $output .= '<div ' . $this->containerHtmlBlockParams($width, $i) . '>';

                    $output .= do_shortcode(shortcode_unautop($content));

                    $output .= '</div>';

                    $output .= '</div>';

                    $output .= '</div>';
                }

                return $output;
            }
        }
    }

    if (class_exists('WPBakeryShortCodesContainer')) {

        class WPBakeryShortCode_cms_carousel extends CMS_ShortcodeContainer
        {
        }

    }
}