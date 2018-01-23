<div class="eltd-fullscreen-search-holder">
	<div class="eltd-fullscreen-search-close-container">
		<div class="eltd-search-close-holder">
			<a class="eltd-fullscreen-search-close" href="javascript:void(0)">
				<?php print $search_icon_close; ?>
			</a>
		</div>
	</div>
	<div class="eltd-fullscreen-search-table">
		<div class="eltd-fullscreen-search-cell">
			<div class="eltd-fullscreen-search-inner">
				<form action="<?php echo esc_url(home_url('/')); ?>" class="eltd-fullscreen-search-form" method="get">
					<div class="eltd-form-holder">
						<span class="eltd-search-label"><?php esc_html_e('Search:', 'chandelier'); ?></span>
						<div class="eltd-field-holder">
							<input type="text"  name="s" class="eltd-search-field" autocomplete="off" />
							<div class="eltd-line"></div>
						</div>
						<input type="submit" class="eltd-search-submit" value="&#x55;" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>