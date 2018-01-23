<?php

if ( ! function_exists('chandelier_elated_title_options_map') ) {

	function chandelier_elated_title_options_map() {

		chandelier_elated_add_admin_page(
			array(
				'slug' => '_title_page',
				'title' => 'Title',
				'icon' => 'fa fa-list-alt'
			)
		);

		$panel_title = chandelier_elated_add_admin_panel(
			array(
				'page' => '_title_page',
				'name' => 'panel_title',
				'title' => 'Title Settings'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'show_title_area',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => 'Show Title Area',
				'description' => 'This option will enable/disable Title Area',
				'parent' => $panel_title,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_show_title_area_container"
				)
			)
		);

		$show_title_area_container = chandelier_elated_add_admin_container(
			array(
				'parent' => $panel_title,
				'name' => 'show_title_area_container',
				'hidden_property' => 'show_title_area',
				'hidden_value' => 'no'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_type',
				'type' => 'select',
				'default_value' => 'standard',
				'label' => 'Title Area Type',
				'description' => 'Choose title type',
				'parent' => $show_title_area_container,
				'options' => array(
					'standard' => 'Standard - Dark',
					'light' => 'Standard - Light',
					'breadcrumb' => 'Breadcrumb'
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"standard" => "",
						"breadcrumb" => "#eltd_title_area_type_container"
					),
					"show" => array(
						"standard" => "#eltd_title_area_type_container",
						"breadcrumb" => ""
					)
				)
			)
		);

		$title_area_type_container = chandelier_elated_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_type_container',
				'hidden_property' => 'title_area_type',
				'hidden_value' => '',
				'hidden_values' => array('breadcrumb'),
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_enable_breadcrumbs',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Enable Breadcrumbs',
				'description' => 'This option will display Breadcrumbs in Title Area',
				'parent' => $title_area_type_container,
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_animation',
				'type' => 'select',
				'default_value' => 'no',
				'label' => 'Animations',
				'description' => 'Choose an animation for Title Area',
				'parent' => $show_title_area_container,
				'options' => array(
					'no' => 'No Animation',
					'one-by-one' => 'One by One',
					'right-left' => 'Text right to left',
					'left-right' => 'Text left to right'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_vertial_alignment',
				'type' => 'select',
				'default_value' => 'window_top',
				'label' => 'Vertical Alignment',
				'description' => 'Specify title vertical alignment',
				'parent' => $show_title_area_container,
				'options' => array(
					'window_top' => 'From Window Top',
					'header_bottom' => 'From Bottom of Header'					
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_content_alignment',
				'type' => 'select',
				'default_value' => 'center',
				'label' => 'Horizontal Alignment',
				'description' => 'Specify title horizontal alignment',
				'parent' => $show_title_area_container,
				'options' => array(
					'center' => 'Center',
					'left' => 'Left',
					'right' => 'Right'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_background_color',
				'type' => 'color',
				'label' => 'Background Color',
				'description' => 'Choose a background color for Title Area',
				'parent' => $show_title_area_container
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_background_image',
				'type' => 'image',
				'label' => 'Background Image',
				'description' => 'Choose an Image for Title Area',
				'parent' => $show_title_area_container
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_background_image_responsive',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Background Responsive Image',
				'description' => 'Enabling this option will make Title background image responsive',
				'parent' => $show_title_area_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "#eltd_title_area_background_image_responsive_container",
					"dependence_show_on_yes" => ""
				)
			)
		);

		$title_area_background_image_responsive_container = chandelier_elated_add_admin_container(
			array(
				'parent' => $show_title_area_container,
				'name' => 'title_area_background_image_responsive_container',
				'hidden_property' => 'title_area_background_image_responsive',
				'hidden_value' => 'yes'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'title_area_background_image_parallax',
				'type' => 'select',
				'default_value' => 'no',
				'label' => 'Background Image in Parallax',
				'description' => 'Enabling this option will make Title background image parallax',
				'parent' => $title_area_background_image_responsive_container,
				'options' => array(
					'no' => 'No',
					'yes' => 'Yes',
					'yes_zoom' => 'Yes, with zoom out'
				)
			)
		);

		chandelier_elated_add_admin_field(array(
			'name' => 'title_area_height',
			'type' => 'text',
			'label' => 'Height',
			'description' => 'Set a height for Title Area',
			'parent' => $title_area_background_image_responsive_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

	}

	add_action( 'chandelier_elated_options_map', 'chandelier_elated_title_options_map', 8);

}