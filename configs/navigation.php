<?php

/**
 * Setup the menus customizer settings.
 *
 * @since   0.1.0
 */
class Mai_Styles_Navigation {

	protected $section;

	function __construct( $section ) {
		$this->section = $section;
	}

	/**
	 * Get the config for a menu.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_config( $label, $key, $class, $callback ) {

		$config = array(
			'type'      => 'multicolor',
			'settings'  => $key,
			'label'     => $label,
			'section'   => $this->section,
			'transport' => 'auto',
			'choices'   => array(
				'menu_bg'            => esc_attr__( 'Background', 'mai-styles' ),
				'item_color'         => esc_attr__( 'Item Color', 'mai-styles' ),
				'item_hover_bg'      => esc_attr__( 'Item Hover Background', 'mai-styles' ),
				'item_hover_color'   => esc_attr__( 'Item Hover Color', 'mai-styles' ),
				'item_current_bg'    => esc_attr__( 'Current Item Background', 'mai-styles' ),
				'item_current_color' => esc_attr__( 'Current Item Color', 'mai-styles' ),
			),
			'default' => array(
				'menu_bg'            => '',
				'item_color'         => '',
				'item_hover_bg'      => '',
				'item_hover_color'   => '',
				'item_current_bg'    => '',
				'item_current_color' => '',
			),
			'output' => array(
				array(
					'choice'   => 'menu_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class}",
						"{$class} .sub-menu a",
						"{$class} .nav-search",
						"{$class} .nav-search:hover",
						"{$class} .nav-search:focus",
						".home {$class} .current-menu-item > a",
					),
				),
				array(
					'choice'   => 'item_color',
					'property' => 'color',
					'element'  => array(
						"{$class} a",
						"{$class} .nav-search",
						"{$class} .sub-menu a",
						".home {$class} .current-menu-item > a",
					),
				),
				array(
					'choice'   => 'item_hover_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class} a:hover",
						"{$class} a:focus",
						"{$class} .sub-menu a:hover",
						"{$class} .sub-menu a:focus",
						"{$class} > .menu-item-has-children:not(.current-menu-ancestor):hover > a",
					),
				),
				array(
					'choice'   => 'item_hover_color',
					'property' => 'color',
					'element'  => array(
						"{$class} a:hover",
						"{$class} a:focus",
						"{$class} .nav-search:hover",
						"{$class} .nav-search:focus",
						"{$class} .sub-menu a:hover",
						"{$class} .sub-menu a:focus",
						"{$class} > .current-menu-item > a",
						"{$class} > .current-menu-ancestor > a",
						"{$class} > .menu-item-has-children:not(.highlight):hover > a",
						"{$class} > .menu-item-has-children:not(.highlight):focus > a",
						"{$class} > .menu-item-has-children:not(.current-menu-ancestor):hover > a",
						"{$class} > .menu-item-has-children:not(.current-menu-ancestor):focus > a",
					),
				),
				array(
					'choice'   => 'item_current_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class} .current-menu-item > a",
						"{$class} .current-menu-item > a:hover",
						"{$class} .current-menu-item > a:focus",
						"{$class} .current-menu-ancestor > a",
						"{$class} .current-menu-ancestor > a:hover",
						"{$class} .current-menu-ancestor > a:focus",
					),
				),
				array(
					'choice'   => 'item_current_color',
					'property' => 'color',
					'element'  => array(
						"{$class} .current-menu-item > a",
						"{$class} .current-menu-item > a:hover",
						"{$class} .current-menu-item > a:focus",
						"{$class} .current-menu-ancestor > a",
						"{$class} .current-menu-ancestor > a:hover",
						"{$class} .current-menu-ancestor > a:focus",
					),
				),
			),
			'active_callback' => $callback,
		);

		// If header nav.
		if ( 'header_nav_color' === $key ) {
			$config['output'][1]['element'][] = '.mai-bars'; // Add mobile menu toggle.
			// Remove items not applicable to header nav.
			unset( $config['choices']['menu_bg'] );
			unset( $config['choices']['item_hover_bg'] );
			unset( $config['choices']['item_current_bg'] );
			unset( $config['default']['menu_bg'] );
			unset( $config['default']['item_hover_bg'] );
			unset( $config['default']['item_current_bg'] );
			unset( $config['output'][0] );               // menu_bg
			unset( $config['output'][1]['element'][2] ); // .nav-search from item_color
			unset( $config['output'][2] );               // item_hover_bg
			unset( $config['output'][3]['element'][4] ); // .nav-search:hover from item_hover_color
			unset( $config['output'][3]['element'][5] ); // .nav-search:focuse from item_hover_color
			unset( $config['output'][4] );               // item_current_bg
		}

		return $config;
	}

	/**
	 * Get the config for menu typography.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_typography_config( $key, $class, $callback ) {

		return array(
			'type'      => 'typography',
			'settings'  => $key,
			'section'   => $this->section,
			'transport' => 'auto',
			'choices'   => array(
				'fonts' => array(
					'google' => array( 'popularity', 30 ),
				),
			),
			'default'   => array(
				'font-family'    => '',
				'font-size'      => '',
				'variant'        => '',
				'letter-spacing' => '',
				'text-transform' => '',
			),
			'output' => array(
				array(
					'element' => array(
						"{$class} a",
						"{$class} .menu-item.highlight > a",
					),
				),
			),
			'active_callback' => $callback,
		);
	}

	/**
	 * Get the config for a submenu.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_submenu_config( $label, $key, $class, $callback ) {

		return array(
			'type'      => 'multicolor',
			'settings'  => $key,
			'label'     => $label,
			'section'   => $this->section,
			'transport' => 'auto',
			'choices'   => array(
				'submenu_menu_bg'            => esc_attr__( 'Background', 'mai-styles' ),
				'submenu_item_color'         => esc_attr__( 'Item Color', 'mai-styles' ),
				'submenu_item_hover_bg'      => esc_attr__( 'Item Hover Background', 'mai-styles' ),
				'submenu_item_hover_color'   => esc_attr__( 'Item Hover Color', 'mai-styles' ),
				'submenu_item_current_bg'    => esc_attr__( 'Current Item Background', 'mai-styles' ),
				'submenu_item_current_color' => esc_attr__( 'Current Item Color', 'mai-styles' ),
			),
			'default' => array(
				'submenu_menu_bg'            => '',
				'submenu_item_color'         => '',
				'submenu_item_hover_bg'      => '',
				'submenu_item_hover_color'   => '',
				'submenu_item_current_bg'    => '',
				'submenu_item_current_color' => '',
			),
			'output' => array(
				array(
					'choice'   => 'submenu_menu_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class} .sub-menu a",
					),
				),
				array(
					'choice'   => 'submenu_item_color',
					'property' => 'color',
					'element'  => array(
						"{$class} .sub-menu a",
					),
				),
				array(
					'choice'   => 'submenu_item_hover_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class} .sub-menu a:hover",
						"{$class} .sub-menu a:focus",
					),
				),
				array(
					'choice'   => 'submenu_item_hover_color',
					'property' => 'color',
					'element'  => array(
						"{$class} .sub-menu a:hover",
						"{$class} .sub-menu a:focus",
					),
				),
				array(
					'choice'   => 'submenu_item_current_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class} .sub-menu .current-menu-item > a",
						"{$class} .sub-menu .current-menu-item > a:hover",
						"{$class} .sub-menu .current-menu-item > a:focus",
						"{$class} .sub-menu .current-menu-ancestor > a",
						"{$class} .sub-menu .current-menu-ancestor > a:hover",
						"{$class} .sub-menu .current-menu-ancestor > a:focus",
					),
				),
				array(
					'choice'   => 'submenu_item_current_color',
					'property' => 'color',
					'element'  => array(
						"{$class} .sub-menu .current-menu-item > a",
						"{$class} .sub-menu .current-menu-item > a:hover",
						"{$class} .sub-menu .current-menu-item > a:focus",
						"{$class} .sub-menu .current-menu-ancestor > a",
						"{$class} .sub-menu .current-menu-ancestor > a:hover",
						"{$class} .sub-menu .current-menu-ancestor > a:focus",
					),
				),
			),
			'active_callback' => $callback,
		);
	}

	/**
	 * Get the config for submenu typography.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_submenu_typography_config( $key, $class, $callback ) {

		return array(
			'type'      => 'typography',
			'settings'  => $key,
			'section'   => $this->section,
			'transport' => 'auto',
			'choices'   => array(
				'fonts' => array(
					'google' => array( 'popularity', 30 ),
				),
			),
			'default'   => array(
				'font-size'      => '',
				'variant'        => '',
				'letter-spacing' => '',
				'text-transform' => '',
			),
			'output' => array(
				array(
					'element' => array(
						"{$class} .sub-menu a",
					),
				),
			),
			'active_callback' => $callback,
		);
	}

	/**
	 * Get the config for a menu's highlight button.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_highlight_config( $label, $key, $class, $callback ) {

		return array(
			'type'      => 'multicolor',
			'settings'  => $key,
			'label'     => $label,
			'section'   => $this->section,
			'transport' => 'auto',
			'choices'   => array(
				'button_bg'          => esc_attr__( 'Highlight Button Background', 'mai-styles' ),
				'button_color'       => esc_attr__( 'Highlight Button Color', 'mai-styles' ),
				'button_hover_bg'    => esc_attr__( 'Highlight Button Hover Background', 'mai-styles' ),
				'button_hover_color' => esc_attr__( 'Highlight Button Hover Color', 'mai-styles' ),
			),
			'default' => array(
				'button_bg'          => '',
				'button_color'       => '',
				'button_hover_bg'    => '',
				'button_hover_color' => '',
			),
			'output' => array(
				array(
					'choice'   => 'button_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class} .highlight > a",
						"{$class} .highlight.current-menu-item > a",
					),
				),
				array(
					'choice'   => 'button_color',
					'property' => 'color',
					'element'  => array(
						"{$class} .highlight > a",
						"{$class} .highlight.current-menu-item > a",
					),
				),
				array(
					'choice'   => 'button_hover_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$class} .highlight > a:hover",
						"{$class} .highlight > a:focus",
						"{$class} .highlight.current-menu-item > a:hover",
						"{$class} .highlight.current-menu-item > a:focus",
					),
				),
				array(
					'choice'   => 'button_hover_color',
					'property' => 'color',
					'element'  => array(
						"{$class} .highlight > a:hover",
						"{$class} .highlight > a:focus",
						"{$class} .highlight.current-menu-item > a:hover",
						"{$class} .highlight.current-menu-item > a:focus",
					),
				),
			),
			'active_callback' => $callback,
		);
	}

	/**
	 * Get the config for a menu's search icon.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_search_config( $label, $key, $class, $callback ) {

		return array(
			'type'      => 'multicolor',
			'settings'  => $key,
			'label'     => $label,
			'section'   => $this->section,
			'transport' => 'auto',
			'choices'   => array(
				'search_hover_color' => esc_attr__( 'Search Hover Color', 'mai-styles' ),
			),
			'default' => array(
				'search_hover_color' => '',
			),
			'output' => array(
				array(
					'choice'   => 'search_hover_color',
					'property' => 'color',
					'element'  => array(
						"{$class} .nav-search:hover",
						"{$class} .nav-search:focus",
					),
				),
			),
			'active_callback' => $callback,
		);
	}

	/**
	 * Check if menu is active.
	 *
	 * @since   0.1.0
	 *
	 * @return  bool
	 */
	function has_menu( $menu_name ) {
		return has_nav_menu( $menu_name );
	}

