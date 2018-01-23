<div class="eltd-related-posts-holder">
	<?php if ( $related_posts && $related_posts->have_posts() ) : ?>
		<div class="eltd-related-posts-title">
			<h5><?php esc_html_e( 'Related Posts', 'chandelier' ); ?></h5>
		</div>
		<div class="eltd-related-posts-inner clearfix">
			<?php while ( $related_posts->have_posts() ) :
				$related_posts->the_post();
				?>
				<div class="eltd-related-post">
					<div class="eltd-related-post-image">
						<?php if ( has_post_thumbnail() ) :
							the_post_thumbnail('chandelier_elated_related_posts');
						endif; ?>
					</div>
					<div class="eltd-related-post-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title( '<h6>', '</h6>' ); ?></a>
					</div>
					<div class="eltd-related-post-date">
						<?php the_time( get_option( 'date_format' ) ); ?>
					</div>
				</div>
				<?php
			endwhile; ?>
		</div>
	<?php endif;
	wp_reset_postdata();
	?>
</div>