<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php chandelier_elated_inline_style($button_styles); ?> <?php chandelier_elated_class_attribute($button_classes); ?> <?php echo chandelier_elated_get_inline_attrs($button_data); ?> <?php echo chandelier_elated_get_inline_attrs($button_custom_attrs); ?>>
    <span class="eltd-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo chandelier_elated_icon_collections()->renderIcon($icon, $icon_pack); ?>
</a>