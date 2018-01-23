<?php
    /*
        Template Name: Blog: Standard
    */
?>
<?php get_header(); ?>
<?php get_template_part( 'title' ); ?>
<?php get_template_part('slider'); ?>
<div class="eltd-container">
    <?php do_action('chandelier_elated_after_container_open'); ?>
    <div class="eltd-container-inner" >
        <?php chandelier_elated_get_blog('standard'); ?>
    </div>
    <?php do_action('chandelier_elated_before_container_close'); ?>
</div>
<?php get_footer(); ?>