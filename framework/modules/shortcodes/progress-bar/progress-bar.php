<?php
namespace Chandelier\Modules\ProgressBar;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

class ProgressBar implements ShortcodeInterface{
	private $base;
	
	function __construct() {
		$this->base = 'eltd_progress_bar';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {

		vc_map( array(
			'name' => 'Progress Bar',
			'base' => $this->base,
			'icon' => 'icon-wpb-progress-bar extended-custom-icon',
			'category' => 'by ELATED',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Title',
					'param_name' => 'title',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Title Tag',
					'param_name' => 'title_tag',
					'value' => array(
						''   => '',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',	
						'h5' => 'h5',	
						'h6' => 'h6',	
					),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'admin_label' => true,
					'heading' => 'Percentage',
					'param_name' => 'percent',
					'description' => ''
				),	
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Percentage Type',
					'param_name' => 'percentage_type',
					'value' => array(
						'Floating'  => 'floating',
						'Static' => 'static'
					),
					'dependency' => Array('element' => 'percent', 'not_empty' => true)
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Background Color',
					'param_name' => 'background_color',
					'value' => '',
					'description' => '',
					'group'       => 'Design Options'
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Progress Bar Color',
					'param_name' => 'progress_bar_color',
					'value' => '',
					'description' => '',
					'group'       => 'Design Options',
				),
				array(
					'type' => 'colorpicker',
					'admin_label' => true,
					'heading' => 'Percent Color',
					'param_name' => 'percent_color',
					'value' => '',
					'description' => '',
					'group'       => 'Design Options',
				)
			)
		) );

	}

	public function render($atts, $content = null) {
		$args = array(
            'title' => '',
            'title_tag' => 'h6',
            'percent' => '100',
            'percentage_type' => 'floating',
			'background_color' => '',
			'progress_bar_color' => '',
			'percent_color' => '',
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		$headings_array = array('h2', 'h3', 'h4', 'h5', 'h6');

        //get correct heading value. If provided heading isn't valid get the default one
        $title_tag = (in_array($title_tag, $headings_array)) ? $title_tag : $args['title_tag'];
		
		$params['percentage_classes'] = $this->getPercentageClasses($params);
		$params['holder_style'] = $this->getHolderStyle($params);
		$params['bar_style'] = $this->getBarStyle($params);
		$params['percent_style'] = $this->getPercentStyle($params);

        //init variables
		$html = chandelier_elated_get_shortcode_module_template_part('templates/progress-bar-template', 'progress-bar', '', $params);
		
        return $html;
		
	}
	/**
    * Generates css classes for progress bar
    *
    * @param $params
    *
    * @return array
    */
	private function getPercentageClasses($params){
		
		$percentClassesArray = array();
		
		if(!empty($params['percentage_type']) !=''){
			
			if($params['percentage_type'] == 'floating'){
				
				$percentClassesArray[]= 'eltd-floating';
				$percentClassesArray[] = 'eltd-floating-outside';

			}
			elseif($params['percentage_type'] == 'static'){
				
				$percentClassesArray[] = 'eltd-static';
				
			}
		}
		return implode(' ', $percentClassesArray);
	}

	private function getHolderStyle($params) {
		$holder_style = array();

		$holder_style[] = ($params['background_color'] !== '') ? 'background-color: ' . $params['background_color'] : '';

		return $holder_style;
	}

	private function getBarStyle($params) {
		$bar_style = array();

		$bar_style[] = ($params['progress_bar_color'] !== '') ? 'background-color: ' . $params['progress_bar_color'] : '';

		return $bar_style;
	}

	private function getPercentStyle($params) {
		$percent_style = array();

		$percent_style[] = ($params['percent_color'] !== '') ? 'color: ' . $params['percent_color'] : '';

		return $percent_style;
	}
}