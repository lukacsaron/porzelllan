<?php

add_action('after_setup_theme', 'chandelier_elated_meta_boxes_map_init', 1);
function chandelier_elated_meta_boxes_map_init() {
    /**
    * Loades all meta-boxes by going through all folders that are placed directly in meta-boxes folder
    * and loads map.php file in each.
    *
    * @see http://php.net/manual/en/function.glob.php
    */

    do_action('chandelier_elated_before_meta_boxes_map');

	global $chandelier_elated_options;
	global $chandelier_elated_Framework;
	global $chandelier_elated_options_fontstyle;
	global $chandelier_elated_options_fontweight;
	global $chandelier_elated_options_texttransform;
	global $chandelier_elated_options_fontdecoration;
	global $chandelier_elated_options_arrows_type;

    foreach(glob(ELATED_FRAMEWORK_ROOT_DIR.'/admin/meta-boxes/*/map.php') as $meta_box_load) {
        include_once $meta_box_load;
    }

	do_action('chandelier_elated_meta_boxes_map');

	do_action('chandelier_elated_after_meta_boxes_map');
}