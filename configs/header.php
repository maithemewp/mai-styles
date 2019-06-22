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
	'type'            => 'multicolor',
	'settings'        => 'header_before_color',
	'label'           => __( 'Before Header', 'mai-styles' ),
	'section'         => $section,
	'transport'       => 'auto',
	'default'         => '',
	'choices'         => maistyles_get_header_before_color_choices(),
	'default'         => maistyles_get_header_before_color_defaults(),
	'output'          => maistyles_get_header_before_color_output(),
	'active_callback' => function() {
		return is_active_sidebar( 'header_before' );
	}
) );

Kirki::add_field( $config_id, array(
	'type'      => 'typography',
	'settings'  => 'heading_before_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-size'      => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => array(
				'.header-before',
			),
		),
	),
	'active_callback' => function() {
		return is_active_sidebar( 'header_before' ) && maistyles_has_header_before_non_menu_widgets();
	}
) );

/**
 * Header Before Menu.
 */
$header_before_menu = new Mai_Styles_Navigation( $config_id, $section, 'header_before' );

/**
 * Header.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'site_header_color',
	'label'     => __( 'Site Header', 'mai-styles' ),
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
			'element'  => '.site-header',
		),
	),
) );

/**
 * Site Title.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'site_title_color',
	'label'     => __( 'Site Title', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'color' => esc_attr__( 'Color', 'mai-styles' ),
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
		return ! ( function_exists( 'has_custom_logo' ) || has_custom_logo() );
	}
) );

/**
 * Header Menu.
 */
$header_menu = new Mai_Styles_Navigation( $config_id, $section, 'header' );

/**
 * Primary Menu.
 */
$primary_menu = new Mai_Styles_Navigation( $config_id, $section, 'primary' );

function maistyles_get_header_before_color_choices() {
	$choices = array(
		'bg' => esc_attr__( 'Background', 'mai-styles' ),
	);
	if ( maistyles_has_header_before_non_menu_widgets() ) {
		$choices = array_merge( $choices, array(
			'color'            => esc_attr__( 'Text Color', 'mai-styles' ),
			'link_color'       => esc_attr__( 'Link Color', 'mai-styles' ),
			'link_hover_color' => esc_attr__( 'Link Hover Color', 'mai-styles' ),
		) );
	}
	return $choices;
}

function maistyles_get_header_before_color_defaults() {
	$defaults = array(
		'bg' => '',
	);
	if ( maistyles_has_header_before_non_menu_widgets() ) {
		$defaults = array_merge( $defaults, array(
			'color'            => '',
			'link_color'       => '',
			'link_hover_color' => '',
		) );
		}
	return $defaults;
}

function maistyles_get_header_before_color_output() {
	$output = array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => '.header-before',
		),
	);
	if ( maistyles_has_header_before_non_menu_widgets() ) {
		$output = array_merge( $output, array(
			array(
				'choice'   => 'color',
				'property' => 'color',
				'element'  => '.header-before',
			),
			array(
				'choice'   => 'link_color',
				'property' => 'color',
				'element'  => array(
					'.header-before a',
				),
			),
			array(
				'choice'   => 'link_hover_color',
				'property' => 'color',
				'element'  => array(
					'.header-before a:hover',
					'.header-before a:focus',
				),
			),
		) );
	}
	return $output;
}

function maistyles_has_header_before_non_menu_widgets() {
	$widgets = wp_get_sidebars_widgets();
	if ( ! $widgets ) {
		return false;
	}
	if ( ! isset( $widgets['header_before'] ) || empty( $widgets['header_before'] ) ) {
		return false;
	}
	foreach ( $widgets['header_before'] as $widget_id ) {
		// Skip if navigation widget.
		if ( false  !== strpos ( $widget_id, 'nav_menu' ) ) {
			continue;
		}
		return true;
	}
	return false;
}
