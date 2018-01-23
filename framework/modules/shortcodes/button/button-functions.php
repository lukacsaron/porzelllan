<?php

if(!function_exists('chandelier_elated_get_button_html')) {
    /**
     * Calls button shortcode with given parameters and returns it's output
     * @param $params
     *
     * @return mixed|string
     */
    function chandelier_elated_get_button_html($params) {
        $button_html = chandelier_elated_execute_shortcode('eltd_button', $params);
        $button_html = str_replace("\n", '', $button_html);
        return $button_html;
    }
}