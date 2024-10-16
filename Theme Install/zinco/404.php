<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Zinco
 */
$title_404 =zinco_get_opt( 'title_404', esc_html__('OOPS! This Page Are Can’t Be Found', 'zinco'));
$content_404 =zinco_get_opt( 'content_404', esc_html__('Sorry, but the page you are looking for does not existing', 'zinco'));
$image_404 =zinco_get_opt( 'image_404' );
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <section class="error-404">
                <div class="container">
                    <?php if(!empty($image_404['url'])) { ?>
                        <div class="error-404-image">
                            <img src="<?php echo esc_url($image_404['url']); ?>" />
                        </div>
                    <?php } else { ?>
                        <div class="error-404-image">
                            <img src="<?php echo esc_url( get_template_directory_uri().'/assets/images/image-404.png' ); ?>" />
                        </div>
                    <?php } ?>
                    <div class="error-404-content">
                        <h2><?php echo esc_attr($title_404); ?></h2>
                        <p><?php echo wp_kses_post($content_404);; ?></p>
                        <a class="btn btn-default" href="<?php esc_url( home_url( '/' ) ); ?>"><?php echo esc_html__('Go To Home', 'zinco'); ?><i class="far fac-chevron-right"></i></a>
                    </div>
                </div>
            </section>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
