<?php do_action('chandelier_elated_before_mobile_logo'); ?>

<div class="eltd-mobile-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php chandelier_elated_inline_style($logo_styles); ?>>
        <img src="<?php echo esc_url($logo_image); ?>" alt="mobile-logo"/>
    </a>
</div>

<?php do_action('chandelier_elated_after_mobile_logo'); ?>