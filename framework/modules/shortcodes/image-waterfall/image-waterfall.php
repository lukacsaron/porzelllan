<?php
namespace Chandelier\Modules\ImageWaterfall;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

class ImageWaterfall implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'eltd_image_waterfall';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {
		vc_map( array(
			"name" => "Image Waterfall",
			"base" => $this->base,
			"icon" => "icon-wpb-img-waterfall-holder extended-custom-icon",
			"category" => 'by ELATED',
			"as_parent" => array('only' => 'eltd_image_waterfall_item, eltd_image_waterfall_heading'),
			"js_view" => 'VcColumnView',
			"params" => array(
				array(
					"type" => "attach_image",
					"holder" => "div",
					"class" => "",
					"value" => "",
					"heading" => "Background Image",
					"param_name" => "bgnd_image",
				),
				array(
					'type' => 'dropdown',
					'class' => '',
					'heading' => 'Show Scroll-Down Message?',
					'param_name' => 'show_scroll_down',
					'value' => array(
						'No' => 'no',
						'Yes' => 'yes'
					),
					'save_always' => true,
					'description' => 'The message is shown on the first item and fades out after scrolling starts.'
				)
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
			'bgnd_image' => '',
			'show_scroll_down' => '',
        );

        extract(shortcode_atts($args, $atts));

        $the_image = wp_get_attachment_image_src($bgnd_image,'full');

        if ($show_scroll_down == 'yes') {
        	$scroll_down_html = 
        		'[eltd_icon icon_pack="simple_line_icons" simple_line_icons="icon-mouse" size="eltd-icon-tiny" custom_size="49" type="normal" icon_animation="" icon_color="#c8a482" hover_icon_color="#c8a482"]' .
        		'[vc_empty_space height="5px"]' .
        		'[eltd_custom_font font_family="Cabin" font_size="13" line_height="15" font_weight="700" letter_spacing="1" text_transform="Uppercase" text_align="center" content_custom_font="Scroll Down" color="#ffffff"]'
        	;
        }

        $html = "";

        $html .= 
            '<div class="eltd-image-waterfall">' .
                '<div class="eltd-iw-content" '. (!empty($bgnd_image) ? 'style="background-image: url(\''.$the_image[0].'\')"' : '') .'>' .
                	($show_scroll_down == 'yes' ? '<div class="eltd-iw-scroll-down">'.do_shortcode($scroll_down_html).'</div>' : '') .
                    do_shortcode($content) .
                '</div>' .
            '</div>'
        ;

        return $html;
	}
	
}
