<?php

if ( ! function_exists('chandelier_elated_woocommerce_options_map') ) {

	/**
	 * Add Woocommerce options page
	 */
	function chandelier_elated_woocommerce_options_map() {

		chandelier_elated_add_admin_page(
			array(
				'slug' => '_woocommerce_page',
				'title' => 'Woocommerce',
				'icon' => 'fa fa-shopping-cart'
			)
		);

		/**
		 * Product List Settings
		 */
		$panel_product_list = chandelier_elated_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_product_list',
				'title' => 'Product List'
			)
		);

		chandelier_elated_add_admin_field(array(
			'name'        	=> 'eltd_woo_products_list_full_width',
			'type'        	=> 'yesno',
			'label'       	=> 'Enable Full Width Template',
			'default_value'	=> 'no',
			'description' 	=> 'Enabling this option will enable full width template for shop page',
			'parent'      	=> $panel_product_list,
		));

		chandelier_elated_add_admin_field(array(
			'name'        	=> 'eltd_woo_product_list_columns',
			'type'        	=> 'select',
			'label'       	=> 'Product List Columns',
			'default_value'	=> 'eltd-woocommerce-columns-3',
			'description' 	=> 'Choose number of columns for product listing and related products on single product',
			'options'		=> array(
				'eltd-woocommerce-columns-3' => '3 Columns (2 with sidebar)',
				'eltd-woocommerce-columns-4' => '4 Columns (3 with sidebar)'
			),
			'parent'      	=> $panel_product_list,
		));

		chandelier_elated_add_admin_field(array(
			'name'        	=> 'eltd_woo_products_per_page',
			'type'        	=> 'text',
			'label'       	=> 'Number of products per page',
			'default_value'	=> '',
			'description' 	=> 'Set number of products on shop page',
			'parent'      	=> $panel_product_list,
			'args' 			=> array(
				'col_width' => 3
			)
		));

		chandelier_elated_add_admin_field(array(
				'name'        	=> 'eltd_woo_products_lightbox',
				'type'        	=> 'yesno',
				'label'       	=> 'Product Preview',
				'default_value'	=> 'yes',
				'description' 	=> 'Enable products lightbox',
				'parent'      	=> $panel_product_list
		));

		chandelier_elated_add_admin_field(array(
			'name'        	=> 'eltd_products_list_title_tag',
			'type'        	=> 'select',
			'label'       	=> 'Products Title Tag',
			'default_value'	=> 'h5',
			'description' 	=> '',
			'options'		=> array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_product_list,
		));

		/**
		 * Single Product Settings
		 */
		$panel_single_product = chandelier_elated_add_admin_panel(
			array(
				'page' => '_woocommerce_page',
				'name' => 'panel_single_product',
				'title' => 'Single Product'
			)
		);

		chandelier_elated_add_admin_field(array(
			'name'        	=> 'eltd_single_product_title_tag',
			'type'        	=> 'select',
			'label'       	=> 'Single Product Title Tag',
			'default_value'	=> 'h2'	,
			'description' 	=> '',
			'options'		=> array(
				'h1' => 'h1',
				'h2' => 'h2',
				'h3' => 'h3',
				'h4' => 'h4',
				'h5' => 'h5',
				'h6' => 'h6',
			),
			'parent'      	=> $panel_single_product,
		));

	}

	add_action( 'chandelier_elated_options_map', 'chandelier_elated_woocommerce_options_map', 25);

}