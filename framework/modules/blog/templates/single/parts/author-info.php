<?php
	$author_info_box = esc_attr(chandelier_elated_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(chandelier_elated_options()->getOptionValue('blog_author_info_email'));

?>
<?php if($author_info_box === 'yes') { ?>
	<div class="eltd-author-description">
		<div class="eltd-author-description-inner">
			<div class="eltd-author-description-image">
				<?php echo chandelier_elated_kses_img(get_avatar(get_the_author_meta( 'ID' ), 102)); ?>
			</div>
			<div class="eltd-author-description-text-holder">
				<h5 class="eltd-author-name">
					<?php
						if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
							echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
						} else {
							echo esc_attr(get_the_author_meta('display_name'));
						}
					?>
				</h5>
				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))){ ?>
					<p class="eltd-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="eltd-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>