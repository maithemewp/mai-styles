<?php

/**
 * Plugin Name:     Mai Styles
 * Plugin URI:      https://maitheme.com/
 * Description:     Easily adjust fonts, colors, and more in Mai Theme powered websites.
 *
 * Version:         0.1.1
 *
 * GitHub URI:      maithemewp/mai-styles
 *
 * Author:          MaiTheme.com
 * Author URI:      https://maitheme.com
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main Mai_Styles Class.
 *
 * @since 0.1.0
 */
final class Mai_Styles {

	/**
	 * @var Mai_Styles The one true Mai_Styles
	 * @since 0.1.0
	 */
	private static $instance;

	/**
	 * Main Mai_Styles Instance.
	 *
	 * Insures that only one instance of Mai_Styles exists in memory at any one
	 * time. Also prevents needing to define globals all over the place.
	 *
	 * @since   0.1.0
	 * @static  var array $instance
	 * @uses    Mai_Styles::setup_constants() Setup the constants needed.
	 * @uses    Mai_Styles::includes() Include the required files.
	 * @uses    Mai_Styles::setup() Activate, deactivate, etc.
	 * @see     Mai_Styles()
	 * @return  object | Mai_Styles The one true Mai_Styles
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			// Setup the setup
			self::$instance = new Mai_Styles;
			// Methods
			self::$instance->setup_constants();
			self::$instance->includes();
			self::$instance->setup();
		}
		return self::$instance;
	}

	/**
	 * Throw error on object clone.
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since   0.1.0
	 * @access  protected
	 * @return  void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mai-styles' ), '1.0' );
	}

	/**
	 * Disable unserializing of the class.
	 *
	 * @since   0.1.0
	 * @access  protected
	 * @return  void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'mai-styles' ), '1.0' );
	}

	/**
	 * Setup plugin constants.
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	private function setup_constants() {

		// Plugin version.
		if ( ! defined( 'MAI_STYLES_VERSION' ) ) {
			define( 'MAI_STYLES_VERSION', '0.1.1' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'MAI_STYLES_PLUGIN_DIR' ) ) {
			define( 'MAI_STYLES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Includes Path.
		if ( ! defined( 'MAI_STYLES_CLASSES_DIR' ) ) {
			define( 'MAI_STYLES_CLASSES_DIR', MAI_STYLES_PLUGIN_DIR . 'classes/' );
		}

		// Plugin Folder URL.
		if ( ! defined( 'MAI_STYLES_PLUGIN_URL' ) ) {
			define( 'MAI_STYLES_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
		}

		// Plugin Root File.
		if ( ! defined( 'MAI_STYLES_PLUGIN_FILE' ) ) {
			define( 'MAI_STYLES_PLUGIN_FILE', __FILE__ );
		}

		// Plugin Base Name
		if ( ! defined( 'MAI_STYLES_BASENAME' ) ) {
			define( 'MAI_STYLES_BASENAME', dirname( plugin_basename( __FILE__ ) ) );
		}

	}

	/**
	 * Include required files.
	 *
	 * composer require yahnis-elsts/plugin-update-checker
	 * composer require aristath/kirki
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	private function includes() {
		require_once __DIR__ . '/vendor/autoload.php';
		// Classes.
		foreach ( glob( MAI_STYLES_CLASSES_DIR . '*.php' ) as $file ) { include_once $file; }
	}

	/**
	 * Setup the plugin.
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	public function setup() {

		// Updater.
		add_action( 'plugins_loaded', array( $this, 'updater' ) );

		// Bail if no Kirki.
		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		// Disable deafult loader to keep things looking like regular WP.
		add_filter( 'kirki_config', function( $config ) {
			return wp_parse_args( array(
				'disable_loader' => true,
			), $config );
		});

		/**
		 * This allows Kirki to run in a symlinked plugin on my computer.
		 * Sorry for the extra code just for me ¯\_(ツ)_/¯
		 */
		$url = Kirki::$url;
		if ( false  !== strpos ( $url, '/Users/JiveDig/Plugins/mai-styles' ) ) {
			add_filter( 'kirki_config', function( $config ) use ( $url ) {
				$url_path = isset( $config['url_path'] ) ? $config['url_path']: $url;
				$new_url  = str_replace( '/Users/JiveDig/Plugins/mai-styles', MAI_STYLES_PLUGIN_URL, $url_path );
				$config['url_path'] = $new_url;
				return $config;
			});
		}

