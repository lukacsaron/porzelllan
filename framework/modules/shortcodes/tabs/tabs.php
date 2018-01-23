<?php
namespace Chandelier\Modules\Tabs;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class Tabs
 */

class Tabs implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'eltd_tabs';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	public function vcMap() {

		vc_map( array(
			'name' => 'Tabs',
			'base' => $this->getBase(),
			'as_parent' => array('only' => 'eltd_tab'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by ELATED',
			'icon' => 'icon-wpb-call-to-action extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin-label' => true,
					'heading' => 'Type',
					'param_name' => 'type',
					'value' => array(
						'Horizontal With Text' => 'horizontal_with_text',
						'Vertical With Text' => 'vertical_with_text'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin-label' => true,
					'heading' => 'Style',
					'param_name' => 'horizontal_tab_style',
					'value' => array(
						'Boxed' => 'boxed',
						'Transparent' => 'transparent'
					),
					'save_always' => true,
					'dependency' => array(
						'element' => 'type',
						'value'  => array('horizontal_with_text')
					),
					'description' => ''
				)
			)
		));

	}

	public function render($atts, $content = null) {
		$args = array(
			'type' => 'horizontal with_text',
			'horizontal_tab_style' => 'boxed'
		);
		
		$args = array_merge($args, chandelier_elated_icon_collections()->getShortcodeParams());
        $params  = shortcode_atts($args, $atts);
		
		extract($params);
		
		// Extract tab titles
		preg_match_all('/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}
		
		$tab_title_array = array();
		
		foreach($tab_titles as $tab) {
			preg_match('/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}
		
		$params['tabs_titles'] = $tab_title_array;
		$params['tab_class'] = $this->getTabClass($params); 
		$params['content'] = $content;
		$tabs_type = 'with_text';
		
		$output = '';
		
		$output .= chandelier_elated_get_shortcode_module_template_part('templates/'.$tabs_type,'tabs', '', $params);
		
		return $output;
		}
		
		
		/**
		   * Generates tabs class
		   *
		   * @param $params
		   *
		   * @return string
		   */
		private function getTabClass($params){
			$tabStyle = $params['type'];
			$horizontal_tab_type = $params['horizontal_tab_style'];
			
			$tabClass = array();
			
			switch ($tabStyle) {
				case 'horizontal_with_text':
					$tabClass[] = 'eltd-horizontal';
					$tabClass[] = 'eltd-tab-text';
					break;
				case 'vertical_with_text':
					$tabClass[] = 'eltd-vertical';
					$tabClass[] = 'eltd-tab-text';
					break;
			}
			if(in_array('eltd-horizontal', $tabClass)){
				
				if($horizontal_tab_type != ''){
					
					if($horizontal_tab_type == 'boxed'){
						$tabClass[] = 'eltd-tab-boxed';
					}
					
					elseif($horizontal_tab_type == 'transparent'){
						$tabClass[] = 'eltd-tab-transparent';
					}
						
				}
				
			}
			
			return implode(' ',$tabClass);
		}
}