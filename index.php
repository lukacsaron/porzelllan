<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>
	<div class="<?php echo chandelier_elated_blog_archive_pages_classes(chandelier_elated_get_default_blog_list())['holder']; ?>">
		<?php do_action('chandelier_elated_after_container_open'); ?>
		<div class="<?php echo  chandelier_elated_blog_archive_pages_classes(chandelier_elated_get_default_blog_list())['inner']; ?>">
			<?php chandelier_elated_get_blog(chandelier_elated_get_default_blog_list()); ?>
		</div>
		<?php do_action('chandelier_elated_before_container_close'); ?>
	</div>
<?php get_footer(); ?>