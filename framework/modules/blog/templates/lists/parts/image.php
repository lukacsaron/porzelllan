<?php 
	$post_format = get_post_format();
	if ( has_post_thumbnail() ) { ?>
	<div class="eltd-post-image">
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<?php the_post_thumbnail('full'); ?>
		</a>
		<?php if($post_format == 'link'){ ?>
			<div class="eltd-post-mark">
				<span class="icon_link eltd-link-mark"></span>
			</div>
		<?php }?>
	</div>
<?php } ?>