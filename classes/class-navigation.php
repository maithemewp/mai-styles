<?php

/**
 * Setup the menus customizer settings.
 *
 * @since  0.1.0
 */
class Mai_Styles_Navigation {

	protected $menu_name;
	protected $section;
	protected $class;
	protected $has_menu;
	protected $has_submenu;
	protected $has_highlight;
	protected $has_search;
	protected $labels;

	function __construct( $config_id, $section, $menu_name ) {

		$this->config_id     = $config_id;
		$this->menu_name     = $menu_name;
		$this->section       = $section;
		$this->class         = sprintf( '.nav-%s', $this->menu_name );
		$this->has_menu      = $this->has_menu( $this->menu_name );
		$this->has_submenu   = $this->has_submenu( $this->menu_name );
		$this->has_highlight = $this->has_highlight( $this->menu_name );
		$this->has_search    = $this->has_search( $this->menu_name );

		$this->labels = array(
			'header' => array(
				'color'              => __( 'Header Menu Color', 'mai-styles' ),
				'submenu_color'      => __( 'Header Submenu Color', 'mai-styles' ),
				'typography'         => __( 'Header Menu Typography', 'mai-styles' ),
				'submenu_typography' => __( 'Header Submenu Typography', 'mai-styles' ),
			),
			'primary' => array(
				'color'              => __( 'Primary Menu Color', 'mai-styles' ),
				'submenu_color'      => __( 'Primary Submenu Color', 'mai-styles' ),
				'typography'         => __( 'Primary Menu Typography', 'mai-styles' ),
				'submenu_typography' => __( 'Primary Submenu Typography', 'mai-styles' ),
			),
			'secondary' => array(
				'color'              => __( 'Footer Color', 'mai-styles' ),
				'submenu_color'      => __( 'Footer Submenu Color', 'mai-styles' ),
				'typography'         => __( 'Footer Typography', 'mai-styles' ),
				'submenu_typography' => __( 'Footer Submenu Typography', 'mai-styles' ),
			),
		);

		/**
		 * Color
		 */
		Kirki::add_field( $this->config_id, $this->get_color_config() );

		/**
		 * Submenu Color.
		 */
		Kirki::add_field( $this->config_id, $this->get_submenu_color_config() );

		if ( 'header' === $this->menu_name ) {

			/**
			 * Header Scroll Color.
			 */
			Kirki::add_field( $config_id, array(
				'type'            => 'multicolor',
				'settings'        => 'site_header_scroll_color',
				'label'           => __( 'Header Scroll', 'mai-styles' ),
				'section'         => $section,
				'transport'       => 'auto',
				'choices'         => $this->get_header_scroll_choices(),
				'default'         => $this->get_header_scroll_defaults(),
				'output'          => $this->get_header_scroll_output(),
				'active_callback' => function() {
					$header_style = genesis_get_option( 'header_style' );
					return ! ( $header_style || in_array( $header_style, array( 'sticky', 'reveal', 'sticky_shrink', 'reveal_shrink' ) ) );
				},
			) );

		}

		/**
		 * Typography.
		 */
		Kirki::add_field( $this->config_id, $this->get_typography_config() );

		/**
		 * Submenu Typography.
		 */
		Kirki::add_field( $this->config_id, $this->get_submenu_typography_config() );
	}

