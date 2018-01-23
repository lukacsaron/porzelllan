<?php if(chandelier_elated_options()->getOptionValue('portfolio_single_hide_date') !== 'yes') : ?>

    <div class="eltd-portfolio-info-item eltd-portfolio-date">
        <h6><?php esc_html_e('Date', 'chandelier'); ?></h6>

        <p><?php the_time(get_option('date_format')); ?></p>
    </div>

<?php endif; ?>