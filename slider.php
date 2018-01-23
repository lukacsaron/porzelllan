<?php
$slider_shortcode = get_post_meta($id, "eltd_page_slider_meta", true);
if (!empty($slider_shortcode)) { ?>
	<div class="eltd-slider">
		<div class="eltd-slider-inner">
			<?php echo do_shortcode(wp_kses_post($slider_shortcode)); // XSS OK ?>
			<div class="eltd-slider-svg-holder">
				<div class="eltd-slider-svg-holder-side"></div>			
				<div class="eltd-slider-svg-holder-middle">
					<svg version="1.1" id="Layer_<?php echo rand(); ?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="80px" height="32px" viewBox="0 0 80 32" enable-background="new 0 0 80 32" xml:space="preserve">
					<line fill="none" x1="4.72" y1="1.501" x2="4.721" y2="1.5"/>
					<path d="M7.9,2.613"/>
					<path fill="#FFFFFF" d="M80,32V0.004h-0.082C79.892,0.004,79.864,0,79.835,0c-0.031,0-0.064,0.004-0.096,0.004h-0.211v0.01
						c-3.099,0.075-5.931,1.262-8.14,3.202l-27.21,25.19c-1.548,1.312-2.979,1.877-4.178,1.877c-1.197,0-2.626-0.562-4.168-1.867
						L8.611,3.217c-2.209-1.94-5.042-3.127-8.139-3.202v-0.01h-0.21C0.23,0.004,0.198,0,0.165,0C0.136,0,0.109,0.004,0.081,0.004H0V32H80
						z"/>
					</svg>
				</div>			
				<div class="eltd-slider-svg-holder-side"></div>			
			</div>
		</div>
	</div>
<?php } ?>