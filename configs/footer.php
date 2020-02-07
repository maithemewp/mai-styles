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
 * Footer Widget Titles.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Footer Widget Titles', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'footer_widget_title_typography',
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
			'element' => array(
				'.footer-widgets .widget-title',
				'.site-footer .widget-title',
			),
		),
	),
) );

/**
 * Footer Widgets.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'multicolor',
	'settings'  => 'footer_widgets',
	'label'     => __( 'Footer Widgets', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
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
	'label'     => __( 'Site Footer Background', 'mai-styles' ),
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
	'choices'   => array(
		'bg'               => esc_attr__( 'Background', 'mai-styles' ),
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
