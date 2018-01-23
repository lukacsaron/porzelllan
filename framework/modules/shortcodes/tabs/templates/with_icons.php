<div class="eltd-tabs <?php echo esc_attr($tab_class) ?> clearfix">
	<ul class="eltd-tabs-nav">
		<?php  foreach ($tabs_titles as $tab_title) {?>
			<li>
				<a href="#tab-<?php echo sanitize_title($tab_title)?>">					
					<span class="eltd-icon-frame"></span>
				</a>
			</li>
		<?php } ?>
	</ul> 
	<?php echo do_shortcode($content) ?>
</div>
