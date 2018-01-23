<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$output = $after_output = $inner_start = $inner_end = $video_output = $after_wrapper_open = $before_wrapper_close = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );

$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
	'vc_row',
	'wpb_row', //deprecated
	'vc_row-fluid',
	'eltd-section',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);

$css_inner_classes = array('clearfix');

$wrapper_attributes = array();
$inner_attributes = array();
$wrapper_style = '';
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if(!empty($anchor)){
	$wrapper_attributes[] = 'data-eltd-anchor="' . esc_attr($anchor ) . '"';
}

if( ! empty($content_aligment)){
	$css_classes[] = 'eltd-content-aligment-' . $content_aligment;
}
if( ! empty($row_type) && $row_type == 'parallax'){
	$css_classes[] = 'eltd-parallax-section-holder';

	if(chandelier_elated_options()->getOptionValue('parallax_on_off') == 'off'){
		$css_classes[] = 'eltd-parallax-section-holder-touch-disabled';
	}
}
if($content_width == 'grid'){
	$css_classes[] =  'eltd-grid-section';
	$css_inner_classes[] = 'eltd-section-inner';
	$inner_start .= '<div class="eltd-section-inner-margin clearfix">';
	$inner_end .= '</div>';
} else{
	$css_inner_classes[] = 'eltd-full-section-inner';
}

if($row_type == 'row' && $css_animation != ''){
	$inner_start .= '<div class="'. $css_animation .'">';
	if($transition_delay !== ''){
		$inner_start .= '<div style="transition-delay:' . $transition_delay . 'ms;">';
		$inner_end .= '</div>';
	}else{
		$inner_start .= '<div>';
		$inner_end .= '</div>';
	}
	$inner_end .= '</div>';
}

if($header_style != ''){
	$wrapper_attributes[] = 'data-eltd_header_style="'.$header_style.'"';	
}

if($parallax_speed != ''){
 $wrapper_attributes[] =  'data-eltd-parallax-speed="'.$parallax_speed.'"';
}
else{
 $wrapper_attributes[] =  'data-eltd-parallax-speed="1"';
}

if($parallax_background_image != ''){

	$parallax_image_link =  wp_get_attachment_url($parallax_background_image);
	$wrapper_style .= 'background-image:url('.$parallax_image_link.');';

}
if($section_height != ''){
	$wrapper_style .= 'min-height:'.$section_height.'px;height:auto;';
}

if($full_screen_section_height == 'yes'){
	$css_classes[] =  'eltd-full-screen-height-parallax';
	$after_wrapper_open .= '<div class="eltd-parallax-content-outer">';
	$before_wrapper_close .= '</div>';

	if($vertically_align_content_in_middle == 'yes'){
		$css_classes[] = 'eltd-vertical-middle-align';
	}

}

if($video == 'show_video'){

	$video_overlay_class = 'eltd-video-overlay';
	$video_overlay_style = '';
	$video_mobile_style = '';
	$video_attrs = '';
	$v_image = '';
	if($video_overlay == "show_video_overlay"){
		$video_overlay_class .= 'eltd-video-overlay-active';
	}
	if($video_image) {
		$v_image = wp_get_attachment_url($video_image);
		$video_mobile_style = 'background-image:url("'. $v_image . '");';
		$video_attrs = $v_image;
	}
	if($video_overlay_image) {
		$v_overlay_image = wp_get_attachment_url($video_overlay_image);
		$video_overlay_style = 'background-image:url("'. $v_overlay_image . '");';
	}
	if($video_image) {
		$video_output .= '<div class="eltd-mobile-video-image" ' . chandelier_elated_get_inline_attr($video_mobile_style, 'style') . ')"></div>';
	}
	$video_output .= '<div class=' . chandelier_elated_get_class_attribute($video_overlay_class) . '"' . chandelier_elated_get_inline_attr($video_overlay_style, 'style') . '></div>';
	$video_output .= '<div class="eltd-video-wrap">';
	$video_output .= '<video class="eltd-video" width="1920" height="800" '. chandelier_elated_get_inline_attr($video_attrs, 'poster')  .' controls="controls" preload="auto" loop autoplay muted>';
	if(!empty($video_webm)) { $video_output .= '<source type="video/webm" src="'.$video_webm.'">'; }
	if(!empty($video_mp4)) { $video_output .= '<source type="video/mp4" src="'.$video_mp4.'">'; }
	if(!empty($video_ogv)) { $video_output .= '<source type="video/ogg" src="'. $video_ogv.'">'; }
	$video_output .='<object width="320" height="240" type="application/x-shockwave-flash" data="flashmediaelement.swf">';
		$video_output .='<param name="movie" value="flashmediaelement.swf" />';
		if(!empty($video_mp4)) {
			$video_output .= '<param name="flashvars" value="controls=true&amp;file=' . $video_mp4 . '" />';
		}
	if($v_image) {
		$video_output .= '<img ' . chandelier_elated_get_inline_attr($v_image, 'src') . ' width="1920" height="800" title="No video playback capabilities" alt="Video thumb" />';
	}
	$video_output .='</object>';
	$video_output .='</video>';
	$video_output .='</div>';

	$after_wrapper_open .= $video_output;
}

$svg = '';
if ($bottom_triangle == 'yes') {
	$svg = '<div class="eltd-row-svg-holder"><div class="eltd-row-svg-holder-side"></div><div class="eltd-row-svg-holder-middle">
<svg version="1.1" id="Layer_' . rand() . '" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="80px" height="32px" viewBox="0 0 80 32" enable-background="new 0 0 80 32" xml:space="preserve">
<line fill="none" x1="4.72" y1="1.501" x2="4.721" y2="1.5"/>
<path d="M7.9,2.613"/>
<path fill="#FFFFFF" d="M80,32V0.004h-0.082C79.892,0.004,79.864,0,79.835,0c-0.031,0-0.064,0.004-0.096,0.004h-0.211v0.01
	c-3.099,0.075-5.931,1.262-8.14,3.202l-27.21,25.19c-1.548,1.312-2.979,1.877-4.178,1.877c-1.197,0-2.626-0.562-4.168-1.867
	L8.611,3.217c-2.209-1.94-5.042-3.127-8.139-3.202v-0.01h-0.21C0.23,0.004,0.198,0,0.165,0C0.136,0,0.109,0.004,0.081,0.004H0V32H80
	z"/>
</svg>
</div><div class="eltd-row-svg-holder-side"></div></div>';
}




$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
$css_inner_classes = preg_replace( '/\s+/', ' ', implode( ' ', $css_inner_classes ));
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';
$wrapper_attributes[] = 'style="' . $wrapper_style . '"';
$inner_attributes[] = 'class="' . esc_attr( trim( $css_inner_classes ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
	if( ! empty($row_type) && $row_type == 'parallax' && $full_screen_section_height !='yes'){
		$output .= '<div class="eltd-parallax-section-inner">';
	}
	$output .= $after_wrapper_open;
	$output .= '<div ' . implode( ' ', $inner_attributes ) . '>';
	$output .= $inner_start;
	$output .= wpb_js_remove_wpautop( $content );
	$output .= $inner_end;
	$output .= '</div>';
$output .= $before_wrapper_close;
$output .= $svg;
$output .= '</div>';
if( ! empty($row_type) && $row_type == 'parallax' && $full_screen_section_height !='yes'){
		$output .= '</div>'; //close eltd-parallax-section-inner
	}
$output .= $after_output;

print $output;