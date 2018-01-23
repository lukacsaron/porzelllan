<?php get_header(); ?>

	<div class="eltd-container">
	<?php do_action('chandelier_elated_after_container_open'); ?>
		<div class="eltd-container-inner eltd-404-page">
			<div class="eltd-page-not-found">
				<h3 class="eltd-page-not-found-subtitle">404</h3>
				<h1 class="eltd-page-not-found-title">
					<?php if(chandelier_elated_options()->getOptionValue('404_title')){
						echo esc_html(chandelier_elated_options()->getOptionValue('404_title'));
					}
					else{
						esc_html_e('Error Page', 'chandelier');
					} ?>
				</h1>
				<h5 class="eltd-page-not-found-text">
					<?php if(chandelier_elated_options()->getOptionValue('404_text')){
						echo esc_html(chandelier_elated_options()->getOptionValue('404_text'));
					}
					else{
						esc_html_e('The page you are looking for not exist. It may have been moved, or removed altogether. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.', 'chandelier');
					} ?>
				</h5>
				<?php
				
				if(chandelier_elated_options()->getOptionValue('second_color')){
					$button__back_color = chandelier_elated_options()->getOptionValue('second_color');
				}else{
					$button__back_color = '#c9a482';
				}
				
				echo chandelier_elated_get_button_html(array(
					'text' => chandelier_elated_options()->getOptionValue('404_back_to_home') ? chandelier_elated_options()->getOptionValue('404_back_to_home') : 'Home',
					'link' => home_url('/'),
					'color' => '#fff',
					'background_color' => '#c9a482',
					'type' => 'solid'
				));
				?>
			</div>
		</div>
		<?php do_action('chandelier_elated_before_container_close'); ?>
	</div>
<?php get_footer(); ?>