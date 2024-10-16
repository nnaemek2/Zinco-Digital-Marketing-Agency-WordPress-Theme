<?php
/**
 * Template part for displaying default header layout
 */
$sticky_on =zinco_get_opt( 'sticky_on', false );
$search_on =zinco_get_opt( 'search_on', false );
$cart_on =zinco_get_opt( 'cart_on', false );
$cart_on_mobile =zinco_get_opt( 'cart_on_mobile', false );

$h_phone_number =zinco_get_opt( 'h_phone_number' );
$phone_result = preg_replace('#[ () ]*#', '', $h_phone_number);
$h3_phone =zinco_get_opt( 'h3_phone', 'hide' );

$h_btn_text =zinco_get_opt( 'h_btn_text' );
$h_btn_link_type =zinco_get_opt( 'h_btn_link_type', 'page' );
$h_btn_link =zinco_get_opt( 'h_btn_link' );
$h_btn_link_custom =zinco_get_opt( 'h_btn_link_custom' );
$h_btn_target =zinco_get_opt( 'h_btn_target', '_self' );
if($h_btn_link_type == 'page') {
    $h_btn_url = get_permalink($h_btn_link);
} else {
    $h_btn_url = $h_btn_link_custom;
}
?>
<header id="masthead" class="header-main">
    <div id="header-wrap" class="header-layout3 header-transparent <?php if($sticky_on == 1) { echo 'is-sticky'; } else { echo 'no-sticky'; } ?>" site-data-offset="80">
        <div id="header-main" class="header-main">
            <div class="container">
                <div class="row">
                    <div class="header-branding">
                        <?php get_template_part( 'template-parts/header-branding' ); ?>
                    </div>
                    <div class="header-navigation">
                        <nav class="main-navigation">
                            <div class="main-navigation-inner">
                                <div class="menu-mobile-close"><i class="zmdi zmdi-close"></i></div>
                                <?php zinco_header_mobile_search(); ?>
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                                <?php if(!empty($h_btn_text)) : ?>
                                    <div class="header-button-mobile">
                                        <a class="btn-mobile btn" href="<?php echo esc_url( $h_btn_url ); ?>" target="<?php echo esc_attr($h_btn_target); ?>"><span><?php echo esc_attr( $h_btn_text ); ?></span></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </nav>
                        <div class="site-menu-right">
                            <?php if(class_exists('Woocommerce') && $cart_on) : ?>
                                <div class="menu-right-item menu-cart">
                                    <span class="h-btn-cart"><i class="fa fa-shopping-cart"></i></span>
                                    <div class="widget_shopping_cart">
                                        <div class="widget_shopping_title">
                                            <?php echo esc_html__( 'Shopping Cart', 'zinco' ); ?> <span class="cart-couter-items">(<?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'zinco' ), WC()->cart->cart_contents_count ); ?>)</span>
                                        </div>
                                        <div class="widget_shopping_cart_content">
                                            <?php woocommerce_mini_cart(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($search_on) : ?>
                                <span class="menu-right-item h-btn-search"><i class="fa fa-search"></i></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if(!empty($h_btn_text) || has_nav_menu( 'language' )) : ?>
                        <div class="header-button-group">
                            <?php if ( has_nav_menu( 'language' ) ) : ?>
                                <div class="header-langague">
                                    <?php 
                                        $attr_menu_language = array(
                                            'theme_location' => 'language',
                                            'container'  => '',
                                            'menu_id'    => 'language-menu',
                                            'menu_class' => 'language-menu',
                                            'depth' => 1,
                                            'depth' => 2,
                                        );
                                        wp_nav_menu( $attr_menu_language );
                                    ?>
                                </div>
                            <?php endif; ?>

                            <?php if(!empty($h_btn_text)) : ?>
                                <a class="btn btn-default" href="<?php echo esc_url( $h_btn_url ); ?>" target="<?php echo esc_attr($h_btn_target); ?>"><span><?php echo esc_attr( $h_btn_text ); ?></span><i class="far fac-chevron-right"></i></a>
                            <?php endif; ?>   

                            <?php if($h3_phone == 'show' && !empty($h_phone_number)) : ?>
                                <a class="btn-phone" href="tel:<?php echo esc_attr( $phone_result ); ?>"><i class="far fac-phone"></i><span><?php echo esc_attr( $h_phone_number ); ?></span></a>
                            <?php endif; ?>                     
                        </div>
                    <?php endif; ?>
                    <div class="menu-mobile-overlay"></div>
                </div>
            </div>
            <div id="main-menu-mobile">
                <?php if (class_exists('Woocommerce') && $cart_on_mobile) : ?>
                    <div class="mobile-menu-cart">
                        <span class="h-btn-cart"><i class="fa fa-shopping-cart"></i></span>
                        <div class="widget_shopping_cart">
                            <div class="widget_shopping_title">
                                <?php echo esc_html__( 'Shopping Cart', 'zinco' ); ?> <span class="cart-couter-items">(<?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count, 'zinco' ), WC()->cart->cart_contents_count ); ?>)</span>
                            </div>
                            <div class="widget_shopping_cart_content">
                                <?php woocommerce_mini_cart(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($h3_phone == 'show' && !empty($h_phone_number)) : ?>
                    <a class="btn-phone-mobile" href="tel:<?php echo esc_attr( $phone_result ); ?>"><i class="far fac-phone"></i><span><?php echo esc_attr( $h_phone_number ); ?></span></a>
                <?php endif; ?>  
                <span class="btn-nav-mobile open-menu">
                    <span></span>
                </span>
            </div>
        </div>
    </div>
</header>