<?php

//Slider

$slider_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Background Type',
        'name' => 'slides_type'
    )
);

    chandelier_elated_add_meta_box_field(
        array(
            'name'          => 'eltd_slide_background_type',
            'type'          => 'imagevideo',
            'default_value' => 'image',
            'label'         => 'Slide Background Type',
            'description'   => 'Do you want to upload an image or video?',
            'parent'        => $slider_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#eltd-meta-box-eltd_slides_video_settings",
                "dependence_show_on_yes" => "#eltd-meta-box-eltd_slides_image_settings"
            )
        )
    );


//Slide Image

$slider_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Background Image',
        'name' => 'eltd_slides_image_settings',
        'hidden_property' => 'eltd_slide_background_type',
        'hidden_values' => array('video')
    )
);

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_image',
            'type'        => 'image',
            'label'       => 'Slide Image',
            'description' => 'Choose background image',
            'parent'      => $slider_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_overlay_image',
            'type'        => 'image',
            'label'       => 'Overlay Image',
            'description' => 'Choose overlay image (pattern) for background image',
            'parent'      => $slider_meta_box
        )
    );


//Slide Video

$video_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Background Video',
        'name' => 'eltd_slides_video_settings',
        'hidden_property' => 'eltd_slide_background_type',
        'hidden_values' => array('image')
    )
);

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_video_webm',
            'type'        => 'text',
            'label'       => 'Video - webm',
            'description' => 'Path to the webm file that you have previously uploaded in Media Section',
            'parent'      => $video_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_video_mp4',
            'type'        => 'text',
            'label'       => 'Video - mp4',
            'description' => 'Path to the mp4 file that you have previously uploaded in Media Section',
            'parent'      => $video_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_video_ogv',
            'type'        => 'text',
            'label'       => 'Video - ogv',
            'description' => 'Path to the ogv file that you have previously uploaded in Media Section',
            'parent'      => $video_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_video_image',
            'type'        => 'image',
            'label'       => 'Video Preview Image',
            'description' => 'Choose background image that will be visible until video is loaded. This image will be shown on touch devices too.',
            'parent'      => $video_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name' => 'eltd_slide_video_overlay',
            'type' => 'yesempty',
            'default_value' => '',
            'label' => 'Video Overlay Image',
            'description' => 'Do you want to have a overlay image on video?',
            'parent' => $video_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "",
                "dependence_show_on_yes" => "#eltd_eltd_slide_video_overlay_container"
            )
        )
    );

    $slide_video_overlay_container = chandelier_elated_add_admin_container(array(
        'name' => 'eltd_slide_video_overlay_container',
        'parent' => $video_meta_box,
        'hidden_property' => 'eltd_slide_video_overlay',
        'hidden_values' => array('','no')
    ));

        chandelier_elated_add_meta_box_field(
            array(
                'name'        => 'eltd_slide_video_overlay_image',
                'type'        => 'image',
                'label'       => 'Overlay Image',
                'description' => 'Choose overlay image (pattern) for background video.',
                'parent'      => $slide_video_overlay_container
            )
        );


//Slide General

