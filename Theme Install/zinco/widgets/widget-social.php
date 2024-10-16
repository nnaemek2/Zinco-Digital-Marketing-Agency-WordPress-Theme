<?php
class CS_Social_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'cs_social_widget', // Base ID
            esc_html__('* Social', 'zinco'), // Name
            array('description' => esc_html__('Social Widget', 'zinco'),) // Args
        );
    }

    function widget($args, $instance) {
        global $woocommerce;

        extract($args);
        if (!empty($instance['title'])) {
        $title = apply_filters('widget_title', empty($instance['title']) ? esc_html__('Social', 'zinco' ) : $instance['title'], $instance, $this->id_base);
        }

        $icon_facebook = 'fa fa-facebook';
        $link_facebook = isset($instance['link_facebook']) ? $instance['link_facebook'] : '';

        $icon_rss = 'fa fa-rss';
        $link_rss = isset($instance['link_rss']) ? $instance['link_rss'] : '';

        $icon_youtube = 'fa fa-youtube';
        $link_youtube = isset($instance['link_youtube']) ? $instance['link_youtube'] : '';

        $icon_twitter = 'fa fa-twitter';
        $link_twitter = isset($instance['link_twitter']) ? $instance['link_twitter'] : '';

        $icon_google = 'fa fa-google-plus';
        $link_google = isset($instance['link_google']) ? $instance['link_google'] : '';

        $icon_skype = 'fa fa-skype';
        $link_skype = isset($instance['link_skype']) ? $instance['link_skype'] : '';

        $icon_dribbble = 'fa fa-dribbble';
        $link_dribbble = isset($instance['link_dribbble']) ? $instance['link_dribbble'] : '';

        $icon_flickr = 'fa fa-flickr';
        $link_flickr = isset($instance['link_flickr']) ? $instance['link_flickr'] : '';

        $icon_linkedin = 'fa fa-linkedin';
        $link_linkedin = isset($instance['link_linkedin']) ? $instance['link_linkedin'] : '';

        $icon_vimeo = 'fa fa-vimeo';
        $link_vimeo = isset($instance['link_vimeo']) ? $instance['link_vimeo'] : '';

        $icon_pinterest = 'fa fa-pinterest';
        $link_pinterest = isset($instance['link_pinterest']) ? $instance['link_pinterest'] : '';

        $icon_instagram = 'fa fa-instagram';
        $link_instagram = isset($instance['link_instagram']) ? $instance['link_instagram'] : '';

        // no 'class' attribute - add one with the value of width
        if( strpos($before_widget, 'class') === false ) {
            $before_widget = str_replace('>', $before_widget);
        }
        echo ''.$before_widget;

        if (!empty($title))
                echo ''.$before_title . $title . $after_title;

            echo "<ul class='ct-social'>";

            if ($link_facebook != '') {
                echo '<li><a class="social-facebook" target="_blank" href="'.esc_url($link_facebook).'"><i class="'.$icon_facebook.'"></i><span>'.esc_html__('Facebook', 'zinco').'</span></a></li>';
            }

            if ($link_rss != '') {
                echo '<li><a class="social-rss" target="_blank" href="'.esc_url($link_rss).'"><i class="'.$icon_rss.'"></i><span>'.esc_html__('Rss', 'zinco').'</span></a></li>';
            }

            if ($link_youtube != '') {
                echo '<li><a class="social-youtube" target="_blank" href="'.esc_url($link_youtube).'"><i class="'.$icon_youtube.'"></i><span>'.esc_html__('YouTube', 'zinco').'</span></a></li>';
            }

            if ($link_twitter != '') {
                echo '<li><a class="social-twitter" target="_blank" href="'.esc_url($link_twitter).'"><i class="'.$icon_twitter.'"></i><span>'.esc_html__('Twitter', 'zinco').'</span></a></li>';
            }

            if ($link_google != '') {
                echo '<li><a class="social-google" target="_blank" href="'.esc_url($link_google).'"><i class="'.$icon_google.'"></i><span>'.esc_html__('Google+', 'zinco').'</span></a></li>';
            }

            if ($link_skype != '') {
                echo '<li><a class="social-skype" target="_blank" href="'.esc_url($link_skype).'"><i class="'.$icon_skype.'"></i><span>'.esc_html__('Skype', 'zinco').'</span></a></li>';
            }

            if ($link_dribbble != '') {
                echo '<li><a class="social-dribbble" target="_blank" href="'.esc_url($link_dribbble).'"><i class="'.$icon_dribbble.'"></i><span>'.esc_html__('Dribbble', 'zinco').'</span></a></li>';
            }

            if ($link_flickr != '') {
                echo '<li><a class="social-flickr" target="_blank" href="'.esc_url($link_flickr).'"><i class="'.$icon_flickr.'"></i><span>'.esc_html__('Flickr', 'zinco').'</span></a></li>';
            }

            if ($link_linkedin != '') {
                echo '<li><a class="social-linkedin" target="_blank" href="'.esc_url($link_linkedin).'"><i class="'.$icon_linkedin.'"></i><span>'.esc_html__('Linkedin', 'zinco').'</span></a></li>';
            }

            if ($link_vimeo != '') {
                echo '<li><a class="social-vimeo" target="_blank" href="'.esc_url($link_vimeo).'"><i class="'.$icon_vimeo.'"></i><span>'.esc_html__('Vimeo', 'zinco').'</span></a></li>';
            }

            if ($link_pinterest != '') {
                echo '<li><a class="social-pinterest" target="_blank" href="'.esc_url($link_pinterest).'"><i class="'.$icon_pinterest.'"></i><span>'.esc_html__('Pinterest', 'zinco').'</span></a></li>';
            }

            if ($link_instagram != '') {
                echo '<li><a class="social-instagram" target="_blank" href="'.esc_url($link_instagram).'"><i class="'.$icon_instagram.'"></i><span>'.esc_html__('Instagram', 'zinco').'</span></a></li>';
            }

            echo "</ul>";

        echo ''.$after_widget;
    }

    function update( $new_instance, $old_instance ) {
         $instance = $old_instance;
         $instance['title'] = strip_tags($new_instance['title']);

         $instance['link_facebook'] = strip_tags($new_instance['link_facebook']);

         $instance['link_rss'] = strip_tags($new_instance['link_rss']);

         $instance['link_youtube'] = strip_tags($new_instance['link_youtube']);

         $instance['link_twitter'] = strip_tags($new_instance['link_twitter']);

         $instance['link_google'] = strip_tags($new_instance['link_google']);

         $instance['link_skype'] = strip_tags($new_instance['link_skype']);

         $instance['link_dribbble'] = strip_tags($new_instance['link_dribbble']);

         $instance['link_flickr'] = strip_tags($new_instance['link_flickr']);

         $instance['link_linkedin'] = strip_tags($new_instance['link_linkedin']);

         $instance['link_vimeo'] = strip_tags($new_instance['link_vimeo']);

         $instance['link_pinterest'] = strip_tags($new_instance['link_pinterest']);

         $instance['link_instagram'] = strip_tags($new_instance['link_instagram']);

         return $instance;
    }

    function form( $instance ) {
         $title = isset($instance['title']) ? esc_attr($instance['title']) : '';

         $link_facebook = isset($instance['link_facebook']) ? esc_attr($instance['link_facebook']) : '';

         $link_rss = isset($instance['link_rss']) ? esc_attr($instance['link_rss']) : '';

         $link_youtube = isset($instance['link_youtube']) ? esc_attr($instance['link_youtube']) : '';

         $link_twitter = isset($instance['link_twitter']) ? esc_attr($instance['link_twitter']) : '';

         $link_google = isset($instance['link_google']) ? esc_attr($instance['link_google']) : '';

         $link_skype = isset($instance['link_skype']) ? esc_attr($instance['link_skype']) : '';

         $link_dribbble = isset($instance['link_dribbble']) ? esc_attr($instance['link_dribbble']) : '';

         $link_flickr = isset($instance['link_flickr']) ? esc_attr($instance['link_flickr']) : '';

         $link_linkedin = isset($instance['link_linkedin']) ? esc_attr($instance['link_linkedin']) : '';

         $link_vimeo = isset($instance['link_vimeo']) ? esc_attr($instance['link_vimeo']) : '';

         $link_pinterest = isset($instance['link_pinterest']) ? esc_attr($instance['link_pinterest']) : '';

         $link_instagram = isset($instance['link_instagram']) ? esc_attr($instance['link_instagram']) : '';

         ?>
         <p><label for="<?php echo esc_url($this->get_field_id('title')); ?>"><?php esc_html_e( 'Title:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_facebook')); ?>"><?php esc_html_e( 'Link Facebook:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_facebook') ); ?>" type="text" value="<?php echo esc_attr( $link_facebook ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_rss')); ?>"><?php esc_html_e( 'Link Rss:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_rss') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_rss') ); ?>" type="text" value="<?php echo esc_attr( $link_rss ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_youtube')); ?>"><?php esc_html_e( 'Link Youtube:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_youtube') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_youtube') ); ?>" type="text" value="<?php echo esc_attr( $link_youtube ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_twitter')); ?>"><?php esc_html_e( 'Link Twitter:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_twitter') ); ?>" type="text" value="<?php echo esc_attr( $link_twitter ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_google')); ?>"><?php esc_html_e( 'Link Google:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_google') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_google') ); ?>" type="text" value="<?php echo esc_attr( $link_google ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_skype')); ?>"><?php esc_html_e( 'Link Skype:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_skype') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_skype') ); ?>" type="text" value="<?php echo esc_attr( $link_skype ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_dribbble')); ?>"><?php esc_html_e( 'Link Dribbble:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_dribbble') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_dribbble') ); ?>" type="text" value="<?php echo esc_attr( $link_dribbble ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_flickr')); ?>"><?php esc_html_e( 'Link Flickr:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_flickr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_flickr') ); ?>" type="text" value="<?php echo esc_attr( $link_flickr ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_linkedin')); ?>"><?php esc_html_e( 'Link Linkedin:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_linkedin') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_linkedin') ); ?>" type="text" value="<?php echo esc_attr( $link_linkedin ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_vimeo')); ?>"><?php esc_html_e( 'Link Vimeo:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_vimeo') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_vimeo') ); ?>" type="text" value="<?php echo esc_attr( $link_vimeo ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_pinterest')); ?>"><?php esc_html_e( 'Link Pinterest:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_pinterest') ); ?>" type="text" value="<?php echo esc_attr( $link_pinterest ); ?>" /></p>

         <p><label for="<?php echo esc_attr($this->get_field_id('link_instagram')); ?>"><?php esc_html_e( 'Link Instagram:', 'zinco' ); ?></label>
         <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('link_instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name('link_instagram') ); ?>" type="text" value="<?php echo esc_attr( $link_instagram ); ?>" /></p>

    <?php
    }

}

/**
* Class CS_Social_Widget
*/

function register_social_widget() {
    if(function_exists('ct_allow_RegisterWidget')){
        ct_allow_RegisterWidget( 'CS_Social_Widget' );
    }
}

add_action('widgets_init', 'register_social_widget');
?>