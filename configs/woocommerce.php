<?php

$section = 'maicolors_woocommerce';

/* *********** *
 * WooCommerce *
 * *********** */
Kirki::add_section( $section, array(
	'title' => esc_attr__( 'WooCommerce', 'mai-styles' ),
	'panel' => $panel_id,
	'active_callback' => function() {
		return class_exists( 'WooCommerce' );
	}
) );

/**
 * Buttons (Primary)
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Buttons (Primary/Products)', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'woocommerce_button',
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
				// '.woocommerce a.button',
				// '.woocommerce button.button',
				// '.woocommerce input.button',
				'.woocommerce .button.alt.single_add_to_cart_button',
				'.woocommerce .button.alt.checkout-button',
				'.woocommerce .button.wc-forward',
				'.woocommerce #payment #place_order',
				'.woocommerce-page #payment #place_order',
			),
		),
		array(
			'choice'   => 'bg_hover',
			'property' => 'background-color',
			'element'  => array(
				// '.woocommerce a.button:hover',
				// '.woocommerce a.button:focus',
				// '.woocommerce button.button:hover',
				// '.woocommerce button.button:focus',
				// '.woocommerce input.button:hover',
				// '.woocommerce input.button:focus',
				'.woocommerce .button.alt.single_add_to_cart_button:hover',
				'.woocommerce .button.alt.single_add_to_cart_button:focus',
				'.woocommerce .button.alt.checkout-button:hover',
				'.woocommerce .button.alt.checkout-button:focus',
				'.woocommerce .button.wc-forward:hover',
				'.woocommerce .button.wc-forward:focus',
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
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				// '.woocommerce a.button',
				// '.woocommerce button.button',
				// '.woocommerce input.button',
				'.woocommerce .button.alt.single_add_to_cart_button',
				'.woocommerce .button.alt.checkout-button',
				'.woocommerce .button.wc-forward',
				'.woocommerce #payment #place_order',
				'.woocommerce-page #payment #place_order',
			),
		),
		array(
			'choice'   => 'color_hover',
			'property' => 'color',
			'element'  => array(
				// '.woocommerce a.button:hover',
				// '.woocommerce a.button:focus',
				// '.woocommerce button.button:hover',
				// '.woocommerce button.button:focus',
				// '.woocommerce input.button:hover',
				// '.woocommerce input.button:focus',
				'.woocommerce .button.alt.single_add_to_cart_button:hover',
				'.woocommerce .button.alt.single_add_to_cart_button:focus',
				'.woocommerce .button.alt.checkout-button:hover',
				'.woocommerce .button.alt.checkout-button:focus',
				'.woocommerce .button.wc-forward:hover',
				'.woocommerce .button.wc-forward:focus',
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
			),
		),
	),
) );

/**
 * Buttons (Alternate/Secondary)
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Buttons (Secondary/Shop)', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'woocommerce_button_alt',
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
				// '.button.alt',
				// '.comment-reply-link',
				// '.entry-content .button.alt',
				// '.entry-content .more-link',
				// '.footer-widgets .button',
				// '.footer-widgets input[type="submit"]',
				// '.site-footer .button',
				// '.woocommerce .actions .button', // Coupons and update cart. This would look bad to change.
				// '.woocommerce a.button.alt',     // These break things when non-woo buttons are used on a woo page.
				'.woocommerce a.button.add_to_cart_button',
				'.woocommerce table.shop_table .button',
				'.woocommerce #respond input#submit',
			),
		),
		array(
			'choice'   => 'bg_hover',
			'property' => 'background-color',
			'element'  => array(
				// '.button.alt:hover',
				// '.button.alt:focus',
				// '.comment-reply-link:hover',
				// '.comment-reply-link:focus',
				// '.entry-content .button.alt:hover',
				// '.entry-content .button.alt:focus',
				// '.entry-content .more-link:hover',
				// '.entry-content .more-link:focus',
				// '.footer-widgets .button:hover',
				// '.footer-widgets .button:focus',
				// '.footer-widgets input[type="submit"]:hover',
				// '.footer-widgets input[type="submit"]:focus',
				// '.site-footer .button:hover',
				// '.site-footer .button:focus',
				// '.woocommerce .actions .button:hover',
				// '.woocommerce .actions .button:focus',
				// '.woocommerce a.button.alt:hover',
				// '.woocommerce a.button.alt:focus',
				'.woocommerce a.button.add_to_cart_button:hover',
				'.woocommerce a.button.add_to_cart_button:focus',
				'.woocommerce table.shop_table .button:hover',
				'.woocommerce table.shop_table .button:focus',
				'.woocommerce #respond input#submit:hover',
				'.woocommerce #respond input#submit:focus',
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				// '.button.alt',
				// '.comment-reply-link',
				// '.entry-content .button.alt',
				// '.entry-content .more-link',
				// '.footer-widgets .button',
				// '.footer-widgets input[type="submit"]',
				// '.site-footer .button',
				// '.woocommerce .actions .button',
				// '.woocommerce a.button.alt',
				'.woocommerce a.button.add_to_cart_button',
				'.woocommerce table.shop_table .button',
				'.woocommerce #respond input#submit',
			),
		),
		array(
			'choice'   => 'color_hover',
			'property' => 'color',
			'element'  => array(
				// '.button.alt:hover',
				// '.button.alt:focus',
				// '.comment-reply-link:hover',
				// '.comment-reply-link:focus',
				// '.entry-content .button.alt:hover',
				// '.entry-content .button.alt:focus',
				// '.entry-content .more-link:hover',
				// '.entry-content .more-link:focus',
				// '.footer-widgets .button:hover',
				// '.footer-widgets .button:focus',
				// '.footer-widgets input[type="submit"]:hover',
				// '.footer-widgets input[type="submit"]:focus',
				// '.site-footer .button:hover',
				// '.site-footer .button:focus',
				// '.woocommerce .actions .button:hover',
				// '.woocommerce .actions .button:focus',
				// '.woocommerce a.button.alt:hover',
				// '.woocommerce a.button.alt:focus',
				'.woocommerce a.button.add_to_cart_button:hover',
				'.woocommerce a.button.add_to_cart_button:focus',
				'.woocommerce table.shop_table .button:hover',
				'.woocommerce table.shop_table .button:focus',
				'.woocommerce #respond input#submit:hover',
				'.woocommerce #respond input#submit:focus',
			),
		),
	),
) );

/**
 * Prices
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Prices', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'woocommerce_price',
	'section'   => $section,
	'transport' => 'auto',
	'choices'   => array(
		'price' => esc_attr__( 'Prices', 'mai-styles' ),
	),
	'default' => array(
		'price' => '',
	),
	'output' => array(
		array(
			'choice'   => 'price',
			'property' => 'color',
			'element'  => array(
				'.woocommerce div.product p.price',
				'.woocommerce div.product span.price',
			),
		),
	),
) );

/**
 * Sale badge
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Sale Badge', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'woocommerce_sale',
	'section'   => $section,
	'transport' => 'auto',
	'choices'   => array(
		'bg'    => esc_attr__( 'Background Color', 'mai-styles' ),
		'color' => esc_attr__( 'Text Color', 'mai-styles' ),
	),
	'default' => array(
		'bg'    => '',
		'color' => '',
	),
	'output' => array(
		array(
			'choice'   => 'bg',
			'property' => 'background',
			'element'  => array(
				'.woocommerce span.onsale',
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				'.woocommerce span.onsale',
			),
		),
	),
) );

/**
 * Store Notice.
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Store Notice', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'woocommerce_store_notice',
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
				'.woocommerce-store-notice',
				'p.demo_store',
			),
		),
		array(
			'choice'   => 'color',
			'property' => 'color',
			'element'  => array(
				'.woocommerce-store-notice',
				'p.demo_store',
			),
		),
		array(
			'choice'   => 'link',
			'property' => 'color',
			'element'  => array(
				'.woocommerce-store-notice a',
				'p.demo_store a',
			),
		),
		array(
			'choice'   => 'link_hover',
			'property' => 'color',
			'element'  => array(
				'.woocommerce-store-notice a:hover',
				'.woocommerce-store-notice a:focus',
				'p.demo_store a:hover',
				'p.demo_store a:focus',
			),
		),
	),
	// 'active_callback' => function() {
	// 	return ( function_exists( 'is_store_notice_showing' ) && is_store_notice_showing() );
	// }
) );

/**
 * Notices
 */
