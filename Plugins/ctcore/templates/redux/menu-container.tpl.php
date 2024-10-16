<?php
/**
 * The template for the menu container of the panel.
 *
 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
 *
 * @author 	Redux Framework
 * @package 	ReduxFramework/Templates
 * @version:    10.0.0
 */
global $cms_theme_options;
?>
<div class="redux-sidebar">
	<div class="redux-sidebar-head">
        <?php if(!empty($cms_theme_options['logo']['url'])) { ?>
    		<div class="redux-logo-main">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url($cms_theme_options['logo']['url']); ?>" />
                </a>
            </div>
        <?php } else { ?>
		  <div class="redux-logo-text"><?php echo esc_html( wp_get_theme()->get('Name') ); ?></div>
        <?php } ?>
        <span>Version <?php echo esc_attr( wp_get_theme()->version ); ?></span>
	</div>
    <ul class="redux-group-menu">
        <?php
        foreach ( $this->parent->sections as $k => $section ) {
            $the_title = isset( $section['title'] ) ? $section['title'] : '';
            $skip_sec  = false;
            foreach ( $this->parent->options_class->hidden_perm_sections as $num => $section_title ) {
                if ( $section_title === $the_title ) {
                    $skip_sec = true;
                }
            }

            if ( isset( $section['customizer_only'] ) && true === $section['customizer_only'] ) {
                continue;
            }

            if ( false === $skip_sec ) {
                echo( $this->parent->render_class->section_menu( $k, $section ) ); // phpcs:ignore WordPress.Security.EscapeOutput
                $skip_sec = false;
            }
        }

        /**
         * Action 'redux/page/{opt_name}/menu/after'
         *
         * @param object $this ReduxFramework
         */
        do_action( "redux/page/{$this->parent->args['opt_name']}/menu/after", $this ); // phpcs:ignore WordPress.NamingConventions.ValidHookName
        ?>
    </ul>
</div>
