<?php
namespace Chandelier\Modules\Tab;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Tab
 */

class Tab implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;
	function __construct() {
		$this->base = 'eltd_tab';
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
			'name' => 'Tab',
			'base' => $this->getBase(),
			'as_child' => array('only' => 'eltd_tabs'),
			'is_container' => true,
			'category' => 'by ELATED',
			'icon' => 'icon-wpb-call-to-action extended-custom-icon',
			'show_settings_on_create' => true,
			'js_view' => 'VcColumnView',
			'params' => array_merge(
				 \ChandelierIconCollections::get_instance()->getVCParamsArray(),
				array(
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'tab_title',
						'description' => ''
					)
				)
			)
		));

	}

	public function render($atts, $content = null) {
		
		$default_atts = array(
			'tab_title' => 'Tab'
		);
		
		$default_atts = array_merge($default_atts, chandelier_elated_icon_collections()->getShortcodeParams());
		$params       = shortcode_atts($default_atts, $atts);
		extract($params);
		
		$iconPackName = chandelier_elated_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $params[$iconPackName];
		$params['content'] = $content;
		
		$output = '';
		$output .= chandelier_elated_get_shortcode_module_template_part('templates/tab_content','tabs', '', $params);
		return $output;

	}
}