$general_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide General',
        'name' => 'eltd_slides_general_settings'
    )
);

    chandelier_elated_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'eltd_text_content_title',
            'title' => 'Slide Text Content'
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name' => 'eltd_slide_hide_title',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Hide Slide Title',
            'description' => 'Do you want to hide slide title?',
            'parent' => $general_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#eltd_eltd_slide_hide_title_container",
                "dependence_show_on_yes" => ""
            )
        )
    );

    $slide_hide_title_container = chandelier_elated_add_admin_container(array(
        'name' => 'eltd_slide_hide_title_container',
        'parent' => $general_meta_box,
        'hidden_property' => 'eltd_slide_hide_title',
        'hidden_value' => 'yes'
    ));

        $group_title_link = chandelier_elated_add_admin_group(array(
            'title' => 'Title Link',
            'name' => 'group_title_link',
            'description' => 'Define styles for title',
            'parent' => $slide_hide_title_container
        ));

            $row1 = chandelier_elated_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_title_link
            ));

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_title_link',
                        'type'        => 'textsimple',
                        'label'       => 'Link',
                        'parent'      => $row1
                    )
                );

                chandelier_elated_add_meta_box_field(
                    array(
                        'parent' => $row1,
                        'type' => 'selectsimple',
                        'name' => 'eltd_slide_title_target',
                        'default_value' => '_self',
                        'label' => 'Target',
                        'options' => array(
                            "_self" => "Self",
                            "_blank" => "Blank"
                        )
                    )
                );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_subtitle',
            'type'        => 'text',
            'label'       => 'Subtitle Text',
            'description' => 'Enter text for subtitle',
            'parent'      => $general_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_text',
            'type'        => 'text',
            'label'       => 'Body Text',
            'description' => 'Enter slide body text',
            'parent'      => $general_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_button_label',
            'type'        => 'text',
            'label'       => 'Button 1 Text',
            'description' => 'Enter text to be displayed on button 1',
            'parent'      => $general_meta_box
        )
    );

    $group_button1 = chandelier_elated_add_admin_group(array(
        'title' => 'Button 1 Link',
        'name' => 'group_button1',
        'parent' => $general_meta_box
    ));

        $row1 = chandelier_elated_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_button1
        ));

            chandelier_elated_add_meta_box_field(
                array(
                    'name'        => 'eltd_slide_button_link',
                    'type'        => 'textsimple',
                    'label'       => 'Link',
                    'parent'      => $row1
                )
            );

            chandelier_elated_add_meta_box_field(
                array(
                    'parent' => $row1,
                    'type' => 'selectsimple',
                    'name' => 'eltd_slide_button_target',
                    'default_value' => '_self',
                    'label' => 'Target',
                    'options' => array(
                        "_self" => "Self",
                        "_blank" => "Blank"
                    )
                )
            );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_button_label2',
            'type'        => 'text',
            'label'       => 'Button 2 Text',
            'description' => 'Enter text to be displayed on button 2',
            'parent'      => $general_meta_box
        )
    );

    $group_button2 = chandelier_elated_add_admin_group(array(
        'title' => 'Button 2 Link',
        'name' => 'group_button2',
        'parent' => $general_meta_box
    ));

        $row1 = chandelier_elated_add_admin_row(array(
            'name' => 'row1',
            'parent' => $group_button2
        ));

            chandelier_elated_add_meta_box_field(
                array(
                    'name'        => 'eltd_slide_button_link2',
                    'type'        => 'textsimple',
                    'label'       => 'Link',
                    'parent'      => $row1
                )
            );

            chandelier_elated_add_meta_box_field(
                array(
                    'parent' => $row1,
                    'type' => 'selectsimple',
                    'name' => 'eltd_slide_button_target2',
                    'default_value' => '_self',
                    'label' => 'Target',
                    'options' => array(
                        "_self" => "Self",
                        "_blank" => "Blank"
                    )
                )
            );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_text_content_top_margin',
            'type'        => 'text',
            'label'       => 'Text Content Top Margin',
            'description' => 'Enter top margin for text content',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_text_content_bottom_margin',
            'type'        => 'text',
            'label'       => 'Text Content Bottom Margin',
            'description' => 'Enter bottom margin for text content',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    chandelier_elated_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'eltd_graphic_title',
            'title' => 'Slide Graphic'
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_thumbnail',
            'type'        => 'image',
            'label'       => 'Slide Graphic',
            'description' => 'Choose slide graphic',
            'parent'      => $general_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_thumbnail_link',
            'type'        => 'text',
            'label'       => 'Graphic Link',
            'description' => 'Enter URL to link slide graphic',
            'parent'      => $general_meta_box
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_graphic_top_padding',
            'type'        => 'text',
            'label'       => 'Graphic Top Padding',
            'description' => 'Enter top padding for slide graphic',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name'        => 'eltd_slide_graphic_bottom_padding',
            'type'        => 'text',
            'label'       => 'Graphic Bottom Padding',
            'description' => 'Enter bottom padding for slide graphic',
            'parent'      => $general_meta_box,
            'args' => array(
                'col_width' => 2,
                'suffix' => 'px'
            )
        )
    );

    chandelier_elated_add_admin_section_title(
        array(
            'parent' => $general_meta_box,
            'name' => 'eltd_general_styling_title',
            'title' => 'General Styling'
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'parent' => $general_meta_box,
            'type' => 'selectblank',
            'name' => 'eltd_slide_header_style',
            'default_value' => '',
            'label' => 'Header Style',
            'description' => 'Header style will be applied when this slide is in focus',
            'options' => array(
                "light" => "Light",
                "dark" => "Dark"
            )
        )
    );
	chandelier_elated_add_meta_box_field(
		array(
			'name'        => 'eltd_slide_nav_color',
			'type'        => 'color',
			'label'       => 'Slide Navigation Color',
			'parent'      => $general_meta_box
		)
	);

//Slide Behaviour

$behaviours_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Behaviours',
        'name' => 'eltd_slides_behaviour_settings'
    )
);
	chandelier_elated_add_admin_section_title(
        array(
            'parent' => $behaviours_meta_box,
            'name' => 'eltd_image_animation_title',
            'title' => 'Slide Image Animation'
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name' => 'eltd_enable_image_animation',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Enable Image Animation',
            'description' => 'Enabling this option will turn on a motion animation on the slide image',
            'parent' => $behaviours_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "",
                "dependence_show_on_yes" => "#eltd_eltd_enable_image_animation_container"
            )
        )
    );

    $enable_image_animation_container = chandelier_elated_add_admin_container(array(
        'name' => 'eltd_enable_image_animation_container',
        'parent' => $behaviours_meta_box,
        'hidden_property' => 'eltd_enable_image_animation',
        'hidden_value' => 'no'
    ));

        chandelier_elated_add_meta_box_field(
            array(
                'parent' => $enable_image_animation_container,
                'type' => 'select',
                'name' => 'eltd_enable_image_animation_type',
                'default_value' => 'zoom_center',
                'label' => 'Animation Type',
                'options' => array(
                    "zoom_center" => "Zoom In Center",
                    "zoom_top_left" => "Zoom In to Top Left",
                    "zoom_top_right" => "Zoom In to Top Right",
                    "zoom_bottom_left" => "Zoom In to Bottom Left",
                    "zoom_bottom_right" => "Zoom In to Bottom Right"
                )
            )
        );

    chandelier_elated_add_admin_section_title(
        array(
            'parent' => $behaviours_meta_box,
            'name' => 'eltd_content_animation_title',
            'title' => 'Slide Content Entry Animations'
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'parent' => $behaviours_meta_box,
            'type' => 'select',
            'name' => 'eltd_slide_thumbnail_animation',
            'default_value' => 'flip',
            'label' => 'Graphic Entry Animation',
            'description' => 'Choose entry animation for graphic',
            'options' => array(
                "flip" => "Flip",
                "fade" => "Fade In",
                "from_bottom" => "From Bottom",
                "from_top" => "From Top",
                "from_left" => "From Left",
                "from_right" => "From Right",
                "clip_anim_hor" => "Clip Animation Horizontal",
                "clip_anim_ver" => "Clip Animation Vertical",
                "clip_anim_puzzle" => "Clip Animation Puzzle",
                "without_animation"	=>	"No Animation"
            )
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'parent' => $behaviours_meta_box,
            'type' => 'select',
            'name' => 'eltd_slide_content_animation',
            'default_value' => 'all_at_once',
            'label' => 'Content Entry Animation',
            'description' => 'Choose entry animation for whole slide content group (title, subtitle, text, button)',
            'options' => array(
                "all_at_once" => "All At Once",
                "one_by_one" => "One By One",
                "without_animation"	=>	"No Animation"
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "all_at_once"=>"",
                    "one_by_one"=>"",
                    "without_animation"=>"#eltd_eltd_slide_content_animation_container"),
                "show" => array(
                    "all_at_once"=>"#eltd_eltd_slide_content_animation_container",
                    "one_by_one"=>"#eltd_eltd_slide_content_animation_container",
                    "without_animation"=>""
                )
            )
        )
    );

    $slide_content_animation_container = chandelier_elated_add_admin_container(array(
        'name' => 'eltd_slide_content_animation_container',
        'parent' => $behaviours_meta_box,
        'hidden_property' => 'eltd_slide_content_animation',
        'hidden_value' => 'without_animation'
    ));

        chandelier_elated_add_meta_box_field(
            array(
                'parent' => $slide_content_animation_container,
                'type' => 'select',
                'name' => 'eltd_slide_content_animation_direction',
                'default_value' => 'from_bottom',
                'label' => 'Animation Direction',
                'options' => array(
                    "from_bottom" => "From Bottom",
                    "from_top" => "From Top",
                    "from_left" => "From Left",
                    "from_right" => "From Right",
                    "fade" => "Fade In"
                )
            )
        );


