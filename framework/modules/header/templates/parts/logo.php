<?php do_action('chandelier_elated_before_site_logo'); ?>

<div class="eltd-logo-wrapper">
    <a href="<?php echo esc_url(home_url('/')); ?>" <?php chandelier_elated_inline_style($logo_styles); ?>>
        <img class="eltd-normal-logo" src="<?php echo esc_url($logo_image); ?>" alt="logo"/>
        <?php if(!empty($logo_image_dark)){ ?><img class="eltd-dark-logo" src="<?php echo esc_url($logo_image_dark); ?>" alt="dark logo"/><?php } ?>
        <?php if(!empty($logo_image_light)){ ?><img class="eltd-light-logo" src="<?php echo esc_url($logo_image_light); ?>" alt="light logo"/><?php } ?>
    </a>
</div>

<?php do_action('chandelier_elated_after_site_logo'); ?>