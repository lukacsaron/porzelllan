<?php

if ( ! function_exists('chandelier_elated_search_options_map') ) {

	function chandelier_elated_search_options_map() {

		chandelier_elated_add_admin_page(
			array(
				'slug' => '_search_page',
				'title' => 'Search',
				'icon' => 'fa fa-search'
			)
		);

		$search_panel = chandelier_elated_add_admin_panel(
			array(
				'title' => 'Search',
				'name' => 'search',
				'page' => '_search_page'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'select',
				'name'			=> 'search_type',
				'default_value'	=> 'search-slides-from-header-bottom',
				'label' 		=> 'Select Search Type',
				'description' 	=> "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with transparent header)",
				'options' 		=> array(
					'search-slides-from-header-bottom' => 'Slide From Header Bottom',
					'search-slides-from-window-top' => 'Slide from Window Top',
					'search-dropdown' => 'Dropdown'
				),
				'args'			=> array(
					'dependence'=> true,
					'hide'		=> array(
						'search-slides-from-header-bottom' => '#eltd_search_animation_container',
						'search-slides-from-window-top' => '#eltd_search_height_container, #eltd_search_animation_container'
					),
					'show'		=> array(
						'search-slides-from-header-bottom' => '#eltd_search_height_container',
						'search-slides-from-window-top' => ''
					)
				)
			)
		);

		$search_height_container = chandelier_elated_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'search_height_container',
				'hidden_property'	=> 'search_type',
				'hidden_value'		=> '',
				'hidden_values'		=> array(
					'search-covers-header',
					'fullscreen-search',
					'search-slides-from-window-top'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_height_container,
				'type'			=> 'text',
				'name'			=> 'search_height',
				'default_value'	=> '',
				'label'			=> 'Search bar height',
				'description'	=> 'Set search bar height',
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);

		$search_animation_container = chandelier_elated_add_admin_container(
			array(
				'parent'			=> $search_panel,
				'name'				=> 'search_animation_container',
				'hidden_property'	=> 'search_type',
				'hidden_value'		=> '',
				'hidden_values'		=> array(
					'search-covers-header',
					'search-slides-from-header-bottom',
					'search-slides-from-window-top'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_animation_container,
				'type'			=> 'select',
				'name'			=> 'search_animation',
				'default_value'	=> 'search-fade',
				'label'			=> 'Fullscreen Search Overlay Animation',
				'description'	=> 'Choose animation for fullscreen search overlay',
				'options'		=> array(
					'search-fade'			=> 'Fade',
					'search-from-circle'	=> 'Circle appear'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'search_in_grid',
				'default_value'	=> 'yes',
				'label'			=> 'Search area in grid',
				'description'	=> 'Set search area to be in grid',
			)
		);

		chandelier_elated_add_admin_section_title(
			array(
				'parent' 	=> $search_panel,
				'name'		=> 'initial_header_icon_title',
				'title'		=> 'Initial Search Icon in Header'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'text',
				'name'			=> 'header_search_icon_size',
				'default_value'	=> '',
				'label'			=> 'Icon Size',
				'description'	=> 'Set size for icon',
				'args'			=> array(
					'col_width' => 3,
					'suffix'	=> 'px'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_panel,
				'type'			=> 'yesno',
				'name'			=> 'enable_search_icon_text',
				'default_value'	=> 'no',
				'label'			=> 'Enable Search Icon Text',
				'description'	=> "Enable this option to show 'Search' text next to search icon in header",
			)
		);

		$search_icon_spacing_group = chandelier_elated_add_admin_group(
			array(
				'parent'	=> $search_panel,
				'title'		=> 'Icon Spacing',
				'description'	=> 'Define padding and margins for Search icon',
				'name'		=> 'search_icon_spacing_group'
			)
		);

		$search_icon_spacing_row = chandelier_elated_add_admin_row(
			array(
				'parent'	=> $search_icon_spacing_group,
				'name'		=> 'search_icon_spacing_row'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_padding_left',
				'default_value'	=> '',
				'label'			=> 'Padding Left',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_padding_right',
				'default_value'	=> '',
				'label'			=> 'Padding Right',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_margin_left',
				'default_value'	=> '',
				'label'			=> 'Margin Left',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent'		=> $search_icon_spacing_row,
				'type'			=> 'textsimple',
				'name'			=> 'search_margin_right',
				'default_value'	=> '',
				'label'			=> 'Margin Right',
				'args'			=> array(
					'suffix'	=> 'px'
				)
			)
		);



	}

	add_action('chandelier_elated_options_map', 'chandelier_elated_search_options_map', 12);

}