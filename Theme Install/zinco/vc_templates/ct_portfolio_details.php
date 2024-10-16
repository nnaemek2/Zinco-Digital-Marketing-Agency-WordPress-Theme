<?php
extract(shortcode_atts(array(
    'detail_list'             => '',
    'el_class'             => '',
), $atts));
$detail_list = (array) vc_param_group_parse_atts($detail_list); ?>
<div class="ct-portfolio-detail-wrap">
    <?php if(!empty($detail_list)) { ?>
        <ul class="ct-portfolio-details <?php echo esc_attr($el_class); ?>">
            <?php foreach ($detail_list as $key => $value) {
                $label = isset($value['label']) ? $value['label'] : '';
                $content = isset($value['content']) ? $value['content'] : '';
                $content_type = isset($value['content_type']) ? $value['content_type'] : 'text';
                ?>
                <li>
                    <label><?php echo esc_attr($label); ?></label>
                    <?php if($content_type == 'text' && !empty($content) ) : ?>
                        <span><?php echo esc_attr($content); ?></span>
                    <?php endif; ?>
                    <?php if($content_type == 'link' && !empty($content) ) : ?>
                        <a href="<?php echo esc_url($content); ?>"><?php echo esc_attr($content); ?></a>
                    <?php endif; ?>
                    <?php if($content_type == 'category') : ?>
                        <?php the_terms( get_the_ID(), 'portfolio-category', '', ', ' ); ?>
                    <?php endif; ?>
                    <?php if($content_type == 'date') : ?>
                        <span><?php echo get_the_date(); ?></span>
                    <?php endif; ?>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
    <div class="ct-portfolio-detail-share">   
        <label><?php echo esc_html__('Share Now', 'zinco'); ?></label>
        <div class="share-list">
            <?php zinco_socials_share_portfolio(); ?>
        </div>
    </div>
</div>