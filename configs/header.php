<?php

$section = 'maistyles_header';

/* ****** *
 * Header *
 * ****** */
Kirki::add_section( $section, array(
	'title' => esc_attr__( 'Header', 'mai-styles' ),
	'panel' => $panel_id,
) );

/**
 * Header Before.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'header_before_color',
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
	'settings'  => 'site_header_color',
	'label'     => __( 'Site Header', 'mai-colors' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg'        => esc_attr__( 'Background', 'mai-colors' ),
		// 'bg_scroll' => esc_attr__( 'Scrolled Background', 'mai-colors' ),

	),
	'default' => array(
		'bg' => '',
		// 'bg_scroll' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.site-header',
		),
		// array(
		// 	'choice'   => 'bg_scroll',
		// 	'property' => 'background-color',
		// 	'element'  => 'body.scroll .site-header',
		// ),
	),
) );

/**
 * Site Title.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'site_title_color',
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
 * Header Menu.
 */
$settings = new Mai_Styles_Menu( $config_id, $section, 'header' );


/**
 * Primary Menu.
 */
$settings = new Mai_Styles_Menu( $config_id, $section, 'primary' );
