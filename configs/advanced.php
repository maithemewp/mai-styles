<?php

$section    = 'maistyles_advanced';
$navigation = new Mai_Styles_Navigation( $section );

/* ******* *
 * Advanced *
 * ******* */
Kirki::add_section( $section, array(
	'title' => esc_attr__( 'Advanced', 'mai-styles' ),
	'panel' => $panel_id,
) );

/**
 * Header Before.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'header_before',
	'label'     => __( 'Before Header', 'mai-colors' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg'               => esc_attr__( 'Background', 'mai-colors' ),
		'color'            => esc_attr__( 'Text Color', 'mai-colors' ),
		'link_color'       => esc_attr__( 'Link Color', 'mai-colors' ),
		'link_hover_color' => esc_attr__( 'Link Hover Color', 'mai-colors' ),

	),
	'default' => array(
		'bg'               => '',
		'color'            => '',
		'link_color'       => '',
		'link_hover_color' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.header-before',
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '.header-before',
		),
		array(
			'choice'   => 'link_color',
			'property' => 'color',
			'element'  => '.header-before a',
		),
		array(
			'choice'   => 'link_hover_color',
			'property' => 'color',
			'element'  => array( '.header-before a:hover', '.header-before a:focus' ),
		),
	),
	'active_callback' => function() {
		return is_active_sidebar( 'header_before' );
	}
) );

/**
 * Header.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'site_header',
	'label'     => __( 'Site Header', 'mai-colors' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-colors' ),

	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.site-header',
		),
	),
) );

/**
 * Site Title.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'site_title',
	'label'     => __( 'Site Title', 'mai-colors' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'color' => esc_attr__( 'Color', 'mai-colors' ),
	),
	'default' => array(
		'color' => '',
	),
	'output' => array(
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '.site-title a:not(.custom-logo-link)',
		),
	),
	'active_callback' => function() {
		return ! has_custom_logo();
	}
) );

/**
 * Header Nav.
 */
Kirki::add_field( $config_id, $navigation->get_config( __( 'Header Nav', 'mai-styles' ), 'header_nav_color', '.nav-header', $navigation->has_menu( 'header' ) ) );

/**
 * Header Nav Typography.
 */
Kirki::add_field( $config_id, $navigation->get_typography_config( 'header_nav_typography', '.nav-header', $navigation->has_menu( 'header' ) ) );

/**
 * Header Nav Submenu.
 */
Kirki::add_field( $config_id, $navigation->get_submenu_config( __( 'Header Nav Submenu', 'mai-styles' ), 'header_nav_submenu_color', '.nav-header', $navigation->has_submenu( 'header' ) ) );

/**
 * Header Nav Submenu Typography.
 */
Kirki::add_field( $config_id, $navigation->get_submenu_typography_config( 'header_nav_submenu_typography', '.nav-header', $navigation->has_submenu( 'header' ) ) );

/**
 * Header Nav Highlight.
 */
Kirki::add_field( $config_id, $navigation->get_highlight_config( __( 'Header Nav Highlight', 'mai-styles' ), 'header_nav_highlight_color', '.nav-header', $navigation->has_highlight( 'header' ) ) );

/**
 * Primary Nav Search.
 */
Kirki::add_field( $config_id, $navigation->get_search_config( __( 'Header Nav Search', 'mai-styles' ), 'header_nav_search_color', '.nav-header', $navigation->has_search( 'header' ) ) );

/**
 * Primary Nav.
 */
Kirki::add_field( $config_id, $navigation->get_config( __( 'Primary Nav', 'mai-styles' ), 'primary_nav_color', '.nav-primary', $navigation->has_menu( 'primary' ) ) );

/**
 * Primary Nav Typography.
 */
Kirki::add_field( $config_id, $navigation->get_typography_config( 'primary_nav_typography', '.nav-primary', $navigation->has_menu( 'primary' ) ) );

/**
 * Primary Nav Submenu.
 */
Kirki::add_field( $config_id, $navigation->get_submenu_config( __( 'Primary Nav Submenu', 'mai-styles' ), 'primary_nav_submenu_color', '.nav-primary', $navigation->has_submenu( 'primary' ) ) );

