<?php
	$day = 'd';
	$month = 'M';
	$year = 'Y';
?>
<div class="eltd-post-info-date">
	<?php if(!chandelier_elated_post_has_title()) { ?>
		<a href="<?php the_permalink() ?>">
	<?php } ?>
	<span class="eltd-post-date-month">
		<?php the_time($month); ?>
	</span>
	<span class="eltd-post-date-day-year">
		<span class="eltd-post-date-day">
			<?php the_time($day); ?>
		</span>
		<span class="eltd-post-date-year">
			<?php the_time($year); ?>
		</span>
	</span>
	<?php if(!chandelier_elated_post_has_title()) { ?>
		</a>
	<?php } ?>
</div>