	/**
	 * Get the config for a menu.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_color_config() {

		$config = array(
			'type'      => 'multicolor',
			'settings'  => sprintf( '%s_nav_color', $this->menu_name ),
			'label'     => $this->labels[ $this->menu_name ]['color'],
			'section'   => $this->section,
			'transport' => 'auto',
			'choices'   => $this->get_color_config_choices(),
			'default'   => $this->get_color_config_defaults(),
			'output'    => $this->get_color_config_output(),
			'active_callback' => function() {
				return $this->has_menu;
			},
		);

		// If header nav.
		if ( 'header' === $this->menu_name ) {
			$config['output'][1]['element'][] = '.mai-bars'; // Add mobile menu toggle.
			// Remove items not applicable to header nav.
			unset( $config['choices']['menu_bg'] );
			unset( $config['choices']['item_hover_bg'] );
			unset( $config['choices']['item_current_bg'] );
			unset( $config['default']['menu_bg'] );
			unset( $config['default']['item_hover_bg'] );
			unset( $config['default']['item_current_bg'] );
			unset( $config['output'][0] );               // menu_bg
			// unset( $config['output'][1]['element'][2] ); // .nav-search from item_color
			unset( $config['output'][2] );               // item_hover_bg
			unset( $config['output'][3]['element'][4] ); // .nav-search:hover from item_hover_color
			unset( $config['output'][3]['element'][5] ); // .nav-search:focuse from item_hover_color
			unset( $config['output'][4] );               // item_current_bg
		}

		return $config;
	}

	/**
	 * Get the config choices array.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The choices config.
	 */
	function get_color_config_choices() {
		$choices = array(
			'menu_bg'            => esc_attr__( 'Background', 'mai-styles' ),
			'item_color'         => esc_attr__( 'Item Color', 'mai-styles' ),
			'item_hover_bg'      => esc_attr__( 'Item Hover Background', 'mai-styles' ),
			'item_hover_color'   => esc_attr__( 'Item Hover Color', 'mai-styles' ),
			'item_current_bg'    => esc_attr__( 'Current Item Background', 'mai-styles' ),
			'item_current_color' => esc_attr__( 'Current Item Color', 'mai-styles' ),
		);
		if ( $this->has_highlight ) {
			$choices = array_merge( $choices, array(
				'button_bg'          => esc_attr__( 'Highlight Button Background', 'mai-styles' ),
				'button_color'       => esc_attr__( 'Highlight Button Color', 'mai-styles' ),
				'button_hover_bg'    => esc_attr__( 'Highlight Button Hover Background', 'mai-styles' ),
				'button_hover_color' => esc_attr__( 'Highlight Button Hover Color', 'mai-styles' ),
			) );
		}
		if ( $this->has_search ) {
			$choices = array_merge( $choices, array(
				'search_hover_color' => esc_attr__( 'Search Hover Color', 'mai-styles' ),
			) );
		}
		return $choices;
	}

	/**
	 * Get the config defaults array.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The defaults config.
	 */
	function get_color_config_defaults() {
		$defaults = array(
			'menu_bg'            => '',
			'item_color'         => '',
			'item_hover_bg'      => '',
			'item_hover_color'   => '',
			'item_current_bg'    => '',
			'item_current_color' => '',
		);
		if ( $this->has_highlight ) {
			$defaults = array_merge( $defaults, array(
				'button_bg'          => '',
				'button_color'       => '',
				'button_hover_bg'    => '',
				'button_hover_color' => '',
			) );
		}
		if ( $this->has_search ) {
			$defaults = array_merge( $defaults, array(
				'search_hover_color' => '',
			) );
		}
		return $defaults;
	}

