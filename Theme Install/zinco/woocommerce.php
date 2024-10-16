<?php
/**
 * Custom Woocommerce shop page.
 */
get_header();
if( (class_exists( 'WooCommerce' ) && is_shop()) || (class_exists( 'WooCommerce' ) && is_product_category()) ) {
    $sidebar_pos = (isset($_GET['sidebar-shop'])) ? trim($_GET['sidebar-shop']) :zinco_get_opt( 'sidebar_shop', 'right' );
} else {
    $sidebar_pos = 'none';
}
?>
    <div class="container content-container">
        <div class="row content-row">
            <div id="primary" <?php zinco_primary_class( $sidebar_pos, 'content-area' ); ?>>
                <main id="main" class="site-main" role="main">
                        <?php woocommerce_content(); ?>
                </main><!-- #main -->
            </div><!-- #primary -->

            <?php if ( is_active_sidebar( 'sidebar-shop' ) && 'left' == $sidebar_pos || is_active_sidebar( 'sidebar-shop' ) && 'right' == $sidebar_pos ) : ?>
                <aside id="secondary"<?php zinco_secondary_class( $sidebar_pos, 'sidebar-fixed widget-area' ); ?>>
                    <div class="sidebar-fixed-inner">
                        <?php dynamic_sidebar( 'sidebar-shop' ); ?>
                    </div>
                </aside>
            <?php endif; ?>
        </div>
    </div>
<?php
get_footer();