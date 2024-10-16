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
?>
<header id="masthead" class="header-main">
    <div id="header-wrap" class="header-layout2 header-transparent <?php if($sticky_on == 1) { echo 'is-sticky'; } else { echo 'no-sticky'; } ?>" site-data-offset="80">
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
                                <?php if(!empty($h_phone_number)) : ?>
                                    <div class="header-button-mobile">
                                        <a class="btn-mobile btn" href="tel:<?php echo esc_attr( $phone_result ); ?>"><i class="far fac-phone"></i><span><?php echo esc_attr( $h_phone_number ); ?></span></a>
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
                    <?php if(!empty($h_phone_number) || has_nav_menu( 'language' )) : ?>
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

                            <?php if(!empty($h_phone_number)) : ?>
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
                <span class="btn-nav-mobile open-menu">
                    <span></span>
                </span>
            </div>
        </div>
    </div>
</header>