	/**
	 * Get the config output array.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The output config.
	 */
	function get_color_config_output() {
		$output = array(
			array(
				'choice'   => 'menu_bg',
				'property' => 'background-color',
				'element'  => array(
					"{$this->class}",
					"{$this->class} .sub-menu a",
					"{$this->class} .nav-search",
					"{$this->class} .nav-search:hover",
					"{$this->class} .nav-search:focus",
					".home {$this->class} .current-menu-item > a",
				),
			),
			array(
				'choice'   => 'item_color',
				'property' => 'color',
				'element'  => array(
					"{$this->class}",
					"{$this->class} a",
					"{$this->class} .nav-search",
					"{$this->class} .sub-menu a",
					".home {$this->class} .current-menu-item > a",
				),
			),
			array(
				'choice'   => 'item_hover_bg',
				'property' => 'background-color',
				'element'  => array(
					"{$this->class} a:hover",
					"{$this->class} a:focus",
					"{$this->class} .sub-menu a:hover",
					"{$this->class} .sub-menu a:focus",
					"{$this->class} > .menu-item-has-children:not(.current-menu-ancestor):hover > a",
				),
			),
			array(
				'choice'   => 'item_hover_color',
				'property' => 'color',
				'element'  => array(
					"{$this->class} a:hover",
					"{$this->class} a:focus",
					"{$this->class} .nav-search:hover",
					"{$this->class} .nav-search:focus",
					"{$this->class} .sub-menu a:hover",
					"{$this->class} .sub-menu a:focus",
					"{$this->class} > .current-menu-item > a",
					"{$this->class} > .current-menu-ancestor > a",
					"{$this->class} > .menu-item-has-children:not(.highlight):hover > a",
					"{$this->class} > .menu-item-has-children:not(.highlight):focus > a",
					"{$this->class} > .menu-item-has-children:not(.current-menu-ancestor):hover > a",
					"{$this->class} > .menu-item-has-children:not(.current-menu-ancestor):focus > a",
				),
			),
			array(
				'choice'   => 'item_current_bg',
				'property' => 'background-color',
				'element'  => array(
					"{$this->class} .current-menu-item > a",
					"{$this->class} .current-menu-item > a:hover",
					"{$this->class} .current-menu-item > a:focus",
					"{$this->class} .current-menu-ancestor > a",
					"{$this->class} .current-menu-ancestor > a:hover",
					"{$this->class} .current-menu-ancestor > a:focus",
				),
			),
			array(
				'choice'   => 'item_current_color',
				'property' => 'color',
				'element'  => array(
					"{$this->class} .current-menu-item > a",
					"{$this->class} .current-menu-item > a:hover",
					"{$this->class} .current-menu-item > a:focus",
					"{$this->class} .current-menu-ancestor > a",
					"{$this->class} .current-menu-ancestor > a:hover",
					"{$this->class} .current-menu-ancestor > a:focus",
				),
			),
		);
		if ( $this->has_highlight ) {
			$output = array_merge( $output, array(
				array(
					'choice'   => 'button_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$this->class} .highlight > a",
						"{$this->class} .highlight.current-menu-item > a",
					),
				),
				array(
					'choice'   => 'button_color',
					'property' => 'color',
					'element'  => array(
						"{$this->class} .highlight > a",
						"{$this->class} .highlight.current-menu-item > a",
					),
				),
				array(
					'choice'   => 'button_hover_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$this->class} .highlight > a:hover",
						"{$this->class} .highlight > a:focus",
						"{$this->class} .highlight.current-menu-item > a:hover",
						"{$this->class} .highlight.current-menu-item > a:focus",
					),
				),
				array(
					'choice'   => 'button_hover_color',
					'property' => 'color',
					'element'  => array(
						"{$this->class} .highlight > a:hover",
						"{$this->class} .highlight > a:focus",
						"{$this->class} .highlight.current-menu-item > a:hover",
						"{$this->class} .highlight.current-menu-item > a:focus",
					),
				),
			) );
		}
		if ( $this->has_search ) {
			$output = array_merge( $output, array(
				array(
					'choice'   => 'search_hover_color',
					'property' => 'color',
					'element'  => array(
						"{$this->class} .nav-search:hover",
						"{$this->class} .nav-search:focus",
					),
				),
			) );
		}
		return $output;
	}

	function get_header_scroll_choices() {
		$choices = array(
			'header_bg' => esc_attr__( 'Header Background', 'mai-styles' ),
		);
		if ( $this->has_menu ) {
			$choices = array_merge( $choices, array(
				'item_color'         => esc_attr__( 'Item Color', 'mai-styles' ),
				'item_hover_color'   => esc_attr__( 'Item Hover Color', 'mai-styles' ),
				'item_current_color' => esc_attr__( 'Current Item Color', 'mai-styles' ),
			) );
		}
		if ( $this->has_menu && $this->has_highlight ) {
			$choices = array_merge( $choices, array(
				'button_bg'          => esc_attr__( 'Highlight Button Background', 'mai-styles' ),
				'button_color'       => esc_attr__( 'Highlight Button Color', 'mai-styles' ),
				'button_hover_bg'    => esc_attr__( 'Highlight Button Hover Background', 'mai-styles' ),
				'button_hover_color' => esc_attr__( 'Highlight Button Hover Color', 'mai-styles' ),
			) );
		}
		if ( $this->has_menu && $this->has_search ) {
			$choices = array_merge( $choices, array(
				'search_hover_color' => esc_attr__( 'Search Hover Color', 'mai-styles' ),
			) );
		}
		return $choices;
	}

	function get_header_scroll_defaults() {
		$defaults = array(
			'header_bg' => '',
		);
		if ( $this->has_menu ) {
			$defaults = array_merge( $defaults, array(
				'item_color'         => '',
				'item_hover_color'   => '',
				'item_current_color' => '',
			) );
		}
		if ( $this->has_menu && $this->has_highlight ) {
			$defaults = array_merge( $defaults, array(
				'button_bg'          => '',
				'button_color'       => '',
				'button_hover_bg'    => '',
				'button_hover_color' => '',
			) );
		}
		if ( $this->has_menu && $this->has_search ) {
			$defaults = array_merge( $defaults, array(
				'search_hover_color' => '',
			) );
		}
		return $defaults;
	}

	function get_header_scroll_output() {
		$output = array(
			array(
				'choice'   => 'header_bg',
				'property' => 'background-color',
				'element'  => array(
					"body.scroll .site-header",
				),
				'media_query' => '@media only screen and (min-width: 545px)',
			)
		);
		if ( $this->has_menu ) {
			$output = array_merge( $output, array(
				array(
					'choice'   => 'item_color',
					'property' => 'color',
					'element'  => array(
						"body.scroll {$this->class}",
						"body.scroll {$this->class} a",
						"body.scroll {$this->class} .nav-search",
						"body.scroll {$this->class} .sub-menu a",
						"body.scroll.home {$this->class} .current-menu-item > a",
						"body.scroll .mai-bars",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
				array(
					'choice'   => 'item_hover_color',
					'property' => 'color',
					'element'  => array(
						"body.scroll {$this->class} a:hover",
						"body.scroll {$this->class} a:focus",
						"body.scroll {$this->class} .nav-search:hover",
						"body.scroll {$this->class} .nav-search:focus",
						"body.scroll {$this->class} .sub-menu a:hover",
						"body.scroll {$this->class} .sub-menu a:focus",
						"body.scroll {$this->class} > .current-menu-item > a",
						"body.scroll {$this->class} > .current-menu-ancestor > a",
						"body.scroll {$this->class} > .menu-item-has-children:not(.highlight):hover > a",
						"body.scroll {$this->class} > .menu-item-has-children:not(.highlight):focus > a",
						"body.scroll {$this->class} > .menu-item-has-children:not(.current-menu-ancestor):hover > a",
						"body.scroll {$this->class} > .menu-item-has-children:not(.current-menu-ancestor):focus > a",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
				array(
					'choice'   => 'item_current_color',
					'property' => 'color',
					'element'  => array(
						"body.scroll {$this->class} .current-menu-item > a",
						"body.scroll {$this->class} .current-menu-item > a:hover",
						"body.scroll {$this->class} .current-menu-item > a:focus",
						"body.scroll {$this->class} .current-menu-ancestor > a",
						"body.scroll {$this->class} .current-menu-ancestor > a:hover",
						"body.scroll {$this->class} .current-menu-ancestor > a:focus",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
			) );
		}
		if ( $this->has_menu && $this->has_highlight ) {
			$output = array_merge( $output, array(
				array(
					'choice'   => 'button_bg',
					'property' => 'background-color',
					'element'  => array(
						"body.scroll {$this->class} .highlight > a",
						"body.scroll {$this->class} .highlight.current-menu-item > a",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
				array(
					'choice'   => 'button_color',
					'property' => 'color',
					'element'  => array(
						"body.scroll {$this->class} .highlight > a",
						"body.scroll {$this->class} .highlight.current-menu-item > a",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
				array(
					'choice'   => 'button_hover_bg',
					'property' => 'background-color',
					'element'  => array(
						"body.scroll {$this->class} .highlight > a:hover",
						"body.scroll {$this->class} .highlight > a:focus",
						"body.scroll {$this->class} .highlight.current-menu-item > a:hover",
						"body.scroll {$this->class} .highlight.current-menu-item > a:focus",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
				array(
					'choice'   => 'button_hover_color',
					'property' => 'color',
					'element'  => array(
						"body.scroll {$this->class} .highlight > a:hover",
						"body.scroll {$this->class} .highlight > a:focus",
						"body.scroll {$this->class} .highlight.current-menu-item > a:hover",
						"body.scroll {$this->class} .highlight.current-menu-item > a:focus",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
			) );
		}
		if ( $this->has_menu && $this->has_search ) {
			$output = array_merge( $output, array(
				array(
					'choice'   => 'search_hover_color',
					'property' => 'color',
					'element'  => array(
						"body.scroll {$this->class} .nav-search:hover",
						"body.scroll {$this->class} .nav-search:focus",
					),
					'media_query' => '@media only screen and (min-width: 545px)',
				),
			) );
		}
		return $output;
	}

	/**
	 * Get the config for a submenu.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_submenu_color_config() {

		return array(
			'type'      => 'multicolor',
			'settings'  => sprintf( '%s_nav_submenu_color', $this->menu_name ),
			'label'     => $this->labels[ $this->menu_name ]['submenu_color'],
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
						"{$this->class} .sub-menu a",
					),
				),
				array(
					'choice'   => 'submenu_item_color',
					'property' => 'color',
					'element'  => array(
						"{$this->class} .sub-menu a",
					),
				),
				array(
					'choice'   => 'submenu_item_hover_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$this->class} .sub-menu a:hover",
						"{$this->class} .sub-menu a:focus",
					),
				),
				array(
					'choice'   => 'submenu_item_hover_color',
					'property' => 'color',
					'element'  => array(
						"{$this->class} .sub-menu a:hover",
						"{$this->class} .sub-menu a:focus",
					),
				),
				array(
					'choice'   => 'submenu_item_current_bg',
					'property' => 'background-color',
					'element'  => array(
						"{$this->class} .sub-menu .current-menu-item > a",
						"{$this->class} .sub-menu .current-menu-item > a:hover",
						"{$this->class} .sub-menu .current-menu-item > a:focus",
						"{$this->class} .sub-menu .current-menu-ancestor > a",
						"{$this->class} .sub-menu .current-menu-ancestor > a:hover",
						"{$this->class} .sub-menu .current-menu-ancestor > a:focus",
					),
				),
				array(
					'choice'   => 'submenu_item_current_color',
					'property' => 'color',
					'element'  => array(
						"{$this->class} .sub-menu .current-menu-item > a",
						"{$this->class} .sub-menu .current-menu-item > a:hover",
						"{$this->class} .sub-menu .current-menu-item > a:focus",
						"{$this->class} .sub-menu .current-menu-ancestor > a",
						"{$this->class} .sub-menu .current-menu-ancestor > a:hover",
						"{$this->class} .sub-menu .current-menu-ancestor > a:focus",
					),
				),
			),
			'active_callback' => function() {
				return $this->has_submenu;
			},
		);
	}

	/**
	 * Get the config for menu typography.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_typography_config() {

		return array(
			'type'      => 'typography',
			'settings'  => sprintf( '%s_nav_typography', $this->menu_name ),
			'label'     => $this->labels[ $this->menu_name ]['typography'],
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
						"{$this->class} a",
						"{$this->class} .menu-item.highlight > a",
					),
				),
			),
			'active_callback' => function() {
				return $this->has_menu;
			},
		);
	}

	/**
	 * Get the config for submenu typography.
	 *
	 * @since   0.1.0
	 *
	 * @return  array  The kirki config.
	 */
	function get_submenu_typography_config() {

		return array(
			'type'      => 'typography',
			'settings'  => sprintf( '%s_nav_submenu_typography', $this->menu_name ),
			'label'     => $this->labels[ $this->menu_name ]['submenu_typography'],
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
						"{$this->class} .sub-menu a",
					),
				),
			),
			'active_callback' => function() {
				return $this->has_submenu;
			},
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
		if ( 'header' === $menu_name ) {
			return has_nav_menu( 'header_left' ) || has_nav_menu( 'header_right' );
		}
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
			if ( $item->menu_item_parent > 0 ) {
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

		$menu_items = array();
		$locations  = $locations_cache;
		$menus      = ( 'header' === $menu_name ) ? array( 'header_left', 'header_right' ) : array( $menu_name );

		foreach ( $menus as $menu ) {

			// Skip if not active.
			if ( ! isset( $locations[ $menu ] ) ) {
				continue;
			}

			$items = wp_get_nav_menu_items( wp_get_nav_menu_object( $locations[ $menu ] ) );

			if ( ! $items ) {
				continue;
			}

			$menu_items = array_merge( $menu_items, $items );
		}

		// Add to cache.
		$menu_items_cache[ $menu_name ] = $menu_items;

		return $menu_items;
	}

}
