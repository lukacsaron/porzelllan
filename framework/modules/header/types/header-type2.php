<?php
namespace Chandelier\Modules\Header\Types;

use Chandelier\Modules\Header\Lib\HeaderType;

class HeaderType2 extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;

    public function __construct() {
        $this->slug = 'header-type2';

        if(!is_admin()) {
            $logoAreaHeight       = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('logo_area_height_header_type2'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? chandelier_elated_filter_px($logoAreaHeight) : 220;

            $menuAreaHeight       = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('menu_area_height_header_type2'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 60;

            add_action('wp', array($this, 'setHeaderHeightProps'));
        }
    }

    /**
     * Loads template for header type
     *
     * @param array $parameters associative array of variables to pass to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['logo_area_in_grid'] = chandelier_elated_options()->getOptionValue('logo_area_in_grid_header_type2') == 'yes' ? true : false;
        $parameters['menu_area_in_grid'] = chandelier_elated_options()->getOptionValue('menu_area_in_grid_header_type2') == 'yes' ? true : false;

        $parameters = apply_filters('chandelier_elated_header_type2_parameters', $parameters);

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
     * @return mixed
     */
    public function calculateHeightOfTransparency() {

        $transparencyHeight = 0;

        if(chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type2') == '') {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_grid_background_color_header_type2') !== '' && chandelier_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type2') !== '1';
        } else {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type2') !== '' && chandelier_elated_options()->getOptionValue('logo_area_background_transparency_header_type2') !== '1';
        }

        $menuAreaTransparent = chandelier_elated_options()->getOptionValue('menu_area_background_color_header_type2') !== '' && chandelier_elated_options()->getOptionValue('menu_area_background_transparency_header_type2') !== '1';

        if($logoAreaTransparent || $menuAreaTransparent) {

            if($logoAreaTransparent) {
                $transparencyHeight += $this->logoAreaHeight;

                if($menuAreaTransparent) {
                    $transparencyHeight += $this->menuAreaHeight;

                    if(chandelier_elated_is_top_bar_enabled() && chandelier_elated_is_top_bar_transparent()) {
                        $transparencyHeight += chandelier_elated_get_top_bar_height();
                    }
                }
            }
        }

        return $transparencyHeight;
    }

    public function calculateHeightOfCompleteTransparency() {
        $transparencyHeight = 0;

        if(chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type2') == '') {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_grid_background_color_header_type2') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type2') === '0';
        } else {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type2') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_background_transparency_header_type2') === '0';
        }

        $menuAreaTransparent = chandelier_elated_options()->getOptionValue('menu_area_background_color_header_type2') !== '' &&
                               chandelier_elated_options()->getOptionValue('menu_area_background_transparency_header_type2') === '0';

        if($logoAreaTransparent || $menuAreaTransparent) {

            if($logoAreaTransparent) {
                $transparencyHeight += $this->logoAreaHeight;

                if($menuAreaTransparent) {
                    $transparencyHeight += $this->menuAreaHeight;

                    if(chandelier_elated_is_top_bar_enabled() && chandelier_elated_is_top_bar_completely_transparent()) {
                        $transparencyHeight += chandelier_elated_get_top_bar_height();
                    }
                }
            }
        }

        return $transparencyHeight;
    }

    public function calculateHeaderHeight() {
        $headerHeight = $this->logoAreaHeight + $this->menuAreaHeight;
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
        $global_variables['eltdMenuAreaHeight'] = $this->menuAreaHeight;

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