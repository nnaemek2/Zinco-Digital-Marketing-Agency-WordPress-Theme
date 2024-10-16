<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Zinco
 */

get_header();
$sidebar_pos =zinco_get_opt( 'archive_sidebar_pos', 'right' );
$sidebar_pos = (isset($_GET['sidebar'])) ? trim($_GET['sidebar']) :zinco_get_opt( 'archive_sidebar_pos', 'right');
?>
<div class="container content-container">
    <div class="row content-row">
        <div id="primary" <?php zinco_primary_class( $sidebar_pos, 'content-area' ); ?>>
            <main id="main" class="site-main">
            <?php

                if ( have_posts() ) { 
                    ?>
                    <div class="blog-hentry">
                        <?php while ( have_posts() )
                        {
                            the_post();

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called loop-post-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'template-parts/content' );
                        } ?>
                    </div>
                    <?php zinco_posts_pagination();
                }
                else
                {
                    get_template_part( 'template-parts/content', 'none' );
                }

            ?>
            </main><!-- #main -->
        </div><!-- #primary -->

        <?php if ( 'left' == $sidebar_pos || 'right' == $sidebar_pos ) : ?>
        <aside id="secondary" <?php zinco_secondary_class( $sidebar_pos, 'widget-area sidebar-fixed' ); ?>>
            <div class="sidebar-fixed-inner">
                <?php get_sidebar(); ?>
            </div>
        </aside>
        <?php endif; ?>
    </div>
</div>
<?php
get_footer();
