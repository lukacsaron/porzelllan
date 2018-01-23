<?php

if(!function_exists('chandelier_elated_is_responsive_on')) {
    /**
     * Checks whether responsive mode is enabled in theme options
     * @return bool
     */
    function chandelier_elated_is_responsive_on() {
        return chandelier_elated_options()->getOptionValue('responsiveness') !== 'no';
    }
}

if(!function_exists('chandelier_elated_is_seo_enabled')) {
    /**
     * Checks if SEO is enabled in theme options
     * @return bool
     */
    function chandelier_elated_is_seo_enabled() {
        return chandelier_elated_options()->getOptionValue('disable_seo') == 'no';
    }
}