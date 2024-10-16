<?php
if (!function_exists('zinco_font_themify')) :

    add_filter( 'vc_iconpicker-type-themify', 'zinco_font_themify' );
    /**
    * awesome class.
    * 
    * @return string[]
    * @author CaseThemes
    */
    function zinco_font_themify( $icons ) {
        $themify = array (
            array( 'ti-wand' => esc_html( 'Icon Themify' ) ),

            array( 'ti-volume' => esc_html( 'Icon Themify' ) ),

            array( 'ti-user' => esc_html( 'Icon Themify' ) ),

            array( 'ti-unlock' => esc_html( 'Icon Themify' ) ),

            array( 'ti-unlink' => esc_html( 'Icon Themify' ) ),

            array( 'ti-trash' => esc_html( 'Icon Themify' ) ),

            array( 'ti-thought' => esc_html( 'Icon Themify' ) ),

            array( 'ti-target' => esc_html( 'Icon Themify' ) ),

            array( 'ti-tag' => esc_html( 'Icon Themify' ) ),

            array( 'ti-tablet' => esc_html( 'Icon Themify' ) ),

            array( 'ti-star' => esc_html( 'Icon Themify' ) ),

            array( 'ti-spray' => esc_html( 'Icon Themify' ) ),

            array( 'ti-signal' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shopping-cart' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shopping-cart-full' => esc_html( 'Icon Themify' ) ),

            array( 'ti-settings' => esc_html( 'Icon Themify' ) ),

            array( 'ti-search' => esc_html( 'Icon Themify' ) ),

            array( 'ti-zoom-in' => esc_html( 'Icon Themify' ) ),

            array( 'ti-zoom-out' => esc_html( 'Icon Themify' ) ),

            array( 'ti-cut' => esc_html( 'Icon Themify' ) ),

            array( 'ti-ruler' => esc_html( 'Icon Themify' ) ),

            array( 'ti-ruler-pencil' => esc_html( 'Icon Themify' ) ),

            array( 'ti-ruler-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bookmark' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bookmark-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-reload' => esc_html( 'Icon Themify' ) ),

            array( 'ti-plus' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pin' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pencil' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pencil-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-paint-roller' => esc_html( 'Icon Themify' ) ),

            array( 'ti-paint-bucket' => esc_html( 'Icon Themify' ) ),

            array( 'ti-na' => esc_html( 'Icon Themify' ) ),

            array( 'ti-mobile' => esc_html( 'Icon Themify' ) ),

            array( 'ti-minus' => esc_html( 'Icon Themify' ) ),

            array( 'ti-medall' => esc_html( 'Icon Themify' ) ),

            array( 'ti-medall-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-marker' => esc_html( 'Icon Themify' ) ),

            array( 'ti-marker-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-lock' => esc_html( 'Icon Themify' ) ),

            array( 'ti-location-arrow' => esc_html( 'Icon Themify' ) ),

            array( 'ti-link' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layers' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layers-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-key' => esc_html( 'Icon Themify' ) ),

            array( 'ti-import' => esc_html( 'Icon Themify' ) ),

            array( 'ti-image' => esc_html( 'Icon Themify' ) ),

            array( 'ti-heart' => esc_html( 'Icon Themify' ) ),

            array( 'ti-heart-broken' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hand-stop' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hand-open' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hand-drag' => esc_html( 'Icon Themify' ) ),

            array( 'ti-folder' => esc_html( 'Icon Themify' ) ),

            array( 'ti-flag' => esc_html( 'Icon Themify' ) ),

            array( 'ti-flag-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-flag-alt-2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-eye' => esc_html( 'Icon Themify' ) ),

            array( 'ti-export' => esc_html( 'Icon Themify' ) ),

            array( 'ti-exchange-vertical' => esc_html( 'Icon Themify' ) ),

            array( 'ti-desktop' => esc_html( 'Icon Themify' ) ),

            array( 'ti-cup' => esc_html( 'Icon Themify' ) ),

            array( 'ti-crown' => esc_html( 'Icon Themify' ) ),

            array( 'ti-comments' => esc_html( 'Icon Themify' ) ),

            array( 'ti-comment' => esc_html( 'Icon Themify' ) ),

            array( 'ti-comment-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-close' => esc_html( 'Icon Themify' ) ),

            array( 'ti-clip' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-check' => esc_html( 'Icon Themify' ) ),

            array( 'ti-check-box' => esc_html( 'Icon Themify' ) ),

            array( 'ti-camera' => esc_html( 'Icon Themify' ) ),

            array( 'ti-announcement' => esc_html( 'Icon Themify' ) ),

            array( 'ti-brush' => esc_html( 'Icon Themify' ) ),

            array( 'ti-briefcase' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bolt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bolt-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-blackboard' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bag' => esc_html( 'Icon Themify' ) ),

            array( 'ti-move' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrows-vertical' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrows-horizontal' => esc_html( 'Icon Themify' ) ),

            array( 'ti-fullscreen' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-top-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-top-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-circle-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-circle-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-circle-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrow-circle-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-double-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-double-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-double-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-angle-double-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-zip' => esc_html( 'Icon Themify' ) ),

            array( 'ti-world' => esc_html( 'Icon Themify' ) ),

            array( 'ti-wheelchair' => esc_html( 'Icon Themify' ) ),

            array( 'ti-view-list' => esc_html( 'Icon Themify' ) ),

            array( 'ti-view-list-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-view-grid' => esc_html( 'Icon Themify' ) ),

            array( 'ti-uppercase' => esc_html( 'Icon Themify' ) ),

            array( 'ti-upload' => esc_html( 'Icon Themify' ) ),

            array( 'ti-underline' => esc_html( 'Icon Themify' ) ),

            array( 'ti-truck' => esc_html( 'Icon Themify' ) ),

            array( 'ti-timer' => esc_html( 'Icon Themify' ) ),

            array( 'ti-ticket' => esc_html( 'Icon Themify' ) ),

            array( 'ti-thumb-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-thumb-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-text' => esc_html( 'Icon Themify' ) ),

            array( 'ti-stats-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-stats-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-split-v' => esc_html( 'Icon Themify' ) ),

            array( 'ti-split-h' => esc_html( 'Icon Themify' ) ),

            array( 'ti-smallcap' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shine' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shift-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shift-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shield' => esc_html( 'Icon Themify' ) ),

            array( 'ti-notepad' => esc_html( 'Icon Themify' ) ),

            array( 'ti-server' => esc_html( 'Icon Themify' ) ),

            array( 'ti-quote-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-quote-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pulse' => esc_html( 'Icon Themify' ) ),

            array( 'ti-printer' => esc_html( 'Icon Themify' ) ),

            array( 'ti-power-off' => esc_html( 'Icon Themify' ) ),

            array( 'ti-plug' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pie-chart' => esc_html( 'Icon Themify' ) ),

            array( 'ti-paragraph' => esc_html( 'Icon Themify' ) ),

            array( 'ti-panel' => esc_html( 'Icon Themify' ) ),

            array( 'ti-package' => esc_html( 'Icon Themify' ) ),

            array( 'ti-music' => esc_html( 'Icon Themify' ) ),

            array( 'ti-music-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-mouse' => esc_html( 'Icon Themify' ) ),

            array( 'ti-mouse-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-money' => esc_html( 'Icon Themify' ) ),

            array( 'ti-microphone' => esc_html( 'Icon Themify' ) ),

            array( 'ti-menu' => esc_html( 'Icon Themify' ) ),

            array( 'ti-menu-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-map' => esc_html( 'Icon Themify' ) ),

            array( 'ti-map-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-loop' => esc_html( 'Icon Themify' ) ),

            array( 'ti-location-pin' => esc_html( 'Icon Themify' ) ),

            array( 'ti-list' => esc_html( 'Icon Themify' ) ),

            array( 'ti-light-bulb' => esc_html( 'Icon Themify' ) ),

            array( 'ti-italic' => esc_html( 'Icon Themify' ) ),

            array( 'ti-info' => esc_html( 'Icon Themify' ) ),

            array( 'ti-infinite' => esc_html( 'Icon Themify' ) ),

            array( 'ti-id-badge' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hummer' => esc_html( 'Icon Themify' ) ),

            array( 'ti-home' => esc_html( 'Icon Themify' ) ),

            array( 'ti-help' => esc_html( 'Icon Themify' ) ),

            array( 'ti-headphone' => esc_html( 'Icon Themify' ) ),

            array( 'ti-harddrives' => esc_html( 'Icon Themify' ) ),

            array( 'ti-harddrive' => esc_html( 'Icon Themify' ) ),

            array( 'ti-gift' => esc_html( 'Icon Themify' ) ),

            array( 'ti-game' => esc_html( 'Icon Themify' ) ),

            array( 'ti-filter' => esc_html( 'Icon Themify' ) ),

            array( 'ti-files' => esc_html( 'Icon Themify' ) ),

            array( 'ti-file' => esc_html( 'Icon Themify' ) ),

            array( 'ti-eraser' => esc_html( 'Icon Themify' ) ),

            array( 'ti-envelope' => esc_html( 'Icon Themify' ) ),

            array( 'ti-download' => esc_html( 'Icon Themify' ) ),

            array( 'ti-direction' => esc_html( 'Icon Themify' ) ),

            array( 'ti-direction-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-dashboard' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-stop' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-shuffle' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-play' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-pause' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-forward' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-backward' => esc_html( 'Icon Themify' ) ),

            array( 'ti-cloud' => esc_html( 'Icon Themify' ) ),

            array( 'ti-cloud-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-cloud-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-clipboard' => esc_html( 'Icon Themify' ) ),

            array( 'ti-car' => esc_html( 'Icon Themify' ) ),

            array( 'ti-calendar' => esc_html( 'Icon Themify' ) ),

            array( 'ti-book' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bell' => esc_html( 'Icon Themify' ) ),

            array( 'ti-basketball' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bar-chart' => esc_html( 'Icon Themify' ) ),

            array( 'ti-bar-chart-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-back-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-back-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-arrows-corner' => esc_html( 'Icon Themify' ) ),

            array( 'ti-archive' => esc_html( 'Icon Themify' ) ),

            array( 'ti-anchor' => esc_html( 'Icon Themify' ) ),

            array( 'ti-align-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-align-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-align-justify' => esc_html( 'Icon Themify' ) ),

            array( 'ti-align-center' => esc_html( 'Icon Themify' ) ),

            array( 'ti-alert' => esc_html( 'Icon Themify' ) ),

            array( 'ti-alarm-clock' => esc_html( 'Icon Themify' ) ),

            array( 'ti-agenda' => esc_html( 'Icon Themify' ) ),

            array( 'ti-write' => esc_html( 'Icon Themify' ) ),

            array( 'ti-window' => esc_html( 'Icon Themify' ) ),

            array( 'ti-widgetized' => esc_html( 'Icon Themify' ) ),

            array( 'ti-widget' => esc_html( 'Icon Themify' ) ),

            array( 'ti-widget-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-wallet' => esc_html( 'Icon Themify' ) ),

            array( 'ti-video-clapper' => esc_html( 'Icon Themify' ) ),

            array( 'ti-video-camera' => esc_html( 'Icon Themify' ) ),

            array( 'ti-vector' => esc_html( 'Icon Themify' ) ),

            array( 'ti-themify-logo' => esc_html( 'Icon Themify' ) ),

            array( 'ti-themify-favicon' => esc_html( 'Icon Themify' ) ),

            array( 'ti-themify-favicon-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-support' => esc_html( 'Icon Themify' ) ),

            array( 'ti-stamp' => esc_html( 'Icon Themify' ) ),

            array( 'ti-split-v-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-slice' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shortcode' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shift-right-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-shift-left-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-ruler-alt-2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-receipt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pin2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pin-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pencil-alt2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-palette' => esc_html( 'Icon Themify' ) ),

            array( 'ti-more' => esc_html( 'Icon Themify' ) ),

            array( 'ti-more-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-microphone-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-magnet' => esc_html( 'Icon Themify' ) ),

            array( 'ti-line-double' => esc_html( 'Icon Themify' ) ),

            array( 'ti-line-dotted' => esc_html( 'Icon Themify' ) ),

            array( 'ti-line-dashed' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-width-full' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-width-default' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-width-default-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-tab' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-tab-window' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-tab-v' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-tab-min' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-slider' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-slider-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-sidebar-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-sidebar-none' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-sidebar-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-placeholder' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-menu' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-menu-v' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-menu-separated' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-menu-full' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-right-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-overlay' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-overlay-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-overlay-alt-2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-left-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-center-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-media-center' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-list-thumb' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-list-thumb-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-list-post' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-list-large-image' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-line-solid' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-grid4' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-grid3' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-grid2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-grid2-thumb' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-cta-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-cta-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-cta-center' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-cta-btn-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-cta-btn-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-column4' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-column3' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-column2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-accordion-separated' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-accordion-merged' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-accordion-list' => esc_html( 'Icon Themify' ) ),

            array( 'ti-ink-pen' => esc_html( 'Icon Themify' ) ),

            array( 'ti-info-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-help-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-headphone-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hand-point-up' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hand-point-right' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hand-point-left' => esc_html( 'Icon Themify' ) ),

            array( 'ti-hand-point-down' => esc_html( 'Icon Themify' ) ),

            array( 'ti-gallery' => esc_html( 'Icon Themify' ) ),

            array( 'ti-face-smile' => esc_html( 'Icon Themify' ) ),

            array( 'ti-face-sad' => esc_html( 'Icon Themify' ) ),

            array( 'ti-credit-card' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-skip-forward' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-skip-backward' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-record' => esc_html( 'Icon Themify' ) ),

            array( 'ti-control-eject' => esc_html( 'Icon Themify' ) ),

            array( 'ti-comments-smiley' => esc_html( 'Icon Themify' ) ),

            array( 'ti-brush-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-youtube' => esc_html( 'Icon Themify' ) ),

            array( 'ti-vimeo' => esc_html( 'Icon Themify' ) ),

            array( 'ti-twitter' => esc_html( 'Icon Themify' ) ),

            array( 'ti-time' => esc_html( 'Icon Themify' ) ),

            array( 'ti-tumblr' => esc_html( 'Icon Themify' ) ),

            array( 'ti-skype' => esc_html( 'Icon Themify' ) ),

            array( 'ti-share' => esc_html( 'Icon Themify' ) ),

            array( 'ti-share-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-rocket' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pinterest' => esc_html( 'Icon Themify' ) ),

            array( 'ti-new-window' => esc_html( 'Icon Themify' ) ),

            array( 'ti-microsoft' => esc_html( 'Icon Themify' ) ),

            array( 'ti-list-ol' => esc_html( 'Icon Themify' ) ),

            array( 'ti-linkedin' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-sidebar-2' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-grid4-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-grid3-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-grid2-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-column4-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-column3-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-layout-column2-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-instagram' => esc_html( 'Icon Themify' ) ),

            array( 'ti-google' => esc_html( 'Icon Themify' ) ),

            array( 'ti-github' => esc_html( 'Icon Themify' ) ),

            array( 'ti-flickr' => esc_html( 'Icon Themify' ) ),

            array( 'ti-facebook' => esc_html( 'Icon Themify' ) ),

            array( 'ti-dropbox' => esc_html( 'Icon Themify' ) ),

            array( 'ti-dribbble' => esc_html( 'Icon Themify' ) ),

            array( 'ti-apple' => esc_html( 'Icon Themify' ) ),

            array( 'ti-android' => esc_html( 'Icon Themify' ) ),

            array( 'ti-save' => esc_html( 'Icon Themify' ) ),

            array( 'ti-save-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-yahoo' => esc_html( 'Icon Themify' ) ),

            array( 'ti-wordpress' => esc_html( 'Icon Themify' ) ),

            array( 'ti-vimeo-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-twitter-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-tumblr-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-trello' => esc_html( 'Icon Themify' ) ),

            array( 'ti-stack-overflow' => esc_html( 'Icon Themify' ) ),

            array( 'ti-soundcloud' => esc_html( 'Icon Themify' ) ),

            array( 'ti-sharethis' => esc_html( 'Icon Themify' ) ),

            array( 'ti-sharethis-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-reddit' => esc_html( 'Icon Themify' ) ),

            array( 'ti-pinterest-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-microsoft-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-linux' => esc_html( 'Icon Themify' ) ),

            array( 'ti-jsfiddle' => esc_html( 'Icon Themify' ) ),

            array( 'ti-joomla' => esc_html( 'Icon Themify' ) ),

            array( 'ti-html5' => esc_html( 'Icon Themify' ) ),

            array( 'ti-flickr-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-email' => esc_html( 'Icon Themify' ) ),

            array( 'ti-drupal' => esc_html( 'Icon Themify' ) ),

            array( 'ti-dropbox-alt' => esc_html( 'Icon Themify' ) ),

            array( 'ti-css3' => esc_html( 'Icon Themify' ) ),

            array( 'ti-rss' => esc_html( 'Icon Themify' ) ),

            array( 'ti-rss-alt' => esc_html( 'Icon Themify' ) ),
        );
        return array_merge( $icons, $themify );
    }
endif;