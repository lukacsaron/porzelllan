<?php
namespace Chandelier\Modules\CoverBoxesItem;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class CoverBoxesItem
 */
class CoverBoxesItem implements ShortcodeInterface {
	
	/**
	 * @var string
	 */
	private $base;
	

	public function __construct() {
		$this->base = 'eltd_cover_boxes_item';

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
			'name' => 'Cover Boxes Item',
			'base' => $this->base,
			'icon' => 'icon-wpb-cover-boxes extended-custom-icon',
			'as_child' => array('only' => 'eltd_cover_boxes_holder'),
			'category' => 'by ELATED',
			'icon' => 'icon-wpb-call-to-action extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
					array(
						'type' => 'attach_image',
						'admin_label' => true,
						'heading' => 'Image',
						'param_name' => 'image'
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Title',
						'param_name' => 'title',
						'value' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => false,
						'heading' => 'Text',
						'param_name' => 'text',
						'value' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Link',
						'param_name' => 'link',
						'value' => ''
					),
					array(
						'type' => 'textfield',
						'admin_label' => true,
						'heading' => 'Link label',
						'param_name' => 'link_label',
						'value' => ''
					),
					array(
						'type' => 'dropdown',
						'admin_label' => true,
						'heading' => 'Target',
						'param_name' => 'target',
						'value' => array(
							'Self' => '_self',
							'Blank' => '_blank'
						),
						'save_always' => true,
						'description' => ''
					)
			)
		) );
	}
	
	public function render($atts, $content = null) {
		
		$args = array(
            'title' => '',
            'text' => '',
            'image' => '',
            'link' => 'javascrpit:void(0)',
            'link_label' => '',
            'target' => ''
        );

        $params  = shortcode_atts($args, $atts);
		extract($params);

		if ($target != "") {
            $target = $target;
        } else {
            $target = "_self";
        }
		
		$params['target'] = $target;
		$params['image_src'] = $this->getImage($params);
		$params['content'] = $content;
      
        $html = chandelier_elated_get_shortcode_module_template_part('templates/cover-boxes-item','cover-boxes', '', $params);
		
        return $html;
		
	}
	/**
	* Generate image src attribute
	*
	* @param $params
	*
	* @return string
	*/
	private function getImage($params){
		$image_src = '';
		if (is_numeric($params['image'])) {
            $image_src = wp_get_attachment_url($params['image']);
        } else {
            $image_src = $params['image'];
        }
		return $image_src;
	}
}