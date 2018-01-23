<div class="eltd-social-share-holder eltd-list">
	<span class="eltd-social-list-text">
		<?php esc_html_e('Follow us', 'chandelier'); ?>
	</span>
	<ul>
		<?php foreach ($networks as $net) {
			print $net;
		} ?>
	</ul>
</div>