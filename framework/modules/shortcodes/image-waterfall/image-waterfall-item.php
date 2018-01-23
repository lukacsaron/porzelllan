<?php
namespace Chandelier\Modules\ImageWaterfallItem;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

class ImageWaterfallItem implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'eltd_image_waterfall_item';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			"name" => "Image Waterfall Item",
			"base" => "eltd_image_waterfall_item",
			"category" => 'by ELATED',
			"as_child" => array('only' => 'eltd_image_waterfall'),
			"icon" => "icon-wpb-img-waterfall-item extended-custom-icon",
			"params" => array(
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Main Image",
					"param_name" => "main_image",
					"description" => "After setting the main image, you can add up to 4 side images."
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Background",
					"param_name" => "bgnd",
					"description" => "Image that fades in and out with scrolling."
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Logo",
					"param_name" => "logo",
					"description" => "Top-left image that fades in and out with scrolling."
				),
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Title',
                    'param_name'  => 'title',
                    'value'       => '',
                    'admin_label' => true,
					"description" => "The text to be displayed in foreground.",
					"dependency" => array('element' => 'main_image', 'not_empty' => true),
                ),
                array(
                    'type'        => 'colorpicker',
                    'heading'     => 'Title Color',
                    'param_name'  => 'title_color',
                    'value'       => '',
                    'admin_label' => true,
					"dependency" => array('element' => 'title', 'not_empty' => true),
                ),
                array(
                    'type'        => 'textfield',
                    'heading'     => 'Link',
                    'param_name'  => 'main_link',
                    'value'       => '',
                    'admin_label' => true,
					"description" => "The link on the main image.",
					"dependency" => array('element' => 'main_image', 'not_empty' => true),
                ),
                array(
                    'type'        => 'dropdown',
                    'heading'     => 'Link Target',
                    'param_name'  => 'main_target',
                    'admin_label' => true,
                    'value'       => array(
                        'Same window'  => '_self',
                        'New window' => '_blank'
                    ),
                    'save_always' => true,
                    'dependency'  => array('element' => 'main_link', 'not_empty' => true)
                ),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Side Image 1",
					"param_name" => "side_image_1",
					"dependency" => array('element' => 'main_image', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Top (%)",
					"param_name" => "side_image_1_top",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's height.",
					"dependency" => array('element' => 'side_image_1', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Left (%)",
					"param_name" => "side_image_1_left",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's width.",
					"dependency" => array('element' => 'side_image_1', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Width (%)",
					"param_name" => "side_image_1_width",
					"description" => "Width of this image relative to the main image's width, in percent.",
					"dependency" => array('element' => 'side_image_1', 'not_empty' => true),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Side Image 2",
					"param_name" => "side_image_2",
					"dependency" => array('element' => 'side_image_1', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Top (%)",
					"param_name" => "side_image_2_top",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's height.",
					"dependency" => array('element' => 'side_image_2', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Left (%)",
					"param_name" => "side_image_2_left",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's width.",
					"dependency" => array('element' => 'side_image_2', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Width (%)",
					"param_name" => "side_image_2_width",
					"description" => "Width of this image relative to the main image's width, in percent.",
					"dependency" => array('element' => 'side_image_2', 'not_empty' => true),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Side Image 3",
					"param_name" => "side_image_3",
					"dependency" => array('element' => 'side_image_2', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Top (%)",
					"param_name" => "side_image_3_top",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's height.",
					"dependency" => array('element' => 'side_image_3', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Left (%)",
					"param_name" => "side_image_3_left",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's width.",
					"dependency" => array('element' => 'side_image_3', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Width (%)",
					"param_name" => "side_image_3_width",
					"description" => "Width of this image relative to the main image's width, in percent.",
					"dependency" => array('element' => 'side_image_3', 'not_empty' => true),
				),
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"heading" => "Side Image 4",
					"param_name" => "side_image_4",
					"dependency" => array('element' => 'side_image_3', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Top (%)",
					"param_name" => "side_image_4_top",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's height.",
					"dependency" => array('element' => 'side_image_4', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Position - Left (%)",
					"param_name" => "side_image_4_left",
					"description" => "Distance of this image's top left corner from the top left corner of the main image, in percent of the main image's width.",
					"dependency" => array('element' => 'side_image_4', 'not_empty' => true),
				),
				array(
					"type" => "textfield",
					"holder" => "div",
					"class" => "",
					"heading" => "Image Width (%)",
					"param_name" => "side_image_4_width",
					"description" => "Width of this image relative to the main image's width, in percent.",
					"dependency" => array('element' => 'side_image_4', 'not_empty' => true),
				),
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
            'main_image' => '',
            'bgnd' => '',
            'logo' => '',
            'title' => '',
            'title_color' => '#000',
            'main_link' => '',
            'main_target' => '',
            'side_image_1' => '',
            'side_image_1_top' => '-25',
            'side_image_1_left' => '-25',
            'side_image_1_width' => '50',
            'side_image_2' => '',
            'side_image_2_top' => '-25',
            'side_image_2_left' => '75',
            'side_image_2_width' => '50',
            'side_image_3' => '',
            'side_image_3_top' => '75',
            'side_image_3_left' => '-25',
            'side_image_3_width' => '50',
            'side_image_4' => '',
            'side_image_4_top' => '75',
            'side_image_4_left' => '75',
            'side_image_4_width' => '50',
        );

        extract(shortcode_atts($args, $atts));

        $the_image = wp_get_attachment_image_src($main_image,'large');
        $the_bgnd = wp_get_attachment_image_src($bgnd,'full');
        $the_logo = wp_get_attachment_image_src($logo,'full');
        $the_image_1 = wp_get_attachment_image_src($side_image_1,'large');
        $the_image_2 = wp_get_attachment_image_src($side_image_2,'large');
        $the_image_3 = wp_get_attachment_image_src($side_image_3,'large');
        $the_image_4 = wp_get_attachment_image_src($side_image_4,'large');

        $button_shortcode_small = '[eltd_button size="small" type="outline" background_color="#c8a482" target="'.$main_target.'" icon_pack="" font_weight="" text=" '.esc_html__("Launch", "chandelier").' " link="'.$main_link.'"]';
        $button_shortcode_medium = '[eltd_button size="medium" type="outline" background_color="#c8a482" target="'.$main_target.'" icon_pack="" font_weight="" text=" '.esc_html__("Launch", "chandelier").' " link="'.$main_link.'"]';

        $html = "";

        $html .=    
            //'<div>' .
            	'<div class="eltd-iw-bgnd"'.(!empty($bgnd) ? ' style="background-image: url(\''.$the_bgnd[0].'\')"' : '').'></div>' .
            	(!empty($logo) ? '<img class="eltd-iw-logo" src="'.$the_logo[0].'">' : '') .
            	(!empty($side_image_1) && !empty($main_image) ? '<img class="eltd-iw-image side" src="'.$the_image_1[0].'" data-top="'.esc_attr($side_image_1_top).'" data-left="'.esc_attr($side_image_1_left).'" data-width="'.esc_attr($side_image_1_width).'">' : '') .
				(!empty($side_image_2) && !empty($main_image) ? '<img class="eltd-iw-image side" src="'.$the_image_2[0].'" data-top="'.esc_attr($side_image_2_top).'" data-left="'.esc_attr($side_image_2_left).'" data-width="'.esc_attr($side_image_2_width).'">' : '') .
				(!empty($side_image_3) && !empty($main_image) ? '<img class="eltd-iw-image side" src="'.$the_image_3[0].'" data-top="'.esc_attr($side_image_3_top).'" data-left="'.esc_attr($side_image_3_left).'" data-width="'.esc_attr($side_image_3_width).'">' : '') .
				(!empty($side_image_4) && !empty($main_image) ? '<img class="eltd-iw-image side" src="'.$the_image_4[0].'" data-top="'.esc_attr($side_image_4_top).'" data-left="'.esc_attr($side_image_4_left).'" data-width="'.esc_attr($side_image_4_width).'">' : '') .
            	(!empty($main_image) ? (!empty($main_link) ? '<a href="'.$main_link.'" target="'.$main_target.'">' : '').'<img class="eltd-iw-image main" src="'.$the_image[0].'">'.(!empty($main_link) ? '</a>' : '') : '') .
            	'<div class="eltd-iw-title '.(empty($title) ? 'empty' : '').'" style="'.(!empty($title_color) ? 'color: '.'white'.';' : '').'">'. 
            		'<div class="eltd-iw-title-inner">' .
            			'<div class="eltd-iw-title-shade"></div>'.
            			'<div class="eltd-iw-title-text">' .
            				'<div class="eltd-iw-title-text-inner">'.$title.'</div>' .
            				(!empty($main_link) ? do_shortcode($button_shortcode_small) : '') .
            				(!empty($main_link) ? do_shortcode($button_shortcode_medium) : '') .
            				//do_shortcode($button_shortcode) .
            			'</div>' .
        			'</div>' .
        			(!empty($main_link) ? '<a class="eltd-iw-overhover" href="'.$main_link.'" target="'.$main_target.'"></a>' : '') .
            		//'<a class="eltd-iw-overhover" href="//google.com" target=""></a>' .
    			'</div>'
            //'</div>'
        ;

        return $html;
	}
	
}