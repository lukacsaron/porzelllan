<?php
	/*
	Template Name: Blog: Masonry Full Width
	*/
?>
<?php get_header(); ?>

<?php get_template_part( 'title' ); ?>
<?php get_template_part('slider'); ?>

	<div class="eltd-full-width">
		<div class="eltd-full-width-inner clearfix">
			<?php chandelier_elated_get_blog('masonry-full-width'); ?>
		</div>
	</div>
<?php get_footer(); ?>