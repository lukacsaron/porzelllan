<div class="eltd-search-dropdown-holder">
	<form method="get" id="searchform-<?php echo rand(); ?>" action="<?php echo esc_url(home_url( '/' )); ?>">
		<i class="icon-magnifier"></i>
		<input type="text" value="" placeholder="<?php esc_html_e('Search', 'chandelier'); ?>" name="s" id="s-<?php echo rand(); ?>" />
		<input type="submit" id="searchsubmit-<?php echo rand(); ?>" value="&#xe090;" />
	</form>
</div>