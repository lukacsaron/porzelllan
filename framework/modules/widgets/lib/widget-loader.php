<?php

if (!function_exists('chandelier_elated_register_widgets')) {

	function chandelier_elated_register_widgets() {

		$widgets = array(
			'ChandelierLatestPosts',
			'ChandelierSearchOpener',
			'ChandelierSideAreaOpener',
			'ChandelierStickySidebar',
		);

		foreach ($widgets as $widget) {
			register_widget($widget);
		}

	}

}

add_action('widgets_init', 'chandelier_elated_register_widgets');