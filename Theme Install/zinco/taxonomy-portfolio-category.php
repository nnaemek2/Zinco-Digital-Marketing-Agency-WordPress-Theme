<?php
/**
 * The template for displaying Category Portfolio
 *
 * @package Zinco
 */
get_header();
?>

<div class="container content-container">

    <div class="row content-row">
        <div id="primary" class="col-12">
            <main id="main" class="site-main">
                <?php
                    $term = get_term_by( 'slug', get_query_var( 'portfolio-category' ), get_query_var( 'taxonomy' ) );
                    echo apply_filters('the_content','[ct_portfolio_grid limit="12" img_size="" layout="masonry" filter="false" filter_default_title="All Projects" col_xs="1" col_sm="2" col_md="2" col_lg="3" col_xl="3" source="'.$term->slug.'|portfolio-category"]');
                ?>
            </main><!-- #main -->
        </div><!-- #primary -->

    </div>
</div>

<?php get_footer(); ?>