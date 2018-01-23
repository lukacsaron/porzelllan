<form action="<?php echo esc_url(home_url('/')); ?>" class="eltd-search-slide-header-bottom" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="eltd-container">
		<div class="eltd-container-inner clearfix">
			<?php } ?>
			<div class="eltd-form-holder-outer">
				<div class="eltd-form-holder">
					<input type="text" placeholder="<?php esc_html_e('Search', 'chandelier'); ?>" name="s" class="eltd-search-field" autocomplete="off" />
					<a class="eltd-search-submit" href="javascript:void(0)">
						<?php print $search_icon ?>
					</a>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>