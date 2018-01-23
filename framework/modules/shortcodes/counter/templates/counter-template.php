<?php
/**
 * Counter shortcode template
 */
?>
<div class="eltd-counter-holder <?php echo esc_attr($position) . ' ' . esc_attr($style); ?>" <?php echo chandelier_elated_get_inline_style($counter_holder_styles); ?>>
	<div class="eltd-counter-icon-holder">
		<div class="eltd-counter-icon-holder-inner">
			<?php echo chandelier_elated_execute_shortcode('eltd_icon', $icon_parameters); ?>
		</div>
		<span class="eltd-counter <?php echo esc_attr($type) ?>" <?php echo chandelier_elated_get_inline_style($counter_styles); ?>>
		<?php echo esc_attr($digit); ?>
	</span>
	</div>
	<<?php echo esc_html($title_tag); ?> class="eltd-counter-title" <?php echo chandelier_elated_get_inline_style($title_styles); ?>>
		<?php echo esc_attr($title); ?>
	</<?php echo esc_html($title_tag);; ?>>
	<?php if ($text != "") { ?>
		<p class="eltd-counter-text"><?php echo esc_html($text); ?></p>
	<?php } ?>

</div>