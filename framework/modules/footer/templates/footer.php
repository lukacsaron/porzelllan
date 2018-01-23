<?php
/**
 * Footer template part
 */

chandelier_elated_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
</div>  <!-- close div.content -->

<footer <?php chandelier_elated_class_attribute($footer_classes); ?>>
	<div class="eltd-footer-inner clearfix">

		<?php

		if($display_footer_top) {
			chandelier_elated_get_footer_top();
		}
		if($display_footer_bottom) {
			chandelier_elated_get_footer_bottom();
		}
		?>

	</div>
</footer>

</div> <!-- close div.eltd-wrapper-inner  -->
</div> <!-- close div.eltd-wrapper -->
<?php wp_footer(); ?>
</body>
</html>