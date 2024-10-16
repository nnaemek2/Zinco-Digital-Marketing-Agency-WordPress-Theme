<?php
/**
 * Template part for displaying posts in loop
 *
 * @package Zinco
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-type-inner">
        <div class="post-type-content">
            <?php the_content(); ?>
        </div>
    </div>
</article><!-- #post -->