//Slide Title Styles

$title_style_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Title Style',
        'name' => 'eltd_slides_title',
        'hidden_property' => 'eltd_slide_hide_title',
        'hidden_values' => array('yes')
    )
);

$title_text_group = chandelier_elated_add_admin_group(array(
    'title' => 'Title Text Style',
    'description' => 'Define styles for title text',
    'name' => 'eltd_title_text_group',
    'parent' => $title_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $title_text_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_color',
        'type'        => 'colorsimple',
        'label'       => 'Font Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_font_size',
        'type'        => 'textsimple',
        'label'       => 'Font Size (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_line_height',
        'type'        => 'textsimple',
        'label'       => 'Line Height (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_letter_spacing',
        'type'        => 'textsimple',
        'label'       => 'Letter Spacing (px)',
        'parent'      => $row1
    )
);

$row2 = chandelier_elated_add_admin_row(array(
    'name' => 'row2',
    'parent' => $title_text_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_font_family',
        'type'        => 'fontsimple',
        'label'       => 'Font Family',
        'parent'      => $row2
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_font_style',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Style',
        'parent'      => $row2,
        'options'     => $chandelier_elated_options_fontstyle
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_font_weight',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Weight',
        'parent'      => $row2,
        'options'     => $chandelier_elated_options_fontweight
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_text_transform',
        'type'        => 'selectblanksimple',
        'label'       => 'Text Transform',
        'parent'      => $row2,
        'options'       => $chandelier_elated_options_texttransform
    )
);

$title_background_group = chandelier_elated_add_admin_group(array(
    'title' => 'Background',
    'description' => 'Define background for title',
    'name' => 'eltd_title_background_group',
    'parent' => $title_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $title_background_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_background_color',
        'type'        => 'colorsimple',
        'label'       => 'Background Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_bg_color_transparency',
        'type'        => 'textsimple',
        'label'       => 'Background Color Transparency (values 0-1)',
        'parent'      => $row1
    )
);

$title_margin_group = chandelier_elated_add_admin_group(array(
    'title' => 'Margin Bottom (px)',
    'description' => 'Enter value for title bottom margin (default value is 14)',
    'name' => 'eltd_title_margin_group',
    'parent' => $title_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $title_margin_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_margin_bottom',
        'type'        => 'textsimple',
        'label'       => '',
        'parent'      => $row1
    )
);

$title_padding_group = chandelier_elated_add_admin_group(array(
    'title' => 'Padding',
    'description' => 'Define padding for title',
    'name' => 'eltd_title_padding_group',
    'parent' => $title_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $title_padding_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_padding_top',
        'type'        => 'textsimple',
        'label'       => 'Top Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_padding_right',
        'type'        => 'textsimple',
        'label'       => 'Right Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_padding_bottom',
        'type'        => 'textsimple',
        'label'       => 'Bottom Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_padding_left',
        'type'        => 'textsimple',
        'label'       => 'Left Padding (px)',
        'parent'      => $row1
    )
);

$slide_title_border = chandelier_elated_add_meta_box_field(array(
    'label' => 'Border',
    'description' => 'Do you want to have a title border?',
    'name' => 'eltd_slide_title_border',
    'type' => 'yesno',
    'default_value' => 'no',
    'parent' => $title_style_meta_box,
    'args' => array(
        'dependence' => true,
        'dependence_hide_on_yes' => '',
        'dependence_show_on_yes' => '#eltd_eltd_title_border_container'
    )
));

$title_border_container = chandelier_elated_add_admin_container(array(
    'name' => 'eltd_title_border_container',
    'parent' => $title_style_meta_box,
    'hidden_property' => 'eltd_slide_title_border',
    'hidden_value' => 'no'
));

$title_border_group = chandelier_elated_add_admin_group(array(
    'title' => 'Title Border',
    'description' => 'Define border for title',
    'name' => 'eltd_title_border_group',
    'parent' => $title_border_container
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $title_border_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_border_thickness',
        'type'        => 'textsimple',
        'label'       => 'Thickness (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_title_border_style',
        'type'        => 'selectsimple',
        'label'       => 'Style',
        'parent'      => $row1,
        'options'     => array(
            "solid" => "solid",
            "dashed" => "dashed",
            "dotted" => "dotted",
            "double" => "double",
            "groove" => "groove",
            "ridge" => "ridge",
            "inset" => "inset",
            "outset" => "outset"
        )
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slider_title_border_color',
        'type'        => 'colorsimple',
        'label'       => 'Color',
        'parent'      => $row1
    )
);


//Slide Subtitle Styles

$subtitle_style_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Subtitle Style',
        'name' => 'eltd_slides_subtitle'
    )
);

