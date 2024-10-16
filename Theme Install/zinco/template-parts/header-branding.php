<?php
/**
 * Template part for displaying site branding
 */

$logo_dark =zinco_get_opt( 'logo', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
$logo_light =zinco_get_opt( 'logo_light', array( 'url' => get_template_directory_uri().'/assets/images/logo-light.png', 'id' => '' ) );

if ($logo_dark['url']) {
    printf(
        '<a class="logo-dark" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_dark['url'] )
    );
}
if ($logo_light['url']) {
    printf(
        '<a class="logo-light" href="%1$s" title="%2$s" rel="home"><img src="%3$s" alt="%2$s"/></a>',
        esc_url( home_url( '/' ) ),
        esc_attr( get_bloginfo( 'name' ) ),
        esc_url( $logo_light['url'] )
    );
}