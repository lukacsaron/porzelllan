<div class="eltd-price-table <?php echo esc_attr($pricing_table_classes);?>">
	<div class="eltd-price-table-inner">
		<?php if($active == 'yes'){ ?>
			<div class="eltd-active-text">
				<span class="eltd-active-text-inner">
					<?php echo esc_attr($active_text) ?>
				</span>
			</div>
		<?php } ?>	
		<ul>
			<li class="eltd-table-title">
				<h6 class="eltd-title-content"><?php echo esc_html($title) ?></h6>
			</li>
			<li class="eltd-table-prices">
				<div class="eltd-price-in-table">
					<sup class="eltd-value"><?php echo esc_attr($currency) ?></sup>
					<span class="eltd-price"><?php echo esc_attr($price)?></span>
					<span class="eltd-mark">/ <?php echo esc_attr($price_period)?></span>
				</div>	
			</li>
			<li class="eltd-table-subtitle">
				<span><?php echo esc_html($subtitle); ?></span>
			</li>
			<li class="eltd-table-content">
				<?php echo do_shortcode($content)?>
			</li>
			<?php 
			if($show_button == "yes" && $button_text !== ''){ ?>
				<li class="eltd-price-button">
					<?php echo chandelier_elated_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'color' => $button_color
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>