$subtitle_text_group = chandelier_elated_add_admin_group(array(
    'title' => 'Subtitle Text Style',
    'description' => 'Define styles for subtitle text',
    'name' => 'eltd_subtitle_text_group',
    'parent' => $subtitle_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $subtitle_text_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_color',
        'type'        => 'colorsimple',
        'label'       => 'Font Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_font_size',
        'type'        => 'textsimple',
        'label'       => 'Font Size (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_line_height',
        'type'        => 'textsimple',
        'label'       => 'Line Height (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_letter_spacing',
        'type'        => 'textsimple',
        'label'       => 'Letter Spacing (px)',
        'parent'      => $row1
    )
);

$row2 = chandelier_elated_add_admin_row(array(
    'name' => 'row2',
    'parent' => $subtitle_text_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_font_family',
        'type'        => 'fontsimple',
        'label'       => 'Font Family',
        'parent'      => $row2
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_font_style',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Style',
        'parent'      => $row2,
        'options'     => $chandelier_elated_options_fontstyle
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_font_weight',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Weight',
        'parent'      => $row2,
        'options'     => $chandelier_elated_options_fontweight
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_text_transform',
        'type'        => 'selectblanksimple',
        'label'       => 'Text Transform',
        'parent'      => $row2,
        'options'       => $chandelier_elated_options_texttransform
    )
);

$subtitle_background_group = chandelier_elated_add_admin_group(array(
    'title' => 'Background',
    'description' => 'Define background for subtitle',
    'name' => 'eltd_subtitle_background_group',
    'parent' => $subtitle_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $subtitle_background_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_background_color',
        'type'        => 'colorsimple',
        'label'       => 'Background Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_bg_color_transparency',
        'type'        => 'textsimple',
        'label'       => 'Background Color Transparency (values 0-1)',
        'parent'      => $row1
    )
);

$subtitle_margin_group = chandelier_elated_add_admin_group(array(
    'title' => 'Margin Bottom (px)',
    'description' => 'Enter value for subtitle bottom margin (default value is 14)',
    'name' => 'eltd_subtitle_margin_group',
    'parent' => $subtitle_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $subtitle_margin_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_margin_bottom',
        'type'        => 'textsimple',
        'label'       => '',
        'parent'      => $row1
    )
);

$subtitle_padding_group = chandelier_elated_add_admin_group(array(
    'title' => 'Padding',
    'description' => 'Define padding for subtitle',
    'name' => 'eltd_subtitle_padding_group',
    'parent' => $subtitle_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $subtitle_padding_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_padding_top',
        'type'        => 'textsimple',
        'label'       => 'Top Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_padding_right',
        'type'        => 'textsimple',
        'label'       => 'Right Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_padding_bottom',
        'type'        => 'textsimple',
        'label'       => 'Bottom Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_subtitle_padding_left',
        'type'        => 'textsimple',
        'label'       => 'Left Padding (px)',
        'parent'      => $row1
    )
);


//Slide Text Styles

$text_style_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Text Style',
        'name' => 'eltd_slides_text'
    )
);

$text_common_text_group = chandelier_elated_add_admin_group(array(
    'title' => 'Text Color and Size',
    'description' => 'Define text color and size',
    'name' => 'eltd_text_common_text_group',
    'parent' => $text_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $text_common_text_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_color',
        'type'        => 'colorsimple',
        'label'       => 'Font Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_font_size',
        'type'        => 'textsimple',
        'label'       => 'Font Size (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_line_height',
        'type'        => 'textsimple',
        'label'       => 'Line Height (px)',
        'parent'      => $row1
    )
);

$text_without_separator_padding_group = chandelier_elated_add_admin_group(array(
    'title' => 'Padding',
    'description' => 'Define padding for text',
    'name' => 'eltd_text_without_separator_padding_group',
    'parent' => $text_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $text_without_separator_padding_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_padding_top',
        'type'        => 'textsimple',
        'label'       => 'Top Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_padding_right',
        'type'        => 'textsimple',
        'label'       => 'Right Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_padding_bottom',
        'type'        => 'textsimple',
        'label'       => 'Bottom Padding (px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_padding_left',
        'type'        => 'textsimple',
        'label'       => 'Left Padding (px)',
        'parent'      => $row1
    )
);

$text_without_separator_text_group = chandelier_elated_add_admin_group(array(
    'title' => 'Text Style',
    'description' => 'Define styles for slide text',
    'name' => 'eltd_text_without_separator_text_group',
    'parent' => $text_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $text_without_separator_text_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_letter_spacing',
        'type'        => 'textsimple',
        'label'       => 'Letter Spacing (px)',
        'parent'      => $row1
    )
);

$row2 = chandelier_elated_add_admin_row(array(
    'name' => 'row2',
    'parent' => $text_without_separator_text_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_font_family',
        'type'        => 'fontsimple',
        'label'       => 'Font Family',
        'parent'      => $row2
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_font_style',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Style',
        'parent'      => $row2,
        'options'     => $chandelier_elated_options_fontstyle
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_font_weight',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Weight',
        'parent'      => $row2,
        'options'     => $chandelier_elated_options_fontweight
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_text_transform',
        'type'        => 'selectblanksimple',
        'label'       => 'Text Transform',
        'parent'      => $row2,
        'options'       => $chandelier_elated_options_texttransform
    )
);

$text_without_separator_background_group = chandelier_elated_add_admin_group(array(
    'title' => 'Background',
    'description' => 'Define background for text',
    'name' => 'eltd_text_without_separator_background_group',
    'parent' => $text_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $text_without_separator_background_group
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_background_color',
        'type'        => 'colorsimple',
        'label'       => 'Background Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_text_bg_color_transparency',
        'type'        => 'textsimple',
        'label'       => 'Background Color Transparency (values 0-1)',
        'parent'      => $row1
    )
);


//Slide Buttons Styles

$buttons_style_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Buttons Style',
        'name' => 'eltd_slides_buttons'
    )
);

