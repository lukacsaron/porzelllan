<?php

if ( ! function_exists('chandelier_elated_load_elements_map') ) {
	/**
	 * Add Elements option page for shortcodes
	 */
	function chandelier_elated_load_elements_map() {

		chandelier_elated_add_admin_page(
			array(
				'slug' => '_elements_page',
				'title' => 'Elements',
				'icon' => 'fa fa-star'
			)
		);

		do_action( 'chandelier_elated_options_elements_map' );

	}

	add_action('chandelier_elated_options_map', 'chandelier_elated_load_elements_map', 17);

}