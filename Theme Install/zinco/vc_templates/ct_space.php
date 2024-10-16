<?php
extract(shortcode_atts(array(
    'space_lg' => '',
    'space_md' => '',
    'space_sm' => '',
    'space_xs' => '',
), $atts));
$uqid = uniqid();

?>
<div id="ct-space-<?php echo esc_attr($uqid);?>">
	<div class="ct-space"></div>
	<div class="ct-inline-css"  data-css="
		<?php if(!empty($space_lg)) : ?>
			@media screen and (min-width: 1200px) {
				#ct-space-<?php echo esc_attr($uqid);?> .ct-space {
					height: <?php echo esc_attr($space_lg); ?>px;
				}
			}
		<?php endif; ?>
		<?php if(!empty($space_md)) : ?>
			@media (min-width: 992px) and (max-width: 1199px) {
				#ct-space-<?php echo esc_attr($uqid);?> .ct-space {
					height: <?php echo esc_attr($space_md); ?>px;
				}
			}
		<?php endif; ?>
		<?php if(!empty($space_sm)) : ?>
			@media (min-width: 768px) and (max-width: 991px) {
				#ct-space-<?php echo esc_attr($uqid);?> .ct-space {
					height: <?php echo esc_attr($space_sm); ?>px;
				}
			}
		<?php endif; ?>
		<?php if(!empty($space_xs)) : ?>
			@media screen and (max-width: 767px) {
				#ct-space-<?php echo esc_attr($uqid);?> .ct-space {
					height: <?php echo esc_attr($space_xs); ?>px;
				}
			}
		<?php endif; ?>">
    </div>
</div>