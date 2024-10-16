<?php
/**
 * Register metabox for posts based on Redux Framework. Supported methods:
 *     isset_args( $post_type )
 *     set_args( $post_type, $redux_args, $metabox_args )
 *     add_section( $post_type, $sections )
 * Each post type can contains only one metabox. Pease note that each field id
 * leads by an underscore sign ( _ ) in order to not show that into Custom Field
 * Metabox from WordPress core feature.
 *
 * @param zinco_Post_Metabox $metabox
 */

/**
 * Get list menu.
 * @return array
 */
function zinco_get_nav_menu(){

    $menus = array(
        '' => esc_html__('Default', 'zinco')
    );

    $obj_menus = wp_get_nav_menus();

    foreach ($obj_menus as $obj_menu){
        $menus[$obj_menu->term_id] = $obj_menu->name;
    }

    return $menus;
}

function zinco_page_options_register( $metabox ) {
	if ( ! $metabox->isset_args( 'post' ) ) {
		$metabox->set_args( 'post', array(
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'zinco' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'page' ) ) {
		$metabox->set_args( 'page', array(
			'opt_name'            =>zinco_get_page_opt_name(),
			'display_name'        => esc_html__( 'Page Settings', 'zinco' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_audio' ) ) {
		$metabox->set_args( 'cms_pf_audio', array(
			'opt_name'     => 'post_format_audio',
			'display_name' => esc_html__( 'Audio', 'zinco' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_link' ) ) {
		$metabox->set_args( 'cms_pf_link', array(
			'opt_name'     => 'post_format_link',
			'display_name' => esc_html__( 'Link', 'zinco' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_quote' ) ) {
		$metabox->set_args( 'cms_pf_quote', array(
			'opt_name'     => 'post_format_quote',
			'display_name' => esc_html__( 'Quote', 'zinco' )
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_video' ) ) {
		$metabox->set_args( 'cms_pf_video', array(
			'opt_name'     => 'post_format_video',
			'display_name' => esc_html__( 'Video', 'zinco' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	if ( ! $metabox->isset_args( 'cms_pf_gallery' ) ) {
		$metabox->set_args( 'cms_pf_gallery', array(
			'opt_name'     => 'post_format_gallery',
			'display_name' => esc_html__( 'Gallery', 'zinco' ),
			'class'        => 'fully-expanded',
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/* Extra Post Type */
	if ( ! $metabox->isset_args( 'portfolio' ) ) {
		$metabox->set_args( 'portfolio', array(
			'opt_name'            => 'portfolio_option',
			'display_name'        => esc_html__( 'Portfolio Settings', 'zinco' ),
			'show_options_object' => false,
		), array(
			'context'  => 'advanced',
			'priority' => 'default'
		) );
	}

	/**
	 * Config portfolio meta options
	 *
	 */

	$metabox->add_section( 'portfolio', array(
		'title'  => esc_html__( 'General', 'zinco' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'             => 'content_padding',
				'type'           => 'spacing',
				'output'         => array( '.single-portfolio .site-content #primary, .single-portfolio .site-content #secondary' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'zinco' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'zinco' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
		)
	) );

	/**
	 * Config post blog meta options
	 *
	 */
	$metabox->add_section( 'post', array(
		'title'  => esc_html__( 'General', 'zinco' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'show_sidebar_post',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Sidebar', 'zinco' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_post_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'zinco' ),
				'options'      => array(
					'left'  => esc_html__('Left', 'zinco'),
	                'right' => esc_html__('Right', 'zinco'),
	                'none'  => esc_html__('Disabled', 'zinco')
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_post', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

	/**
	 * Config page meta options
	 *
	 */

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Header', 'zinco' ),
		'desc'   => esc_html__( 'Header settings for the page.', 'zinco' ),
		'icon'   => 'el-icon-website',
		'fields' => array(
			array(
				'id'      => 'custom_header',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Header', 'zinco' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'header_layout',
				'type'         => 'image_select',
				'title'        => esc_html__( 'Layout', 'zinco' ),
				'subtitle'     => esc_html__( 'Select a layout for header.', 'zinco' ),
				'options'      => array(
					'0' => get_template_directory_uri() . '/assets/images/header-layout/h0.jpg',
					'1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
					'2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
					'3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
				),
				'default'      =>zinco_get_option_of_theme_options( 'header_layout' ),
				'required'     => array( 0 => 'custom_header', 1 => 'equals', 2 => '1' ),
				'force_output' => true
			),
			array(
                'id'       => 'h_custom_menu',
                'type'     => 'select',
                'title'    => esc_html__( 'Custom Menu', 'zinco' ),
                'subtitle' => esc_html__( 'Custom menu for current page.', 'zinco' ),
                'options'  => zinco_get_nav_menu(),
                'default' => '',
            ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Page Title', 'zinco' ),
		'icon'   => 'el-icon-map-marker',
		'fields' => array(
			array(
	            'id'       => 'ptitle_on',
	            'type'     => 'button_set',
	            'title'    => esc_html__('Displayed', 'zinco'),
	            'options'  => array(
	                'themeoption'  => esc_html__('Theme Option', 'zinco'),
	                'show'  => esc_html__('Show', 'zinco'),
	                'hidden'  => esc_html__('Hidden', 'zinco'),
	            ),
	            'default'  => 'themeoption'
	        ),
	        array(
				'id'           => 'custom_title',
				'type'         => 'text',
				'title'        => esc_html__( 'Title', 'zinco' ),
				'subtitle'     => esc_html__( 'Use custom title for this page. The default title will be used on document title.', 'zinco' ),
				'required' => array('ptitle_on', '!=', 'hidden'),
			),
			array(
	            'id'       => 'ptitle_font_size',
	            'type'     => 'text',
	            'title'    => esc_html__('Font Size', 'zinco'),
	            'validate' => 'numeric',
	            'desc'     => 'Enter number (Default 70px)',
	            'msg'      => 'Please enter number',
	            'default'  => '',
	            'required' => array('ptitle_on', '!=', 'hidden'),
	        ),
	        array(
	            'id'       => 'ptitle_bg',
	            'type'     => 'background',
	            'title'    => esc_html__('Background', 'zinco'),
	            'subtitle' => esc_html__('Page title background color.', 'zinco'),
	            'output'   => array('body #pagetitle'),
	            'background-color' => false,
	            'required' => array('ptitle_on', '!=', 'hidden'),
	        ),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Content', 'zinco' ),
		'desc'   => esc_html__( 'Settings for content area.', 'zinco' ),
		'icon'   => 'el-icon-pencil',
		'fields' => array(
			array(
				'id'       => 'content_bg_color',
				'type'     => 'color_rgba',
				'title'    => esc_html__( 'Background Color', 'zinco' ),
				'subtitle' => esc_html__( 'Content background color.', 'zinco' ),
				'output'   => array( 'background-color' => '#content, .site-layout-default .site-footer:before' )
			),
			array(
				'id'             => 'content_padding',
				'type'           => 'spacing',
				'output'         => array( '.site-content #primary, .site-content #secondary' ),
				'right'          => false,
				'left'           => false,
				'mode'           => 'padding',
				'units'          => array( 'px' ),
				'units_extended' => 'false',
				'title'          => esc_html__( 'Content Padding', 'zinco' ),
				'desc'           => esc_html__( 'Default: Theme Option.', 'zinco' ),
				'default'        => array(
					'padding-top'    => '',
					'padding-bottom' => '',
					'units'          => 'px',
				)
			),
			array(
				'id'      => 'show_sidebar_page',
				'type'    => 'switch',
				'title'   => esc_html__( 'Show Sidebar', 'zinco' ),
				'default' => false,
				'indent'  => true
			),
			array(
				'id'           => 'sidebar_page_pos',
				'type'         => 'button_set',
				'title'        => esc_html__( 'Sidebar Position', 'zinco' ),
				'options'      => array(
					'left'  => esc_html__( 'Left', 'zinco' ),
					'right' => esc_html__( 'Right', 'zinco' ),
				),
				'default'      => 'right',
				'required'     => array( 0 => 'show_sidebar_page', 1 => '=', 2 => '1' ),
				'force_output' => true
			),
		)
	) );

	$metabox->add_section( 'page', array(
		'title'  => esc_html__( 'Footer', 'zinco' ),
		'desc'   => esc_html__( 'Settings for footer area.', 'zinco' ),
		'icon'   => 'el el-website',
		'fields' => array(
			array(
				'id'      => 'custom_footer',
				'type'    => 'switch',
				'title'   => esc_html__( 'Custom Footer', 'zinco' ),
				'default' => false,
				'indent'  => true
			),
			array(
            	'id'       => 'footer_layout',
	            'type'     => 'image_select',
	            'title'    => esc_html__('Layout', 'zinco'),
	            'subtitle' => esc_html__('Select a layout for footer.', 'zinco'),
	            'options'  => array(
	                '1' => get_template_directory_uri() . '/assets/images/footer-layout/f1.jpg',
	                '2' => get_template_directory_uri() . '/assets/images/footer-layout/f2.jpg',
	                'custom' => get_template_directory_uri() . '/assets/images/footer-layout/custom.jpg',
	            ),
	            'default'  => '1',
	            'required' => array( 0 => 'custom_footer', 1 => 'equals', 2 => '1' ),
	            'force_output' => true
	        ),
	        array(
	            'id'          => 'footer_layout_custom',
	            'type'        => 'select',
	            'title'       => esc_html__('Custom Layout', 'zinco'),
	            'desc'        => sprintf(esc_html__('To use this Option please %sClick Here%s to add your custom footer layout first.','zinco'),'<a href="' . esc_url( admin_url( 'edit.php?post_type=footer' ) ) . '">','</a>'),
	            'options'     =>zinco_list_post('footer'),
	            'default'     => '',
	            'required' => array( 0 => 'footer_layout', 1 => 'equals', 2 => 'custom' ),
	            'force_output' => true
	        ),
	    )
	) );

	/**
	 * Config post format meta options
	 *
	 */

	$metabox->add_section( 'cms_pf_video', array(
		'title'  => esc_html__( 'Video', 'zinco' ),
		'fields' => array(
			array(
				'id'    => 'post-video-url',
				'type'  => 'text',
				'title' => esc_html__( 'Video URL', 'zinco' ),
				'desc'  => esc_html__( 'YouTube or Vimeo video URL', 'zinco' )
			),
		)
	) );

	$metabox->add_section( 'cms_pf_gallery', array(
		'title'  => esc_html__( 'Gallery', 'zinco' ),
		'fields' => array(
			array(
				'id'       => 'post-gallery-lightbox',
				'type'     => 'switch',
				'title'    => esc_html__( 'Lightbox?', 'zinco' ),
				'subtitle' => esc_html__( 'Enable lightbox for gallery images.', 'zinco' ),
				'default'  => true
			),
			array(
				'id'       => 'post-gallery-images',
				'type'     => 'gallery',
				'title'    => esc_html__( 'Gallery Images ', 'zinco' ),
				'subtitle' => esc_html__( 'Upload images or add from media library.', 'zinco' )
			)
		)
	) );

	$metabox->add_section( 'cms_pf_audio', array(
		'title'  => esc_html__( 'Audio', 'zinco' ),
		'fields' => array(
			array(
				'id'          => 'post-audio-url',
				'type'        => 'text',
				'title'       => esc_html__( 'SoundCloud URL', 'zinco' ),
				'validate'    => 'url',
				'msg'         => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_link', array(
		'title'  => esc_html__( 'Link', 'zinco' ),
		'fields' => array(
			array(
				'id'       => 'post-link-url',
				'type'     => 'text',
				'title'    => esc_html__( 'URL', 'zinco' ),
				'validate' => 'url',
				'msg'      => 'Url error!'
			)
		)
	) );

	$metabox->add_section( 'cms_pf_quote', array(
		'title'  => esc_html__( 'Quote Settings', 'zinco' ),
		'fields' => array(
			array(
				'id'    => 'post-quote',
				'type'  => 'textarea',
				'title' => esc_html__( 'Quote', 'zinco' )
			)
		)
	) );

}


add_action( 'cms_post_metabox_register', 'zinco_page_options_register' );

function zinco_get_option_of_theme_options( $key, $default = '' ) {
	if ( empty( $key ) ) {
		return '';
	}
	$options = get_option(zinco_get_opt_name(), array() );
	$value   = isset( $options[ $key ] ) ? $options[ $key ] : $default;

	return $value;
}