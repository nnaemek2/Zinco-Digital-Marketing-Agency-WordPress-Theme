<?php
/**
 * The template for the main panel container.
 */

global $pagenow;

$classes = array( 'redux-container' );

if ( ! isset( $this->parent->args['metabox_context'] ) || ! in_array( $this->parent->args['metabox_context'], array( 'normal', 'advanced', 'side' ) ) )
{
    $this->parent->args['metabox_context'] = 'advanced';
}

if ( ! isset( $this->parent->args['metabox_priority'] ) || ! in_array( $this->parent->args['metabox_priority'], array( 'high', 'core', 'default', 'low' ) ) )
{
    $this->parent->args['metabox_priority'] = 'default';
}

if ( ( 'post.php' != $pagenow && 'post-new.php' != $pagenow ) || 'side' == $this->parent->args['metabox_context'] )
{
    $this->parent->args['open_expanded'] = true;
    $classes[] = 'redux-container-context-side';
    $classes[] = 'fully-expanded';
}

$classes[] = 'redux-container-context-' . $this->parent->args['metabox_context'];

if ( ! empty( $this->parent->args['class'] ) )
{
    $classes[] = $this->parent->args['class'];
}

$classes = implode( ' ', array_filter( $classes ) );
?>

<div class="<?php echo trim( esc_attr( $classes ) ); ?>">
    <div class="redux-save-warn notice-yellow">
        <strong><?php echo apply_filters( "redux-changed-text-{$this->parent->args['opt_name']}", esc_html__( 'Settings have changed, you should save them!', 'redux-framework' ) ) ?></strong>
    </div>
    <div class="redux-field-errors notice-red">
        <strong><span></span> <?php echo esc_html__( 'error(s) were found!', 'redux-framework' ) ?></strong>
    </div>
    <div class="redux-field-warnings notice-yellow">
        <strong><span></span> <?php echo esc_html__( 'warning(s) were found!', 'redux-framework' ) ?>
        </strong></div>
    <?php
        do_action( "redux/page/{$this->parent->args['opt_name']}/content/before", $this );
        $this->get_template( 'content.tpl.php' );
        do_action( "redux/page/{$this->parent->args['opt_name']}/content/after", $this );
    ?>
</div>