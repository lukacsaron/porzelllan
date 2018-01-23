<div class="eltd-blog-holder eltd-blog-type-standard">
	<?php
		if($blog_query->have_posts()) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			chandelier_elated_get_post_format_html($blog_type);
		endwhile;
		else:
			chandelier_elated_get_module_template_part('templates/parts/no-posts', 'blog');
		endif;
	?>
	<?php
		if(chandelier_elated_options()->getOptionValue('pagination') == 'yes') {
			chandelier_elated_pagination($blog_query->max_num_pages, $blog_page_range, $paged);
		}
	?>
</div>
