<?php
namespace Chandelier\Modules\ImageWaterfallHeading;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

class ImageWaterfallHeading implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'eltd_image_waterfall_heading';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			"name" => "Image Waterfall Heading",
			"base" => "eltd_image_waterfall_heading",
			"category" => 'by ELATED',
			"as_child" => array('only' => 'eltd_image_waterfall'),
			"as_parent" => array('only' => 'eltd_elements_holder'),
			"icon" => "icon-wpb-img-waterfall-heading extended-custom-icon",
			"js_view" => 'VcColumnView',
			"show_settings_on_create" => false,
			"params" => array(
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
        );

        extract(shortcode_atts($args, $atts));

        $html = "";

        $html .=
            	'<div class="eltd-iw-heading">'. 
            		do_shortcode($content) .
    			'</div>'
        ;

        return $html;
	}
	
}