<?php

if(!function_exists('chandelier_elated_button_map')) {
    function chandelier_elated_button_map() {
        $panel = chandelier_elated_add_admin_panel(array(
            'title' => 'Button',
            'name'  => 'panel_button',
            'page'  => '_elements_page'
        ));

        //Typography options
        chandelier_elated_add_admin_section_title(array(
            'name' => 'typography_section_title',
            'title' => 'Typography',
            'parent' => $panel
        ));

        $typography_group = chandelier_elated_add_admin_group(array(
            'name' => 'typography_group',
            'title' => 'Typography',
            'description' => 'Setup typography for all button types',
            'parent' => $panel
        ));

        $typography_row = chandelier_elated_add_admin_row(array(
            'name' => 'typography_row',
            'next' => true,
            'parent' => $typography_group
        ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'fontsimple',
            'name'          => 'button_font_family',
            'default_value' => '',
            'label'         => 'Font Family',
        ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'button_text_transform',
            'default_value' => '',
            'label'         => 'Text Transform',
            'options'       => chandelier_elated_get_text_transform_array()
        ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'selectsimple',
            'name'          => 'button_font_style',
            'default_value' => '',
            'label'         => 'Font Style',
            'options'       => chandelier_elated_get_font_style_array()
        ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $typography_row,
            'type'          => 'textsimple',
            'name'          => 'button_letter_spacing',
            'default_value' => '',
            'label'         => 'Letter Spacing',
            'args'          => array(
                'suffix' => 'px'
            )
        ));

        $typography_row2 = chandelier_elated_add_admin_row(array(
            'name' => 'typography_row2',
            'next' => true,
            'parent' => $typography_group
        ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $typography_row2,
            'type'          => 'selectsimple',
            'name'          => 'button_font_weight',
            'default_value' => '',
            'label'         => 'Font Weight',
            'options'       => chandelier_elated_get_font_weight_array()
        ));

        //Outline type options
        chandelier_elated_add_admin_section_title(array(
            'name' => 'type_section_title',
            'title' => 'Types',
            'parent' => $panel
        ));

        $outline_group = chandelier_elated_add_admin_group(array(
            'name' => 'outline_group',
            'title' => 'Outline Type',
            'description' => 'Setup outline button type',
            'parent' => $panel
        ));

        $outline_row = chandelier_elated_add_admin_row(array(
            'name' => 'outline_row',
            'next' => true,
            'parent' => $outline_group
        ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $outline_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_outline_text_color',
            'default_value' => '',
            'label'         => 'Text Color',
            'description'   => ''
        ));

        // chandelier_elated_add_admin_field(array(
        //     'parent'        => $outline_row,
        //     'type'          => 'colorsimple',
        //     'name'          => 'btn_outline_hover_text_color',
        //     'default_value' => '',
        //     'label'         => 'Text Hover Color',
        //     'description'   => ''
        // ));

        // chandelier_elated_add_admin_field(array(
        //     'parent'        => $outline_row,
        //     'type'          => 'colorsimple',
        //     'name'          => 'btn_outline_hover_bg_color',
        //     'default_value' => '',
        //     'label'         => 'Hover Background Color',
        //     'description'   => ''
        // ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $outline_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_outline_border_color',
            'default_value' => '',
            'label'         => 'Border Color',
            'description'   => ''
        ));

        // $outline_row2 = chandelier_elated_add_admin_row(array(
        //     'name' => 'outline_row2',
        //     'next' => true,
        //     'parent' => $outline_group
        // ));

        // chandelier_elated_add_admin_field(array(
        //     'parent'        => $outline_row2,
        //     'type'          => 'colorsimple',
        //     'name'          => 'btn_outline_hover_border_color',
        //     'default_value' => '',
        //     'label'         => 'Hover Border Color',
        //     'description'   => ''
        // ));

        //Solid type options
        $solid_group = chandelier_elated_add_admin_group(array(
            'name' => 'solid_group',
            'title' => 'Solid Type',
            'description' => 'Setup solid button type',
            'parent' => $panel
        ));

        $solid_row = chandelier_elated_add_admin_row(array(
            'name' => 'solid_row',
            'next' => true,
            'parent' => $solid_group
        ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $solid_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_text_color',
            'default_value' => '',
            'label'         => 'Text Color',
            'description'   => ''
        ));

        // chandelier_elated_add_admin_field(array(
        //     'parent'        => $solid_row,
        //     'type'          => 'colorsimple',
        //     'name'          => 'btn_solid_hover_text_color',
        //     'default_value' => '',
        //     'label'         => 'Text Hover Color',
        //     'description'   => ''
        // ));

        chandelier_elated_add_admin_field(array(
            'parent'        => $solid_row,
            'type'          => 'colorsimple',
            'name'          => 'btn_solid_bg_color',
            'default_value' => '',
            'label'         => 'Background Color',
            'description'   => ''
        ));

        // chandelier_elated_add_admin_field(array(
        //     'parent'        => $solid_row,
        //     'type'          => 'colorsimple',
        //     'name'          => 'btn_solid_hover_bg_color',
        //     'default_value' => '',
        //     'label'         => 'Hover Background Color',
        //     'description'   => ''
        // ));

        // $solid_row2 = chandelier_elated_add_admin_row(array(
        //     'name' => 'solid_row2',
        //     'next' => true,
        //     'parent' => $solid_group
        // ));

        // chandelier_elated_add_admin_field(array(
        //     'parent'        => $solid_row2,
        //     'type'          => 'colorsimple',
        //     'name'          => 'btn_solid_border_color',
        //     'default_value' => '',
        //     'label'         => 'Border Color',
        //     'description'   => ''
        // ));

        // chandelier_elated_add_admin_field(array(
        //     'parent'        => $solid_row2,
        //     'type'          => 'colorsimple',
        //     'name'          => 'btn_solid_hover_border_color',
        //     'default_value' => '',
        //     'label'         => 'Hover Border Color',
        //     'description'   => ''
        // ));
    }

    add_action('chandelier_elated_options_elements_map', 'chandelier_elated_button_map');
}