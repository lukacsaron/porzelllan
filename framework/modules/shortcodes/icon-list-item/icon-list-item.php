<?php
namespace Chandelier\Modules\IconListItem;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Icon List Item
 */

class IconListItem implements ShortcodeInterface{
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'eltd_icon_list_item';
		
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 */
	
	public function vcMap() {
		vc_map( array(
			'name' => 'Icon List Item',
			'base' => $this->base,
			'icon' => 'icon-wpb-icon-list-item extended-custom-icon',
			'category' => 'by ELATED',
			'params' => array_merge(
				\ChandelierIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type' => 'textfield',
						'heading' => 'Icon Size (px)',
						'param_name' => 'icon_size',
						'description' => ''
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Icon Color',
						'param_name' => 'icon_color',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'title',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Title size (px)',
						'param_name' => 'title_size',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Title Color',
						'param_name' => 'title_color',
						'description' => '',
						'dependency' => Array('element' => 'title', 'not_empty' => true)
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Text',
						'param_name' => 'text',
						'description' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => 'Text size (px)',
						'param_name' => 'text_size',
						'description' => '',
						'dependency' => Array('element' => 'text', 'not_empty' => true)
					),
					array(
						'type' => 'colorpicker',
						'heading' => 'Text Color',
						'param_name' => 'text_color',
						'description' => '',
						'dependency' => Array('element' => 'text', 'not_empty' => true)
					)
				)
			)
		) );

	}
	
	public function render($atts, $content = null) {
		$args = array(
            'icon_size' => '',
            'icon_color' => '',
            'title' => '',
            'title_color' => '',
            'title_size' => '',
			'text' => '',
            'text_color' => '',
            'text_size' => ''
        );

        $args = array_merge($args, chandelier_elated_icon_collections()->getShortcodeParams());
		
        $params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$iconPackName = chandelier_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$iconClasses = '';
		
		//generate icon holder classes
		$iconClasses .= 'eltd-icon-list-item-icon ';
		$iconClasses .= $params['icon_pack'];
		
		$params['icon_classes'] = $iconClasses;
		$params['icon'] = '';
		if(isset($params[$iconPackName])){
			$params['icon'] = $params[$iconPackName];
		}
		$params['icon_attributes']['style'] =  $this->getIconStyle($params);
		$params['title_style'] =  $this->getTitleStyle($params);
		$params['text_style'] =  $this->getTextStyle($params);

		//Get HTML from template
		$html = chandelier_elated_get_shortcode_module_template_part('templates/icon-list-item-template', 'icon-list-item', '', $params);
		return $html;
	}
	 /**
     * Generates icon styles
     *
     * @param $params
     *
     * @return array
     */
	private function getIconStyle($params){
		$iconStylesArray = array();
		if(!empty($params['icon_color'])) {
			$iconStylesArray[] = 'color:' . $params['icon_color'];
		}

		if (!empty($params['icon_size'])) {
			$iconStylesArray[] = 'font-size:' .chandelier_elated_filter_px( $params['icon_size']) . 'px';
		}
		
		 return implode(';', $iconStylesArray);
	}
	 /**
     * Generates title styles
     *
     * @param $params
     *
     * @return string
     */
	private function getTitleStyle($params){
		$titleStylesArray = array();
		if(!empty($params['title_color'])) {
			$titleStylesArray[] = 'color:' . $params['title_color'];
		}

		if (!empty($params['title_size'])) {
			$titleStylesArray[] = 'font-size:' .chandelier_elated_filter_px( $params['title_size']) . 'px';
		}
		
		 return implode(';', $titleStylesArray);
	}
	 /**
     * Generates text styles
     *
     * @param $params
     *
     * @return string
     */
	private function getTextStyle($params){
		$textStylesArray = array();
		if(!empty($params['text_color'])) {
			$textStylesArray[] = 'color:' . $params['text_color'];
		}

		if (!empty($params['text_size'])) {
			$textStylesArray[] = 'font-size:' .chandelier_elated_filter_px( $params['text_size']) . 'px';
		}
		
		 return implode(';', $textStylesArray);
	}

}