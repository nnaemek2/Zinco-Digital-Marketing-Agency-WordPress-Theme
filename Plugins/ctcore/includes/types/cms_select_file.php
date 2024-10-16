<?php
/**
 * @Template: cms_select_file.php
 * @since: 1.0.0
 * @author: CaseThemes
 * @descriptions:
 * @create: 19-Apr-18
 */

vc_add_shortcode_param( 'cms_select_file', 'cms_shortcode_select_file' );


function cms_shortcode_select_file( $settings, $value ) {
	$file_name = ! empty( $value ) ? basename( get_attached_file( intval( $value ) ) ) : '';
	$shortcode = $settings['shortcode'];
	$output    = "";
	$output    .= "<div id=\"" . $shortcode . "-cms-select-file\">";
	$output    .= '<span class="cms-sf-name">' . $file_name . '</span>';
	$output    .= '<input type="hidden" class="wpb_vc_param_value cms-sf-val" name="' . esc_attr( $settings['param_name'] ) . '" value="' . esc_attr( $value ) . '">';
	$output    .= '<button class="csm-select-file-btn">' . esc_html__( "Select file", CMS_TEXT_DOMAIN ) . '</button>';
	$output    .= "</div>";
	$script    = '
    <script type="text/javascript">
        jQuery(\'button.vc_panel-btn-save[data-save=true]\').click(function(){
            jQuery(\'.cms_custom_param.vc_dependent-hidden\').remove();
        });
        jQuery(document).ready(function($){
		    $(document).on(\'click\', \'.csm-select-file-btn\', function (e) {
		        e.preventDefault();
		        var file_frame, _this = $(this);
		        file_frame = wp.media.frames.file_frame = wp.media({
		            title: "Select file",
		            button: {text: "Select file"},
		            library: {type: \'application/*\'}
		        });
		
		        // Runs when an image is selected.
		        file_frame.on(\'select\', function () {
		            // Grabs the attachment selection and creates a JSON representation of the model.
		            var media_attachment = file_frame.state().get(\'selection\').first().toJSON();
		            // Sends the attachment URL to our custom image input field.
		            console.log(media_attachment);
		            _this.prev().val(media_attachment.id);
		            _this.parent().find(\'.cms-sf-name\').html(media_attachment.filename);
		        });
		
		        // Opens the media library frame.
		        file_frame.open();
		    });
        });           
    </script>';

	return $output . $script;
}

?>