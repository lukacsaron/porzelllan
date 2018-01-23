<?php
namespace Chandelier\Modules\Counter;

use Chandelier\Modules\Shortcodes\Lib\ShortcodeInterface;
/**
 * Class Countdown
 */
class Countdown implements ShortcodeInterface {

	/**
	 * @var string
	 */
	private $base;

	public function __construct() {
		$this->base = 'eltd_countdown';

		add_action('vc_before_init', array($this, 'vcMap'));
	}

	/**
	 * Returns base for shortcode
	 * @return string
	 */
	public function getBase()
	{
		return $this->base;
	}

	/**
	 * Maps shortcode to Visual Composer. Hooked on vc_before_init
	 *
	 * @see eltd_core_get_carousel_slider_array_vc()
	 */
	public function vcMap() {

		vc_map( array(
			'name' => 'Countdown',
			'base' => $this->getBase(),
			'category' => 'by ELATED',
			'admin_enqueue_css' => array(chandelier_elated_get_skin_uri().'/assets/css/eltd-vc-extend.css'),
			'icon' => 'icon-wpb-countdown extended-custom-icon',
			'allowed_container_element' => 'vc_row',
			'params' => array(
				array(
					'type' => 'dropdown',
					'heading' => 'Year',
					'param_name' => 'year',
					'value' => array(
						'' => '',
						'2015' => '2015',
						'2016' => '2016',
						'2017' => '2017',
						'2018' => '2018',
						'2019' => '2019',
						'2020' => '2020'
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Month',
					'param_name' => 'month',
					'value' => array(
						'' => '',
						'January' => '1',
						'February' => '2',
						'March' => '3',
						'April' => '4',
						'May' => '5',
						'June' => '6',
						'July' => '7',
						'August' => '8',
						'September' => '9',
						'October' => '10',
						'November' => '11',
						'December' => '12'
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Day',
					'param_name' => 'day',
					'value' => array(
						'' => '',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Hour',
					'param_name' => 'hour',
					'value' => array(
						'' => '',
						'0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24'
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Minute',
					'param_name' => 'minute',
					'value' => array(
						'' => '',
						'0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						'13' => '13',
						'14' => '14',
						'15' => '15',
						'16' => '16',
						'17' => '17',
						'18' => '18',
						'19' => '19',
						'20' => '20',
						'21' => '21',
						'22' => '22',
						'23' => '23',
						'24' => '24',
						'25' => '25',
						'26' => '26',
						'27' => '27',
						'28' => '28',
						'29' => '29',
						'30' => '30',
						'31' => '31',
						'32' => '32',
						'33' => '33',
						'34' => '34',
						'35' => '35',
						'36' => '36',
						'37' => '37',
						'38' => '38',
						'39' => '39',
						'40' => '40',
						'41' => '41',
						'42' => '42',
						'43' => '43',
						'44' => '44',
						'45' => '45',
						'46' => '46',
						'47' => '47',
						'48' => '48',
						'49' => '49',
						'50' => '50',
						'51' => '51',
						'52' => '52',
						'53' => '53',
						'54' => '54',
						'55' => '55',
						'56' => '56',
						'57' => '57',
						'58' => '58',
						'59' => '59',
						'60' => '60',
					),
					'admin_label' => true,
					'save_always' => true
				),
				array(
					'type' => 'textfield',
					'heading' => 'Month Label',
					'param_name' => 'month_label',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Day Label',
					'param_name' => 'day_label',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Hour Label',
					'param_name' => 'hour_label',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Minute Label',
					'param_name' => 'minute_label',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Second Label',
					'param_name' => 'second_label',
					'description' => ''
				),
				array(
					'type' => 'textfield',
					'heading' => 'Digit Font Size (px)',
					'param_name' => 'digit_font_size',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'textfield',
					'heading' => 'Label Font Size (px)',
					'param_name' => 'label_font_size',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Digit Color',
					'param_name' => 'digit_color',
					'description' => '',
					'group' => 'Design Options'
				),
				array(
					'type' => 'colorpicker',
					'heading' => 'Label Color',
					'param_name' => 'label_color',
					'description' => '',
					'group' => 'Design Options'
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
	public function render($atts, $content = null)
	{

		$args = array(
			'year' => '',
			'month' => '', 
			'day' => '',
			'hour' => '',
			'minute' => '',
			'month_label' => 'Months',
			'day_label' => 'Days',
			'hour_label' => 'Hours',
			'minute_label' => 'Minutes',
			'second_label' => 'Seconds',
			'digit_font_size' => '',
			'label_font_size' => '',
			'digit_color' => '',
			'label_color' => '',
		);

		$params = shortcode_atts($args, $atts);

		$params['id'] = mt_rand(1000, 9999);
		$params['countdown_data'] = $this->getCountdownData($params);

		//Get HTML from template
		$html = chandelier_elated_get_shortcode_module_template_part('templates/countdown-template', 'countdown', '', $params);

		return $html;

	}

	private function getCountdownData($params) {

		$countdown_data = array();

		$countdown_data['data-year'] = ($params['year'] !== '') ? $params['year'] : '';
		$countdown_data['data-month'] = ($params['month'] !== '') ? $params['month'] : '';
		$countdown_data['data-day'] = ($params['day'] !== '') ? $params['day'] : '';
		$countdown_data['data-hour'] = ($params['hour'] !== '') ? $params['hour'] : '';
		$countdown_data['data-minute'] = ($params['minute'] !== '') ? $params['minute'] : '';
		$countdown_data['data-timezone'] = get_option('gmt_offset');;
		$countdown_data['data-month-label'] = ($params['month_label'] !== '') ? $params['month_label'] : '';
		$countdown_data['data-day-label'] = ($params['day_label'] !== '') ? $params['day_label'] : '';
		$countdown_data['data-hour-label'] = ($params['hour_label'] !== '') ? $params['hour_label'] : '';
		$countdown_data['data-minute-label'] = ($params['minute_label'] !== '') ? $params['minute_label'] : '';
		$countdown_data['data-second-label'] = ($params['second_label'] !== '') ? $params['second_label'] : '';
		$countdown_data['data-digit-size'] = ($params['digit_font_size'] !== '') ? $params['digit_font_size'] : '';
		$countdown_data['data-label-size'] = ($params['label_font_size'] !== '') ? $params['label_font_size'] : '';
		$countdown_data['data-digit-color'] = ($params['digit_color'] !== '') ? $params['digit_color'] : '';
		$countdown_data['data-label-color'] = ($params['label_color'] !== '') ? $params['label_color'] : '';

		return $countdown_data;

	}


}