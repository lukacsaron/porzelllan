<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltd-post-title-holder">
		<?php chandelier_elated_post_info(array(
			'category' => 'yes',
		)); ?>
		<?php chandelier_elated_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
	</div>
	<div class="eltd-post-content">
		<div class="eltd-post-content-info-column">
			<?php chandelier_elated_post_info(array(
				'date' => 'yes'
			)); ?>
		</div>
		<div class="eltd-post-content-content-column">
			<?php chandelier_elated_get_module_template_part('templates/lists/parts/image', 'blog'); ?>
			<div class="eltd-post-text">
				<div class="eltd-post-text-inner">
					<?php
						the_content();
					?>
					<div class="eltd-post-info clearfix">
						<div class="eltd-post-info-author-category">
							<?php chandelier_elated_post_info(array(
								'author' => 'yes',
								'category' => 'yes',
							)); ?>
						</div>
						<div class="eltd-post-info-comments">
							<?php chandelier_elated_post_info(array(
								'comments' => 'yes',
							)); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>