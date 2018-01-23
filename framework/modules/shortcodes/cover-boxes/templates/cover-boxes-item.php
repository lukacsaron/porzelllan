<?php $back_style = 'background-image: url('.$image_src.')'?>
<li class = "eltd-cover-boxes-item">
	<div class="eltd-cover-box clearfix">
		<div class="eltd-cover-thumb" <?php echo chandelier_elated_get_inline_style($back_style) ?>>
		</div>
		<div class="eltd-cover-box-content">
			<h6 class="eltd-cover-box-title">
				<?php echo esc_attr($title)?>
			</h6>
			<p class="eltd-cover-box-text">
				<?php echo esc_attr($text)?>
			</p>
			<?php if($link_label !=''){ ?>
				<?php echo chandelier_elated_get_button_html(array(
						'type' => 'transparent',
						'link' => $link,
						'target' => $target,
						'text' => $link_label,
						'icon_pack' => 'font_elegant',
						'fe_icon'	=> 'arrow_right'
					))?>
			<?php }?>
		</div>	
	</div>	
</li>