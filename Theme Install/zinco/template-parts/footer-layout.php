<?php
$footer_copyright =zinco_get_opt('footer_copyright'); ?>
<footer id="colophon" class="site-footer footer-layout1">
    <?php if(class_exists('Newsletter')) { ?>
            <?php $newsletter =zinco_get_opt('newsletter', 'hide');
            $newsletter_title =zinco_get_opt('newsletter_title');
            if($newsletter == 'show') { ?>
                <div class="newsletter-footer">
                    <div class="container">
                        <div class="ct-newsletter-inner">
                            <?php if(!empty($newsletter_title)) : ?>
                                <h3 class="ct-newsletter-title">
                                    <?php echo wp_kses_post($newsletter_title); ?>
                                </h3>
                            <?php endif; ?>
                            <?php echo do_shortcode( '[newsletter_form]' ); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
    <?php } ?>
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