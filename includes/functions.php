<?php

function maistyles_has_scroll_colors() {
	$option = get_option( 'mai_styles' );
	return ( $option && isset( $option['site_header_scroll_color'] ) && ! empty( $option['site_header_scroll_color'] ) );
}

function maistyles_has_scroll_logo() {
	if ( ! maistyles_has_scroll() ) {
		return false;
	}
	if ( ! maistyles_has_scroll_logos() ) {
		return false;
	}
	return true;
}

function maistyles_has_scroll() {
	$header_style = genesis_get_option( 'header_style' );
	return ( $header_style || in_array( $header_style, array( 'sticky', 'reveal', 'sticky_shrink', 'reveal_shrink' ) ) );
}

function maistyles_has_scroll_logos() {
	return ( function_exists( 'has_custom_logo' ) && has_custom_logo() && get_theme_mod( 'custom_scroll_logo' ) );
}
