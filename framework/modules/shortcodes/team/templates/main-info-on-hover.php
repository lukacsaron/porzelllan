<?php
/**
 * Team info on hover shortcode template
 */

global $chandelier_elated_IconCollections;
$number_of_social_icons = 5;
?>

<div class="eltd-team <?php echo esc_attr( $team_type )?>">
	<div class="eltd-team-inner">
		<?php if ( $team_image !== '' ) { ?>
		<div class="eltd-team-image">
			<img src="<?php echo esc_url($team_image_src); ?>" alt="team-image" />
			<div class="eltd-team-social-holder">
				<div class="eltd-team-social">
					<div class="eltd-team-social-inner">
						<div class="eltd-team-title-holder">
							
							<?php if ( $team_name !== '' ) { ?>
							
							<<?php echo esc_attr($team_name_tag); ?> class="eltd-team-name">
								<?php echo esc_attr( $team_name ); ?>
							</<?php echo esc_attr($team_name_tag); ?>>
							
							<?php }
							
							if ( $team_position !== '' ) { ?>
							
							<h6 class="eltd-team-position">
								<?php echo esc_attr( $team_position ); ?>
							</h6>
							
							<?php } ?>
						</div>
						<div class="eltd-team-social-wrapp">

							<?php foreach( $team_social_icons as $team_social_icon ) {
								print $team_social_icon;
							} ?>

						</div>
					</div>
				</div>
			</div>
		</div>
		<?php }

		if ($team_description !== '') { ?>
		<div class="eltd-team-text">
			<p><?php echo esc_attr( $team_description ); ?></p>
		</div>
		<?php } ?>
	</div>
</div>