chandelier_elated_add_admin_section_title(
    array(
        'parent' => $buttons_style_meta_box,
        'name' => 'eltd_button_1_styling_title',
        'title' => 'Button 1'
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_size',
        'type'        => 'selectblank',
        'parent'      => $buttons_style_meta_box,
        'label'       => 'Size',
        'description' => 'Choose button size',
        'default_value' => '',
        'options'     => array(
            "" => "Default",
            "small" => "Small",
            "medium" => "Medium",
            "large" => "Large",
            "huge" => "Extra Large",
            "huge-full-width" => "Extra Large Full Width"
        )
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_type',
        'type'        => 'selectblank',
        'parent'      => $buttons_style_meta_box,
        'label'       => 'Type',
        'description' => 'Choose button type',
        'default_value' => '',
        'options'     => array(
            "" => "Default",
            "outline" => "Outline",
            "solid" => "Solid"
        )
    )
);

$buttons_style_group_1 = chandelier_elated_add_admin_group(array(
    'title' => 'Text Style',
    'description' => 'Define text style',
    'name' => 'eltd_buttons_style_group_1',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons_style_group_1
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_font_size',
        'type'        => 'textsimple',
        'label'       => 'Text Size(px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_font_weight',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Weight',
        'parent'      => $row1,
        'options'     => $chandelier_elated_options_fontweight
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_text_color',
        'type'        => 'colorsimple',
        'label'       => 'Text Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_text_hover_color',
        'type'        => 'colorsimple',
        'label'       => 'Text Hover Color',
        'parent'      => $row1
    )
);

$buttons_style_group_2 = chandelier_elated_add_admin_group(array(
    'title' => 'Background',
    'description' => 'Define background',
    'name' => 'eltd_buttons_style_group_2',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons_style_group_2
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_background_color',
        'type'        => 'colorsimple',
        'label'       => 'Background Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_background_hover_color',
        'type'        => 'colorsimple',
        'label'       => 'Background Hover Color',
        'parent'      => $row1
    )
);

$buttons_style_group_4 = chandelier_elated_add_admin_group(array(
    'title' => 'Border',
    'description' => 'Define border style',
    'name' => 'eltd_buttons_style_group_4',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons_style_group_4
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_border_color',
        'type'        => 'colorsimple',
        'label'       => 'Border Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_border_hover_color',
        'type'        => 'colorsimple',
        'label'       => 'Border Hover Color',
        'parent'      => $row1
    )
);

$buttons_style_group_5 = chandelier_elated_add_admin_group(array(
    'title' => 'Margin (px)',
    'description' => 'Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px',
    'name' => 'eltd_buttons_style_group_5',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons_style_group_5
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_margin1',
        'type'        => 'textsimple',
        'label'       => '',
        'parent'      => $row1
    )
);

//init icon pack hide and show array. It will be populated dinamically from collections array
$button1_icon_pack_hide_array = array();
$button1_icon_pack_show_array = array();

//do we have some collection added in collections array?
if(is_array($chandelier_elated_IconCollections->iconCollections) && count($chandelier_elated_IconCollections->iconCollections)) {
    //get collections params array. It will contain values of 'param' property for each collection
    $button1_icon_collections_params = $chandelier_elated_IconCollections->getIconCollectionsParams();

    //foreach collection generate hide and show array
    foreach ($chandelier_elated_IconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
        $button1_icon_pack_hide_array[$dep_collection_key] = '';
        $button1_icon_pack_hide_array["no_icon"] = "";

        //button1_icon_size is input that is always shown when some icon pack is activated and hidden if 'no_icon' is selected
        $button1_icon_pack_hide_array["no_icon"] .= "#eltd_slider_button1_icon_size,";

        //we need to include only current collection in show string as it is the only one that needs to show
        $button1_icon_pack_show_array[$dep_collection_key] = '#eltd_slider_button1_icon_size, #eltd_button1_icon_'.$dep_collection_object->param.'_container';

        //for all collections param generate hide string
        foreach ($button1_icon_collections_params as $button1_icon_collections_param) {
            //we don't need to include current one, because it needs to be shown, not hidden
            if($button1_icon_collections_param !== $dep_collection_object->param) {
                $button1_icon_pack_hide_array[$dep_collection_key].= '#eltd_button1_icon_'.$button1_icon_collections_param.'_container,';
            }

            $button1_icon_pack_hide_array["no_icon"] .= '#eltd_button1_icon_'.$button1_icon_collections_param.'_container,';
        }

        //remove remaining ',' character
        $button1_icon_pack_hide_array[$dep_collection_key] = rtrim($button1_icon_pack_hide_array[$dep_collection_key], ',');
        $button1_icon_pack_hide_array["no_icon"] = rtrim($button1_icon_pack_hide_array["no_icon"], ',');
    }

}

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_button1_icon_pack',
        'type'        => 'select',
        'label'       => 'Button 1 Icon Pack',
        'description' => 'Choose icon pack for the first button',
        'default_value' => 'no_icon',
        'parent'      => $buttons_style_meta_box,
        'options'     => $chandelier_elated_IconCollections->getIconCollectionsEmpty("no_icon"),
        'args'        => array(
            "dependence" => true,
            "hide" => $button1_icon_pack_hide_array,
            "show" => $button1_icon_pack_show_array
        )
    )
);

