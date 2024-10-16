<?php
$footer_copyright =zinco_get_opt('footer_copyright'); ?>
<footer id="colophon" class="site-footer footer-layout2">
    <?php if ( is_active_sidebar( 'sidebar-footer-1' ) || is_active_sidebar( 'sidebar-footer-2' ) || is_active_sidebar( 'sidebar-footer-3' ) || is_active_sidebar( 'sidebar-footer-4' ) ) : ?>
        <div class="top-footer">
            <div class="container">
                <div class="row">
                    <?php zinco_footer_top(); ?>
                </div>
            </div>
            <div class="ft-gap"></div>
        </div>
    <?php endif; ?>
    <div class="bottom-footer">
        <div class="container">
            <div class="row">
                <div class="bottom-copyright">
                    <?php if ($footer_copyright) {
                        echo apply_filters('the_content', $footer_copyright);
                    } else {
                        echo wp_kses_post(''.esc_attr(date("Y")).' &copy; All rights reserved by <a target="_blank" href="//themeforest.net/user/case-themes/portfolio">CaseThemes</a>');
                    } ?>
                </div>
            </div>
        </div>
    </div>
</footer>