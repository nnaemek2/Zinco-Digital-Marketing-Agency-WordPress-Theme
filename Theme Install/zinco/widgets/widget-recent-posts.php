<?php defined( 'ABSPATH' ) or exit( -1 );
/**
 * Recent Posts widgets
 *
 * @package Zinco
 * @version 1.0
 */

class Recent_Posts_Widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'ct_recent_posts',
            esc_html__( '* Recent Posts', 'zinco' ),
            array(
                'description' => esc_html__( 'Shows your most recent posts.', 'zinco' ),
                'customize_selective_refresh' => true,
            )
        );
    }

    /**
     * Outputs the HTML for this widget.
     *
     * @param array $args An array of standard parameters for widgets in this theme
     * @param array $instance An array of settings for this widget instance
     * @return void Echoes it's output
     **/
    function widget( $args, $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => esc_html__( 'Recent Posts', 'zinco' ),
            'number'        => 4,
            'post_in'        => '',
            'show_featured_image'        => '',
        ) );

        $title = empty( $instance['title'] ) ? esc_html__( 'Recent Posts', 'zinco' ) : $instance['title'];
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        echo wp_kses_post($args['before_widget']);

        echo wp_kses_post($args['before_title']) . wp_kses_post($title) . wp_kses_post($args['after_title']);

        $number = absint( $instance['number'] );
        if ( $number <= 0 || $number > 10)
        {
            $number = 4;
        }
        $post_in = $instance['post_in'];
        $show_featured_image = $instance['show_featured_image'];
        $sticky = '';
        if($post_in == 'featured') {
            $sticky = get_option( 'sticky_posts' );
        }
        $r = new WP_Query( array(
            'post_type'           => 'post',
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'post__in'  => $sticky,
        ) );

        if ( $r->have_posts() )
        {
            echo '<div class="posts-list">';

            while ( $r->have_posts() )
            {
                $r->the_post();
                global $post;
                echo '<div class="entry-brief">';
                    if($show_featured_image == 'show') :
                        if (has_post_thumbnail($post->ID) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)):
                        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'zinco-thumbnail', false); ?>
                            <div class="entry-media">
                               <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
                             </div>
                        <?php endif;
                    endif; ?>
                    <div class="entry-content">
                        <?php printf(
                            '<h4 class="entry-title"><a href="%1$s" title="%2$s">%3$s</a></h4>',
                            esc_url( get_permalink() ),
                            esc_attr( get_the_title() ),
                            get_the_title()
                        ); ?>
                        <div class="item-date">
                            <?php $date_formart = get_option('date_format'); echo get_the_date($date_formart, $post->ID); ?>
                        </div>
                    </div>
                </div>
            <?php }

            echo '</div>';
        }

        wp_reset_postdata();
        wp_reset_query();

        echo wp_kses_post($args['after_widget']);
    }

    /**
     * Deals with the settings when they are saved by the admin. Here is
     * where any validation should be dealt with.
     *
     * @param array $new_instance An array of new settings as submitted by the admin
     * @param array $old_instance An array of the previous settings
     * @return array The validated and (if necessary) amended settings
     **/
    function update( $new_instance, $old_instance )
    {
        $instance = $old_instance;
        $instance['title']         = sanitize_text_field( $new_instance['title'] );
        $instance['number']        = absint( $new_instance['number'] );
        $instance['post_in'] = strip_tags($new_instance['post_in']);
        $instance['show_featured_image'] = strip_tags($new_instance['show_featured_image']);
        return $instance;
    }

    /**
     * Displays the form for this widget on the Widgets page of the WP Admin area.
     *
     * @param array $instance An array of the current settings for this widget
     * @return void Echoes it's output
     **/
    function form( $instance )
    {
        $instance = wp_parse_args( (array) $instance, array(
            'title'         => esc_html__( 'Recent Posts', 'zinco' ),
            'number'        => 4,
        ) );

        $title         = $instance['title'] ? esc_attr( $instance['title'] ) : esc_html__( 'Recent Posts', 'zinco' );
        $number        = absint( $instance['number'] );
        $post_in = isset($instance['post_in']) ? esc_attr($instance['post_in']) : '';
        $show_featured_image = isset($instance['show_featured_image']) ? esc_attr($instance['show_featured_image']) : '';

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'zinco' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <p><label for="<?php echo esc_url($this->get_field_id('post_in')); ?>"><?php esc_html_e( 'Post in', 'zinco' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('post_in') ); ?>" name="<?php echo esc_attr( $this->get_field_name('post_in') ); ?>">
            <option value="recent"<?php if( $post_in == 'recent' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Recent', 'zinco'); ?></option>
            <option value="featured"<?php if( $post_in == 'featured' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Featured', 'zinco'); ?></option>
         </select>
         </p>

         <p><label for="<?php echo esc_url($this->get_field_id('show_featured_image')); ?>"><?php esc_html_e( 'Featured Image', 'zinco' ); ?></label>
         <select class="widefat" id="<?php echo esc_attr( $this->get_field_id('show_featured_image') ); ?>" name="<?php echo esc_attr( $this->get_field_name('show_featured_image') ); ?>">
            <option value="show"<?php if( $show_featured_image == 'show' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Show', 'zinco'); ?></option>
            <option value="hide"<?php if( $show_featured_image == 'hide' ){ echo 'selected="selected"';} ?>><?php esc_html_e('Hide', 'zinco'); ?></option>
         </select>
         </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>"><?php esc_html_e( 'Number of posts to show:', 'zinco' ); ?></label>
            <input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" />
        </p>

        <?php
    }
}
add_action( 'widgets_init', 'zinco_register_recent_widget' );
function zinco_register_recent_widget(){
    if(function_exists('ct_allow_RegisterWidget')){
        ct_allow_RegisterWidget( 'Recent_Posts_Widget' );
    }
}