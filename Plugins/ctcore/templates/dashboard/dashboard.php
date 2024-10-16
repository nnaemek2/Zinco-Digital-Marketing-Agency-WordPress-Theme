<?php
/**
 * @since: 1.0.0
 * @author: CaseThemes
 * @create: 16-Nov-17
 */
?>

<div class="cms-dashboard">
	<div class="cms-dashboard-inner clearfix">
		<div class="cms-dashboard-item">
			<div class="cms-dashboard-item-inner">
				<i class="dashicon dashicons-before dashicons-format-aside"></i>
				<h3><?php echo esc_html__('Documentation', CMS_TEXT_DOMAIN)?></h3>
				<p><?php echo esc_html__('Extensive documentation including up-to-date changelog.', CMS_TEXT_DOMAIN)?></p>
				<a href="<?php echo esc_url($docs_link) ?>" target="_blank"><?php echo esc_html__('Read Docs', CMS_TEXT_DOMAIN)?><i class="dashicons-before dashicons-arrow-right-alt2"></i></a>
			</div>
		</div>
		<div class="cms-dashboard-item video-tutorial">
			<div class="cms-dashboard-item-inner">
				<i class="dashicon dashicons-before dashicons-format-video"></i>
				<h3><?php echo esc_html__('Video Tutorials', CMS_TEXT_DOMAIN)?></h3>
				<p><?php echo esc_html__('The fastest and easiest way to learn more about', CMS_TEXT_DOMAIN)?> <?php echo esc_attr($this->theme_name) ?>.</p>
				<a href="<?php echo esc_url($video_link) ?>" target="_blank"><?php echo esc_html__('Watch Now', CMS_TEXT_DOMAIN)?><i class="dashicons-before dashicons-arrow-right-alt2"></i></a>
				<div class="dash-deactivate"></div>
			</div>
		</div>
		<div class="cms-dashboard-ticket">
            <?php $t_link = $ticket_link['type'] = 'email' ? ''.$ticket_link['link']: $ticket_link['link']?>
			<a href="<?php echo esc_attr($t_link) ?>"><?php echo esc_html__("Couldn't find what you're looking for? submit a ticket", CMS_TEXT_DOMAIN)?></a>
		</div>
	</div>
</div>