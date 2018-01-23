<?php
namespace Chandelier\Modules\TeamHolder;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class TeamHolder
 */
class TeamHolder implements ShortcodeInterface
{
	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_team_holder';

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
	 *
	 * @see eltd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap()	{

		vc_map( array(
			'name' => 'Team Holder',
			'base' => $this->base,
			'category' => 'by ELATED',
			'as_parent' => array('only' => 'eltd_team'),
			'content_element' => true,
			'show_settings_on_create' => true,
			'icon' => 'icon-wpb-team extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array(
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Number of Columns',
						'param_name' => 'column_number',
						'value' => array(
							'Default'	=> 'five',
							'Three'		=> 'three',
							'Four'		=> 'four',
							'Five'		=> 'five'
						),
						'save_always' => true
					)
				)
		) );

	}

	/**
	 * Renders shortcodes HTML
	 *
	 * @param $atts array of shortcode params
	 * @param $content string shortcode content
	 * @return string
	 */
	public function render($atts, $content = null) {
		
		$args = array(
            'column_number' => 'five'
        );

        $params  = shortcode_atts($args, $atts);
		
		$params['content'] = $content;
		$params['holder_classes'] = $this->getClasses($params);
      
        $html = chandelier_elated_get_shortcode_module_template_part('templates/team-holder','team', '', $params);
		
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
		if($params['column_number'] == 'three'){
			$class = 'eltd-team-three-columns';
		}
		elseif($params['column_number'] == 'four'){
			$class = 'eltd-team-four-columns';
		}
		elseif($params['column_number'] == 'five'){
			$class = 'eltd-team-five-columns';
		}
		return $class;
	}

}