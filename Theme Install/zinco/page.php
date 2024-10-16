<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Zinco
 */

get_header();
$sidebar_pos = '';
$show_sidebar_page =zinco_get_page_opt( 'show_sidebar_page', false );
if ($show_sidebar_page){
    $sidebar_pos =zinco_get_page_opt( 'sidebar_page_pos' );
}
?>
    <div class="container content-container">
        <div class="row content-row">
            <div id="primary" <?php zinco_primary_class( $sidebar_pos, 'content-area' ); ?>>
                <main id="main" class="site-main">
                    <?php

                    while ( have_posts() )
                    {
                        the_post();

                        get_template_part( 'template-parts/content', 'page' );

                        if ( comments_open() || get_comments_number() )
                        {
                            comments_template();
                        }
                    }

                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->

            <?php if ( 'left' == $sidebar_pos || 'right' == $sidebar_pos ) : ?>
                <aside id="secondary" <?php zinco_secondary_class( $sidebar_pos, 'sidebar-fixed widget-area' ); ?>>
                    <div class="sidebar-fixed-inner">
                        <?php dynamic_sidebar( 'sidebar-page' ); ?>
                    </div>
                </aside>
            <?php endif; ?>

        </div>
    </div>
<?php
get_footer();