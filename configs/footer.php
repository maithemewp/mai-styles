<?php

$section = 'maistyles_footer';

/* ****** *
 * Footer *
 * ****** */
Kirki::add_section( $section, array(
	'title' => esc_attr__( 'Footer', 'mai-styles' ),
	'panel' => $panel_id,
) );

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
		return ( genesis_get_option( 'footer_widget_count' ) > 0 ) && is_active_sidebar( 'footer-1' );
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

/**
 * Footer Menu.
 */
$secondary_menu = new Mai_Styles_Navigation( $config_id, $section, 'secondary' );

// Color.
// $secondary_menu->get_color_config();

// Submenu Color.
// $secondary_menu->get_submenu_color_config();

// Typography.
// $secondary_menu->get_typography_config();

// Submenu Typography.
// $secondary_menu->get_submenu_typography_config();
