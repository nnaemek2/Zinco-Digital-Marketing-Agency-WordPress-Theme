<?php
/**
 * The template for displaying all single portfolio
 *
 * @package Zinco
 */
get_header(); ?>
<div class="container content-container">
    <div class="row content-row">
        <div id="primary" class="content-area col-12">
            <main id="main" class="site-main">
                <?php

                    while ( have_posts() )
                    {
                        the_post();
                        get_template_part( 'template-parts/content-portfolio/content', get_post_format() );
                    }
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->
    </div>
</div>
<?php get_footer();
