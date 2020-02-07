<?php

$section = 'maistyles_general';

/* ******* *
 * General *
 * ******* */
Kirki::add_section( $section, array(
	'title' => esc_attr__( 'General', 'mai-styles' ),
	'panel' => $panel_id,
) );

/**
 * Disable theme fonts.
 */
Kirki::add_field( $config_id, array(
	'type'        => 'checkbox',
	'settings'    => 'disable_theme_fonts',
	'label'       => esc_attr__( 'Disable theme fonts', 'mai-styles' ),
	// 'description' => esc_attr__( 'Removes default fonts from the theme.', 'mai-styles' ),
	'section'     => $section,
	'default'     => false,
) );

/**
 * Body.
 */
Kirki::add_field( $config_id, array(
	// 'label'     => esc_attr__( 'Body Color', 'mai-styles' ),
	'label'     => esc_attr__( 'Body', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'body_color',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => '',
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
			'element'  => array(
				'body',
				'body.text-md',
				'body.has-boxed-site-container'
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				'body',
				'body.text-md',
				'.entry.boxed:not(.has-bg-image)'
			),
		),
		array(
			'choice'   => 'link',
			'property' => 'color',
			'element'  => array(
				'body a'
			),
		),
		array(
			'choice'   => 'link_hover',
			'property' => 'color',
			'element'  => array(
				'body a:hover',
				'body a:focus'
			),
		),
	),
) );

Kirki::add_field( $config_id, array(
	// 'label'     => esc_attr__( 'Body Typography', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'body_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '',
		'letter-spacing' => '',
		'line-height'    => '',
	),
	'output' => array(
		array(
			'element' => array(
				'body',
				'body.text-md',
			),
		),
	),
) );

/**
 * Headings.
 */
Kirki::add_field( $config_id, array(
	// 'label'     => esc_attr__( 'Heading Color', 'mai-styles' ),
	'label'       => esc_attr__( 'Headings', 'mai-styles' ),
	'description' => esc_attr__( 'Default settings for all headings', 'mai-styles' ),
	'type'        => 'multicolor',
	'settings'    => 'heading_color',
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => '',
	'choices'     => array(
		'color' => esc_attr__( 'Color', 'mai-styles' ),
	),
	'default' => array(
		'color' => '',
	),
	'output' => array(
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				'.banner-title',
				'.entry-title',
				'.entry-title a',
				'.heading',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
			),
		),
	),
) );

Kirki::add_field( $config_id, array(
	// 'label'     => esc_attr__( 'Heading Typography', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'heading_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'variant'        => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => array(
				'.banner-title',
				'.entry-title',
				'.heading',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
			),
		),
	),
) );

/**
 * Banner Title.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Banner Title', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'banner_title_color',
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
			'element'  => array(
				'.banner-title',
				'.light-content .banner-title',
			),
		),
	),
	'active_callback' => function() {
		return ( function_exists( 'mai_is_banner_area_enabled' ) && mai_is_banner_area_enabled() );
	}
) );

Kirki::add_field( $config_id, array(
	// 'label'     => esc_attr__( 'Banner Title Typography', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'banner_title_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'font-size'      => '',
		'variant'        => '',
		'letter-spacing' => '',
		'text-transform' => '',
		// 'color'          => '',
	),
	'output' => array(
		array(
			'element' => array(
				'.banner-title',
			),
		),
	),
	'active_callback' => function() {
		return ( function_exists( 'mai_is_banner_area_enabled' ) && mai_is_banner_area_enabled() );
	}
) );

/**
 * Section Titles.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Section Titles', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'section_title_color',
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
			'element'  => array(
				'.heading',
			),
		),
	),
	'active_callback' => function() {
		return is_page_template( 'sections.php' );
	}
) );

Kirki::add_field( $config_id, array(
	'type'      => 'typography',
	'settings'  => 'section_title_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'font-size'      => '',
		'variant'        => '',
		'letter-spacing' => '',
		'text-transform' => '',
		// 'color'          => '',
	),
	'output' => array(
		array(
			'element' => array(
				'.heading',
			),
		),
	),
	'active_callback' => function() {
		return is_page_template( 'sections.php' );
	}
) );

/**
 * h1.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Entry Title', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'entry_title_color',
	'section'   => $section,
	'transport' => 'auto',
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
			'element'  => array(
				'h1',
				'h1.entry-title',
			),
		),
	),
) );

/**
 * h1.
 */
