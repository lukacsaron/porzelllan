<?php do_action('chandelier_elated_before_page_title');
if($show_title_area) { ?>

    <div class="eltd-title <?php echo chandelier_elated_title_classes(); ?>" style="<?php echo esc_attr($title_height); echo esc_attr($title_background_color); echo esc_attr($title_background_image); ?>" data-height="<?php echo esc_attr(intval(preg_replace('/[^0-9]+/', '', $title_height), 10));?>" <?php echo esc_attr($title_background_image_width); ?>>
        <?php if($title_background_image_src != ""){ ?>
			<div class="eltd-title-image">
				<img src="<?php echo esc_url($title_background_image_src); ?>" alt="&nbsp;" />
			</div>
		<?php } ?>
        <div class="eltd-title-holder" <?php chandelier_elated_inline_style($title_holder_height); ?>>
			
            <div class="eltd-container clearfix">
                <div class="eltd-container-inner">
                    <div class="eltd-title-subtitle-holder" style="<?php echo esc_attr($title_subtitle_holder_padding); ?>">
                        <div class="eltd-title-subtitle-holder-inner">
                        <?php switch ($type){
                            case 'standard': ?>
								<?php if($has_subtitle){ ?>
                                    <span class="eltd-subtitle" <?php chandelier_elated_inline_style($subtitle_color); ?>>
										<span>
											<?php chandelier_elated_subtitle_text(); ?>
										</span>
									</span>
                                <?php } ?>
                                <h1 <?php chandelier_elated_inline_style($title_color); ?>>
									<span>
										<?php chandelier_elated_title_text(); ?>
									</span>
								</h1>
                                <?php if($enable_breadcrumbs){ ?>
							
                                    <div class="eltd-breadcrumbs-holder">
										<?php chandelier_elated_custom_breadcrumbs(); ?>
									</div>
							
                                <?php } ?>
								<div class ="eltd-title-separator-holder">
									<span class="eltd-title-separator"></span>
								</div>
                            <?php break;
							
							case 'light': ?>
								<?php if($has_subtitle){ ?>
                                    <span class="eltd-subtitle" <?php chandelier_elated_inline_style($subtitle_color); ?>>
										<span>
											<?php chandelier_elated_subtitle_text(); ?>
										</span>
									</span>
                                <?php } ?>
                                <h1 <?php chandelier_elated_inline_style($title_color); ?>>
									<span>
										<?php chandelier_elated_title_text(); ?>
									</span>
								</h1>
                                <?php if($enable_breadcrumbs){ ?>
							
                                    <div class="eltd-breadcrumbs-holder">
										<?php chandelier_elated_custom_breadcrumbs(); ?>
									</div>
							
                                <?php } ?>
                            <?php break;
							
                            case 'breadcrumb': ?>
							
                                <div class="eltd-breadcrumbs-holder">
									<?php chandelier_elated_custom_breadcrumbs(); ?>
								</div>
							
                            <?php break;
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="eltd-title-svg-holder">
			
			<div class="eltd-title-svg-holder-side"></div>
			<div class="eltd-title-svg-holder-middle">
				<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="80px" height="32px" viewBox="0 0 80 32" enable-background="new 0 0 80 32" xml:space="preserve">
				<path fill="none" x1="4.72" y1="1.501" x2="4.721" y2="1.5"/>
				<path d="M7.9,2.613"/>
				<path fill="#FFFFFF" d="M80,32V0.004h-0.082C79.892,0.004,79.864,0,79.835,0c-0.031,0-0.064,0.004-0.096,0.004h-0.211v0.01
					c-3.099,0.075-5.931,1.262-8.14,3.202l-27.21,25.19c-1.548,1.312-2.979,1.877-4.178,1.877c-1.197,0-2.626-0.562-4.168-1.867
					L8.611,3.217c-2.209-1.94-5.042-3.127-8.139-3.202v-0.01h-0.21C0.23,0.004,0.198,0,0.165,0C0.136,0,0.109,0.004,0.081,0.004H0V32H80
					z"/>
				</svg>
			</div>
			<div class="eltd-title-svg-holder-side"></div>
		
		</div>
    </div>

<?php } ?>
<?php do_action('chandelier_elated_after_page_title'); ?>