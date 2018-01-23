<?php

if ( ! function_exists('chandelier_elated_header_options_map') ) {

	function chandelier_elated_header_options_map() {

		chandelier_elated_add_admin_page(
			array(
				'slug' => '_header_page',
				'title' => 'Header',
				'icon' => 'fa fa-header'
			)
		);

		$panel_header = chandelier_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header',
				'title' => 'Header'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_behaviour',
				'default_value' => 'sticky-header-on-scroll-up',
				'label' => 'Choose Header behaviour',
				'description' => 'Select the behaviour of header when you scroll down to page',
				'options' => array(
					'sticky-header-on-scroll-up' => 'Sticky on scrol up',
					'sticky-header-on-scroll-down-up' => 'Sticky on scrol up/down',
					'fixed-on-scroll' => 'Fixed on scroll'
				),
				'args' => array(
					'dependence' => true,
					'show' => array(
						'sticky-header-on-scroll-up' => '#eltd_panel_sticky_header',
						'sticky-header-on-scroll-down-up' => '#eltd_panel_sticky_header',
						'fixed-on-scroll' => '#eltd_panel_fixed_header'
					),
					'hide' => array(
						'sticky-header-on-scroll-up' => '#eltd_panel_fixed_header',
						'sticky-header-on-scroll-down-up' => '#eltd_panel_fixed_header',
						'fixed-on-scroll' => '#eltd_panel_sticky_header',
					)
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'top_bar',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Top Bar',
				'description' => 'Enabling this option will show top bar area',
				'parent' => $panel_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_container"
				)
			)
		);

		$top_bar_container = chandelier_elated_add_admin_container(array(
			'name' => 'top_bar_container',
			'parent' => $panel_header,
			'hidden_property' => 'top_bar',
			'hidden_value' => 'no'
		));

		chandelier_elated_add_admin_field(
			array(
				'parent' => $top_bar_container,
				'type' => 'select',
				'name' => 'top_bar_layout',
				'default_value' => 'three-columns',
				'label' => 'Choose top bar layout',
				'description' => 'Select the layout for top bar',
				'options' => array(
					'two-columns' => 'Two columns',
					'three-columns' => 'Three columns'
				),
				'args' => array(
					"dependence" => true,
					"hide" => array(
						"two-columns" => "#eltd_top_bar_layout_container",
						"three-columns" => ""
					),
					"show" => array(
						"two-columns" => "",
						"three-columns" => "#eltd_top_bar_layout_container"
					)
				)
			)
		);

		$top_bar_layout_container = chandelier_elated_add_admin_container(array(
			'name' => 'top_bar_layout_container',
			'parent' => $top_bar_container,
			'hidden_property' => 'top_bar_layout',
			'hidden_value' => '',
			'hidden_values' => array("two-columns"),
		));

		chandelier_elated_add_admin_field(
			array(
				'parent' => $top_bar_layout_container,
				'type' => 'select',
				'name' => 'top_bar_column_widths',
				'default_value' => '30-30-30',
				'label' => 'Choose column widths',
				'description' => '',
				'options' => array(
					'30-30-30' => '33% - 33% - 33%',
					'25-50-25' => '25% - 50% - 25%'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'top_bar_in_grid',
				'type' => 'yesno',
				'default_value' => 'yes',
				'label' => 'Top Bar in grid',
				'description' => 'Set top bar content to be in grid',
				'parent' => $top_bar_layout_container,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_top_bar_in_grid_container"
				)
			)
		);

		$top_bar_in_grid_container = chandelier_elated_add_admin_container(array(
			'name' => 'top_bar_in_grid_container',
			'parent' => $top_bar_layout_container,
			'hidden_property' => 'top_bar_in_grid',
			'hidden_value' => 'no'
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'top_bar_grid_background_color',
			'type' => 'color',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for top bar',
			'parent' => $top_bar_in_grid_container
		));


		chandelier_elated_add_admin_field(array(
			'name' => 'top_bar_grid_background_transparency',
			'type' => 'text',
			'label' => 'Grid Background Transparency',
			'description' => 'Set grid background transparency for top bar',
			'parent' => $top_bar_in_grid_container,
			'args' => array('col_width' => 3)
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'top_bar_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for top bar',
			'parent' => $top_bar_layout_container
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'top_bar_background_transparency',
			'type' => 'text',
			'label' => 'Background Transparency',
			'description' => 'Set background transparency for top bar',
			'parent' => $top_bar_layout_container,
			'args' => array('col_width' => 3)
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'top_bar_height',
			'type' => 'text',
			'label' => 'Top bar height',
			'description' => 'Enter top bar height (Default is 40px)',
			'parent' => $top_bar_layout_container,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'select',
				'name' => 'header_style',
				'default_value' => '',
				'label' => 'Header Skin',
				'description' => 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style',
				'options' => array(
					'' => '',
					'light-header' => 'Light',
					'dark-header' => 'Dark'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_header,
				'type' => 'yesno',
				'name' => 'enable_header_style_on_scroll',
				'default_value' => 'no',
				'label' => 'Enable Header Style on Scroll',
				'description' => 'Enabling this option, header will change style depending on row settings for dark/light style',
			)
		);

		$panel_header_standard = chandelier_elated_add_admin_panel(
			array(
				'page' => '_header_page',
				'name' => 'panel_header_standard',
				'title' => 'Header Standard',
			)
		);

		chandelier_elated_add_admin_section_title(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_title',
				'title' => 'Menu Area'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'yesno',
				'name' => 'menu_area_in_grid_header_standard',
				'default_value' => 'no',
				'label' => 'Header in grid',
				'description' => 'Set header content to be in grid',
				'args' => array(
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#eltd_menu_area_in_grid_header_standard_container'
				)
			)
		);

		$menu_area_in_grid_header_standard_container = chandelier_elated_add_admin_container(
			array(
				'parent' => $panel_header_standard,
				'name' => 'menu_area_in_grid_header_standard_container',
				'hidden_property' => 'menu_area_in_grid_header_standard',
				'hidden_value' => 'no'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'color',
				'name' => 'menu_area_grid_background_color_header_standard',
				'default_value' => '',
				'label' => 'Grid Background color',
				'description' => 'Set grid background color for header area',
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $menu_area_in_grid_header_standard_container,
				'type' => 'text',
				'name' => 'menu_area_grid_background_transparency_header_standard',
				'default_value' => '',
				'label' => 'Grid background transparency',
				'description' => 'Set grid background transparency for header',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'color',
				'name' => 'menu_area_background_color_header_standard',
				'default_value' => '',
				'label' => 'Background color',
				'description' => 'Set background color for header'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_background_transparency_header_standard',
				'default_value' => '',
				'label' => 'Background transparency',
				'description' => 'Set background transparency for header',
				'args' => array(
					'col_width' => 3
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_header_standard,
				'type' => 'text',
				'name' => 'menu_area_height_header_standard',
				'default_value' => '',
				'label' => 'Height',
				'description' => 'Enter header height (default is 60px)',
				'args' => array(
					'col_width' => 3,
					'suffix' => 'px'
				)
			)
		);

		$panel_sticky_header = chandelier_elated_add_admin_panel(
			array(
				'title' => 'Sticky Header',
				'name' => 'panel_sticky_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array(
					'fixed-on-scroll'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'scroll_amount_for_sticky',
				'type' => 'text',
				'label' => 'Scroll Amount for Sticky',
				'description' => 'Enter scroll amount for Sticky Menu to appear (deafult is header height)',
				'parent' => $panel_sticky_header,
				'args' => array(
					'col_width' => 2,
					'suffix' => 'px'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'name' => 'sticky_header_in_grid',
				'type' => 'yesno',
				'default_value' => 'no',
				'label' => 'Sticky Header in grid',
				'description' => 'Set sticky header content to be in grid',
				'parent' => $panel_sticky_header,
				'args' => array(
					"dependence" => true,
					"dependence_hide_on_yes" => "",
					"dependence_show_on_yes" => "#eltd_sticky_header_in_grid_container"
				)
			)
		);

		$sticky_header_in_grid_container = chandelier_elated_add_admin_container(array(
			'name' => 'sticky_header_in_grid_container',
			'parent' => $panel_sticky_header,
			'hidden_property' => 'sticky_header_in_grid',
			'hidden_value' => 'no'
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'sticky_header_grid_background_color',
			'type' => 'color',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for sticky header',
			'parent' => $sticky_header_in_grid_container
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'sticky_header_grid_transparency',
			'type' => 'text',
			'label' => 'Sticky Header Grid Transparency',
			'description' => 'Enter transparency for sticky header grid (value from 0 to 1)',
			'parent' => $sticky_header_in_grid_container,
			'args' => array(
				'col_width' => 1
			)
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'sticky_header_background_color',
			'type' => 'color',
			'label' => 'Background Color',
			'description' => 'Set background color for sticky header',
			'parent' => $panel_sticky_header
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'sticky_header_transparency',
			'type' => 'text',
			'label' => 'Sticky Header Transparency',
			'description' => 'Enter transparency for sticky header (value from 0 to 1)',
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 1
			)
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'sticky_header_height',
			'type' => 'text',
			'label' => 'Sticky Header Height',
			'description' => 'Enter height for sticky header (default is 60px)',
			'parent' => $panel_sticky_header,
			'args' => array(
				'col_width' => 2,
				'suffix' => 'px'
			)
		));

		$panel_fixed_header = chandelier_elated_add_admin_panel(
			array(
				'title' => 'Fixed Header',
				'name' => 'panel_fixed_header',
				'page' => '_header_page',
				'hidden_property' => 'header_behaviour',
				'hidden_values' => array('sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up')
			)
		);

		chandelier_elated_add_admin_field(array(
			'name' => 'fixed_header_grid_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => 'Grid Background Color',
			'description' => 'Set grid background color for fixed header',
			'parent' => $panel_fixed_header
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'fixed_header_grid_transparency',
			'type' => 'text',
			'default_value' => '',
			'label' => 'Header Transparency Grid',
			'description' => 'Enter transparency for fixed header grid (value from 0 to 1)',
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'fixed_header_background_color',
			'type' => 'color',
			'default_value' => '',
			'label' => 'Background Color',
			'description' => 'Set background color for fixed header',
			'parent' => $panel_fixed_header
		));

		chandelier_elated_add_admin_field(array(
			'name' => 'fixed_header_transparency',
			'type' => 'text',
			'label' => 'Header Transparency',
			'description' => 'Enter transparency for fixed header (value from 0 to 1)',
			'parent' => $panel_fixed_header,
			'args' => array(
				'col_width' => 1
			)
		));


		$panel_main_menu = chandelier_elated_add_admin_panel(
			array(
				'title' => 'Main Menu',
				'name' => 'panel_main_menu',
				'page' => '_header_page',
			)
		);

		chandelier_elated_add_admin_section_title(
			array(
				'parent' => $panel_main_menu,
				'name' => 'main_menu_area_title',
				'title' => 'Main Menu General Settings'
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'select',
				'name' => 'menu_dropdown_appearance',
				'default_value' => 'default',
				'label' => 'Main Dropdown Menu Appearance',
				'description' => 'Choose appearance for dropdown menu',
				'options' => array(
					'dropdown-default' => 'Default',
					'dropdown-slide-from-bottom' => 'Slide From Bottom',
					'dropdown-slide-from-top' => 'Slide From Top',
					'dropdown-animate-height' => 'Animate Height',
					'dropdown-slide-from-left' => 'Slide From Left'
				)
			)
		);

		chandelier_elated_add_admin_field(
			array(
				'parent' => $panel_main_menu,
				'type' => 'yesno',
				'name' => 'enable_wide_manu_background',
				'default_value' => 'no',
				'label' => 'Enable Full Width Background for Wide Dropdown Type',
				'description' => 'Enabling this option will show full width background  for wide dropdown type',
			)
		);

		$panel_mobile_header = chandelier_elated_add_admin_panel(array(
				'title' => 'Mobile header',
				'name'  => 'panel_mobile_header',
				'page'  => '_header_page'
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_header_height',
				'type'        => 'text',
				'label'       => 'Mobile Header Height',
				'description' => 'Enter height for mobile header in pixels',
				'parent'      => $panel_mobile_header,
				'args'        => array(
						'col_width' => 3,
						'suffix'    => 'px'
				)
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_header_background_color',
				'type'        => 'color',
				'label'       => 'Mobile Header Background Color',
				'description' => 'Choose color for mobile header',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_menu_background_color',
				'type'        => 'color',
				'label'       => 'Mobile Menu Background Color',
				'description' => 'Choose color for mobile menu',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_menu_separator_color',
				'type'        => 'color',
				'label'       => 'Mobile Menu Item Separator Color',
				'description' => 'Choose color for mobile menu horizontal separators',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_logo_height',
				'type'        => 'text',
				'label'       => 'Logo Height For Mobile Header',
				'description' => 'Define logo height for screen size smaller than 1000px',
				'parent'      => $panel_mobile_header,
				'args'        => array(
						'col_width' => 3,
						'suffix'    => 'px'
				)
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_logo_height_phones',
				'type'        => 'text',
				'label'       => 'Logo Height For Mobile Devices',
				'description' => 'Define logo height for screen size smaller than 480px',
				'parent'      => $panel_mobile_header,
				'args'        => array(
						'col_width' => 3,
						'suffix'    => 'px'
				)
		));

		chandelier_elated_add_admin_section_title(array(
				'parent' => $panel_mobile_header,
				'name'   => 'mobile_header_fonts_title',
				'title'  => 'Typography'
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_text_color',
				'type'        => 'color',
				'label'       => 'Navigation Text Color',
				'description' => 'Define color for mobile navigation text',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_text_hover_color',
				'type'        => 'color',
				'label'       => 'Navigation Hover/Active Color',
				'description' => 'Define hover/active color for mobile navigation text',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_font_family',
				'type'        => 'font',
				'label'       => 'Navigation Font Family',
				'description' => 'Define font family for mobile navigation text',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_font_size',
				'type'        => 'text',
				'label'       => 'Navigation Font Size',
				'description' => 'Define font size for mobile navigation text',
				'parent'      => $panel_mobile_header,
				'args'        => array(
						'col_width' => 3,
						'suffix'    => 'px'
				)
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_line_height',
				'type'        => 'text',
				'label'       => 'Navigation Line Height',
				'description' => 'Define line height for mobile navigation text',
				'parent'      => $panel_mobile_header,
				'args'        => array(
						'col_width' => 3,
						'suffix'    => 'px'
				)
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_text_transform',
				'type'        => 'select',
				'label'       => 'Navigation Text Transform',
				'description' => 'Define text transform for mobile navigation text',
				'parent'      => $panel_mobile_header,
				'options'     => chandelier_elated_get_text_transform_array(true)
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_font_style',
				'type'        => 'select',
				'label'       => 'Navigation Font Style',
				'description' => 'Define font style for mobile navigation text',
				'parent'      => $panel_mobile_header,
				'options'     => chandelier_elated_get_font_style_array(true)
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_font_weight',
				'type'        => 'select',
				'label'       => 'Navigation Font Weight',
				'description' => 'Define font weight for mobile navigation text',
				'parent'      => $panel_mobile_header,
				'options'     => chandelier_elated_get_font_weight_array(true)
		));

		chandelier_elated_add_admin_section_title(array(
				'name' => 'mobile_opener_panel',
				'parent' => $panel_mobile_header,
				'title' => 'Mobile Menu Opener'
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_icon_pack',
				'type'        => 'select',
				'label'       => 'Mobile Navigation Icon Pack',
				'default_value' => 'font_awesome',
				'description' => 'Choose icon pack for mobile navigation icon',
				'parent'      => $panel_mobile_header,
				'options'     => chandelier_elated_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'simple_line_icons'))
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_icon_color',
				'type'        => 'color',
				'label'       => 'Mobile Navigation Icon Color',
				'description' => 'Choose color for icon header',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_icon_hover_color',
				'type'        => 'color',
				'label'       => 'Mobile Navigation Icon Hover Color',
				'description' => 'Choose hover color for mobile navigation icon ',
				'parent'      => $panel_mobile_header
		));

		chandelier_elated_add_admin_field(array(
				'name'        => 'mobile_icon_size',
				'type'        => 'text',
				'label'       => 'Mobile Navigation Icon size',
				'description' => 'Choose size for mobile navigation icon ',
				'parent'      => $panel_mobile_header,
				'args' => array(
						'col_width' => 3,
						'suffix' => 'px'
				)
		));

	}

	add_action( 'chandelier_elated_options_map', 'chandelier_elated_header_options_map', 7);

}