		// Hooks.
		add_action( 'init',       array( $this, 'kirki_settings' ) );
		add_action( 'login_head', array( $this, 'login_styles' ) );
	}

	/**
	 * Setup the updater.
	 *
	 * @since   0.1.0
	 * @uses    https://github.com/YahnisElsts/plugin-update-checker/
	 * @return  void
	 */
	public function updater() {
		if ( ! is_admin() ) {
			return;
		}
		if ( ! class_exists( 'Puc_v4_Factory' ) ) {
			return;
		}
		$updater = Puc_v4_Factory::buildUpdateChecker( 'https://github.com/maithemewp/mai-styles/', __FILE__, 'mai-styles' );
	}

	/**
	 * Register the customizer settings..
	 *
	 * @since   0.1.0
	 * @return  void
	 */
	function kirki_settings() {

		$config_id      = 'mai_styles';
		$panel_id       = 'mai_styles';
		$settings_field = 'mai_styles';
		$config         = array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'option',
			'option_name' => $settings_field,
		);

		/**
		 * Kirki Config.
		 */
		Kirki::add_config( $config_id, array(
			'capability'  => 'edit_theme_options',
			'option_type' => 'option',
			'option_name' => $settings_field,
		) );

		/**
		 * Mai Styles.
		 */
		Kirki::add_panel( $panel_id, array(
			'title'       => esc_attr__( 'Mai Styles', 'mai-styles' ),
			'description' => esc_attr__( 'Loading more than 1-2 Google fonts may slow down your site.', 'mai-styles' ),
			'priority'    => 55,
		) );

		// General.
		include_once 'configs/general.php';

		// Header.
		include_once 'configs/header.php';

		// Content.
		include_once 'configs/content.php';

		// Footer.
		include_once 'configs/footer.php';

		// WooCommerce.
		include_once 'configs/woocommerce.php';

	}

	/**
	 * Add custom login styles based on front end styles.
	 * If using a logo and site header is dark, login page would look weird, this matches a little more consistenty.
	 *
	 * @since   0.1.0
	 * @return  void
	 */
	function login_styles() {

		$logo_id = get_theme_mod( 'custom_logo' );

		// Bail if we don't have a custom logo.
		if ( ! $logo_id ) {
			return;
		}

		$colors = get_option( 'mai_styles' );

		// Bail if no colors.
		if ( ! $colors ) {
			return;
		}

		$header_bg    = isset( $colors['site_header_color']['bg'] ) ? esc_attr( $colors['site_header_color']['bg'] ) : false;
		$header_color = isset( $colors['header_nav_color']['item_color'] ) ? esc_attr( $colors['header_nav_color']['item_color'] ) : false;

		// Bail if no header background color.
		if ( ! $header_bg ) {
			return;
		}

		echo '<style>';
			echo 'body {';
				printf( 'background: %s;', $header_bg );
				$header_color ? printf( 'color: %s;', $header_color ) : '';
			echo '}';
			if ( $header_color ) {
				echo 'a,';
				echo '.login #nav a,';
				echo '.login #backtoblog a {';
					printf( 'color: %s;', $header_color );
				echo '}';
				echo 'a:hover,';
				echo 'a:focus,';
				echo '.login #nav a:hover,';
				echo '.login #nav a:focus,';
				echo '.login #backtoblog a:hover,';
				echo '.login #backtoblog a:focus {';
					printf( 'color: %s;', $header_color );
					echo 'text-decoration: underline dotted;';
				echo '}';
			}
		echo '</style>';
	}

}

/**
 * The main function for that returns Mai_Styles
 *
 * The main function responsible for returning the one true Mai_Styles
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $plugin = Mai_Styles(); ?>
 *
 * @since 0.1.0
 *
 * @return object|Mai_Styles The one true Mai_Styles Instance.
 */
function Mai_Styles() {
	return Mai_Styles::instance();
}

// Get Mai_Styles Running.
Mai_Styles();

