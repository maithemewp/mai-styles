<?php

$section = 'maistyles_content';

/* ******* *
 * Content *
 * ******* */
Kirki::add_section( $section, array(
	'title' => esc_attr__( 'Content', 'mai-styles' ),
	'panel' => $panel_id,
) );

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
				'.date .content > .entry.boxed',
				'.search .content > .entry.boxed',
				'.archive .content > .row > .entry.boxed',
				'.blog .content > .row > .entry.boxed',
				'.date .content > .row > .entry.boxed',
				'.search .content > .row > .entry.boxed',
			),
		),
	),
	'active_callback' => function() {
		return in_array( 'entry_archive', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );

/**
 * Sidebar Widget Titles.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Sidebar Widget Titles', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'sidebar_widget_title_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-size'      => '',
		'variant'        => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => array( '.sidebar .widget-title' ),
		),
	),
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
	'choices'   => array(
		'bg'               => esc_attr__( 'Background', 'mai-styles' ),
		'title_color'      => esc_attr__( 'Title Color', 'mai-styles' ),
		'color'            => esc_attr__( 'Text Color', 'mai-styles' ),
		'link_color'       => esc_attr__( 'Link Color', 'mai-styles' ),
		'link_hover_color' => esc_attr__( 'Link Hover Color', 'mai-styles' ),

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
			'element'  => '.sidebar-primary .widget.boxed',
		),
		array(
			'choice'   => 'title_color',
			'property' => 'color',
			'element'  => array( '.sidebar-primary .widget.boxed .widgettitle', '.sidebar-primary .widget.boxed .widget-title' ),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '.sidebar-primary .widget.boxed',
		),
		array(
			'choice'   => 'link_color',
			'property' => 'color',
			'element'  => '.sidebar-primary .widget.boxed a',
		),
		array(
			'choice'   => 'link_hover_color',
			'property' => 'color',
			'element'  => array( '.sidebar-primary .widget.boxed a:hover', '.sidebar-primary .widget.boxed a:focus' ),
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
	'choices'   => array(
		'bg'               => esc_attr__( 'Background', 'mai-styles' ),
		'title_color'      => esc_attr__( 'Title Color', 'mai-styles' ),
		'color'            => esc_attr__( 'Text Color', 'mai-styles' ),
		'link_color'       => esc_attr__( 'Link Color', 'mai-styles' ),
		'link_hover_color' => esc_attr__( 'Link Hover Color', 'mai-styles' ),

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
			'element'  => '.sidebar-secondary .widget.boxed',
		),
		array(
			'choice'   => 'title_color',
			'property' => 'color',
			'element'  => array( '.sidebar-secondary .widget.boxed .widgettitle', '.sidebar-secondary .widget.boxed .widget-title' ),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => '.sidebar-secondary .widget.boxed',
		),
		array(
			'choice'   => 'link_color',
			'property' => 'color',
			'element'  => '.sidebar-secondary .widget.boxed a',
		),
		array(
			'choice'   => 'link_hover_color',
			'property' => 'color',
			'element'  => array( '.sidebar-secondary .widget.boxed a:hover', '.sidebar-secondary .widget.boxed a:focus' ),
		),
	),
	'active_callback' => function() {
		return in_array( 'sidebar_alt_widgets', (array) genesis_get_option( 'boxed_elements' ) );
	}
) );
