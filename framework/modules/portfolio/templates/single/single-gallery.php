<div class="eltd-portfolio-gallery">
	<?php
	$media = chandelier_elated_get_portfolio_single_media();

	if(is_array($media) && count($media)) : ?>
		<div class="eltd-portfolio-media">
			<?php foreach($media as $single_media) : ?>
				<div class="eltd-portfolio-single-media">
					<?php chandelier_elated_portfolio_get_media_html($single_media); ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

<div class="eltd-two-columns-75-25 clearfix">
	<div class="eltd-column1">
		<div class="eltd-column-inner">
			<?php chandelier_elated_portfolio_get_info_part('content'); ?>
		</div>
	</div>
	<div class="eltd-column2">
		<div class="eltd-column-inner">
			<div class="eltd-portfolio-info-holder">
				<?php
				//get portfolio custom fields section
				chandelier_elated_portfolio_get_info_part('custom-fields');

				//get portfolio date section
				chandelier_elated_portfolio_get_info_part('date');

				//get portfolio categories section
				chandelier_elated_portfolio_get_info_part('categories');

				//get portfolio tags section
				chandelier_elated_portfolio_get_info_part('tags');

				//get portfolio share section
				chandelier_elated_portfolio_get_info_part('social');
				?>
			</div>
		</div>
	</div>
</div>