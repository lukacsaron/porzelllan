<?php
namespace Chandelier\Modules\Header\Types;

use Chandelier\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Type 1 layout and option
 *
 * Class HeaderType1
 */
class HeaderType1 extends HeaderType {
    protected $heightOfTransparency;
    protected $heightOfCompleteTransparency;
    protected $headerHeight;

    /**
     * Sets slug property which is the same as value of option in DB
     */
    public function __construct() {
        $this->slug = 'header-type1';

        if(!is_admin()) {
            $logoAreaHeight       = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('logo_area_height_header_type1'));
            $this->logoAreaHeight = $logoAreaHeight !== '' ? chandelier_elated_filter_px($logoAreaHeight) : 220;

            $menuAreaHeight       = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('menu_area_height_header_type1'));
            $this->menuAreaHeight = $menuAreaHeight !== '' ? $menuAreaHeight : 60;

            add_action('wp', array($this, 'setHeaderHeightProps'));
        }
    }

    /**
     * Loads template file for this header type
     *
     * @param array $parameters associative array of variables that needs to passed to template
     */
    public function loadTemplate($parameters = array()) {

        $parameters['logo_area_in_grid'] = chandelier_elated_options()->getOptionValue('logo_area_in_grid_header_type1') == 'yes' ? true : false;
        $parameters['menu_area_in_grid'] = chandelier_elated_options()->getOptionValue('menu_area_in_grid_header_type1') == 'yes' ? true : false;

        $parameters = apply_filters('chandelier_elated_header_type1_parameters', $parameters);

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

        if(chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type1') == '') {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_grid_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type1') !== '1';
        } else {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_background_transparency_header_type1') !== '1';
        }

        if(chandelier_elated_options()->getOptionValue('menu_area_background_color_header_type1') == '') {
            $menuAreaTransparent = chandelier_elated_options()->getOptionValue('menu_area_grid_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('menu_area_grid_background_transparency_header_type1') !== '1';
        } else {
            $menuAreaTransparent = chandelier_elated_options()->getOptionValue('menu_area_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('menu_area_background_transparency_header_type1') !== '1';
        }

        if($logoAreaTransparent || $menuAreaTransparent) {
            if($logoAreaTransparent) {
                $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;

                if(chandelier_elated_is_top_bar_enabled() && chandelier_elated_is_top_bar_transparent()) {
                    $transparencyHeight += chandelier_elated_get_top_bar_height();
                }
            }

            if(!$logoAreaTransparent && $menuAreaTransparent) {
                $transparencyHeight = $this->menuAreaHeight;
            }
        }

        return $transparencyHeight;
    }

    /**
     * Returns height of completely transparent header parts
     *
     * @return int
     */
    public function calculateHeightOfCompleteTransparency() {
        $transparencyHeight = 0;

        if(chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type1') == '') {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_grid_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_grid_background_transparency_header_type1') === '0';
        } else {
            $logoAreaTransparent = chandelier_elated_options()->getOptionValue('logo_area_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('logo_area_background_transparency_header_type1') === '0';
        }

        if(chandelier_elated_options()->getOptionValue('menu_area_background_color_header_type1') == '') {
            $menuAreaTransparent = chandelier_elated_options()->getOptionValue('menu_area_grid_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('menu_area_grid_background_transparency_header_type1') === '0';
        } else {
            $menuAreaTransparent = chandelier_elated_options()->getOptionValue('menu_area_background_color_header_type1') !== '' &&
                                   chandelier_elated_options()->getOptionValue('menu_area_background_transparency_header_type1') === '0';
        }

        if($logoAreaTransparent || $menuAreaTransparent) {
            if($logoAreaTransparent) {
                $transparencyHeight = $this->logoAreaHeight + $this->menuAreaHeight;

                if(chandelier_elated_is_top_bar_enabled() && chandelier_elated_is_top_bar_completely_transparent()) {
                    $transparencyHeight += chandelier_elated_get_top_bar_height();
                }
            }

            if(!$logoAreaTransparent && $menuAreaTransparent) {
                $transparencyHeight = $this->menuAreaHeight;
            }
        }

        return $transparencyHeight;
    }


    /**
     * Returns total height of header
     *
     * @return int|string
     */
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