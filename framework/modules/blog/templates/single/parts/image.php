<?php
	$post_format = get_post_format();
	if ( has_post_thumbnail() ) { ?>
	<div class="eltd-post-image">
		<?php the_post_thumbnail('full'); ?>
		<?php if($post_format == 'link'){ ?>
			<div class="eltd-post-mark">
				<span class="icon_link eltd-link-mark"></span>
			</div>
		<?php }?>
	</div>
<?php } ?>