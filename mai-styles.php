<?php

/**
 * Plugin Name:     Mai Styles
 * Plugin URI:      https://maitheme.com/
 * Description:     Easily adjust fonts, colors, and more in Mai Theme powered websites.
 *
 * Version:         0.8.0
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
			self::$instance->hooks();
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
			define( 'MAI_STYLES_VERSION', '0.8.0' );
		}

		// Plugin Folder Path.
		if ( ! defined( 'MAI_STYLES_PLUGIN_DIR' ) ) {
			define( 'MAI_STYLES_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
		}

		// Plugin Classes Path.
		if ( ! defined( 'MAI_STYLES_CLASSES_DIR' ) ) {
			define( 'MAI_STYLES_CLASSES_DIR', MAI_STYLES_PLUGIN_DIR . 'classes/' );
		}

		// Plugin Includes Path.
		if ( ! defined( 'MAI_STYLES_INCLUDES_DIR' ) ) {
			define( 'MAI_STYLES_INCLUDES_DIR', MAI_STYLES_PLUGIN_DIR . 'includes/' );
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
	 * composer require aristath/kirki
	 * composer require yahnis-elsts/plugin-update-checker
	 *
	 * v4.5  Plugin Update Checker
	 * v4.5  Plugin Update Checker
	 *
	 * @access  private
	 * @since   0.1.0
	 * @return  void
	 */
	private function includes() {

		// Include vendor libraries.
		require_once __DIR__ . '/vendor/autoload.php';
		require_once __DIR__ . '/vendor/aristath/kirki/kirki.php';
		// require_once __DIR__ . '/vendor/aristath/kirki/example.php';

		// Includes.
		foreach ( glob( MAI_STYLES_INCLUDES_DIR . '*.php' ) as $file ) { include_once $file; }
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
	public function hooks() {

		// Updater.
		add_action( 'plugins_loaded', array( $this, 'updater' ) );

		// Maybe deactivate. Run after Mai Theme.
		add_action( 'plugins_loaded', array( $this, 'maybe_deactivate' ), 20 );

		// Disable Kirki statistics notice.
		add_filter( 'kirki_telemetry', '__return_false' );



		// Hooks.
		add_action( 'init',               array( $this, 'kirki_settings' ) );
		add_action( 'customize_register', array( $this, 'kirki_gettext' ) );
		add_action( 'customize_register', array( $this, 'kirki_styles' ) );
		add_action( 'login_head',         array( $this, 'login_styles' ) );
		add_action( 'after_setup_theme',  array( $this, 'disable_theme_fonts' ) );
		// add_filter( 'body_class',         array( $this, 'body_class' ) );
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
	 * Maybe deactivate the plugin if conditions aren't met.
	 *
	 * @since   0.7.0
	 *
	 * @return  void
	 */
	public function maybe_deactivate() {
		// Bail if no Mai Theme.
		if ( class_exists( 'Mai_Theme_Engine' ) ) {
			return;
		}
		// Deactivate.
		add_action( 'admin_init', function() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
		});
		// Notice.
		add_action( 'admin_notices', function() {
			printf( '<div class="notice notice-warning"><p>%s</p></div>', __( 'Mai Styles requires Mai Theme Engine plugin. As a result, Mai Styles has been deactivated.', 'mai-styles' ) );
			// Remove "Plugin activated" notice.
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}
		});
	}

	/**
	 * Register the customizer settings..
	 *
	 * @since   0.1.0
	 *
	 * @return  void
	 */
	function kirki_settings() {

		// Bail if no Kirki.
		if ( ! class_exists( 'Kirki' ) ) {
			return;
		}

		// This allows me to symlink the plugin into all my testing environments. Sorry for extra code that's just for me ¯\_(ツ)_/¯.
		$url = Kirki::$url;
		if ( false  !== strpos ( $url, '/Users/JiveDig/Plugins/' ) ) {
			add_filter( 'kirki_config', function( $config ) use ( $url ) {
				$config['url_path'] = str_replace( '/Users/JiveDig/Plugins/mai-styles/', plugin_dir_url( __FILE__ ), $url );
				return $config;
			});
		}

		$config_id = $panel_id = $settings_field = 'mai_styles';

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
	 * Translation default font-family label in customizer.
	 *
	 * @return  void
	 */
	function kirki_gettext() {
		/**
		 * Change kirki default font-family label.
		 *
		 * @param   string $translated_text
		 * @param   string $text
		 * @param   string $domain
		 *
		 * @return  string
		 */
		add_filter( 'gettext', function( $translated_text, $text, $domain ) {
			if ( 'kirki' !== $domain ) {
				return $translated_text;
			}
			switch ( $translated_text ) {
				case 'Default Browser Font-Family' :
					$translated_text = esc_html__( 'Default Font-Family', 'mai-styles' );
				break;
			}
			return $translated_text;
		}, 10, 3 );
	}

	/**
	 * Add the Mai Theme icon logo as the loader.
	 *
	 * @since   0.8.0
	 *
	 * @return  void
	 */
	function kirki_styles() {
		// Run after Kirki, and add !important to override. Until Kikri v4 with a filter for this.
		add_action( 'wp_head', function() {
			$svg = trailingslashit( MAI_STYLES_PLUGIN_URL ) . 'assets/mai-logo.svg';
			printf( '<style>.kirki-customizer-loading-wrapper { background-image: url( "%s" ) !important; }</style>', esc_url_raw( $svg ) );
		}, 101 );
	}

	/**
	 * Add custom login styles based on front end styles.
	 * If using a logo and site header is dark, login page would look weird, this matches a little more consistenty.
	 *
	 * @since   0.1.0
	 *
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
				echo '.login .message, .login .success, .login #login_error { color: #222; }';
			}
		echo '</style>';
	}

	/**
	 * Maybe disable fonts enqueued in Mai Theme.
	 *
	 * @since   0.5.0
	 *
	 * @return  void
	 */
	function disable_theme_fonts() {
		$option = get_option( 'mai_styles' );
		if ( ! $option ) {
			return;
		}
		if ( ! ( isset( $option['disable_theme_fonts'] ) && $option['disable_theme_fonts'] ) ) {
			return;
		}
		// Remove fonts callback from theme.
		remove_action( 'wp_enqueue_scripts', 'maitheme_enqueue_fonts' );
	}

	/**
	 * Add custom body class.
	 *
	 * @param   array  The existing body classes.
	 *
	 * @return  array  Modified classes.
	 */
	function body_class( $classes ) {
		if ( maistyles_has_scroll_colors() ) {
			$classes[] = 'has-scroll-colors';
		}
		return $classes;
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
