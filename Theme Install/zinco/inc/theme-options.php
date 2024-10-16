<?php
if (!class_exists('ReduxFramework')) {
    return;
}
if (class_exists('ReduxFrameworkPlugin')) {
    remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
}

if(class_exists('Newsletter')) {
    $forms = array_filter( (array) get_option( 'newsletter_forms', array() ) );

    $newsletter_forms = array(
        'default' => esc_html__( 'Default Form', 'zinco' )
    );

    if ( $forms )
    {
        $index = 1;
        foreach ( $forms as $key => $form )
        {
            $newsletter_forms[ $key ] = sprintf( esc_html__( 'Form %s', 'zinco' ), $index );
            $index ++;
        }
    }
} else {
    $newsletter_forms = '';
}

$opt_name =zinco_get_opt_name();
$theme = wp_get_theme();

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name'             => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name'         => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version'      => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type'            => class_exists('CaseThemeCore') ? 'submenu' : '',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu'       => true,
    // Show the sections below the admin menu item or not
    'menu_title'           => esc_html__('Theme Options', 'zinco'),
    'page_title'           => esc_html__('Theme Options', 'zinco'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: //developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key'       => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography'     => false,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar'            => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon'       => 'dashicons-admin-generic',
    // Choose an icon for the admin bar menu
    'admin_bar_priority'   => 50,
    // Choose an priority for the admin bar menu
    'global_variable'      => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode'             => true,
    // Show the time the page took to load, etc
    'update_notice'        => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer'           => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    'show_options_object' => false,
    // OPTIONAL -> Give you extra features
    'page_priority'        => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent'          => class_exists('CaseThemeCore') ? $theme->get('TextDomain') : '',
    // For a full list of options, visit: //codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions'     => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon'            => '',
    // Specify a custom URL to an icon
    'last_tab'             => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon'            => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug'            => 'theme-options',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults'        => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show'         => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark'         => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export'   => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time'       => 60 * MINUTE_IN_SECONDS,
    'output'               => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag'           => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database'             => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn'              => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

    // HINTS
    'hints'                => array(
        'icon'          => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color'    => 'lightgray',
        'icon_size'     => 'normal',
        'tip_style'     => array(
            'color'   => 'red',
            'shadow'  => true,
            'rounded' => false,
            'style'   => '',
        ),
        'tip_position'  => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect'    => array(
            'show' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'mouseover',
            ),
            'hide' => array(
                'effect'   => 'slide',
                'duration' => '500',
                'event'    => 'click mouseleave',
            ),
        ),
    ),
    'templates_path'       => class_exists('CaseThemeCore') ? casethemescore()->path('APP_DIR') . '/templates/redux/' : '',
);

Redux::SetArgs($opt_name, $args);

