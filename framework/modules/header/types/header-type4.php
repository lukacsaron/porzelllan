<?php
namespace Chandelier\Modules\Header\Types;

use Chandelier\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Type 1 layout and option
 *
 * Class HeaderType4
 */
class HeaderType4 extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-type4';

        if(!is_admin()) {
            $logoAreaHeight       = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('logo_area_height_header_type4'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? chandelier_elated_filter_px($logoAreaHeight) : 220;

            add_action('wp', array($this, 'setHeaderHeightProps'));
        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['logo_area_in_grid'] = chandelier_elated_options()->getOptionValue('logo_area_in_grid_header_type4') == 'yes' ? true : false;

        $parameters = apply_filters('chandelier_elated_header_type4_parameters', $parameters);

        chandelier_elated_get_module_template_part('templates/types/'.$this->slug, $this->moduleName, '', $parameters);
    }

    /**
     * Sets header height properties after WP object is set up
     */
    public function setHeaderHeightProps(){
        $this->heightOfTransparency         = $this->calculateHeightOfTransparency();
        $this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
        $this->headerHeight                 = $this->calculateHeaderHeight();
    }

    /**
     * Returns total height of transparent parts of header
     *
     * @return int
     */
    public function calculateHeightOfTransparency() {
        $transparencyHeight = 0;

        if(chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type4') == '') {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_grid_background_color_header_type4') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type4') !== '1';
        } else {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type4') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_background_transparency_header_type4') !== '1';
        }

        if($logoAreaTransparent) {
            $transparencyHeight = $this->logoAreaHeight;

            if(chandelier_elated_is_top_bar_enabled() && chandelier_elated_is_top_bar_transparent()) {
                $transparencyHeight += chandelier_elated_get_top_bar_height();
            }
        }

        return $transparencyHeight;
    }

    public function calculateHeightOfCompleteTransparency() {
        $transparencyHeight = 0;

        if(chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type4') == '') {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_grid_background_color_header_type4') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type4') === '0';
        } else {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type4') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_background_transparency_header_type4') === '0';
        }

        if($logoAreaTransparent) {
            if(chandelier_elated_options()->getOptionValue('logo_area_height_header_type4') !== '') {
                $logoAreaHeight = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('logo_area_height_header_type4'));
            }

            $transparencyHeight = $logoAreaHeight;

            if(chandelier_elated_is_top_bar_enabled() && chandelier_elated_is_top_bar_completely_transparent()) {
                $transparencyHeight += chandelier_elated_get_top_bar_height();
            }
        }

        return $transparencyHeight;
    }

    public function calculateHeaderHeight() {
        $headerHeight = $this->logoAreaHeight;
        if(chandelier_elated_is_top_bar_enabled()) {
            $headerHeight += chandelier_elated_get_top_bar_height();
        }

        return $headerHeight;
    }

    /**
     * Returns global js variables of header
     *
     * @param $globalVariables
     * @return int|string
     */
    public function getGlobalJSVariables($globalVariables) {
        $global_variables['eltdLogoAreaHeight'] = $this->logoAreaHeight;
        $global_variables['eltdMenuAreaHeight'] = 0;

        return $globalVariables;
    }

    /**
     * Returns per page js variables of header
     *
     * @param $perPageVars
     * @return int|string
     */
    public function getPerPageJSVariables($perPageVars) {
        return $perPageVars;
    }
}