	/**
	 * Check if a given menu has a submenu.
	 *
	 * @since   0.1.0
	 *
	 * @return  bool
	 */
	function has_submenu( $menu_name ) {

		if ( ! $this->has_menu( $menu_name ) ) {
			return false;
		}

		// Get menu items.
		$menu_items = $this->get_menu_items( $menu_name );

		// Loop thru em.
		foreach ( $menu_items as $item ) {
			// If we have a child menu item.
			if ( $item->post_parent > 0 ) {
				return true;
				continue;
			}
		}

		// Nope.
		return false;
	}

	/**
	 * Check if a given menu has a highlight menu item.
	 *
	 * @since   0.1.0
	 *
	 * @return  bool
	 */
	function has_highlight( $menu_name ) {

		if ( ! $this->has_menu( $menu_name ) ) {
			return false;
		}

		// Get menu items.
		$menu_items = $this->get_menu_items( $menu_name );

		// Loop thru em.
		foreach ( $menu_items as $item ) {
			// If we have a highlight.
			if ( in_array( 'highlight', $item->classes ) ) {
				return true;
				continue;
			}
		}

		// Nope.
		return false;
	}

	/**
	 * Check if a given menu has a search icon menu item.
	 *
	 * @since   0.1.0
	 *
	 * @return  bool
	 */
	function has_search( $menu_name ) {

		if ( ! $this->has_menu( $menu_name ) ) {
			return false;
		}

		// Get menu items.
		$menu_items = $this->get_menu_items( $menu_name );

		// Loop thru em.
		foreach ( $menu_items as $item ) {
			// If we have a search.
			if ( in_array( 'search', $item->classes ) ) {
				return true;
				continue;
			}
		}

		// Nope.
		return false;
	}

	/**
	 * Get menu items, from cache or new query.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  Menu items.
	 */
	function get_menu_items( $menu_name ) {

		// Setup caches.
		static $menu_items_cache = array();
		static $locations_cache  = array();

		// If cached, return it.
		if ( isset( $menu_items_cache[ $menu_name ] ) ) {
			return $menu_items_cache[ $menu_name ];
		}

		// Maybe cache locations.
		if ( empty( $locations_cache ) ) {
			$locations_cache = get_nav_menu_locations();
		}

		// Bail if menu doesn't exist.
		if ( ! isset( $locations_cache[ $menu_name ] ) ) {
			return;
		}

		// Get menu items.
		$menu_items = wp_get_nav_menu_items( wp_get_nav_menu_object( $locations_cache[ $menu_name ] ) );

		// Add cache.
		$menu_items_cache[ $menu_name ] = $menu_items;

		return $menu_items_cache[ $menu_name ];
	}

}