/**
 * Primary Nav Submenu Typography.
 */
Kirki::add_field( $config_id, $navigation->get_submenu_typography_config( 'primary_nav_submenu_typography', '.nav-primary', $navigation->has_submenu( 'primary' ) ) );

/**
 * Primary Nav Highlight.
 */
Kirki::add_field( $config_id, $navigation->get_highlight_config( __( 'Primary Nav Highlight', 'mai-styles' ), 'primary_nav_highlight_color', '.nav-primary', $navigation->has_highlight( 'primary' ) ) );

/**
 * Primary Nav Search.
 */
Kirki::add_field( $config_id, $navigation->get_search_config( __( 'Primary Nav Search', 'mai-styles' ), 'primary_nav_search_color', '.nav-primary', $navigation->has_search( 'primary' ) ) );

/**
 * Site Container.
 */
Kirki::add_field( $config_id, array(
	'label'     => __( 'Site Container', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'site_container',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),

	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.site-container.boxed',
		),
	),
	'active_callback' => function() {
		return in_array( 'site_container', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Content Sidebar Wrap.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'content_sidebar_wrap',
	'label'     => __( 'Content Sidebar Wrap', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),

	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.content-sidebar-wrap.boxed',
		),
	),
	'active_callback' => function() {
		return in_array( 'content_sidebar_wrap', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Content.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'content',
	'label'     => __( 'Content', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.content.boxed',
		),
	),
	'active_callback' => function() {
		return in_array( 'content', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Single Posts/Entries.
 * If choosing a dark bg color then text color would get screwed up,
 * but we're not getting that granular.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'entry_singular',
	'label'     => __( 'Single Posts/Entries', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.singular .content > .entry.boxed',
		),
	),
	'active_callback' => function() {
		return in_array( 'entry_singular', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Archive Posts/Entries.
 * If choosing a dark bg color then text color would get screwed up,
 * but we're not getting that granular.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'entry_archive',
	'label'     => __( 'Archive Posts/Entries', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => array(
				'.archive .content > .entry.boxed',
				'.blog .content > .entry.boxed',
				'.search .content > .entry.boxed',
			),
		),
	),
	'active_callback' => function() {
		return in_array( 'entry_archive', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Primary Sidebar.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'sidebar',
	'label'     => __( 'Primary Sidebar', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.sidebar-primary.boxed',
		),
	),

	'choices'   => array(
		'bg'         => esc_attr__( 'Background Color', 'mai-styles' ),
		'color'      => esc_attr__( 'Text Color', 'mai-styles' ),
		'link'       => esc_attr__( 'Link Color', 'mai-styles' ),
		'link_hover' => esc_attr__( 'Link Hover Color', 'mai-styles' ),
	),
	'default' => array(
		'bg'         => '',
		'color'      => '',
		'link'       => '',
		'link_hover' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => array( 'body', 'body.has-boxed-site-container' ),
		),
		array(
			'choice'   => 'heading',
			'property' => 'color',
			'element'  => array(
				'.blog .content .entry-title',
				'.archive .content .entry-title',
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array( 'body', 'body.text-md' ),
		),
		array(
			'choice'   => 'link',
			'property' => 'color',
			'element'  => array( 'a' ),
		),
		array(
			'choice'   => 'link_hover',
			'property' => 'color',
			'element'  => array( 'a:hover', 'a:focus' ),
		),
	),
	'active_callback' => function() {
		return in_array( 'sidebar', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Primary Sidebar Widgets.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'sidebar_widgets',
	'label'     => __( 'Primary Sidebar Widgets', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.sidebar-primary .widget.boxed',
		),
	),
	'active_callback' => function() {
		return in_array( 'sidebar_widgets', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Secondary Sidebar.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'sidebar_alt',
	'label'     => __( 'Secondary Sidebar', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.sidebar-secondary.boxed',
		),
	),
	'active_callback' => function() {
		return in_array( 'sidebar_alt', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Secondary Sidebar Widgets.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'sidebar_alt_widgets',
	'label'     => __( 'Secondary Sidebar Widgets', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	),
	'default' => array(
		'bg' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.sidebar-secondary .widget.boxed',
		),
	),
	'active_callback' => function() {
		return in_array( 'sidebar_alt_widgets', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Secondary Nav.
 */
Kirki::add_field( $config_id, $navigation->get_config( __( 'Footer Nav', 'mai-styles' ), 'secondary_nav_color', '.nav-secondary', $navigation->has_menu( 'secondary' ) ) );

/**
 * Secondary Nav Typography.
 */
Kirki::add_field( $config_id, $navigation->get_typography_config( 'secondary_nav_typography', '.nav-secondary', $navigation->has_menu( 'secondary' ) ) );

/**
 * Secondary Nav Submenu.
 */
Kirki::add_field( $config_id, $navigation->get_submenu_config( __( 'Footer Nav Submenu', 'mai-styles' ), 'secondary_nav_submenu_color', '.nav-secondary', $navigation->has_submenu( 'secondary' ) ) );

/**
 * Secondary Nav Submenu Typography.
 */
Kirki::add_field( $config_id, $navigation->get_submenu_typography_config( 'secondary_nav_submenu_typography', '.nav-secondary', $navigation->has_submenu( 'secondary' ) ) );

/**
 * Secondary Nav Highlight.
 */
Kirki::add_field( $config_id, $navigation->get_highlight_config( __( 'Footer Nav Highlight', 'mai-styles' ), 'secondary_nav_highlight_color', '.nav-secondary', $navigation->has_highlight( 'secondary' ) ) );

/**
 * Secondary Nav Search.
 */
Kirki::add_field( $config_id, $navigation->get_search_config( __( 'Footer Nav Search', 'mai-styles' ), 'secondary_nav_search_color', '.nav-secondary', $navigation->has_search( 'secondary' ) ) );

/**
 * Footer Widgets.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'footer_widgets',
	'label'     => __( 'Footer Widgets', 'mai-colors' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg'               => esc_attr__( 'Background', 'mai-colors' ),
		'title_color'      => esc_attr__( 'Title Color', 'mai-colors' ),
		'color'            => esc_attr__( 'Text Color', 'mai-colors' ),
		'link_color'       => esc_attr__( 'Link Color', 'mai-colors' ),
		'link_hover_color' => esc_attr__( 'Link Hover Color', 'mai-colors' ),

	),
	'default' => array(
		'bg'               => '',
		'color'            => '',
		'link_color'       => '',
		'link_hover_color' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.footer-widgets',
		),
		array(
			'choice'   => 'title_color',
			'property' => 'color',
			'element'  => array( '.footer-widgets .widgettitle', '.footer-widgets .widget-title' ),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '.footer-widgets',
		),
		array(
			'choice'   => 'link_color',
			'property' => 'color',
			'element'  => '.footer-widgets a',
		),
		array(
			'choice'   => 'link_hover_color',
			'property' => 'color',
			'element'  => array( '.footer-widgets a:hover', '.footer-widgets a:focus' ),
		),
	),
	'active_callback' => function() {
		return ( genesis_get_option( 'footer_widget_count' ) > 0 );
	}
) );

/**
 * Site Footer.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'site_footer',
	'label'     => __( 'Site Footer Background', 'mai-colors' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg'               => esc_attr__( 'Background', 'mai-colors' ),
		'color'            => esc_attr__( 'Text Color', 'mai-colors' ),
		'link_color'       => esc_attr__( 'Link Color', 'mai-colors' ),
		'link_hover_color' => esc_attr__( 'Link Hover Color', 'mai-colors' ),

	),
	'default' => array(
		'bg'               => '',
		'color'            => '',
		'link_color'       => '',
		'link_hover_color' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.site-footer',
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '.site-footer',
		),
		array(
			'choice'   => 'link_color',
			'property' => 'color',
			'element'  => '.site-footer a',
		),
		array(
			'choice'   => 'link_hover_color',
			'property' => 'color',
			'element'  => array( '.site-footer a:hover', '.site-footer a:focus' ),
		),
	),
) );
