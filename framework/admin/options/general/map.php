<?php

if ( ! function_exists('chandelier_elated_general_options_map') ) {
    /**
     * General options page
     */
    function chandelier_elated_general_options_map() {

        chandelier_elated_add_admin_page(
            array(
                'slug'  => '',
                'title' => 'General',
                'icon'  => 'fa fa-institution'
            )
        );

        $panel_design_style = chandelier_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_design_style',
                'title' => 'Design Style'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'google_fonts',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose a default Google font for your site',
                'parent' => $panel_design_style
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'additional_google_fonts',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Additional Google Fonts',
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#eltd_additional_google_fonts_container"
                )
            )
        );

        $additional_google_fonts_container = chandelier_elated_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'additional_google_fonts_container',
                'hidden_property'   => 'additional_google_fonts',
                'hidden_value'      => 'no'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font1',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font2',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font3',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font4',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'additional_google_font5',
                'type'          => 'font',
                'default_value' => '-1',
                'label'         => 'Font Family',
                'description'   => 'Choose additional Google font for your site',
                'parent'        => $additional_google_fonts_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'first_color',
                'type'          => 'color',
                'label'         => 'First Main Color',
                'description'   => 'Choose the most dominant theme color. Default color is #000000',
                'parent'        => $panel_design_style
            )
        );
		chandelier_elated_add_admin_field(
            array(
                'name'          => 'second_color',
                'type'          => 'color',
                'label'         => 'Second Main Color',
                'description'   => 'Choose the second main theme color. Default color is #c9a482',
                'parent'        => $panel_design_style
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'page_background_color',
                'type'          => 'color',
                'label'         => 'Page Background Color',
                'description'   => 'Choose the background color for page content. Default color is #ffffff',
                'parent'        => $panel_design_style
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'selection_color',
                'type'          => 'color',
                'label'         => 'Text Selection Color',
                'description'   => 'Choose the color users see when selecting text',
                'parent'        => $panel_design_style
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'boxed',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Boxed Layout',
                'description'   => '',
                'parent'        => $panel_design_style,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#eltd_boxed_container"
                )
            )
        );

        $boxed_container = chandelier_elated_add_admin_container(
            array(
                'parent'            => $panel_design_style,
                'name'              => 'boxed_container',
                'hidden_property'   => 'boxed',
                'hidden_value'      => 'no'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'page_background_color_in_box',
                'type'          => 'color',
                'label'         => 'Page Background Color',
                'description'   => 'Choose the page background color outside box.',
                'parent'        => $boxed_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'boxed_background_image',
                'type'          => 'image',
                'label'         => 'Background Image',
                'description'   => 'Choose an image to be displayed in background',
                'parent'        => $boxed_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'boxed_pattern_background_image',
                'type'          => 'image',
                'label'         => 'Background Pattern',
                'description'   => 'Choose an image to be used as background pattern',
                'parent'        => $boxed_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'boxed_background_image_attachment',
                'type'          => 'select',
                'default_value' => 'fixed',
                'label'         => 'Background Image Attachment',
                'description'   => 'Choose background image attachment',
                'parent'        => $boxed_container,
                'options'       => array(
                    'fixed'     => 'Fixed',
                    'scroll'    => 'Scroll'
                )
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'initial_content_width',
                'type'          => 'select',
                'default_value' => '',
                'label'         => 'Initial Width of Content',
                'description'   => 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid"',
                'parent'        => $panel_design_style,
                'options'       => array(
                    ""          => "1100px - default",
                    "grid-1300" => "1300px",
                    "grid-1200" => "1200px",
                    "grid-1000" => "1000px",
                    "grid-800"  => "800px"
                )
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'preload_pattern_image',
                'type'          => 'image',
                'label'         => 'Preload Pattern Image',
                'description'   => 'Choose preload pattern image to be displayed until images are loaded ',
                'parent'        => $panel_design_style
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name' => 'element_appear_amount',
                'type' => 'text',
                'label' => 'Element Appearance',
                'description' => 'For animated elements, set distance (related to browser bottom) to start the animation',
                'parent' => $panel_design_style,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => 'px'
                )
            )
        );

        $panel_settings = chandelier_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_settings',
                'title' => 'Settings'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'smooth_scroll',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => 'Smooth Scroll',
                'description'   => 'Enabling this option will perform a smooth scrolling effect on every page (except on Mac and touch devices)',
                'parent'        => $panel_settings
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'smooth_page_transitions',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Smooth Page Transitions',
                'description'   => 'Enabling this option will perform a smooth transition between pages when clicking on links.',
                'parent'        => $panel_settings,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "",
                    "dependence_show_on_yes" => "#eltd_page_transitions_container"
                )
            )
        );

        $page_transitions_container = chandelier_elated_add_admin_container(
            array(
                'parent'            => $panel_settings,
                'name'              => 'page_transitions_container',
                'hidden_property'   => 'smooth_page_transitions',
                'hidden_value'      => 'no'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'smooth_pt_bgnd_color',
                'type'          => 'color',
                'label'         => 'Page Loader Background Color',
                //'description'   => 'Enabling this option will perform a smooth transition between pages when clicking on links.',
                'parent'        => $page_transitions_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'elements_animation_on_touch',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Elements Animation on Mobile/Touch Devices',
                'description'   => 'Enabling this option will allow elements (shortcodes) to animate on mobile / touch devices',
                'parent'        => $panel_settings
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'show_back_button',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => 'Show "Back To Top Button"',
                'description'   => 'Enabling this option will display a Back to Top button on every page',
                'parent'        => $panel_settings
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'responsiveness',
                'type'          => 'yesno',
                'default_value' => 'yes',
                'label'         => 'Responsiveness',
                'description'   => 'Enabling this option will make all pages responsive',
                'parent'        => $panel_settings
            )
        );

        $panel_custom_code = chandelier_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_custom_code',
                'title' => 'Custom Code'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'custom_css',
                'type'          => 'textarea',
                'label'         => 'Custom CSS',
                'description'   => 'Enter your custom CSS here',
                'parent'        => $panel_custom_code
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'custom_js',
                'type'          => 'textarea',
                'label'         => 'Custom JS',
                'description'   => 'Enter your custom Javascript here',
                'parent'        => $panel_custom_code
            )
        );

        $panel_seo = chandelier_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_seo',
                'title' => 'Seo'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'disable_seo',
                'type'          => 'yesno',
                'default_value' => 'no',
                'label'         => 'Disable SEO',
                'description'   => 'Enabling this option will turn off SEO',
                'parent'        => $panel_seo,
                'args'          => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#eltd_disable_seo_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $disable_seo_container = chandelier_elated_add_admin_container(
            array(
                'parent'            => $panel_seo,
                'name'              => 'disable_seo_container',
                'hidden_property'   => 'disable_seo',
                'hidden_value'      => 'yes'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'meta_keywords',
                'type'          => 'textarea',
                'label'         => 'Meta Keywords',
                'description'   => 'Add relevant keywords separated with commas to improve SEO',
                'parent'        => $disable_seo_container
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'          => 'meta_description',
                'type'          => 'textarea',
                'label'         => 'Meta Description',
                'description'   => 'Enter a short description of the website for SEO',
                'parent'        => $disable_seo_container
            )
        );

        $panel_google_api = chandelier_elated_add_admin_panel(
            array(
                'page'  => '',
                'name'  => 'panel_google_api',
                'title' => 'Google API'
            )
        );

        chandelier_elated_add_admin_field(
            array(
                'name'        => 'google_maps_api_key',
                'type'        => 'text',
                'label'       => 'Google Maps Api Key',
                'description' => 'Insert your Google Maps API key here.',
                'parent'      => $panel_google_api
            )
        );

    }

    add_action( 'chandelier_elated_options_map', 'chandelier_elated_general_options_map', 5);

}