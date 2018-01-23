<?php
/**
 * Team info on hover shortcode template
 */
global $chandelier_elated_IconCollections;
$number_of_social_icons = 5;
?>

<div class="eltd-team <?php echo esc_attr($team_type) ?>">
	<div class="eltd-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="eltd-team-image">
				<div class="eltd-team-image-inner">
					<img src="<?php print $team_image_src; ?>" alt="eltd-team-image"/>
				</div>
				<div class ="eltd-team-hover-info">
					<div class = "eltd-team-hover-info-inner">
						<div class="eltd-team-hover-icon">
							<i class="arrow_carrot-up"></i>
						</div>
						<div class="eltd-team-svg-holder">
							<svg version="1.1" id="Layer_<?php echo rand(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								width="81px" height="33px" viewBox="0 0 81 33" enable-background="new 0 0 81 33" xml:space="preserve">
								<line fill="none" x1="75.418" y1="30.831" x2="75.418" y2="30.832"/>
								<path d="M72.232,29.717"/>
								<g>
									<path fill="#FFFFFF" d="M80.409,33h0.164v-0.005h-0.08C80.464,32.995,80.437,33,80.409,33z"/>
									<path fill="#FFFFFF" d="M80.101,32.995v-0.01c-3.104-0.075-5.939-1.265-8.154-3.208L44.675,4.531
										C43.13,3.223,41.698,2.66,40.499,2.66c-1.201,0-2.635,0.566-4.186,1.881L9.054,29.776c-2.213,1.944-5.051,3.133-8.154,3.208v0.011
										H0.688c-0.031,0-0.064,0.004-0.096,0.004c-0.029,0-0.057-0.004-0.084-0.004H0.427V33h79.982c-0.033,0-0.066-0.005-0.098-0.005
										H80.101z"/>
								</g>
							</svg>
						</div>
						
						<div class="eltd-team-hover-description">
							<p><?php echo esc_attr($team_description) ?></p>
						</div>
						<?php if(!empty($team_social_icons)){ ?>

							<div class="eltd-team-social-holder-between">
								<div class="eltd-team-social <?php echo esc_attr($team_social_icon_type) ?>">
									<div class="eltd-team-social-inner">
										<div class="eltd-team-social-wrapp">

											<?php foreach( $team_social_icons as $team_social_icon ) {
												print $team_social_icon;
											} ?>

										</div>
									</div>
								</div>
							</div>

						
							<?php } ?>
					</div>
				</div>	 
			</div>
		<?php } ?>

		<?php if ($team_name !== '' || $team_position !== '' || $team_description != "" || $show_skills == 'yes') { ?>
		<div class="eltd-team-info" <?php echo chandelier_elated_get_inline_style($team_info_back_color)?> >
				
				<?php if ($team_name !== '' || $team_position !== '') { ?>
					<div class="eltd-team-title-holder <?php echo esc_attr($team_social_icon_type) ?>">
						<?php if ($team_name !== '') { ?>
							<<?php echo esc_attr($team_name_tag); ?> class="eltd-team-name">
								<?php echo esc_attr($team_name); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
						<?php } ?>
						<?php if ($team_position !== "") { ?>
							<span class="eltd-team-position"><?php echo esc_attr($team_position) ?></span>
						<?php } ?>
					</div>
				<?php }
				
			} ?>
		</div>
	</div>
</div>