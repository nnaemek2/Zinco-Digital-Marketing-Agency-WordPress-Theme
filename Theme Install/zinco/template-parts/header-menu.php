<?php
/**
 * Template part for displaying the primary menu of the site
 */
$h_custom_menu = zinco_get_page_opt('h_custom_menu');
if ( has_nav_menu( 'primary' ) )
{
    $attr_menu = array(
        'theme_location' => 'primary',
        'container'  => '',
        'menu_id'    => 'primary-menu',
        'menu_class' => 'primary-menu clearfix',
        'walker'         => class_exists( 'EFramework_Mega_Menu_Walker' ) ? new EFramework_Mega_Menu_Walker : '',
    );
    if(!empty($h_custom_menu)) {
        $attr_menu['menu'] = $h_custom_menu;
    }
    wp_nav_menu( $attr_menu );
}
else
{
    printf(
        '<ul class="primary-menu-not-set style-none"><li><a href="%1$s">%2$s</a></li></ul>',
        esc_url( admin_url( 'nav-menus.php' ) ),
        esc_html__( 'Create New Menu', 'zinco' )
    );
}