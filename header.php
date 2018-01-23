<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php chandelier_elated_wp_title(); ?>
    <?php
    /**
     * @see chandelier_elated_header_meta() - hooked with 10
     * @see eltd_user_scalable - hooked with 10
     */
    ?>
	<?php do_action('chandelier_elated_header_meta'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php chandelier_elated_get_side_area(); ?>

<?php if(chandelier_elated_options()->getOptionValue('smooth_page_transitions') == "yes") { ?>
    <div class="eltd-smooth-transition-loader">
    </div>
<?php } ?>

<div class="eltd-wrapper">
    <div class="eltd-wrapper-inner">
        <?php
        if ( ! is_404() ) {
            chandelier_elated_get_header();
        }
        ?>

        <?php if(chandelier_elated_options()->getOptionValue('show_back_button') == "yes") { ?>
            <a id='eltd-back-to-top'  href='#'>
                <span class="eltd-icon-stack">
                     <?php
                        chandelier_elated_icon_collections()->getBackToTopIcon('font_elegant');
                    ?>
                </span>
            </a>
        <?php } ?>

        <div class="eltd-content" <?php chandelier_elated_content_elem_style_attr(); ?>>
            <div class="eltd-content-inner">