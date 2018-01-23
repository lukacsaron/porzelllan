<?php

if ( ! function_exists('chandelier_elated_mobile_header_options_map') ) {

	function chandelier_elated_mobile_header_options_map() {

		chandelier_elated_add_admin_page(array(
			'slug'  => '_mobile_header',
			'title' => 'Mobile Header',
			'icon'  => 'fa fa-header'
		));



	}

	add_action( 'chandelier_elated_options_map', 'chandelier_elated_mobile_header_options_map', 7);

}