if(is_array($chandelier_elated_IconCollections->iconCollections) && count($chandelier_elated_IconCollections->iconCollections)) {
    //foreach icon collection we need to generate separate container that will have dependency set
    //it will have one field inside with icons dropdown
    foreach ($chandelier_elated_IconCollections->iconCollections as $collection_key => $collection_object) {
        $icons_array = $collection_object->getIconsArray();

        //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
        $icon_collections_keys = $chandelier_elated_IconCollections->getIconCollectionsKeys();

        //unset current one, because it doesn't have to be included in dependency that hides icon container
        unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

        $button1_icon_hide_values = $icon_collections_keys;
        $button1_icon_hide_values[] = "no_icon";
        $button1_icon_container = chandelier_elated_add_admin_container(array(
            'name' => "button1_icon_".$collection_object->param."_container",
            'parent' => $buttons_style_meta_box,
            'hidden_property' => 'eltd_button1_icon_pack',
            'hidden_value' => '',
            'hidden_values' => $button1_icon_hide_values
        ));

        chandelier_elated_add_meta_box_field(
            array(
                'name'        => "button1_icon_".$collection_object->param,
                'type'        => 'select',
                'label'       => 'Button 1 Icon',
                'parent'      => $button1_icon_container,
                'options'     => $icons_array
            )
        );
    }

}

chandelier_elated_add_admin_section_title(
    array(
        'parent' => $buttons_style_meta_box,
        'name' => 'eltd_button_2_styling_title',
        'title' => 'Button 2'
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_size2',
        'type'        => 'selectblank',
        'parent'      => $buttons_style_meta_box,
        'label'       => 'Size',
        'description' => 'Choose button size',
        'default_value' => '',
        'options'     => array(
            "" => "Default",
            "small" => "Small",
            "medium" => "Medium",
            "large" => "Large",
            "huge" => "Extra Large",
            "huge-full-width" => "Extra Large Full Width"
        )
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_type2',
        'type'        => 'selectblank',
        'parent'      => $buttons_style_meta_box,
        'label'       => 'Type',
        'description' => 'Choose button type',
        'default_value' => '',
        'options'     => array(
            "" => "Default",
            "outline" => "Outline",
            "solid" => "Solid"
        )
    )
);

$buttons2_style_group_1 = chandelier_elated_add_admin_group(array(
    'title' => 'Text Style',
    'description' => 'Define text style',
    'name' => 'eltd_buttons2_style_group_1',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons2_style_group_1
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_font_size2',
        'type'        => 'textsimple',
        'label'       => 'Text Size(px)',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_font_weight2',
        'type'        => 'selectblanksimple',
        'label'       => 'Font Weight',
        'parent'      => $row1,
        'options'     => $chandelier_elated_options_fontweight
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_text_color2',
        'type'        => 'colorsimple',
        'label'       => 'Text Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_text_hover_color2',
        'type'        => 'colorsimple',
        'label'       => 'Text Hover Color',
        'parent'      => $row1
    )
);

$buttons2_style_group_2 = chandelier_elated_add_admin_group(array(
    'title' => 'Background',
    'description' => 'Define background',
    'name' => 'eltd_buttons2_style_group_2',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons2_style_group_2
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_background_color2',
        'type'        => 'colorsimple',
        'label'       => 'Background Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_background_hover_color2',
        'type'        => 'colorsimple',
        'label'       => 'Background Hover Color',
        'parent'      => $row1
    )
);

$buttons2_style_group_4 = chandelier_elated_add_admin_group(array(
    'title' => 'Border',
    'description' => 'Define border style',
    'name' => 'eltd_buttons2_style_group_4',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons2_style_group_4
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_border_color2',
        'type'        => 'colorsimple',
        'label'       => 'Border Color',
        'parent'      => $row1
    )
);

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_border_hover_color2',
        'type'        => 'colorsimple',
        'label'       => 'Border Hover Color',
        'parent'      => $row1
    )
);

$buttons2_style_group_5 = chandelier_elated_add_admin_group(array(
    'title' => 'Margin (px)',
    'description' => 'Please insert margin in format (top right bottom left) i.e. 5px 5px 5px 5px',
    'name' => 'eltd_buttons2_style_group_5',
    'parent' => $buttons_style_meta_box
));

$row1 = chandelier_elated_add_admin_row(array(
    'name' => 'row1',
    'parent' => $buttons2_style_group_5
));

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_slide_button_margin2',
        'type'        => 'textsimple',
        'label'       => '',
        'parent'      => $row1
    )
);

//init icon pack hide and show array. It will be populated dinamically from collections array
$button2_icon_pack_hide_array = array();
$button2_icon_pack_show_array = array();

//do we have some collection added in collections array?
if(is_array($chandelier_elated_IconCollections->iconCollections) && count($chandelier_elated_IconCollections->iconCollections)) {
    //get collections params array. It will contain values of 'param' property for each collection
    $button2_icon_collections_params = $chandelier_elated_IconCollections->getIconCollectionsParams();

    //foreach collection generate hide and show array
    foreach ($chandelier_elated_IconCollections->iconCollections as $dep_collection_key => $dep_collection_object) {
        $button2_icon_pack_hide_array[$dep_collection_key] = '';
        $button2_icon_pack_hide_array["no_icon"] = "";

        //button2_icon_size is input that is always shown when some icon pack is activated and hidden if 'no_icon' is selected
        $button2_icon_pack_hide_array["no_icon"] .= "#eltd_slider_button2_icon_size,";

        //we need to include only current collection in show string as it is the only one that needs to show
        $button2_icon_pack_show_array[$dep_collection_key] = '#eltd_slider_button2_icon_size, #eltd_button2_icon_'.$dep_collection_object->param.'_container';

        //for all collections param generate hide string
        foreach ($button2_icon_collections_params as $button2_icon_collections_param) {
            //we don't need to include current one, because it needs to be shown, not hidden
            if($button2_icon_collections_param !== $dep_collection_object->param) {
                $button2_icon_pack_hide_array[$dep_collection_key].= '#eltd_button2_icon_'.$button2_icon_collections_param.'_container,';
            }

            $button2_icon_pack_hide_array["no_icon"] .= '#eltd_button2_icon_'.$button2_icon_collections_param.'_container,';
        }

        //remove remaining ',' character
        $button2_icon_pack_hide_array[$dep_collection_key] = rtrim($button2_icon_pack_hide_array[$dep_collection_key], ',');
        $button2_icon_pack_hide_array["no_icon"] = rtrim($button2_icon_pack_hide_array["no_icon"], ',');
    }

}