/*--------------------------------------------------------------
# General
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('General', 'zinco'),
    'icon'   => 'el-icon-home',
    'fields' => array(
        array(
            'id'       => 'show_page_loading',
            'type'     => 'switch',
            'title'    => esc_html__('Enable Page Loading', 'zinco'),
            'subtitle' => esc_html__('Enable page loading effect when you load site.', 'zinco'),
            'default'  => false
        ),
        array(
            'id'       => 'loading_type',
            'type'     => 'select',
            'title'    => esc_html__('Loading Style', 'zinco'),
            'options'  => array(
                'style1'  => esc_html__('Style 1', 'zinco'),
                'style2'  => esc_html__('Style 2', 'zinco'),
                'style3'  => esc_html__('Style 3', 'zinco'),
                'style4'  => esc_html__('Style 4', 'zinco'),
                'style5'  => esc_html__('Style 5', 'zinco'),
                'style6'  => esc_html__('Style 6', 'zinco'),
                'style7'  => esc_html__('Style 7', 'zinco'),
                'style8'  => esc_html__('Style 8', 'zinco'),
            ),
            'default'  => 'style1',
            'required' => array( 0 => 'show_page_loading', 1 => 'equals', 2 => '1' ),
            'force_output' => true
        ),
        array(
            'id'       => 'smoothscroll',
            'type'     => 'switch',
            'title'    => esc_html__('Smooth Scroll', 'zinco'),
            'default'  => false
        ),
        array(
            'id'       => 'body_background',
            'type'     => 'background',
            'title'    => esc_html__('Body Boxed Background', 'zinco'),
            'required' => array( 0 => 'layout_boxed', 1 => 'equals', 2 => '1' ),
            'force_output' => true
        ),
        array(
            'id'       => 'dev_mode',
            'type'     => 'switch',
            'title'    => esc_html__('Dev Mode (not recommended)', 'zinco'),
            'description' => 'no minimize , generate css over time...',
            'default'  => false
        ),
        array(
            'id'       => 'favicon',
            'type'     => 'media',
            'title'    => esc_html__('Favicon', 'zinco'),
            'default' => ''
        ),
    )
));

/*--------------------------------------------------------------
# Header
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Header', 'zinco'),
    'icon'   => 'el-icon-website',
    'fields' => array(
        array(
            'id'       => 'header_layout',
            'type'     => 'image_select',
            'title'    => esc_html__('Layout', 'zinco'),
            'subtitle' => esc_html__('Select a layout for header.', 'zinco'),
            'options'  => array(
                '1' => get_template_directory_uri() . '/assets/images/header-layout/h1.jpg',
                '2' => get_template_directory_uri() . '/assets/images/header-layout/h2.jpg',
                '3' => get_template_directory_uri() . '/assets/images/header-layout/h3.jpg',
            ),
            'default'  => '1'
        ),
        array(
            'id'       => 'search_on',
            'type'     => 'switch',
            'title'    => esc_html__('Search Icon', 'zinco'),
            'default'  => false
        ),
        array(
            'id'       => 'cart_on',
            'type'     => 'switch',
            'title'    => esc_html__('Cart Icon', 'zinco'),
            'default'  => false
        ),
        array(
            'id'       => 'sticky_on',
            'type'     => 'switch',
            'title'    => esc_html__('Sticky Header', 'zinco'),
            'subtitle' => esc_html__('Header will be sticked when applicable.', 'zinco'),
            'default'  => false
        ),
        array(
            'id'       => 'search_background_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Search Background Color Overlay', 'zinco'),
            'output' => array('background-color' => '.ct-modal.ct-search-popup'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'      => esc_html__('Logo', 'zinco'),
    'icon'       => 'el el-picture',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'logo',
            'type'     => 'media',
            'title'    => esc_html__('Logo Dark', 'zinco'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-dark.png'
            )
        ),
        array(
            'id'       => 'logo_light',
            'type'     => 'media',
            'title'    => esc_html__('Logo Light', 'zinco'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/logo-light.png'
            )
        ),
        array(
            'id'       => 'logo_maxh',
            'type'     => 'dimensions',
            'title'    => esc_html__('Logo Max height', 'zinco'),
            'subtitle' => esc_html__('Set maximum height for your logo.', 'zinco'),
            'width'    => false,
            'unit'     => 'px'
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Navigation', 'zinco'),
    'icon'       => 'el el-lines',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'font_menu',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Google Font', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'font-style'  => false,
            'font-weight'  => false,
            'text-align'  => false,
            'font-size'  => false,
            'line-height'  => false,
            'color'  => false,
            'output'      => array('.primary-menu li a'),
            'units'       => 'px',
        ),
        array(
            'id'       => 'menu_font_size',
            'type'     => 'text',
            'title'    => esc_html__('Font Size', 'zinco'),
            'validate' => 'numeric',
            'desc'     => 'Enter number',
            'msg'      => 'Please enter number',
            'default'  => ''
        ),
        array(
            'id'       => 'menu_letter_spacing',
            'type'     => 'text',
            'title'    => esc_html__('Letter Spacing', 'zinco'),
            'validate' => 'numeric',
            'desc'     => 'Enter number',
            'msg'      => 'Please enter number',
            'default'  => ''
        ),
        array(
            'id'       => 'menu_text_transform',
            'type'     => 'select',
            'title'    => esc_html__('Text Transform', 'zinco'),
            'options'  => array(
                ''  => esc_html__('Capitalize', 'zinco'),
                'uppercase' => esc_html__('Uppercase', 'zinco'),
                'lowercase'  => esc_html__('Lowercase', 'zinco'),
                'initial'  => esc_html__('Initial', 'zinco'),
                'inherit'  => esc_html__('Inherit', 'zinco'),
                'none'  => esc_html__('None', 'zinco'),
            ),
            'default'  => ''
        ),
        array(
            'id'      => 'main_menu_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Menu Item Color - First Level ( Main Menu )', 'zinco'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'id'      => 'main_menu_color_sticky',
            'type'    => 'link_color',
            'title'   => esc_html__('Menu Item Color - First Level ( Sticky Menu )', 'zinco'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'id'      => 'main_menu_color_sub',
            'type'    => 'link_color',
            'title'   => esc_html__('Menu Item Color - Sub Level', 'zinco'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'title' => esc_html__('Button Phone', 'zinco'),
            'type'  => 'section',
            'id' => 'button_phone',
            'indent' => true,
        ),
        array(
            'id' => 'h_phone_number',
            'type' => 'text',
            'title' => esc_html__('Phone Number', 'zinco'),
            'default' => '',
        ),
        array(
            'id'       => 'h3_phone',
            'type'     => 'button_set',
            'title'    => esc_html__('Show Header Layout 1, Layout 3', 'zinco'),
            'options'  => array(
                'show'  => esc_html__('Show', 'zinco'),
                'hide'  => esc_html__('Hide', 'zinco')
            ),
            'default'  => 'hide',
        ),
        array(
            'title' => esc_html__('Button Navigation', 'zinco'),
            'type'  => 'section',
            'id' => 'button_navigation',
            'indent' => true,
        ),
        array(
            'id' => 'h_btn_text',
            'type' => 'text',
            'title' => esc_html__('Button Text', 'zinco'),
            'default' => '',
        ),
        array(
            'id'       => 'h_btn_link_type',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Link Type', 'zinco'),
            'options'  => array(
                'page'  => esc_html__('Page', 'zinco'),
                'custom'  => esc_html__('Custom', 'zinco')
            ),
            'default'  => 'page',
        ),
        array(
            'id'    => 'h_btn_link',
            'type'  => 'select',
            'title' => esc_html__( 'Page Link', 'zinco' ), 
            'data'  => 'page',
            'args'  => array(
                'post_type'      => 'page',
                'posts_per_page' => -1,
                'orderby'        => 'title',
                'order'          => 'ASC',
            ),
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'page' ),
            'force_output' => true
        ),
        array(
            'id' => 'h_btn_link_custom',
            'type' => 'text',
            'title' => esc_html__('Custom Link', 'zinco'),
            'default' => '',
            'required' => array( 0 => 'h_btn_link_type', 1 => 'equals', 2 => 'custom' ),
            'force_output' => true
        ),
        array(
            'id'       => 'h_btn_target',
            'type'     => 'button_set',
            'title'    => esc_html__('Button Target', 'zinco'),
            'options'  => array(
                '_self'  => esc_html__('Self', 'zinco'),
                '_blank'  => esc_html__('Blank', 'zinco')
            ),
            'default'  => '_self',
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Mobile', 'zinco'),
    'icon'       => 'el el-iphone-home',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'mobile_header_bgcolor',
            'type'        => 'color',
            'title'       => esc_html__('Header Background Color', 'zinco'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'mobile_icon_menu_color',
            'type'        => 'color',
            'title'       => esc_html__('Header Icon Menu Color', 'zinco'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'          => 'header_menu_bgcolor',
            'type'        => 'color',
            'title'       => esc_html__('Menu Background Color', 'zinco'),
            'transparent' => false,
            'default'     => ''
        ),
        array(
            'id'      => 'main_menu_color_mobile',
            'type'    => 'link_color',
            'title'   => esc_html__('Menu Item Color', 'zinco'),
            'default' => array(
                'regular' => '',
                'hover'   => '',
                'active'   => '',
            ),
        ),
        array(
            'id'       => 'search_on_mobile',
            'type'     => 'switch',
            'title'    => esc_html__('Search Icon', 'zinco'),
            'default'  => false
        ),
        array(
            'id'       => 'cart_on_mobile',
            'type'     => 'switch',
            'title'    => esc_html__('Cart Icon', 'zinco'),
            'default'  => false
        ),
    )
));

/*--------------------------------------------------------------
# Page Title area
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Page Title', 'zinco'),
    'icon'   => 'el-icon-map-marker',
    'fields' => array(
        array(
            'id'       => 'ptitle_on',
            'type'     => 'button_set',
            'title'    => esc_html__('Displayed', 'zinco'),
            'options'  => array(
                'show'  => esc_html__('Show', 'zinco'),
                'hidden'  => esc_html__('Hidden', 'zinco'),
            ),
            'default'  => 'show'
        ),
        array(
            'id'       => 'ptitle_bg',
            'type'     => 'background',
            'title'    => esc_html__('Background', 'zinco'),
            'subtitle' => esc_html__('Page title background color.', 'zinco'),
            'output'   => array('#pagetitle'),
            'required' => array( 0 => 'ptitle_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'pagetitle_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Background Color Overlay', 'zinco'),
            'output' => array('background-color' => '#pagetitle.bg-overlay:before'),
            'required' => array( 0 => 'ptitle_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'ptitle_color',
            'type'     => 'color',
            'title'    => esc_html__('Title Color', 'zinco'),
            'subtitle' => esc_html__('Page title color.', 'zinco'),
            'output'   => array('#pagetitle h1.page-title, #pagetitle h6.page-subtitle'),
            'default'  => '',
            'transparent' => false,
            'required' => array( 0 => 'ptitle_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
        array(
            'id'       => 'ptitle_breadcrumb_on',
            'type'     => 'button_set',
            'title'    => esc_html__('Breadcrumb', 'zinco'),
            'options'  => array(
                'show'  => esc_html__('Show', 'zinco'),
                'hidden'  => esc_html__('Hidden', 'zinco'),
            ),
            'default'  => 'show',
            'required' => array( 0 => 'ptitle_on', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# WordPress default content
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title' => esc_html__('Content', 'zinco'),
    'icon'  => 'el-icon-pencil',
    'fields'     => array(
        array(
            'id'       => 'content_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Content Background Color', 'zinco'),
            'subtitle' => esc_html__('Content background color.', 'zinco'),
            'output' => array('background-color' => '#content, .site-layout-default .site-footer:before')
        ),
        array(
            'id'       => 'sidebar_bg_color',
            'type'     => 'color_rgba',
            'title'    => esc_html__('Sidebar Background Color', 'zinco'),
            'subtitle' => esc_html__('Sidebar background color.', 'zinco'),
            'output' => array('background-color' => '.content-row #secondary.widget-has-sidebar::before')
        ),
        array(
            'id'             => 'content_padding',
            'type'           => 'spacing',
            'output'         => array('.site-content #primary, .site-content #secondary'),
            'right'   => false,
            'left'    => false,
            'mode'           => 'padding',
            'units'          => array('px'),
            'units_extended' => 'false',
            'title'          => esc_html__('Content Padding', 'zinco'),
            'desc'           => esc_html__('Default: Top-130px, Bottom-130px', 'zinco'),
            'default'            => array(
                'padding-top'   => '',
                'padding-bottom'   => '',
                'units'          => 'px',
            )
        ),
        array(
            'id'      => 'search_field_placeholder',
            'type'    => 'text',
            'title'   => esc_html__('Search Form - Text Placeholder', 'zinco'),
            'default' => '',
            'desc'           => esc_html__('Default: Search Keywords...', 'zinco'),
        ),
    )
));


Redux::setSection($opt_name, array(
    'title'      => esc_html__('Archive', 'zinco'),
    'icon'       => 'el-icon-list',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'archive_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'zinco'),
            'subtitle' => esc_html__('Select a sidebar position for blog home, archive, search...', 'zinco'),
            'options'  => array(
                'left'  => esc_html__('Left', 'zinco'),
                'right' => esc_html__('Right', 'zinco'),
                'none'  => esc_html__('Disabled', 'zinco')
            ),
            'default'  => 'right'
        ),
        array(
            'id'       => 'archive_author_on',
            'title'    => esc_html__('Author', 'zinco'),
            'subtitle' => esc_html__('Show author name on each post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_date_on',
            'title'    => esc_html__('Date', 'zinco'),
            'subtitle' => esc_html__('Show date posted on each post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_categories_on',
            'title'    => esc_html__('Categories', 'zinco'),
            'subtitle' => esc_html__('Show category names on each post.', 'zinco'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'archive_comments_on',
            'title'    => esc_html__('Comments', 'zinco'),
            'subtitle' => esc_html__('Show comments count on each post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'archive_social_share_on',
            'title'    => esc_html__('Social Share', 'zinco'),
            'subtitle' => esc_html__('Show social share on each post.', 'zinco'),
            'type'     => 'switch',
            'default'  => false,
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Post', 'zinco'),
    'icon'       => 'el-icon-file-edit',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'       => 'post_sidebar_pos',
            'type'     => 'button_set',
            'title'    => esc_html__('Sidebar Position', 'zinco'),
            'subtitle' => esc_html__('Select a sidebar position', 'zinco'),
            'options'  => array(
                'left'  => esc_html__('Left', 'zinco'),
                'right' => esc_html__('Right', 'zinco'),
                'none'  => esc_html__('Disabled', 'zinco')
            ),
            'default'  => 'right'
        ),
        array(
            'id'       => 'post_text_align',
            'type'     => 'button_set',
            'title'    => esc_html__('Text Align', 'zinco'),
            'options'  => array(
                'inherit'  => esc_html__('Inherit', 'zinco'),
                'justify'  => esc_html__('Justify', 'zinco'),
            ),
            'default'  => 'inherit'
        ),
        array(
            'id'       => 'post_author_on',
            'title'    => esc_html__('Author', 'zinco'),
            'subtitle' => esc_html__('Show author name on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_date_on',
            'title'    => esc_html__('Date', 'zinco'),
            'subtitle' => esc_html__('Show date on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_categories_on',
            'title'    => esc_html__('Categories', 'zinco'),
            'subtitle' => esc_html__('Show category names on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => false
        ),
        array(
            'id'       => 'post_tags_on',
            'title'    => esc_html__('Tags', 'zinco'),
            'subtitle' => esc_html__('Show tags count on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_comments_on',
            'title'    => esc_html__('Comments', 'zinco'),
            'subtitle' => esc_html__('Show comments count on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_social_share_on',
            'title'    => esc_html__('Social Share', 'zinco'),
            'subtitle' => esc_html__('Show social share on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'post_navigation_on',
            'title'    => esc_html__('Navigation', 'zinco'),
            'subtitle' => esc_html__('Show navigation on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true,
        ),
        array(
            'id'       => 'post_author_box_on',
            'title'    => esc_html__('Author Box', 'zinco'),
            'subtitle' => esc_html__('Show author box on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => false,
        ),
        array(
            'id'       => 'post_comments_form_on',
            'title'    => esc_html__('Comments Form', 'zinco'),
            'subtitle' => esc_html__('Show comments form on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_feature_image_on',
            'title'    => esc_html__('Feature Image', 'zinco'),
            'subtitle' => esc_html__('Show feature image on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => true
        ),
        array(
            'id'       => 'post_related_post',
            'title'    => esc_html__('Related', 'zinco'),
            'subtitle' => esc_html__('Show related on single post.', 'zinco'),
            'type'     => 'switch',
            'default'  => false
        ),
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Single Portfolio', 'zinco'),
    'icon'       => 'el el-cog ',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'      => 'portfolio_slug',
            'type'    => 'text',
            'title'   => esc_html__('Portfolio Slug', 'zinco'),
            'default' => '',
            'desc'     => 'Default: portfolio',
        ),
    )
));

/*--------------------------------------------------------------
# Footer
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Footer', 'zinco'),
    'icon'   => 'el el-website',
    'fields' => array(
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
            'default'  => '1'
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
        array(
            'id'       => 'footer_top_column',
            'type'     => 'button_set',
            'title'    => esc_html__('Footer Top Columns', 'zinco'),
            'options'  => array(
                '1'  => esc_html__('1 Column', 'zinco'),
                '2'  => esc_html__('2 Column', 'zinco'),
                '3'  => esc_html__('3 Column', 'zinco'),
                '4'  => esc_html__('4 Column', 'zinco'),
            ),
            'default'  => '3',
            'required' => array('footer_layout', '!=', 'custom'),
            'force_output' => true
        ),
        array(
            'id'=>'footer_copyright',
            'type' => 'textarea',
            'title' => esc_html__('Footer Bottom Copyright', 'zinco'),
            'validate' => 'html_custom',
            'default' => '',
            'subtitle' => esc_html__('Custom HTML Allowed: a,br,em,strong,span,p,div,h1->h6,[ct_year]', 'zinco'),
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array(),
                    'class' => array(),
                ),
                'img' => array(
                    'src' => array(),
                    'alt' => array(),
                    'class' => array(),
                ),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'span' => array(),
                'p' => array(),
                'div' => array(
                    'class' => array()
                ),
                'h1' => array(
                    'class' => array()
                ),
                'h2' => array(
                    'class' => array()
                ),
                'h3' => array(
                    'class' => array()
                ),
                'h4' => array(
                    'class' => array()
                ),
                'h5' => array(
                    'class' => array()
                ),
                'h6' => array(
                    'class' => array()
                ),
                'ul' => array(
                    'class' => array()
                ),
                'li' => array(),
            ),
            'required' => array('footer_layout', '!=', 'custom'),
            'force_output' => true
        ),
        array(
            'id'       => 'back_totop_on',
            'type'     => 'switch',
            'title'    => esc_html__('Back to Top Button', 'zinco'),
            'subtitle' => esc_html__('Show back to top button when scrolled down.', 'zinco'),
            'default'  => true,
        ),
        array(
            'id'       => 'newsletter',
            'type'     => 'button_set',
            'title'    => esc_html__('Newsletter', 'zinco'),
            'options'  => array(
                'hide'  => esc_html__('Hide', 'zinco'),
                'show'  => esc_html__('Show', 'zinco'),
            ),
            'default'  => 'hide',
            'required' => array( 0 => 'footer_layout', 1 => 'equals', 2 => '1' ),
            'force_output' => true
        ),
        array(
            'id'      => 'newsletter_title',
            'type'    => 'text',
            'title'   => esc_html__('Newsletter Title', 'zinco'),
            'default' => '',
            'required' => array( 0 => 'newsletter', 1 => 'equals', 2 => 'show' ),
            'force_output' => true
        ),
    )
));

/*--------------------------------------------------------------
# 404 Page
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('404 Page', 'zinco'),
    'icon'   => 'el el-website',
    'fields' => array(
        array(
            'id'      => 'title_404',
            'type'    => 'text',
            'title'   => esc_html__('Title', 'zinco'),
            'default' => '',
        ),
        array(
            'id'=>'content_404',
            'type' => 'textarea',
            'title' => esc_html__('Content', 'zinco'),
            'validate' => 'html_custom',
            'default' => '',
            'allowed_html' => array(
                'a' => array(
                    'href' => array(),
                    'title' => array(),
                    'class' => array(),
                ),
                'cite' => array(),
                'br' => array(),
                'em' => array(),
                'strong' => array(),
                'span' => array(),
                'p' => array(),
                'div' => array(
                    'class' => array()
                ),
                'h1' => array(
                    'class' => array()
                ),
                'h2' => array(
                    'class' => array()
                ),
                'h3' => array(
                    'class' => array()
                ),
                'h4' => array(
                    'class' => array()
                ),
                'h5' => array(
                    'class' => array()
                ),
                'h6' => array(
                    'class' => array()
                ),
                'ul' => array(
                    'class' => array()
                ),
                'li' => array(),
                'time' => array(),
            ),
        ),
        array(
            'id'      => 'text_button_404',
            'type'    => 'text',
            'title'   => esc_html__('Text Button', 'zinco'),
            'default' => '',
        ),
        array(
            'id'       => 'image_404',
            'type'     => 'media',
            'title'    => esc_html__('Image', 'zinco'),
            'default' => array(
                'url'=>get_template_directory_uri().'/assets/images/image-404.png'
            )
        ),
    )
));


/*--------------------------------------------------------------
# Colors
--------------------------------------------------------------*/

