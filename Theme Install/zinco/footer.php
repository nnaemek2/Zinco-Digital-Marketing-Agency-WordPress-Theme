<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Zinco
 */
$back_totop_on =zinco_get_opt('back_totop_on', true); 
$footer_style =zinco_get_opt( 'footer_style', 'style1' );
$custom_footer =zinco_get_page_opt('custom_footer', false); 
$footer_style_page =zinco_get_page_opt('footer_style', 'themeoption'); 
if($custom_footer && isset($footer_style_page) && $footer_style_page != 'themeoption' ) {
    $footer_style = $footer_style_page;
}
?>

		</div><!-- #content inner -->
	</div><!-- #content -->

	<?php zinco_footer(); ?>
	
	<?php if (isset($back_totop_on) && $back_totop_on && $footer_style == 'style1') : ?>
        <a href="#" class="ct-scroll-top"><i class="far fac-arrow-up"></i></a>
    <?php endif; ?>
    
	</div><!-- #page -->
	
	<?php zinco_popup_search(); ?>

	<?php zinco_hidden_sidebar(); ?>

	<?php wp_footer(); ?>

	<?php echo zinco_get_opt( 'site_footer_code', '' ); ?>
	
	</body>
</html>