chandelier_elated_add_meta_box_field(
    array(
        'name'        => 'eltd_button2_icon_pack',
        'type'        => 'select',
        'label'       => 'Button 2 Icon Pack',
        'description' => 'Choose icon pack for the first button',
        'default_value' => 'no_icon',
        'parent'      => $buttons_style_meta_box,
        'options'     => $chandelier_elated_IconCollections->getIconCollectionsEmpty("no_icon"),
        'args'        => array(
            "dependence" => true,
            "hide" => $button2_icon_pack_hide_array,
            "show" => $button2_icon_pack_show_array
        )
    )
);

if(is_array($chandelier_elated_IconCollections->iconCollections) && count($chandelier_elated_IconCollections->iconCollections)) {
    //foreach icon collection we need to generate separate container that will have dependency set
    //it will have one field inside with icons dropdown
    foreach ($chandelier_elated_IconCollections->iconCollections as $collection_key => $collection_object) {
        $icons_array = $collection_object->getIconsArray();

        //get icon collection keys (keys from collections array, e.g 'font_awesome', 'font_elegant' etc.)
        $icon_collections_keys = $chandelier_elated_IconCollections->getIconCollectionsKeys();

        //unset current one, because it doesn't have to be included in dependency that hides icon container
        unset($icon_collections_keys[array_search($collection_key, $icon_collections_keys)]);

        $button2_icon_hide_values = $icon_collections_keys;
        $button2_icon_hide_values[] = "no_icon";
        $button2_icon_container = chandelier_elated_add_admin_container(array(
            'name' => "button2_icon_".$collection_object->param."_container",
            'parent' => $buttons_style_meta_box,
            'hidden_property' => 'eltd_button2_icon_pack',
            'hidden_value' => '',
            'hidden_values' => $button2_icon_hide_values
        ));

        chandelier_elated_add_meta_box_field(
            array(
                'name'        => "button2_icon_".$collection_object->param,
                'type'        => 'select',
                'label'       => 'Button 2 Icon',
                'parent'      => $button2_icon_container,
                'options'     => $icons_array
            )
        );
    }

}


//Slide Content Positioning

