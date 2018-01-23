<?php
namespace Chandelier\Modules\CoverBoxesHolder;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class CoverBoxesHolder
 */
class CoverBoxesHolder implements ShortcodeInterface {
	
	/**
	 * @var string
	 */
	private $base;
	

	public function __construct() {
		$this->base = 'eltd_cover_boxes_holder';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap(){
		vc_map( array(
			'name' => 'Cover Boxes Holder',
			'base' => $this->base,			
			'as_parent' => array('only' => 'eltd_cover_boxes_item'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'category' => 'by ELATED',
			'icon' => 'icon-wpb-cover-boxes extended-custom-icon',
			'js_view' => 'VcColumnView',
			'params'  => array(
				array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Number of Columns',
						'param_name' => 'column_number',
						'value' => array(
							'Three' => 'three',
							'Two' => 'two'
						),
						'save_always' => true,
						'description' => ''
					)
			)
		) );
	}
	
	public function render($atts, $content = null) {
		
		$args = array(
            'column_number' => 'three'
        );

        $params  = shortcode_atts($args, $atts);
		
		$params['content'] = $content;
		$params['holder_classes'] = $this->getClasses($params);
      
        $html = chandelier_elated_get_shortcode_module_template_part('templates/cover-boxes-holder','cover-boxes', '', $params);
		
        return $html;
		
	}
	
	/**
	* Generate holder classes 
	*
	* @param $params
	*
	* @return string
	*/
	private function getClasses($params){
		$class = '';
		if($params['column_number'] == 'two'){
			$class = 'eltd-cover-two-columns';
		}elseif($params['column_number'] == 'three'){
			$class = 'eltd-cover-three-columns';
		}
		return $class;
	}
}