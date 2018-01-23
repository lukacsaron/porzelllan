<?php if(chandelier_elated_options()->getOptionValue('portfolio_single_hide_pagination') !== 'yes') : ?>

    <?php
    $back_to_link = get_post_meta(get_the_ID(), 'portfolio_single_back_to_link', true);
    $nav_same_category = chandelier_elated_options()->getOptionValue('portfolio_single_nav_same_category') == 'yes';
    ?>

    <div class="eltd-portfolio-single-nav">
        <?php if(get_previous_post() !== '') : ?>
            <div class="eltd-portfolio-prev">
                <?php if($nav_same_category) {
                    previous_post_link('%link', '<span class="ion-ios-arrow-left"></span>', true, '', 'portfolio-category');
                } else {
                    previous_post_link('%link', '<span class="ion-ios-arrow-left"></span>');
                } ?>
            </div>
        <?php endif; ?>

        <?php if($back_to_link !== '') : ?>
            <div class="eltd-portfolio-back-btn">
                <a href="<?php echo esc_url(get_permalink($back_to_link)); ?>">
                    <span class="icon_grid-3x3"></span>
                </a>
            </div>
        <?php endif; ?>

        <?php if(get_next_post() !== '') : ?>
            <div class="eltd-portfolio-next">
                <?php if($nav_same_category) {
                    next_post_link('%link', '<span class="ion-ios-arrow-right"></span>', true, '', 'portfolio-category');
                } else {
                    next_post_link('%link', '<span class="ion-ios-arrow-right"></span>');
                } ?>
            </div>
        <?php endif; ?>
    </div>

<?php endif; ?>