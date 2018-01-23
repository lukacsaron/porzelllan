<?php ?>
<form action="<?php echo esc_url(home_url('/')); ?>" class="eltd-search-slide-window-top" method="get">
	<?php if ( $search_in_grid ) { ?>
		<div class="eltd-container">
			<div class="eltd-container-inner clearfix">
				<?php } ?>
					<div class="form-inner">
						<i class="fa fa-search"></i>
						<input type="text" placeholder="<?php esc_html_e('Search', 'chandelier'); ?>" name="s" class="eltd-search-field" autocomplete="off" />
						<input type="submit" value="Search" />
						<div class="eltd-search-close">
							<a href="#">
								<i class="fa fa-times"></i>
							</a>
						</div>
					</div>
				<?php if ( $search_in_grid ) { ?>
			</div>
		</div>
	<?php } ?>
</form>