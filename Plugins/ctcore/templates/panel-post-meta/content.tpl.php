<?php
/**
 * The template for the main content of the panel.
 */

$post_layout = (function_exists('get_post_type') && get_post_type(get_the_ID()) === 'post') ? true : false;
$this->get_template( 'menu_container.tpl.php' );
?>

<div class="redux-main"<?php echo $post_layout ? 'style="margin-left: 0 !important;"' : '' ?>>
    <?php
        foreach ( $this->parent->sections as $k => $section )
        {
            if ( isset( $section['customizer_only'] ) && $section['customizer_only'] == true )
            {
                continue;
            }

            $section['class'] = isset( $section['class'] ) ? ' ' . $section['class'] : '';
            echo '<div id="' . $k . '_section_group' . '" class="redux-group-tab' . esc_attr( $section['class'] ) . '" data-rel="' . $k . '">';

            // Don't display in the
            $display = true;
            if ( isset( $_GET['page'] ) && $_GET['page'] == $this->parent->args['page_slug'] )
            {
                if ( isset( $section['panel'] ) && $section['panel'] == "false" )
                {
                    $display = false;
                }
            }

            if ( $display )
            {
                do_action( "redux/page/{$this->parent->args['opt_name']}/section/before", $section );
                $this->output_section( $k );
                do_action( "redux/page/{$this->parent->args['opt_name']}/section/after", $section );
            }

            echo '</div>';
        }
    ?>
</div>
<div class="clear"></div>