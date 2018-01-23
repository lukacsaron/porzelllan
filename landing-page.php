<?php
/*
Template Name: Landing Page
*/
$sidebar = chandelier_elated_sidebar_layout();

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <?php chandelier_elated_wp_title(); ?>

        <?php
        /**
         * chandelier_elated_header_meta hook
         *
         * @see chandelier_elated_header_meta() - hooked with 10
         * @see eltd_user_scalable_meta() - hooked with 10
         */
        do_action('chandelier_elated_header_meta');
        ?>

        <?php wp_head(); ?>
    </head>

<body <?php body_class(); ?>>

<?php if(chandelier_elated_options()->getOptionValue('smooth_page_transitions') == "yes") { ?>
	<div class="eltd-smooth-transition-loader">
		<div class="eltd-st-loader">
			<div class="eltd-st-loader1">
				<?php chandelier_elated_loading_spinners(); ?>
			</div>
		</div>
	</div>
<?php } ?>

<div class="eltd-wrapper">
	<div class="eltd-wrapper-inner">
		<div class="eltd-content">
			<div class="eltd-content-inner">
				<?php get_template_part('slider');?>
				<div class="eltd-full-width">
					<div class="eltd-full-width-inner">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<?php if(($sidebar == 'default')||($sidebar == '')) : ?>
								<?php the_content(); ?>
								<?php do_action('chandelier_elated_page_after_content'); ?>
							<?php elseif($sidebar == 'sidebar-33-right' || $sidebar == 'sidebar-25-right'): ?>
								<div <?php echo chandelier_elated_sidebar_columns_class(); ?>>
									<div class="eltd-column1 eltd-content-left-from-sidebar">
										<div class="eltd-column-inner">
											<?php the_content(); ?>
											<?php do_action('chandelier_elated_page_after_content'); ?>
										</div>
									</div>
									<div class="eltd-column2">
										<?php get_sidebar(); ?>
									</div>
								</div>
							<?php elseif($sidebar == 'sidebar-33-left' || $sidebar == 'sidebar-25-left'): ?>
								<div <?php echo chandelier_elated_sidebar_columns_class(); ?>>
									<div class="eltd-column1">
										<?php get_sidebar(); ?>
									</div>
									<div class="eltd-column2 eltd-content-right-from-sidebar">
										<div class="eltd-column-inner">
											<?php the_content(); ?>
											<?php do_action('chandelier_elated_page_after_content'); ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php get_footer(); ?>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>