Kirki::add_field( $config_id, array(
	'type'      => 'typography',
	'settings'  => 'h1_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'font-size'      => '',
		'variant'        => '',
		'letter-spacing' => '',
		'text-transform' => '',
		// 'color'          => '',
	),
	'output' => array(
		array(
			'element' => array(
				'h1',
				'h1.entry-title',
			),
		),
	),
) );

/**
 * h2.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Heading 2', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'h2_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-size' => '',
	),
	'output' => array(
		array(
			'element' => array( 'h2' ),
		),
	),
) );

/**
 * h3.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Heading 3', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'h3_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-size' => '',
	),
	'output' => array(
		array(
			'element' => array( 'h3' ),
		),
	),
) );

/**
 * h4.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Heading 4', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'h4_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-size' => '',
	),
	'output' => array(
		array(
			'element' => array( 'h4' ),
		),
	),
) );

/**
 * h5.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Heading 5', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'h5_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-size' => '',
	),
	'output' => array(
		array(
			'element' => array( 'h5' ),
		),
	),
) );

/**
 * h6.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Heading 6', 'mai-styles' ),
	'type'      => 'typography',
	'settings'  => 'h6_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-size' => '',
	),
	'output' => array(
		array(
			'element' => array( 'h6' ),
		),
	),
) );

/**
 * Button (Primary).
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Button (Primary)', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'button',
	'section'   => $section,
	'transport' => 'auto',
	'choices'   => array(
		'bg'          => esc_attr__( 'Background Color', 'mai-styles' ),
		'color'       => esc_attr__( 'Text Color', 'mai-styles' ),
		'bg_hover'    => esc_attr__( 'Background Hover', 'mai-styles' ),
		'color_hover' => esc_attr__( 'Text Hover', 'mai-styles' ),
	),
	'default' => array(
		'bg'          => '',
		'color'       => '',
		'bg_hover'    => '',
		'color_hover' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => array(
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.button',
				'.entry-content .button',
				'.woocommerce a.button',
				'.woocommerce button.button',
				'.woocommerce input.button',
				'.woocommerce .button.alt.single_add_to_cart_button',
				'.woocommerce .button.alt.checkout-button',
				'.woocommerce #payment #place_order',
				'.woocommerce-page #payment #place_order',
				'.edd-submit.button',
				'#edd-purchase-button',
			),
		),
		array(
			'choice'   => 'bg_hover',
			'property' => 'background-color',
			'element'  => array(
				'button:hover',
				'button:focus',
				'input:hover[type="button"]',
				'input:focus[type="button"]',
				'input:hover[type="reset"]',
				'input:focus[type="reset"]',
				'input:hover[type="submit"]',
				'input:focus[type="submit"]',
				'.button:hover',
				'.button:focus',
				'.entry-content .button:hover',
				'.entry-content .button:focus',
				'.woocommerce a.button:hover',
				'.woocommerce a.button:focus',
				'.woocommerce button.button:hover',
				'.woocommerce button.button:focus',
				'.woocommerce input.button:hover',
				'.woocommerce input.button:focus',
				'.woocommerce .button.alt.single_add_to_cart_button:hover',
				'.woocommerce .button.alt.single_add_to_cart_button:focus',
				'.woocommerce .button.alt.checkout-button:hover',
				'.woocommerce .button.alt.checkout-button:focus',
				'.woocommerce #payment #place_order:hover',
				'.woocommerce #payment #place_order:focus',
				'.woocommerce-page #payment #place_order:hover',
				'.woocommerce-page #payment #place_order:focus',
				'.woocommerce #respond input#submit.alt.disabled',
				'.woocommerce #respond input#submit.alt.disabled:hover',
				'.woocommerce #respond input#submit.alt:disabled',
				'.woocommerce #respond input#submit.alt:disabled:hover',
				'.woocommerce #respond input#submit.alt:disabled[disabled]',
				'.woocommerce #respond input#submit.alt:disabled[disabled]:hover',
				'.woocommerce a.button.alt.disabled',
				'.woocommerce a.button.alt.disabled:hover',
				'.woocommerce a.button.alt:disabled',
				'.woocommerce a.button.alt:disabled:hover',
				'.woocommerce a.button.alt:disabled[disabled]',
				'.woocommerce a.button.alt:disabled[disabled]:hover',
				'.woocommerce button.button.alt.disabled',
				'.woocommerce button.button.alt.disabled:hover',
				'.woocommerce button.button.alt:disabled',
				'.woocommerce button.button.alt:disabled:hover',
				'.woocommerce button.button.alt:disabled[disabled]',
				'.woocommerce button.button.alt:disabled[disabled]:hover',
				'.woocommerce input.button.alt.disabled',
				'.woocommerce input.button.alt.disabled:hover',
				'.woocommerce input.button.alt:disabled',
				'.woocommerce input.button.alt:disabled:hover',
				'.woocommerce input.button.alt:disabled[disabled]',
				'.woocommerce input.button.alt:disabled[disabled]:hover',
				'.edd-submit.button:hover',
				'.edd-submit.button:focus',
				'#edd-purchase-button:hover',
				'#edd-purchase-button:focus',
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.button',
				'.entry-content .button',
				// '.entry-content .more-link',
				'.menu-item.highlight > a',
				'.woocommerce a.button',
				'.woocommerce button.button',
				'.woocommerce input.button',
				'.woocommerce .button.alt.single_add_to_cart_button',
				'.woocommerce .button.alt.checkout-button',
				'.woocommerce #payment #place_order',
				'.woocommerce-page #payment #place_order',
				'.edd-submit.button',
				'#edd-purchase-button',
			),
		),
		array(
			'choice'   => 'color_hover',
			'property' => 'color',
			'element'  => array(
				'button:hover',
				'button:focus',
				'input:hover[type="button"]',
				'input:focus[type="button"]',
				'input:hover[type="reset"]',
				'input:focus[type="reset"]',
				'input:hover[type="submit"]',
				'input:focus[type="submit"]',
				'.button:hover',
				'.button:focus',
				'.entry-content .button:hover',
				'.entry-content .button:focus',
				// '.entry-content .more-link:hover',
				// '.entry-content .more-link:focus',
				'.menu-item.highlight.current-menu-item > a',
				'.menu-item.highlight > a:hover',
				'.menu-item.highlight > a:focus',
				'.woocommerce a.button:hover',
				'.woocommerce a.button:focus',
				'.woocommerce button.button:hover',
				'.woocommerce button.button:focus',
				'.woocommerce input.button:hover',
				'.woocommerce input.button:focus',
				'.woocommerce .button.alt.single_add_to_cart_button:hover',
				'.woocommerce .button.alt.single_add_to_cart_button:focus',
				'.woocommerce .button.alt.checkout-button:hover',
				'.woocommerce .button.alt.checkout-button:focus',
				'.woocommerce #payment #place_order:hover',
				'.woocommerce #payment #place_order:focus',
				'.woocommerce-page #payment #place_order:hover',
				'.woocommerce-page #payment #place_order:focus',
				'.woocommerce #respond input#submit.alt.disabled',
				'.woocommerce #respond input#submit.alt.disabled:hover',
				'.woocommerce #respond input#submit.alt:disabled',
				'.woocommerce #respond input#submit.alt:disabled:hover',
				'.woocommerce #respond input#submit.alt:disabled[disabled]',
				'.woocommerce #respond input#submit.alt:disabled[disabled]:hover',
				'.woocommerce a.button.alt.disabled',
				'.woocommerce a.button.alt.disabled:hover',
				'.woocommerce a.button.alt:disabled',
				'.woocommerce a.button.alt:disabled:hover',
				'.woocommerce a.button.alt:disabled[disabled]',
				'.woocommerce a.button.alt:disabled[disabled]:hover',
				'.woocommerce button.button.alt.disabled',
				'.woocommerce button.button.alt.disabled:hover',
				'.woocommerce button.button.alt:disabled',
				'.woocommerce button.button.alt:disabled:hover',
				'.woocommerce button.button.alt:disabled[disabled]',
				'.woocommerce button.button.alt:disabled[disabled]:hover',
				'.woocommerce input.button.alt.disabled',
				'.woocommerce input.button.alt.disabled:hover',
				'.woocommerce input.button.alt:disabled',
				'.woocommerce input.button.alt:disabled:hover',
				'.woocommerce input.button.alt:disabled[disabled]',
				'.woocommerce input.button.alt:disabled[disabled]:hover',
				'.edd-submit.button:hover',
				'.edd-submit.button:focus',
				'#edd-purchase-button:hover',
				'#edd-purchase-button:focus',
			),
		),
	),
) );

Kirki::add_field( $config_id, array(
	'type'      => 'typography',
	'settings'  => 'button_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => array(
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.button',
				'.entry-content .button',
				'.edd-submit.button',
				'#edd-purchase-button',
			),
		),
	),
) );

/**
 * Buttons (Alternate/Secondary).
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Button (Alternate)', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'button_alt_color',
	'section'   => $section,
	'transport' => 'auto',
	'choices'   => array(
		'bg'          => esc_attr__( 'Background Color', 'mai-styles' ),
		'color'       => esc_attr__( 'Text Color', 'mai-styles' ),
		'bg_hover'    => esc_attr__( 'Background Hover', 'mai-styles' ),
		'color_hover' => esc_attr__( 'Text Hover', 'mai-styles' ),
	),
	'default' => array(
		'bg'          => '',
		'color'       => '',
		'bg_hover'    => '',
		'color_hover' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background-color',
			'element'  => array(
				'.button.alt',
				'.comment-reply-link',
				'.entry-content .button.alt',
				'.entry-content .more-link',
				'.footer-widgets .button',
				'.footer-widgets input[type="submit"]',
				'.site-footer .button',
				// '.woocommerce .actions .button', // Coupons and update cart. This would look bad to change.
				// '.woocommerce a.button.alt',     // These break things when non-woo buttons are used on a woo page.
				'.woocommerce a.button.add_to_cart_button',
			),
		),
		array(
			'choice'   => 'bg_hover',
			'property' => 'background-color',
			'element'  => array(
				'.button.alt:hover',
				'.button.alt:focus',
				'.comment-reply-link:hover',
				'.comment-reply-link:focus',
				'.entry-content .button.alt:hover',
				'.entry-content .button.alt:focus',
				'.entry-content .more-link:hover',
				'.entry-content .more-link:focus',
				'.footer-widgets .button:hover',
				'.footer-widgets .button:focus',
				'.footer-widgets input[type="submit"]:hover',
				'.footer-widgets input[type="submit"]:focus',
				'.site-footer .button:hover',
				'.site-footer .button:focus',
				// '.woocommerce .actions .button:hover',
				// '.woocommerce .actions .button:focus',
				// '.woocommerce a.button.alt:hover',
				// '.woocommerce a.button.alt:focus',
				'.woocommerce a.button.add_to_cart_button:hover',
				'.woocommerce a.button.add_to_cart_button:focus',
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				'.button.alt',
				'.comment-reply-link',
				'.entry-content .button.alt',
				'.entry-content .more-link',
				'.footer-widgets .button',
				'.footer-widgets input[type="submit"]',
				'.site-footer .button',
				// '.woocommerce .actions .button',
				// '.woocommerce a.button.alt',
				'.woocommerce a.button.add_to_cart_button',
			),
		),
		array(
			'choice'   => 'color_hover',
			'property' => 'color',
			'element'  => array(
				'.button.alt:hover',
				'.button.alt:focus',
				'.comment-reply-link:hover',
				'.comment-reply-link:focus',
				'.entry-content .button.alt:hover',
				'.entry-content .button.alt:focus',
				'.entry-content .more-link:hover',
				'.entry-content .more-link:focus',
				'.footer-widgets .button:hover',
				'.footer-widgets .button:focus',
				'.footer-widgets input[type="submit"]:hover',
				'.footer-widgets input[type="submit"]:focus',
				'.site-footer .button:hover',
				'.site-footer .button:focus',
				// '.woocommerce .actions .button:hover',
				// '.woocommerce .actions .button:focus',
				// '.woocommerce a.button.alt:hover',
				// '.woocommerce a.button.alt:focus',
				'.woocommerce a.button.add_to_cart_button:hover',
				'.woocommerce a.button.add_to_cart_button:focus',
			),
		),
	),
) );

Kirki::add_field( $config_id, array(
	'type'      => 'typography',
	'settings'  => 'button_alt_typography',
	'section'   => $section,
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '',
		'letter-spacing' => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => array(
				'.button.alt',
				'.comment-reply-link',
				'.entry-content .button.alt',
				'.entry-content .more-link',
			),
		),
	),
) );

/**
 * Buttons (Border Radius).
 */
Kirki::add_field( $config_id, array(
	'label'       => esc_attr__( 'Button (Border Radius)', 'mai-styles' ),
	'type'        => 'dimension',
	'settings'    => 'button_border_radius',
	'section'     => $section,
	'transport'   => 'auto',
	'default'     => '',
	'input_attrs' => array(
		'placeholder' => '3px',
	),
	'output' => array(
		array(
			'element'  => array(
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.button',
				'.entry-content .button',
				'.entry-content .more-link',
				'.menu-item.highlight a',
				'.woocommerce a.button',
				'.woocommerce button.button',
				'.woocommerce input.button',
				'.woocommerce .button.alt.single_add_to_cart_button',
				'.woocommerce .button.alt.checkout-button',
				'.woocommerce #payment #place_order',
				'.woocommerce-page #payment #place_order',
			),
			'property' => 'border-radius'
		),
	),
) );
