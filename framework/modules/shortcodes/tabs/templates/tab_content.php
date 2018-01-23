<?php 
$tab_data_str = '';
$icon_html = '';
$tab_data_str .= 'data-icon-pack="'.$icon_pack.'" ';
$icon_html .=  chandelier_elated_icon_collections()->renderIcon($icon, $icon_pack,array());
$tab_data_str .= 'data-icon-html="'. $icon_html .'"';
$tab_unique_id = sanitize_title( $tab_title.'-'.rand() );
$tab_data_str .= 'data-tab-unique-id="'.$tab_unique_id.'"';
?>
<div class="eltd-tab-container" id="tab-<?php echo sanitize_title( $tab_title )?>">
	<?php echo do_shortcode($content); ?>      
</div>


