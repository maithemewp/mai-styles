<?php

function maistyles_has_scroll_header() {
	if ( function_exists( 'mai_has_scroll_header' ) ) {
		return mai_has_scroll_header();
	}
	$header_style = genesis_get_option( 'header_style' );
	return ( $header_style && in_array( $header_style, array( 'sticky', 'reveal', 'sticky_shrink', 'reveal_shrink' ) ) );
}

function maistyles_has_scroll_colors() {
	if ( ! maistyles_has_scroll_header() ) {
		return false;
	}
	$option = get_option( 'mai_styles' );
	return ( $option && isset( $option['site_header_scroll_color'] ) && ! empty( $option['site_header_scroll_color'] ) );
}

function maistyles_has_header_before_menu() {
	$widgets = wp_get_sidebars_widgets();
	if ( ! $widgets ) {
		return false;
	}
	if ( ! isset( $widgets['header_before'] ) || empty( $widgets['header_before'] ) ) {
		return false;
	}
	foreach ( $widgets['header_before'] as $widget_id ) {
		// Has navigation widget.
		if ( false  !== strpos ( $widget_id, 'nav_menu' ) ) {
			return true;
		}
	}
	return false;
}

