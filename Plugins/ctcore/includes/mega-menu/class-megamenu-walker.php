<?php
/**
 * @Template: class-megamenu-walker.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 22-Nov-17
 */
if(!defined('ABSPATH')){
    die();
}
class EFramework_Mega_Menu_Walker extends Walker_Nav_Menu {
    private $item;
    /**
     * Starts the list before the elements are added.
     *
     * @since 3.0.0
     *
     * @see Walker::start_lvl()
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of wp_nav_menu() arguments.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    /**
     * @see Walker::start_el()
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $item_html = '';
        if( '[divider]' === $item->title ) {
            $output .= '<li class="menu-item-divider"></li>';
            return;
        }
        $this->item = $item->cms_onepage;
        if($this->item ==='item-one-page' && !wp_script_is('ct-one-page')){
            wp_enqueue_script('ct-one-page', CMS_JS . 'one-page.js', array('jquery'), 'all',true);
        }
        add_filter('nav_menu_link_attributes',function ($atts){
            $atts['class'] = $this->item;
            return $atts;
        },10,1);
        if( !empty( $item->cms_megaprofile ) ) {
            $item->classes[] = 'megamenu megamenu-style-alt';
        }

        if( ! empty( $args->local_scroll ) && $depth === 0 ) {
            $item->classes[] = 'local-scroll' ;
        }
        $item->cms_icon_position = 'left';
        if( !empty( $item->cms_icon ) ) {
            if( 'left' === $item->cms_icon_position ) {
                $args->old_link_before = $args->link_before;
                $args->link_before = '<span class="link-icon left-icon"><i class="'. esc_attr( $item->cms_icon ) .'"></i></span>' . $args->link_before;
            } else {
                $args->old_link_after = $args->link_after;
                $args->link_after = $args->link_after . '<span class="link-icon right-icon"><i class="'. esc_attr( $item->cms_icon ) .'"></i></span>';
            }
        }

        parent::start_el( $item_html, $item, $depth, $args, $id );

        if( isset( $args->old_link_before ) ) {

            $args->link_before = $args->old_link_before;
            $args->old_link_before = '';
        }

        if( isset( $args->old_link_after ) ) {
            $args->link_after = $args->old_link_after;
            $args->old_link_after = '';
        }

        if( !empty( $item->cms_megaprofile ) ) {
            $item_html .= $this->get_megamenu( $item->cms_megaprofile );
        }

        $output .= $item_html;
    }

    function get_megamenu( $id ) {
        $post = get_post( $id );
        $content = do_shortcode( $post->post_content );

        $css = $this->get_vc_custom_css( $id );

        return $css . '<ul class="sub-menu"><li><div class="container">' . $content . '</div></li></ul>';
    }

    public function get_vc_custom_css( $id ) {

        $out = '';

        if ( ! $id ) {
            return;
        }

        $post_custom_css = get_post_meta( $id, '_wpb_post_custom_css', true );
        if ( ! empty( $post_custom_css ) ) {
            $post_custom_css = strip_tags( $post_custom_css );
            $out .= '<style type="text/css" data-type="vc_custom-css">';
            $out .= $post_custom_css;
            $out .= '</style>';
        }

        $shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
        if ( ! empty( $shortcodes_custom_css ) ) {
            $shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
            $out .= '<style type="text/css" data-type="vc_shortcodes-custom-css">';
            $out .= $shortcodes_custom_css;
            $out .= '</style>';
        }

        return $out;
    }

    function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

        // check whether this item has children, and set $item->hasChildren accordingly
        $element->hasChildren = isset( $children_elements[$element->ID] ) && !empty( $children_elements[$element->ID] );

        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}