Kirki::add_field( $config_id, array(
	'label'     => esc_attr__( 'Notices', 'mai-styles' ),
	'type'      => 'multicolor',
	'settings'  => 'woocommerce_notice',
	'section'   => $section,
	'transport' => 'auto',
	'choices'   => array(
		'message_color' => esc_attr__( 'Message', 'mai-styles' ),
		'info_color'    => esc_attr__( 'Info', 'mai-styles' ),
		'error_color'   => esc_attr__( 'Error', 'mai-styles' ),
	),
	'default' => array(
		'message_color' => '#8fae1b',
		'info_color'    => '#1e85be',
		'error_color'   => '#b81c23',
	),
	'output' => array(
		array(
			'choice'   => 'message_color',
			'property' => 'border-top-color',
			'element'  => array(
				'.woocommerce-message',
			),
		),
		array(
			'choice'   => 'info_color',
			'property' => 'color',
			'element'  => array(
				'.woocommerce-info::before',
			),
		),
		array(
			'choice'   => 'info_color',
			'property' => 'border-top-color',
			'element'  => array(
				'.woocommerce-info',
			),
		),
		array(
			'choice'   => 'error_color',
			'property' => 'color',
			'element'  => array(
				'.woocommerce-error::before',
			),
		),
		array(
			'choice'   => 'error_color',
			'property' => 'border-top-color',
			'element'  => array(
				'.woocommerce-error',
			),
		),
	),
) );
