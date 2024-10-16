<?php
if (!function_exists('zinco_font_flaticon')) :

    add_filter( 'vc_iconpicker-type-flaticon', 'zinco_font_flaticon' );
    /**
    * awesome class.
    * 
    * @return string[]
    * @author CaseThemes
    */
    function zinco_font_flaticon( $icons ) {
        $flaticon = array (
            array( 'flaticon-magnifying-glass'                   => esc_html( 'flaticon-magnifying-glass' ) ),
            array( 'flaticon-right-arrow'                   => esc_html( 'flaticon-right-arrow' ) ),
            array( 'flaticon-down-arrow'                   => esc_html( 'flaticon-down-arrow' ) ),
            array( 'flaticon-left-arrow'                   => esc_html( 'flaticon-left-arrow' ) ),
            array( 'flaticon-checked'                   => esc_html( 'flaticon-checked' ) ),
            array( 'flaticon-play-button'                   => esc_html( 'flaticon-play-button' ) ),
            array( 'flaticon-twitter'                   => esc_html( 'flaticon-twitter' ) ),
            array( 'flaticon-whatsapp'                   => esc_html( 'flaticon-whatsapp' ) ),
            array( 'flaticon-youtube'                   => esc_html( 'flaticon-youtube' ) ),
            array( 'flaticon-linkedin'                   => esc_html( 'flaticon-linkedin' ) ),
            array( 'flaticon-github'                   => esc_html( 'flaticon-github' ) ),
            array( 'flaticon-facebook-logo'                   => esc_html( 'flaticon-facebook-logo' ) ),
            array( 'flaticon-apple'                   => esc_html( 'flaticon-apple' ) ),
            array( 'flaticon-up-arrow'                   => esc_html( 'flaticon-up-arrow' ) ),
            array( 'flaticon-phone-call'                   => esc_html( 'flaticon-phone-call' ) ),
            array( 'flaticon-download-arrow'                   => esc_html( 'flaticon-download-arrow' ) ),
            array( 'flaticon-left-arrow-1'                   => esc_html( 'flaticon-left-arrow-1' ) ),
            array( 'flaticon-right-arrow-1'                   => esc_html( 'flaticon-right-arrow-1' ) ),
            array( 'flaticon-call'                   => esc_html( 'flaticon-call' ) ),
            array( 'flaticon-clock'                   => esc_html( 'flaticon-clock' ) ),
            array( 'flaticon-research'                   => esc_html( 'flaticon-research' ) ),
            array( 'flaticon-coding'                   => esc_html( 'flaticon-coding' ) ),
            array( 'flaticon-analytics'                   => esc_html( 'flaticon-analytics' ) ),
            array( 'flaticon-tooth'                   => esc_html( 'flaticon-tooth' ) ),
            array( 'flaticon-tooth-1'                   => esc_html( 'flaticon-tooth-1' ) ),
            array( 'flaticon-tooth-2'                   => esc_html( 'flaticon-tooth-2' ) ),
            array( 'flaticon-tooth-3'                   => esc_html( 'flaticon-tooth-3' ) ),
            array( 'flaticon-tooth-4'                   => esc_html( 'flaticon-tooth-4' ) ),
            array( 'flaticon-broken-tooth'                   => esc_html( 'flaticon-broken-tooth' ) ),
            array( 'flaticon-molar-with-cavity'                   => esc_html( 'flaticon-molar-with-cavity' ) ),
            array( 'flaticon-brushing-teeth'                   => esc_html( 'flaticon-brushing-teeth' ) ),
            array( 'flaticon-tooth-filling'                   => esc_html( 'flaticon-tooth-filling' ) ),
            array( 'flaticon-molar-and-roots'                   => esc_html( 'flaticon-molar-and-roots' ) ),
            array( 'flaticon-user'                   => esc_html( 'flaticon-user' ) ),
            array( 'flaticon-calendar'                   => esc_html( 'flaticon-calendar' ) ),
            array( 'flaticon-customer-service'                   => esc_html( 'flaticon-customer-service' ) ),
            array( 'flaticon-stopwatch'                   => esc_html( 'flaticon-stopwatch' ) ),
            array( 'flaticon-alarm-clock'                   => esc_html( 'flaticon-alarm-clock' ) ),
            array( 'flaticon-24-hours'                   => esc_html( 'flaticon-24-hours' ) ),
            array( 'flaticon-tooth-5'                   => esc_html( 'flaticon-tooth-5' ) ),
            array( 'flaticon-doctor'                   => esc_html( 'flaticon-doctor' ) ),
            array( 'flaticon-group'                   => esc_html( 'flaticon-group' ) ),
            array( 'flaticon-hospital'                   => esc_html( 'flaticon-hospital' ) ),
            array( 'flaticon-quality'                   => esc_html( 'flaticon-quality' ) ),
            array( 'flaticon-award'                   => esc_html( 'flaticon-award' ) ),
            array( 'flaticon-medal'                   => esc_html( 'flaticon-medal' ) ),
            array( 'flaticon-medal-1'                   => esc_html( 'flaticon-medal-1' ) ),
            array( 'flaticon-add'                   => esc_html( 'flaticon-add' ) ),
            array( 'flaticon-menu'                   => esc_html( 'flaticon-menu' ) ),
            array( 'flaticon-list'                   => esc_html( 'flaticon-list' ) ),
            array( 'flaticon-shopping-cart'                   => esc_html( 'flaticon-shopping-cart' ) ),
            array( 'flaticon-shopping-cart-1'                   => esc_html( 'flaticon-shopping-cart-1' ) ),
            array( 'flaticon-shopping-cart-2'                   => esc_html( 'flaticon-shopping-cart-2' ) ),
            array( 'flaticon-double-angle-pointing-to-right'                   => esc_html( 'flaticon-double-angle-pointing-to-right' ) ),
            array( 'flaticon-double-left-chevron'                   => esc_html( 'flaticon-double-left-chevron' ) ),
            array( 'flaticon-right-quotation-mark'                   => esc_html( 'flaticon-right-quotation-mark' ) ),
            array( 'flaticon-quote-left'                   => esc_html( 'flaticon-quote-left' ) ),
            array( 'flaticon-quotes'                   => esc_html( 'flaticon-quotes' ) ),
            array( 'flaticon-left-quote'                   => esc_html( 'flaticon-left-quote' ) ),
            array( 'flaticon-reply-all-button'                   => esc_html( 'flaticon-reply-all-button' ) ),
            array( 'flaticon-reply-arrow'                   => esc_html( 'flaticon-reply-arrow' ) ),
            array( 'flaticon-reply'                   => esc_html( 'flaticon-reply' ) ),
        );
        return array_merge( $icons, $flaticon );
    }
endif;