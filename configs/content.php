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