Redux::setSection($opt_name, array(
    'title'  => esc_html__('Colors', 'zinco'),
    'icon'   => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id'          => 'primary_color',
            'type'        => 'color',
            'title'       => esc_html__('Primary Color', 'zinco'),
            'transparent' => false,
            'default'     => '#ff7200'
        ),
        array(
            'id'          => 'secondary_color',
            'type'        => 'color',
            'title'       => esc_html__('Secondary Color', 'zinco'),
            'transparent' => false,
            'default'     => '#3767ff'
        ),
        array(
            'id'      => 'link_color',
            'type'    => 'link_color',
            'title'   => esc_html__('Link Colors', 'zinco'),
            'default' => array(
                'regular' => '#ff7200',
                'hover'   => '#e06909',
                'active'  => '#e06909'
            ),
            'output'  => array('a')
        )
    )
));

/*--------------------------------------------------------------
# Typography
--------------------------------------------------------------*/
$custom_font_selectors_1 = Redux::get_option($opt_name, 'custom_font_selectors_1');
$custom_font_selectors_1 = !empty($custom_font_selectors_1) ? explode(',', $custom_font_selectors_1) : array();
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Typography', 'zinco'),
    'icon'   => 'el-icon-text-width',
    'fields' => array(
        array(
            'id'       => 'body_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Body Default Font', 'zinco'),
            'options'  => array(
                'Open-Sans'  => esc_html__('Default', 'zinco'),
                'Google-Font'  => esc_html__('Google Font', 'zinco'),
            ),
            'default'  => 'Open-Sans',
        ),
        array(
            'id'          => 'font_main',
            'type'        => 'typography',
            'title'       => esc_html__('Body Google Font', 'zinco'),
            'subtitle'    => esc_html__('This will be the default font of your website.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'line-height'  => true,
            'font-size'  => true,
            'text-align'  => false,
            'color'  => false,
            'output'      => array('body'),
            'units'       => 'px',
            'required' => array( 0 => 'body_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'body_color',
            'type'        => 'color',
            'title'       => esc_html__('Body Color', 'zinco'),
            'transparent' => false,
            'default'     => '',
            'required' => array( 0 => 'body_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true,
            'output'      => array('body, .single-hentry.archive .entry-content, .single-post .content-area, .ct-related-post .item-holder .item-content'),
        ),
        array(
            'id'       => 'heading_default_font',
            'type'     => 'select',
            'title'    => esc_html__('Heading Default Font', 'zinco'),
            'options'  => array(
                'Gilroy-Bold'  => esc_html__('Default', 'zinco'),
                'Google-Font'  => esc_html__('Google Font', 'zinco'),
            ),
            'default'  => 'Gilroy-Bold',
        ),
        array(
            'id'          => 'font_h1',
            'type'        => 'typography',
            'title'       => esc_html__('H1', 'zinco'),
            'subtitle'    => esc_html__('This will be the default font for all H1 tags of your website.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'color'  => false,
            'output'      => array('h1', '.h1', '.text-heading'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h2',
            'type'        => 'typography',
            'title'       => esc_html__('H2', 'zinco'),
            'subtitle'    => esc_html__('This will be the default font for all H2 tags of your website.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'color'  => false,
            'output'      => array('h2', '.h2'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h3',
            'type'        => 'typography',
            'title'       => esc_html__('H3', 'zinco'),
            'subtitle'    => esc_html__('This will be the default font for all H3 tags of your website.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'color'  => false,
            'output'      => array('h3', '.h3'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h4',
            'type'        => 'typography',
            'title'       => esc_html__('H4', 'zinco'),
            'subtitle'    => esc_html__('This will be the default font for all H4 tags of your website.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'color'  => false,
            'output'      => array('h4', '.h4'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h5',
            'type'        => 'typography',
            'title'       => esc_html__('H5', 'zinco'),
            'subtitle'    => esc_html__('This will be the default font for all H5 tags of your website.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'color'  => false,
            'output'      => array('h5', '.h5'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        ),
        array(
            'id'          => 'font_h6',
            'type'        => 'typography',
            'title'       => esc_html__('H6', 'zinco'),
            'subtitle'    => esc_html__('This will be the default font for all H6 tags of your website.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'color'  => false,
            'output'      => array('h6', '.h6'),
            'units'       => 'px',
            'required' => array( 0 => 'heading_default_font', 1 => 'equals', 2 => 'Google-Font' ),
            'force_output' => true
        )
    )
));

Redux::setSection($opt_name, array(
    'title'      => esc_html__('Fonts Selectors', 'zinco'),
    'icon'       => 'el el-fontsize',
    'subsection' => true,
    'fields'     => array(
        array(
            'id'          => 'custom_font_1',
            'type'        => 'typography',
            'title'       => esc_html__('Custom Font', 'zinco'),
            'subtitle'    => esc_html__('This will be the font that applies to the class selector.', 'zinco'),
            'google'      => true,
            'font-backup' => true,
            'all_styles'  => true,
            'text-align'  => false,
            'output'      => $custom_font_selectors_1,
            'units'       => 'px',

        ),
        array(
            'id'       => 'custom_font_selectors_1',
            'type'     => 'textarea',
            'title'    => esc_html__('CSS Selectors', 'zinco'),
            'subtitle' => esc_html__('Add class selectors to apply above font.', 'zinco'),
            'validate' => 'no_html'
        )
    )
));

/*--------------------------------------------------------------
# Shop
--------------------------------------------------------------*/
if(class_exists('Woocommerce')) {
    Redux::setSection($opt_name, array(
        'title'  => esc_html__('Shop', 'zinco'),
        'icon'   => 'el el-shopping-cart',
        'fields' => array(
            array(
                'id'       => 'sidebar_shop',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Position', 'zinco'),
                'subtitle' => esc_html__('Select a sidebar position for archive shop.', 'zinco'),
                'options'  => array(
                    'left'  => esc_html__('Left', 'zinco'),
                    'right' => esc_html__('Right', 'zinco'),
                    'none'  => esc_html__('Disabled', 'zinco')
                ),
                'default'  => 'left'
            ),
            array(
                'title' => esc_html__('Products displayed per page', 'zinco'),
                'id' => 'product_per_page',
                'type' => 'slider',
                'subtitle' => esc_html__('Number product to show', 'zinco'),
                'default' => 9,
                'min'  => 6,
                'step' => 1,
                'max' => 50,
                'display_value' => 'text'
            ),
            array(
                'id'       => 'shop_content_padding',
                'type'     => 'spacing',
                'title'    => esc_html__('Content Paddings', 'zinco'),
                'subtitle' => esc_html__('Content paddings.', 'zinco'),
                'mode'     => 'padding',
                'units'    => array('em', 'px', '%'),
                'top'      => true,
                'right'    => false,
                'bottom'   => true,
                'left'     => false,
                'output'   => array('.woocommerce #content, .woocommerce-page #content'),
                'default'  => array(
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                    'units'  => 'px',
                )
            ),
            array(
                'id'       => 'product_social_share',
                'title'    => esc_html__('Product Social Share', 'zinco'),
                'type'     => 'switch',
                'default'  => false,
            ),
        )
    ));
}
/* Custom Code /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom Code', 'zinco'),
    'icon'   => 'el-icon-edit',
    'fields' => array(

        array(
            'id'       => 'site_header_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Scripts in Header', 'zinco'),
            'subtitle' => esc_html__('These scripts will be printed in the <head> section.', 'zinco'),
        ),
        array(
            'id'       => 'site_footer_code',
            'type'     => 'textarea',
            'theme'    => 'chrome',
            'title'    => esc_html__('Scripts in Footer', 'zinco'),
            'subtitle' => esc_html__('These scripts will be printed above the </body> tag.', 'zinco'),
        ),

    ),
));

/* Custom CSS /--------------------------------------------------------- */
Redux::setSection($opt_name, array(
    'title'  => esc_html__('Custom CSS', 'zinco'),
    'icon'   => 'el-icon-adjust-alt',
    'fields' => array(

        array(
            'id'   => 'customcss',
            'type' => 'info',
            'desc' => esc_html__('Custom CSS', 'zinco')
        ),

        array(
            'id'       => 'site_css',
            'type'     => 'ace_editor',
            'title'    => esc_html__('CSS Code', 'zinco'),
            'subtitle' => esc_html__('Advanced CSS Options. You can paste your custom CSS Code here.', 'zinco'),
            'mode'     => 'css',
            'validate' => 'css',
            'theme'    => 'chrome',
            'default'  => ""
        ),

    ),
));