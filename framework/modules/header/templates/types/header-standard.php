<?php do_action('chandelier_elated_before_page_header'); ?>

<header class="eltd-page-header">
    <?php if($show_fixed_wrapper) : ?>
        <div class="eltd-fixed-wrapper">
    <?php endif; ?>
    <div class="eltd-menu-area" <?php chandelier_elated_inline_style($menu_area_background_color); ?>>
        <?php if($menu_area_in_grid) : ?>
            <div class="eltd-grid">
        <?php endif; ?>
			<?php do_action( 'chandelier_elated_after_header_menu_area_html_open' )?>
            <div class="eltd-vertical-align-containers">
                <div class="eltd-position-left">
                    <div class="eltd-position-left-inner">
                        <?php if(!$hide_logo) {
                            chandelier_elated_get_logo();
                        } ?>
                    </div>
                </div>
                <div class="eltd-position-center">
                    <div class="eltd-position-center-inner">
                        <?php chandelier_elated_get_main_menu(); ?>
                    </div>
                </div>
                <div class="eltd-position-right">
                    <div class="eltd-position-right-inner">
						<?php if(is_active_sidebar('eltd-right-from-main-menu')) : ?>
							<div class="eltd-header-right-sidebar">
								<div class="eltd-header-right-sidebar-inner">
									<?php dynamic_sidebar('eltd-right-from-main-menu'); ?>
								</div>	
							</div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        <?php if($menu_area_in_grid) : ?>
        </div>
        <?php endif; ?>
    </div>
    <?php do_action('chandelier_elated_before_page_header_close'); ?>
    <?php if($show_fixed_wrapper) : ?>
        </div>
    <?php endif; ?>
    <?php if($show_sticky) {
        chandelier_elated_get_sticky_header();
    } ?>
</header>

<?php do_action('chandelier_elated_after_page_header'); ?>

