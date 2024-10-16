<?php
/**
 * Search Form
 */
$search_field_placeholder =zinco_get_opt( 'search_field_placeholder' );
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url( '/' )); ?>">
	<div class="searchform-wrap">
        <input type="text" placeholder="<?php if(!empty($search_field_placeholder)) { echo esc_attr( $search_field_placeholder ); } else { esc_attr_e('Search your keyword...', 'zinco'); } ?>" name="s" class="search-field" />
    	<button type="submit" class="search-submit"><i class="fa fa-search"></i></button>
    </div>
</form>