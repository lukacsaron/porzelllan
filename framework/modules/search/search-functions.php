<?php

if( !function_exists('chandelier_elated_search_body_class') ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function chandelier_elated_search_body_class($classes) {

		if ( is_active_widget( false, false, 'eltd_search_opener' ) ) {

			$classes[] = 'eltd-' . chandelier_elated_options()->getOptionValue('search_type');

			if ( chandelier_elated_options()->getOptionValue('search_type') == 'fullscreen-search' ) {

				$classes[] = 'eltd-' . chandelier_elated_options()->getOptionValue('search_animation');

			}

		}
		return $classes;

	}

	add_filter('body_class', 'chandelier_elated_search_body_class');
}

if ( ! function_exists('chandelier_elated_get_search') ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function chandelier_elated_get_search() {

		if ( chandelier_elated_active_widget( false, false, 'eltd_search_opener' ) ) {

			$search_type = chandelier_elated_options()->getOptionValue('search_type');

			if ($search_type == 'search-dropdown') {
				chandelier_elated_set_position_for_dropdown_search();
				return;
			}
			if ($search_type == 'search-covers-header') {
				chandelier_elated_set_position_for_covering_search();
				return;
			} else if ($search_type == 'search-slides-from-window-top' || $search_type == 'search-slides-from-header-bottom') {
				chandelier_elated_set_search_position_in_menu( $search_type );
				if ( chandelier_elated_is_responsive_on() ) {
					chandelier_elated_set_search_position_mobile();
				}
				return;
			}

			chandelier_elated_load_search_template();

		}
	}

}

if ( ! function_exists('chandelier_elated_set_position_for_covering_search') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function chandelier_elated_set_position_for_covering_search() {

		$containing_sidebar = chandelier_elated_active_widget( false, false, 'eltd_search_opener' );

		foreach ($containing_sidebar as $sidebar) {

			if ( strpos( $sidebar, 'top-bar' ) !== false ) {
				add_action( 'chandelier_elated_after_header_top_html_open', 'chandelier_elated_load_search_template');
			} else if ( strpos( $sidebar, 'main-menu' ) !== false ) {
				add_action( 'chandelier_elated_after_header_menu_area_html_open', 'chandelier_elated_load_search_template');
			} else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
				add_action( 'chandelier_elated_after_mobile_header_html_open', 'chandelier_elated_load_search_template');
			} else if ( strpos( $sidebar, 'logo' ) !== false ) {
				add_action( 'chandelier_elated_after_header_logo_area_html_open', 'chandelier_elated_load_search_template');
			} else if ( strpos( $sidebar, 'sticky' ) !== false ) {
				add_action( 'chandelier_elated_after_sticky_menu_html_open', 'chandelier_elated_load_search_template');
			}

		}

	}

}

if ( ! function_exists('chandelier_elated_set_search_position_in_menu') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function chandelier_elated_set_search_position_in_menu( $type ) {

		add_action( 'chandelier_elated_after_header_menu_area_html_open', 'chandelier_elated_load_search_template');
		if ( $type == 'search-slides-from-header-bottom' ) {
			add_action( 'chandelier_elated_after_sticky_menu_html_open', 'chandelier_elated_load_search_template');
		}

	}
}

if ( ! function_exists( 'chandelier_elated_set_position_for_dropdown_search' ) ) {

	function chandelier_elated_set_position_for_dropdown_search() {

		$containing_sidebar = chandelier_elated_active_widget( false, false, 'eltd_search_opener' );

		foreach ($containing_sidebar as $sidebar) {

			if ( strpos( $sidebar, 'main-menu' ) !== false ) {
				add_action('chandelier_elated_before_page_header_close', 'chandelier_elated_load_search_template');
			} else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
				add_action( 'chandelier_elated_after_mobile_header_html_open', 'chandelier_elated_load_search_template');
			} else if ( strpos( $sidebar, 'sticky' ) !== false ) {
				add_action('chandelier_elated_before_sticky_menu_html_close', 'chandelier_elated_load_search_template');
			}

		}

	}

}

if ( ! function_exists('chandelier_elated_set_search_position_mobile') ) {
	/**
	 * Hooks search template to mobile header
	 */
	function chandelier_elated_set_search_position_mobile() {

		add_action( 'chandelier_elated_after_mobile_header_html_open', 'chandelier_elated_load_search_template');

	}

}

if ( ! function_exists('chandelier_elated_load_search_template') ) {
	/**
	 * Loads HTML template with parameters
	 */
	function chandelier_elated_load_search_template() {

		$search_type = chandelier_elated_options()->getOptionValue('search_type');

		$search_icon = '<i class="eltd-icon-font-awesome fa fa-search "></i>';
		$search_icon_close = '<i class="eltd-icon-font-awesome fa fa-times "></i>';
		
		$parameters = array(
			'search_in_grid'		=> chandelier_elated_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'			=> $search_icon,
			'search_icon_close'		=> $search_icon_close
		);

		chandelier_elated_get_module_template_part( 'templates/types/'.$search_type, 'search', '', $parameters );

	}

}