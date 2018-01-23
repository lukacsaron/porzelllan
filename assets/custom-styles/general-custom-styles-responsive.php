<?php
if(!function_exists('chandelier_elated_design_responsive_styles')) {
    /**
     * Generates general responsive custom styles
     */
    function chandelier_elated_design_responsive_styles() {

        $parallax_style = array();
        if (chandelier_elated_options()->getOptionValue('parallax_min_height') !== '') {
            $parallax_style['height'] = 'auto !important';
            $parallax_min_height = chandelier_elated_options()->getOptionValue('parallax_min_height');
            $parallax_style['min-height'] = chandelier_elated_filter_px($parallax_min_height) . 'px';
        }

		echo chandelier_elated_dynamic_css('.eltd-section.eltd-parallax-section-holder', $parallax_style);
    }

    add_action('chandelier_elated_style_dynamic_responsive_480', 'chandelier_elated_design_responsive_styles');
    add_action('chandelier_elated_style_dynamic_responsive_480_768', 'chandelier_elated_design_responsive_styles');
}
