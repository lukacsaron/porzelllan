<?php
namespace Chandelier\Modules\PricingTables;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

class PricingTables implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'eltd_pricing_tables';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
				'name' => 'Pricing Tables',
				'base' => $this->base,
				'as_parent' => array('only' => 'eltd_pricing_table'),
				'content_element' => true,
				'category' => 'by ELATED',
				'icon' => 'icon-wpb-pricing-tables extended-custom-icon',
				'show_settings_on_create' => true,
				'params' => array(
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Columns',
						'param_name' => 'columns',
						'value' => array(
							'Two'       => 'eltd-two-columns',
							'Three'     => 'eltd-three-columns',
							'Four'      => 'eltd-four-columns',
						),
						'save_always' => true,
						'description' => ''
					),
					array(
						'type' => 'dropdown',
						'holder' => 'div',
						'class' => '',
						'heading' => 'Skin',
						'param_name' => 'skin',
						'value' => array(
							'Light'       => 'light',
							'Dark'     => 'dark'
						),
						'save_always' => true,
						'description' => ''
					)
				),
				'js_view' => 'VcColumnView'
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
			'columns'   => 'eltd-two-columns',
			'skin'		=> 'light'
		);
		
		$params = shortcode_atts($args, $atts);
		extract($params);
		$classes = $this->getClasses($params);
		
		$html = '<div class="eltd-pricing-tables clearfix '.$classes.'">'; 
		$html .= do_shortcode($content);      
		$html .= '</div>';

		return $html;
	}
	/**
	 * Pricing Table Classes
	 *
	 * @param $params
	 * @return array
	 */
	private function getClasses($params){
		$class = array();
		if(!empty($params['columns'])){
			$class[] = $params['columns'];
		}
		if(!empty($params['skin'])){
			if($params['skin'] == 'light'){
				$class[] = 'eltd-light-skin';
			}elseif($params['skin'] == 'dark'){
				$class[] = 'eltd-dark-skin';
			}			
		}
		return implode(' ', $class); 
	}
}
