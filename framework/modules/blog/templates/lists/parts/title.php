<?php
	if(isset($title_tag)){
		$title_tag = $title_tag;
	}else{
		$title_tag = 'h3';
	}

?>
<<?php echo esc_attr($title_tag);?> class="eltd-post-title">
	<a href="<?php chandelier_elated_get_post_link(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
</<?php echo esc_attr($title_tag);?>>