$content_positioning_meta_box = chandelier_elated_add_meta_box(
    array(
        'scope' => array('slides'),
        'title' => 'Slide Content Positioning',
        'name' => 'eltd_content_positioning_settings'
    )
);

    chandelier_elated_add_meta_box_field(
        array(
            'parent' => $content_positioning_meta_box,
            'type' => 'selectblank',
            'name' => 'eltd_slide_content_alignment',
            'default_value' => '',
            'label' => 'Text Alignment',
            'description' => 'Choose an alignment for the slide text',
            'options' => array(
                "left" => "Left",
                "center" => "Center",
                "right" => "Right"
            )
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'parent' => $content_positioning_meta_box,
            'type' => 'selectblank',
            'name' => 'eltd_slide_separate_text_graphic',
            'default_value' => 'no',
            'label' => 'Separate Graphic and Text Positioning',
            'description' => 'Do you want to separately position graphic and text?',
            'options' => array(
                "no" => "No",
                "yes" => "Yes"
            ),
            'args' => array(
                "dependence" => true,
                "hide" => array(
                    "" => "#eltd_eltd_slide_graphic_positioning_container",
                    "no" => "#eltd_eltd_slide_graphic_positioning_container, #eltd_eltd_content_vertical_positioning_group_container"
                ),
                "show" => array(
                    "yes" => "#eltd_eltd_slide_graphic_positioning_container, #eltd_eltd_content_vertical_positioning_group_container"
                )
            )
        )
    );

    chandelier_elated_add_meta_box_field(
        array(
            'name' => 'eltd_slide_content_vertical_middle',
            'type' => 'yesno',
            'default_value' => 'no',
            'label' => 'Vertically Align Content to Middle',
            'parent' => $content_positioning_meta_box,
            'args' => array(
                "dependence" => true,
                "dependence_hide_on_yes" => "#eltd_eltd_slide_content_vertical_middle_no_container",
                "dependence_show_on_yes" => "#eltd_eltd_slide_content_vertical_middle_yes_container"
            )
        )
    );

    $slide_content_vertical_middle_yes_container = chandelier_elated_add_admin_container(array(
        'name' => 'eltd_slide_content_vertical_middle_yes_container',
        'parent' => $content_positioning_meta_box,
        'hidden_property' => 'eltd_slide_content_vertical_middle',
        'hidden_value' => 'no'
    ));

        chandelier_elated_add_meta_box_field(
            array(
                'parent' => $slide_content_vertical_middle_yes_container,
                'type' => 'selectblank',
                'name' => 'eltd_slide_content_vertical_middle_type',
                'default_value' => '',
                'label' => 'Align Content Vertically Relative to the Height Measured From',
                'options' => array(
                    "bottom_of_header" => "Bottom of Header",
                    "window_top" => "Window Top"
                )
            )
        );

        chandelier_elated_add_meta_box_field(
            array(
                'name' => 'eltd_slide_vertical_content_full_width',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Content Holder Full Width',
                'description' => 'Do you want to set slide content holder to full width?',
                'parent' => $slide_content_vertical_middle_yes_container
            )
        );

        chandelier_elated_add_meta_box_field(
            array(
                'name'        => 'eltd_slide_vertical_content_width',
                'type'        => 'text',
                'label'       => 'Content Width',
                'description' => 'Enter Width for Content Area',
                'parent'      => $slide_content_vertical_middle_yes_container,
                'args' => array(
                    'col_width' => 2,
                    'suffix' => '%'
                )
            )
        );

        $group_space_around_content = chandelier_elated_add_admin_group(array(
            'title' => 'Space Around Content in Slide',
            'name' => 'group_space_around_content',
            'parent' => $slide_content_vertical_middle_yes_container
        ));

            $row1 = chandelier_elated_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_space_around_content
            ));

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_vertical_content_left',
                        'type'        => 'textsimple',
                        'label'       => 'From Left',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_vertical_content_right',
                        'type'        => 'textsimple',
                        'label'       => 'From Right',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

    $slide_content_vertical_middle_no_container = chandelier_elated_add_admin_container(array(
        'name' => 'eltd_slide_content_vertical_middle_no_container',
        'parent' => $content_positioning_meta_box,
        'hidden_property' => 'eltd_slide_content_vertical_middle',
        'hidden_value' => 'yes'
    ));

        chandelier_elated_add_meta_box_field(
            array(
                'name' => 'eltd_slide_content_full_width',
                'type' => 'yesno',
                'default_value' => 'no',
                'label' => 'Content Holder Full Width',
                'description' => 'Do you want to set slide content holder to full width?',
                'parent' => $slide_content_vertical_middle_no_container,
                'args' => array(
                    "dependence" => true,
                    "dependence_hide_on_yes" => "#eltd_eltd_slide_content_width_container",
                    "dependence_show_on_yes" => ""
                )
            )
        );

        $slide_content_width_container = chandelier_elated_add_admin_container(array(
            'name' => 'eltd_slide_content_width_container',
            'parent' => $slide_content_vertical_middle_no_container,
            'hidden_property' => 'eltd_slide_content_full_width',
            'hidden_value' => 'yes'
        ));

            chandelier_elated_add_meta_box_field(
                array(
                    'name'        => 'eltd_slide_content_width',
                    'type'        => 'text',
                    'label'       => 'Content Holder Width',
                    'description' => 'Enter Width for Content Holder Area',
                    'parent'      => $slide_content_width_container,
                    'args' => array(
                        'col_width' => 2,
                        'suffix' => '%'
                    )
                )
            );

        $group_space_around_content = chandelier_elated_add_admin_group(array(
            'title' => 'Space Around Content in Slide',
            'name' => 'group_space_around_content',
            'parent' => $slide_content_vertical_middle_no_container
        ));

            $row1 = chandelier_elated_add_admin_row(array(
                'name' => 'row1',
                'parent' => $group_space_around_content
            ));

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_content_top',
                        'type'        => 'textsimple',
                        'label'       => 'From Top',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_content_left',
                        'type'        => 'textsimple',
                        'label'       => 'From Left',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_content_bottom',
                        'type'        => 'textsimple',
                        'label'       => 'From Bottom',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_content_right',
                        'type'        => 'textsimple',
                        'label'       => 'From Right',
                        'parent'      => $row1,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );

            $row2 = chandelier_elated_add_admin_row(array(
                'name' => 'row2',
                'parent' => $group_space_around_content
            ));

                $content_vertical_positioning_group_container = chandelier_elated_add_admin_container_no_style(array(
                    'name' => 'eltd_content_vertical_positioning_group_container',
                    'parent' => $row2,
                    'hidden_property' => 'eltd_slide_separate_text_graphic',
                    'hidden_value' => 'no'
                ));

                    chandelier_elated_add_meta_box_field(
                        array(
                            'name'        => 'eltd_slide_text_width',
                            'type'        => 'textsimple',
                            'label'       => 'Text Holder Width',
                            'parent'      => $content_vertical_positioning_group_container,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

        $slide_graphic_positioning_container = chandelier_elated_add_admin_container(array(
            'name' => 'eltd_slide_graphic_positioning_container',
            'parent' => $slide_content_vertical_middle_no_container,
            'hidden_property' => 'eltd_slide_separate_text_graphic',
            'hidden_value' => 'no'
        ));

            chandelier_elated_add_meta_box_field(
                array(
                    'parent' => $slide_graphic_positioning_container,
                    'type' => 'selectblank',
                    'name' => 'eltd_slide_graphic_alignment',
                    'default_value' => 'left',
                    'label' => 'Choose an alignment for the slide graphic',
                    'options' => array(
                        "left" => "Left",
                        "center" => "Center",
                        "right" => "Right"
                    )
                )
            );

            $group_graphic_positioning = chandelier_elated_add_admin_group(array(
                'title' => 'Graphic Positioning',
                'description' => 'Positioning for slide graphic',
                'name' => 'group_graphic_positioning',
                'parent' => $slide_graphic_positioning_container
            ));

                $row1 = chandelier_elated_add_admin_row(array(
                    'name' => 'row1',
                    'parent' => $group_graphic_positioning
                ));

                    chandelier_elated_add_meta_box_field(
                        array(
                            'name'        => 'eltd_slide_graphic_top',
                            'type'        => 'textsimple',
                            'label'       => 'From Top',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    chandelier_elated_add_meta_box_field(
                        array(
                            'name'        => 'eltd_slide_graphic_left',
                            'type'        => 'textsimple',
                            'label'       => 'From Left',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    chandelier_elated_add_meta_box_field(
                        array(
                            'name'        => 'eltd_slide_graphic_bottom',
                            'type'        => 'textsimple',
                            'label'       => 'From Bottom',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

                    chandelier_elated_add_meta_box_field(
                        array(
                            'name'        => 'eltd_slide_graphic_right',
                            'type'        => 'textsimple',
                            'label'       => 'From Right',
                            'parent'      => $row1,
                            'args' => array(
                                'col_width' => 2,
                                'suffix' => '%'
                            )
                        )
                    );

            $row2 = chandelier_elated_add_admin_row(array(
                'name' => 'row2',
                'parent' => $group_graphic_positioning
            ));

                chandelier_elated_add_meta_box_field(
                    array(
                        'name'        => 'eltd_slide_graphic_width',
                        'type'        => 'textsimple',
                        'label'       => 'Graphic Holder Width',
                        'parent'      => $row2,
                        'args' => array(
                            'col_width' => 2,
                            'suffix' => '%'
                        )
                    )
                );