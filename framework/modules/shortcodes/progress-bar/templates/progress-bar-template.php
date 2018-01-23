<div class="eltd-progress-bar">
	<<?php echo esc_attr($title_tag);?> class="eltd-progress-title-holder clearfix">
		<span class="eltd-progress-title"><?php echo esc_attr($title)?></span>
		<span class="eltd-progress-number-wrapper <?php echo esc_attr($percentage_classes)?> " >
			<span class="eltd-progress-number">
				<span class="eltd-percent">0</span>
			</span>
		</span>
	</<?php echo esc_attr($title_tag)?>>
	<div class="eltd-progress-content-outer " <?php echo chandelier_elated_get_inline_style($holder_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent)?> class="eltd-progress-content" <?php echo chandelier_elated_get_inline_style($bar_style); ?>></div>
	</div>
</div>	