add_action( 'customize_register', 'maistyles_register_customizer_scroll_logo_settings' );
function maistyles_register_customizer_scroll_logo_settings( $wp_customize ) {

	$wp_customize->add_setting(
		'custom_scroll_logo',
		array(
			'theme_supports' => array( 'custom-logo' ),
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Cropped_Image_Control(
			$wp_customize,
			'custom_scroll_logo',
			array(
				'label'         => __( 'Scroll Logo' ),
				'section'       => 'title_tagline',
				'priority'      => 9,
				'height'        => '120',
				'width'         => '240',
				'flex_height'   => true,
				'flex_width'    => true,
				'button_labels' => array(
					'select'       => __( 'Select logo', 'mai-styles' ),
					'change'       => __( 'Change logo', 'mai-styles' ),
					'remove'       => __( 'Remove', 'mai-styles' ),
					'default'      => __( 'Default', 'mai-styles' ),
					'placeholder'  => __( 'No logo selected', 'mai-styles' ),
					'frame_title'  => __( 'Select logo', 'mai-styles' ),
					'frame_button' => __( 'Choose logo', 'mai-styles' ),
				),
				'active_callback' => function() use ( $wp_customize ) {
					return ( maistyles_has_scroll_effects() && ! empty( $wp_customize->get_setting( 'custom_logo' )->value() ) );
				},
			)
		)
	);

	$wp_customize->add_setting(
		'custom_scroll_logo_width',
		array(
			'theme_supports' => array( 'custom-logo' ),
		)
	);
	$wp_customize->add_control( 'custom_scroll_logo_width', array(
		'type'        => 'number',
		'priority'    => 9,
		'section'     => 'title_tagline',
		'label'       => __( 'Scroll Logo Width (in px)', 'mai-styles' ),
		'description' => '',
		'input_attrs' => array(
			'min'         => 0,
			'step'        => 1,
			'placeholder' => '180',
		),
		'active_callback' => function() use ( $wp_customize ) {
			return ( maistyles_has_scroll_effects() && ! empty( $wp_customize->get_setting( 'custom_logo_width' )->value() ) );
		},
	));

}

/**
 * Add custom body class.
 *
 * @param   array  The existing body classes.
 *
 * @return  array  Modified classes.
 */
add_filter( 'body_class', 'maistyles_has_scroll_logo_body_class' );
function maistyles_has_scroll_logo_body_class( $classes ) {
	if ( maistyles_has_scroll_effects() && get_theme_mod( 'custom_scroll_logo' ) ) {
		$classes[] = 'has-scroll-logo';
	}
	return $classes;
}

/**
 * kirki/{$config_id}/styles
 */
add_filter( 'kirki_mai_styles_styles', 'maistyles_kirki_styles' );
function maistyles_kirki_styles( $css ) {

	if ( ! maistyles_has_scroll_effects() ) {
		return $css;
	}

	$logo_id = get_theme_mod( 'custom_scroll_logo' );

	if ( ! $logo_id ) {
		return $css;
	}

	$image = wp_get_attachment_image_src( $logo_id, 'full' );

	if ( ! $image ) {
		return $css;
	}

	$width = get_theme_mod( 'custom_scroll_logo_width' );

	$url    = $image[0];
	$width  = $width ? absint( $width ) : $image[1];

	// TODO: Need math to get scaled height.

	$css['global']['body.has-scroll-logo .custom-logo-link']['position'] = 'relative';
	$css['global']['body.scroll .custom-logo-link']['max-width'] = sprintf( '%spx', $width );
	$css['global']['.custom-logo-link:after']['content'] = '" "';
	$css['global']['.custom-logo-link:after']['position'] = 'absolute';
	$css['global']['.custom-logo-link:after']['top'] = '0';
	$css['global']['.custom-logo-link:after']['bottom'] = '0';
	$css['global']['.custom-logo-link:after']['left'] = '0';
	$css['global']['.custom-logo-link:after']['right'] = '0';
	$css['global']['.custom-logo-link:after']['background'] = sprintf( 'url( %s ) no-repeat', $url );
	$css['global']['.site-header.has-header-left .custom-logo-link:after']['background-position'] = 'left center';
	$css['global']['.site-header.has-header-right .custom-logo-link:after']['background-position'] = 'right center';
	$css['global']['.site-header.has-header-left.has-header-right .custom-logo-link:after']['background-position'] = 'left center';
	$css['global']['.custom-logo-link:after']['background-size'] = sprintf( 'auto %spx', $width );
	$css['global']['.custom-logo-link:after']['opacity'] = '0';
	$css['global']['body.scroll .custom-logo-link:after']['opacity'] = '1';
	$css['global']['.custom-logo']['opacity'] = '1'; // img
	$css['global']['body.scroll .custom-logo']['opacity'] = '0'; // img
	$css['@media only screen and (min-width: 769px) {']['.site-header.has-header-left .custom-logo-link:after']['background-position'] = 'left center';
	$css['@media only screen and (min-width: 769px) {']['.site-header.has-header-right .custom-logo-link:after']['background-position'] = 'right center';
	$css['@media only screen and (min-width: 769px) {']['.site-header.has-header-left.has-header-right .custom-logo-link:after']['background-position'] = 'center center';
	return $css;
}

function maistyles_has_scroll_effects() {
	if ( function_exists( 'mai_has_scroll_effects' ) ) {
		return mai_has_scroll_effects();
	}
	$header_style = genesis_get_option( 'header_style' );
	if ( $header_style && in_array( $header_style, array( 'sticky', 'reveal', 'sticky_shrink', 'reveal_shrink' ) ) ) {
		return true;
	}
	return false;
}
