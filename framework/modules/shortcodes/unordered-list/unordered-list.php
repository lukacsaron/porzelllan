<?php
namespace Chandelier\Modules\UnorderedList;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class unordered List
 */
class UnorderedList implements ShortcodeInterface{

	private $base;

	function __construct() {
		$this->base='eltd_unordered_list';
		
		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**\
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	public function vcMap() {

		vc_map( array(
			'name' => 'List - Unordered',
			'base' => $this->base,
			'icon' => 'icon-wpb-unordered-list extended-custom-icon',
			'category' => 'by ELATED',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Style',
					'param_name' => 'style',
					'value' => array(
						'Default' => 'default',	
						'Circle' => 'circle',
						'Line'	 => 'line'
					),
					'save_always' => true,
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Title',
					'admin_label' => true,
					'param_name' => 'unordered_list_title',
					'value' => ''
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Font Weight',
					'param_name' => 'font_weight',
					'value' => array(
						'Default' => '',
						'Light' => 'light',
						'Normal' => 'normal',
						'Bold' => 'bold'
					),
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Padding left (px)',
					'param_name' => 'padding_left',
					'value' => ''
				),
				array(
					'type' => 'textarea_html',
					'heading' => 'Content',
					'param_name' => 'content',
					'value' => '<ul><li>Lorem Ipsum</li><li>Lorem Ipsum</li><li>Lorem Ipsum</li></ul>',
					'description' => ''
				),
				array(
					'type' => 'dropdown',
					'admin_label' => true,
					'heading' => 'Animate list on appear',
					'param_name' => 'animated_list',
					'value' => array(
						'Yes' => 'yes',	
						'No' => 'no'
					),
					'save_always' => true,
					'description' => 'Show list item one by one on appear.'
				)
			)
		) );

	}


	public function render($atts, $content = null) {
		$args = array(
            'style' => '',
            'font_weight' => '',
            'padding_left' => '',
            'animated_list' => '',
			'unordered_list_title'		=> ''
        );
		$params = shortcode_atts($args, $atts);
		
		//Extract params for use in method
		extract($params);
		
		$list_item_classes = "";

        if ($style != '') {
			if($style == 'circle'){
				$list_item_classes .= ' eltd-circle';
			}elseif ($style == 'line') {
				$list_item_classes .= ' eltd-line';
			}elseif ($style == 'default') {
				$list_item_classes .= ' eltd-default-type';
			}  
        }

        if ($animated_list =='yes') {
        	$list_item_classes .= ' eltd-animated-list';
        }
		
		$list_style = '';
		if($padding_left != '') {
			$list_style .= 'padding-left: ' . $padding_left .'px;';
		}
		$html = '';
		
        $html .= '<div class="eltd-unordered-list '.$list_item_classes.'" '.  chandelier_elated_get_inline_style($list_style).'>';
		
		if($unordered_list_title != ''){
			$html .= '<h6 class = "eltd-unordered-list-title">';
			$html .= esc_attr($unordered_list_title);
			$html .= '<span class = "eltd-unordered-list-title-separator"></span>';
			$html .= '</h6>';
		}
		
		$html .= do_shortcode($content);
		$html .= '</div>';
        return $html;
	}

}