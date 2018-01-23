<?php
$attr = '';
if ( has_post_thumbnail() ) {
	$id = get_post_thumbnail_id();
	$img = wp_get_attachment_image_src($id, 'full');
	$attr = 'style="background-image: url(' . esc_url( $img[0] ) . ');"';
}
$quote_text = get_post_meta(get_the_ID(), "eltd_post_quote_text_meta", true);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="eltd-post-content">
		<div class="eltd-post-content-content-column" <?php print $attr; ?>>
			<div class="eltd-post-title-holder">
				<?php chandelier_elated_post_info(array(
					'category' => 'yes',
				)); ?>
				<?php chandelier_elated_get_module_template_part('templates/lists/parts/title', 'blog'); ?>
			</div>
			<div class="eltd-post-text">
				<div class="eltd-post-text-inner">
					<div class="eltd-quote-mark-holder">
						<div class="eltd-post-mark">
							<span class="eltd-quote-mark icon_quotations"></span>
						</div>
					</div>					
					<div class="eltd-quote-content-holder">
						<?php if($quote_text != ''){ ?>
						<p class="eltd-post-qoute">
							<?php echo esc_html($quote_text); ?>
						</p>
						<?php } ?>

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
	</div>
</article>