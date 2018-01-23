<?php
if(!function_exists('chandelier_elated_design_styles')) {
    /**
     * Generates general custom styles
     */
    function chandelier_elated_design_styles() {

        $preload_background_styles = array();

        if(chandelier_elated_options()->getOptionValue('preload_pattern_image') !== ""){
            $preload_background_styles['background-image'] = 'url('.chandelier_elated_options()->getOptionValue('preload_pattern_image').') !important';
        }else{
            $preload_background_styles['background-image'] = 'url('.esc_url(ELATED_ASSETS_ROOT."/img/preload_pattern.png").') !important';
        }

        echo chandelier_elated_dynamic_css('.eltd-preload-background', $preload_background_styles);

		if (chandelier_elated_options()->getOptionValue('google_fonts')){
			$font_family = chandelier_elated_options()->getOptionValue('google_fonts');
			if(chandelier_elated_is_font_option_valid($font_family)) {
				echo chandelier_elated_dynamic_css('body', array('font-family' => chandelier_elated_get_font_option_val($font_family)));
			}
		}

		/**
		 * FIRST COLOR
		 */
		$color_selector = array(
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover',
				'a',
				'p a',
				'.eltd-drop-down .wide .second .inner > ul > li > a:hover',
				'.eltd-drop-down .wide .second .inner ul li.sub .flexslider ul li a:hover',
				'.eltd-drop-down .wide .second ul li .flexslider ul li a:hover',
				'.eltd-drop-down .wide .second .inner ul li.sub .flexslider.widget_flexslider .menu_recent_post_text a:hover',
				'.eltd-header-vertical .eltd-vertical-dropdown-float .second .inner ul li a:hover',
				'.eltd-header-vertical .eltd-vertical-dropdown-toggle .second .inner ul li a:hover',
				'.eltd-header-vertical .eltd-vertical-menu ul li a:hover',
				'.eltd-mobile-header .eltd-mobile-nav a:hover, .eltd-mobile-header .eltd-mobile-nav h4:hover',
				'.eltd-mobile-header .eltd-mobile-menu-opener a:hover',
				'.eltd-side-menu-button-opener:hover',
				'nav.eltd-fullscreen-menu ul li a:hover',
				'nav.eltd-fullscreen-menu ul li ul li a',
				'.eltd-search-slide-header-bottom .eltd-search-submit:hover',
				'.eltd-search-cover .eltd-search-close a:hover',
				'.eltd-message .eltd-message-inner a.eltd-close i:hover',
				'.eltd-ordered-list ol > li:before',
				'.eltd-icon-list-item .eltd-icon-list-icon-holder .eltd-icon-list-icon-holder-inner i',
				'.eltd-icon-list-item .eltd-icon-list-icon-holder .eltd-icon-list-icon-holder-inner .font_elegant',
				'.eltd-price-table .eltd-price-table-inner ul li.eltd-table-prices .eltd-value',
				'.eltd-price-table .eltd-price-table-inner ul li.eltd-table-prices .eltd-price',
				'.eltd-price-table .eltd-price-table-inner ul li.eltd-table-prices .eltd-mark',
				'.eltd-tabs.eltd-tab-boxed.eltd-horizontal .eltd-tabs-nav li.ui-state-active a',
				'.eltd-tabs.eltd-tab-boxed.eltd-horizontal .eltd-tabs-nav li.ui-state-hover a:hover',
				'.eltd-tabs.eltd-vertical .eltd-tabs-nav li.ui-state-active a',
				'.eltd-tabs.eltd-vertical .eltd-tabs-nav li.ui-state-hover a:hover',
				'.eltd-tabs.eltd-tab-transparent.eltd-horizontal .eltd-tabs-nav li a',
				'.eltd-btn.eltd-btn-outline',
				'#submit_comment:hover',
				'.post-password-form input[type="submit"]:hover',
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'.eltd-accordion-holder .eltd-title-holder .eltd-accordion-mark',
				'.eltd-accordion-holder .eltd-title-holder.ui-state-active',
				'.eltd-accordion-holder .eltd-title-holder.ui-state-hover',
				'.eltd-icon-list-item .eltd-icon-list-icon-holder-inner i',
				'.eltd-icon-list-item .eltd-icon-list-icon-holder-inner .font_elegant',
				'.eltd-ordered-list ol>li:before',
				'.eltd-portfolio-filter-holder .eltd-portfolio-filter-holder-inner ul li.active span',
				'.eltd-portfolio-filter-holder .eltd-portfolio-filter-holder-inner ul li.current span',
				'.eltd-ptf-list-holder article .eltd-item-icons-holder a',
				'.eltd-ptf-list-holder.eltd-ptf-standard article .eltd-item-icons-holder a:hover',
				'.eltd-ptf-list-wrapper.eltd-ptf-standard-with-space article .eltd-item-text-holder .eltd-ptf-category-holder span',
				'.eltd-portfolio-slider-holder .eltd-ptf-list-holder.owl-carousel .owl-buttons .eltd-prev-icon i',
				'.eltd-portfolio-slider-holder .eltd-ptf-list-holder.owl-carousel .owl-buttons .eltd-next-icon i',
				'.eltd-blog-holder article.sticky .eltd-post-title a',
				'.eltd-filter-blog-holder li.eltd-active',
				'.eltd-blog-single-navigation .eltd-blog-navigation-info-holder a:hover .eltd-blog-navigation-info',
				'.eltd-blog-single-navigation .eltd-blog-navigation-info-holder a:hover .eltd-navigation-icon',
				'footer .widget.widget_search form input[type="submit"]',
				'.eltd-call-to-action .eltd-text-wrapper .eltd-call-to-action-icon .eltd-call-to-action-icon-inner i',
				'.countdown-amount',
				'.eltd-counter-holder .eltd-counter',
				'.eltd-dropcaps',
				'.eltd-icon-shortcode',
				'.eltd-pie-chart-with-icon-holder .eltd-pie-chart-with-icon span',
				'.eltd-progress-bar .eltd-progress-number-wrapper .eltd-progress-number',
				'.eltd-testimonials .eltd-testimonial-content',
				'.eltd-video-button-play .eltd-video-button-wrapper:hover',
				'aside.eltd-sidebar .widget.widget_rss li .rss-date',
				'aside.eltd-sidebar .widget.widget_recent_entries span.post-date',
				'.eltd-team.main-info-below-image .eltd-team-social-holder-between .eltd-icon-shortcode a:hover',
				'.eltd-social-share-holder.eltd-list .eltd-social-list-text'
		);
		if(chandelier_elated_options()->getOptionValue('first_color') !== "") {

            $background_color_selector = array(
				'.eltd-drop-down .second .inner > ul',
				'li.narrow .second .inner ul',
                '.eltd-header-vertical .eltd-vertical-dropdown-toggle .second:after',
                '.eltd-header-vertical .eltd-vertical-menu > ul > li > a:before',
                '.eltd-header-vertical .eltd-vertical-menu > ul > li > a:after',
                '.eltd-header-vertical.eltd-vertical-header-hidden .eltd-vertical-menu-hidden-button-line',
                '.eltd-header-vertical.eltd-vertical-header-hidden .eltd-vertical-menu-hidden-button-line:after',
                '.eltd-header-vertical.eltd-vertical-header-hidden .eltd-vertical-menu-hidden-button-line:before',
                '.eltd-title',
                '.eltd-fullscreen-menu-opener:hover .eltd-line',
                '.eltd-fullscreen-menu-opener.opened:hover .eltd-line:after',
                '.eltd-fullscreen-menu-opener.opened:hover .eltd-line:before',
                '.eltd-icon-shortcode.circle, .eltd-icon-shortcode.square',
                '.eltd-progress-bar .eltd-progress-content-outer .eltd-progress-content',
				'.eltd-price-table .eltd-price-table-inner ul  .eltd-table-title',
				'.eltd-price-table .eltd-price-table-inner ul .eltd-table-content:before',
                '.eltd-price-table.eltd-active .eltd-active-text',
                '.eltd-pie-chart-doughnut-holder .eltd-pie-legend ul li .eltd-pie-color-holder',
                '.eltd-pie-chart-pie-holder .eltd-pie-legend ul li .eltd-pie-color-holder',
				'.eltd-tabs.eltd-tab-transparent.eltd-horizontal .eltd-tabs-nav li.ui-state-active a',
				'.eltd-tabs.eltd-tab-transparent.eltd-horizontal .eltd-tabs-nav li.ui-state-hover a:hover',
                '.eltd-btn.eltd-btn-solid',
				'.eltd-btn.eltd-btn-transparent.eltd-read-more:before',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
				'.eltd-newsletter input[type=submit]:hover',
				'.eltd-ptf-list-holder.eltd-ptf-standard article .eltd-item-icons-holder a',
				'.eltd-blog-holder article  .eltd-post-content-info-column .eltd-post-date-month',
				'.eltd-counter-holder.dark .eltd-counter-icon-holder',
				'.eltd-dropcaps.eltd-square',
				'.eltd-ptf-list-wrapper.eltd-ptf-gallery article .eltd-item-image-holder .eltd-item-text-holder',
				'.eltd-ptf-list-wrapper.eltd-ptf-pinterest article .eltd-item-image-holder .eltd-item-text-holder',
				'.eltd-ptf-list-wrapper.eltd-ptf-masonry article .eltd-item-image-holder .eltd-item-text-holder',
				'.eltd-testimonials.owl-carousel .owl-pagination .owl-page.active span',
				'footer .eltd-footer-top-holder',
				'aside.eltd-sidebar .widget .eltd-widget-title',
				'.eltd-accordion-holder.eltd-boxed .eltd-title-holder.ui-state-active',
				'.eltd-accordion-holder.eltd-boxed .eltd-title-holder.ui-state-hover',
				'aside.eltd-sidebar .widget.widget_search form input[type="submit"]'
            );

             $background_color_important_selector = array(
				 '.wpcf7-form.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-submit.eltd-btn:hover'
             );

            $border_color_selector = array(
                '.eltd-drop-down .second',
                '.eltd-progress-bar .eltd-progress-number-wrapper.eltd-floating .eltd-down-arrow',
				'.eltd-tabs.eltd-tab-transparent.eltd-horizontal .eltd-tabs-nav li.ui-state-active a',
				'.eltd-tabs.eltd-tab-transparent.eltd-horizontal .eltd-tabs-nav li.ui-state-hover a:hover',
                '.eltd-btn.eltd-btn-solid',
                '.eltd-btn.eltd-btn-outline',
				'.eltd-btn.eltd-btn-outline:before',
				'.eltd-btn.eltd-btn-outline:after',
                '#submit_comment',
                '.post-password-form input[type="submit"]',
                'input.wpcf7-form-control.wpcf7-submit',
                '.wpcf7-form-control.wpcf7-text:focus',
                '.wpcf7-form-control.wpcf7-number:focus',
                '.wpcf7-form-control.wpcf7-date:focus',
                '.wpcf7-form-control.wpcf7-textarea:focus',
                '.wpcf7-form-control.wpcf7-select:focus',
                '.wpcf7-form-control.wpcf7-quiz:focus',
                '#respond textarea:focus',
                '#respond input[type="text"]:focus',
                '.post-password-form input[type="password"]:focus',
				'.eltd-accordion-holder.eltd-boxed .eltd-title-holder.ui-state-active',
				'.eltd-accordion-holder.eltd-boxed .eltd-title-holder.ui-state-hover',
				'.eltd-accordion-holder .eltd-title-holder.ui-state-active .eltd-accordion-mark',
				'.eltd-accordion-holder .eltd-title-holder.ui-state-hover .eltd-accordion-mark',
				'.eltd-ptf-list-holder article .eltd-item-icons-holder a',
				'.eltd-portfolio-slider-holder .eltd-ptf-list-holder.owl-carousel .owl-buttons .eltd-prev-icon',
				'.eltd-portfolio-slider-holder .eltd-ptf-list-holder.owl-carousel .owl-buttons .eltd-next-icon',
				'.eltd-testimonials.owl-carousel .owl-pagination .owl-page span'
            );
			
			echo chandelier_elated_dynamic_css($color_selector, array('color' => chandelier_elated_options()->getOptionValue('first_color')));
            echo chandelier_elated_dynamic_css('::selection', array('background' => chandelier_elated_options()->getOptionValue('first_color')));
            echo chandelier_elated_dynamic_css('::-moz-selection', array('background' => chandelier_elated_options()->getOptionValue('first_color')));
            echo chandelier_elated_dynamic_css($background_color_selector, array('background-color' => chandelier_elated_options()->getOptionValue('first_color')));
            echo chandelier_elated_dynamic_css($background_color_important_selector, array('background-color' => chandelier_elated_options()->getOptionValue('first_color').'!important'));
            echo chandelier_elated_dynamic_css($border_color_selector, array('border-color' => chandelier_elated_options()->getOptionValue('first_color')));
			
			if( chandelier_elated_is_woocommerce_installed() ){
				
				$woocommerce_color_selectors = array(
					'.eltd-woocommerce-page input.button',
					'.eltd-woocommerce-page .star-rating span',
					'.eltd-single-product-summary form.cart .label',
					'.eltd-single-product-summary .product_meta span',
					'.eltd-single-product-summary  .single_variation .price',
					'.eltd-woocommerce-page .eltd-quantity-buttons .eltd-quantity-input',
					'.eltd-woocommerce-page .eltd-quantity-buttons .eltd-quantity-control',
					'.eltd-woocommerce-page .eltd-quantity-buttons .eltd-quantity-minus',
					'.eltd-woocommerce-page .eltd-quantity-buttons .eltd-quantity-plus',
					'.eltd-woocommerce-page thead th',
					'.eltd-woocommerce-page .eltd-cart-totals table th',
					'.eltd-shopping-cart-outer .eltd-shopping-cart-header .eltd-header-cart i',
					'.eltd-shopping-cart-dropdown ul li a:hover',
					'.eltd-single-product-summary .eltd-single-product-price .price',
					'.eltd-woocommerce-page .product .eltd-woocommerce-lightbox:hover',
					'.eltd-woocommerce-page .woocommerce-message',
					'.eltd-woocommerce-page .woocommerce-info',
					'.eltd-woocommerce-page .woocommerce-error',
					'.eltd-woocommerce-page .woocommerce-message .button',
					'.eltd-woocommerce-page .woocommerce-info .button',
					'.eltd-woocommerce-page .woocommerce-error .button',
					'.eltd-woocommerce-page .eltd-tab-container .comment-form-rating label',
					'.eltd-woocommerce-page .eltd-tab-container .comment-form-comment label'
				);
				$woocommerce_background_color_selectors = array(
					'.eltd-woocommerce-page .product .eltd-out-of-stock',
					'.eltd-woocommerce-page .product .eltd-onsale',
					'.eltd-woocommerce-page .widget_price_filter .price_slider  .ui-slider-handle',
					'.woocommerce-pagination .page-numbers li a:hover',
					'.woocommerce-pagination .page-numbers li span:hover',
					'.woocommerce-pagination .page-numbers li span.current:hover',
					'.eltd-single-product-summary .eltd-single-product-price .price del:after',
					'.eltd-woocommerce-page .widget_product_search form input[type="submit"]',
					'.woocommerce-pagination .page-numbers li a:hover',
					'.woocommerce-pagination .page-numbers li span:hover',
					'.woocommerce-pagination .page-numbers li span.current:hover',
					'.woocommerce-pagination .page-numbers li span.current',
					'.eltd-shopping-cart-dropdown ul li',
					'.eltd-shopping-cart-dropdown .eltd-cart-bottom'
				);
				$woocommerce_border_color_selectors = array(
					'.eltd-woocommerce-page .widget_price_filter .price_slider  .ui-slider-handle',
					'.woocommerce-pagination .page-numbers li a:hover',
					'.woocommerce-pagination .page-numbers li span:hover',
					'.woocommerce-pagination .page-numbers li span.current:hover',
					'.woocommerce-pagination .page-numbers li span.current'
				);
				echo chandelier_elated_dynamic_css($woocommerce_color_selectors, array('color' => chandelier_elated_options()->getOptionValue('first_color')));
				echo chandelier_elated_dynamic_css($woocommerce_background_color_selectors, array('background-color' => chandelier_elated_options()->getOptionValue('first_color')));
				echo chandelier_elated_dynamic_css($woocommerce_border_color_selectors, array('border-color' => chandelier_elated_options()->getOptionValue('first_color')));
				
			}

            
        }

		/**
		 * SECOND COLOR
		 */
		if(chandelier_elated_options()->getOptionValue('second_color') !== "") {
            $second_color_color_selector = array(
				'.eltd-404-page .eltd-page-not-found-subtitle',
				'.eltd-main-menu ul li:hover > a',
				'.eltd-main-menu ul li.eltd-active-item > a',
				'body:not(.eltd-menu-item-first-level-bg-color) .eltd-main-menu > ul > li:hover > a',
				'.eltd-main-menu > ul > li.eltd-active-item > a',
				'footer .widget .tagcloud a:hover',
				'.eltd-title .eltd-title-holder .eltd-subtitle',
				'.eltd-side-menu-button-opener:hover',
				'.eltd-search-opener:hover',
				'.eltd-team.main-info-below-image .eltd-team-position',
				'.eltd-team.main-info-below-image .eltd-team-social-holder-between .eltd-icon-shortcode a',
				'.eltd-testimonials .eltd-testimonials-job',
				'.eltd-testimonials .eltd-testimonials-website',
				'blockquote .eltd-icon-quotations-holder',
				'blockquote .eltd-blockquote-text',
				'.eltd-ptf-list-wrapper .eltd-ptf-category-holder',
				'.eltd-ptf-list-wrapper .eltd-ptf-category-holder span',
				'.eltd-section-title-outer-holder .eltd-section-title-subtitle-holder h3',
				'.eltd-processes-holder .eltd-process-arrow:after',
				'.carousel-inner .eltd-slide-subtitle',
				'aside.eltd-sidebar .widget ul li a:hover',
				'aside.eltd-sidebar .widget .tagcloud a:hover',
				'.eltd-blog-holder article .eltd-post-title-holder .eltd-post-info-category a',
				'.eltd-blog-holder article.format-quote .eltd-post-qoute',
				'.eltd-blog-holder article.format-quote .eltd-post-mark .eltd-quote-mark',
				'.eltd-blog-holder article.format-link .eltd-post-mark span',
				'.eltd-social-share-holder.eltd-list li a',
				'.eltd-header-standard .eltd-sticky-header .eltd-header-right-sidebar a:hover',
				'.eltd-icon-list-item .eltd-icon-list-text'
			);
            $second_color_background_color_selector = array(
				'.wpcf7-form.cf7_custom_style_2 input.wpcf7-form-control.wpcf7-submit.eltd-btn',
				'.eltd-newsletter input[type=submit]',
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'.eltd-title .eltd-title-separator-holder .eltd-title-separator',
				'.eltd-progress-bar .eltd-progress-content-outer .eltd-progress-content',
				'.eltd-pricing-tables.eltd-dark-skin .eltd-price-table-inner ul .eltd-table-title',
				'.eltd-pricing-tables.eltd-dark-skin .eltd-price-table.eltd-active .eltd-active-text',
				'.eltd-processes-holder .eltd-process-arrow',
				'.eltd-blog-holder article .eltd-post-content-info-column .eltd-post-date-day-year',
				'.eltd-blog-holder article.format-audio .mejs-container .mejs-time-current',
				'.eltd-blog-holder article.format-audio .mejs-container .mejs-horizontal-volume-current',
				'.eltd-404-page .eltd-page-not-found-title:after'
            );

             $second_color_background_color_important_selector = array(
				'input.wpcf7-form-control.wpcf7-submit:hover',
				'.post-password-form input[type="submit"]:hover'
             );

            $second_color_border_color_selector = array(
				'.wpcf7-form div.wpcf7-mail-sent-ok',
				'.eltd-single-product-summary .eltd-single-product-categories a'
            );
			
			echo chandelier_elated_dynamic_css($second_color_color_selector, array('color' => chandelier_elated_options()->getOptionValue('second_color')));
            echo chandelier_elated_dynamic_css($second_color_background_color_selector, array('background-color' => chandelier_elated_options()->getOptionValue('second_color')));
            echo chandelier_elated_dynamic_css($second_color_background_color_important_selector, array('background-color' => chandelier_elated_options()->getOptionValue('second_color').'!important'));
            echo chandelier_elated_dynamic_css($second_color_border_color_selector, array('border-color' => chandelier_elated_options()->getOptionValue('second_color')));
			
			if( chandelier_elated_is_woocommerce_installed() ){
				$second_color_woo_color_selectors = array(
					'.eltd-single-product-summary .eltd-single-product-categories',
					'.eltd-single-product-summary .eltd-single-product-categories a',
					'.eltd-single-product-summary .eltd-single-product-price .woocommerce-review-link:hover',
					'.eltd-single-product-summary form.cart .reset_variations:hover',
					'.eltd-woocommerce-page .eltd-tab-container .comment-form-rating .stars a.active:after',
					'.eltd-woocommerce-page .eltd-tab-container .comment-form-rating .stars a:hover:after',
					'.eltd-woocommerce-page .related.products .eltd-related-products-subtitle',
					'.eltd-shopping-cart-dropdown .eltd-item-info-holder .eltd-item-left a:hover'
				);
				$secoond_color_woo_background_color_selectors = array(
					'.eltd-woocommerce-page .product .eltd-image-add-to-cart-holder .added_to_cart',
					'.eltd-woocommerce-page .woocommerce-message .button',
					'.eltd-woocommerce-page .woocommerce-info .button',
					'.eltd-woocommerce-page .woocommerce-error .button',
					'.eltd-woocommerce-page .widget_price_filter .price_slider .ui-slider-range',
					'.eltd-woocommerce-page .price_slider_amount .button',
					'.eltd-shopping-cart-outer .eltd-shopping-cart-header .eltd-header-cart-span',
					'.eltd-woocommerce-page .select2-results .select2-highlighted'
				);
				
				echo chandelier_elated_dynamic_css($second_color_woo_color_selectors, array('color' => chandelier_elated_options()->getOptionValue('second_color')));
				echo chandelier_elated_dynamic_css($secoond_color_woo_background_color_selectors, array('background-color' => chandelier_elated_options()->getOptionValue('second_color')));
			}

            
        }

		if (chandelier_elated_options()->getOptionValue('page_background_color')) {
			$background_color_selector = array(
				'.eltd-wrapper-inner',
				'.eltd-container',
				'.eltd-full-width',
			);
			echo chandelier_elated_dynamic_css($background_color_selector, array('background-color' => chandelier_elated_options()->getOptionValue('page_background_color')));

			$background_color_svg_holder_selector = array(
				'.eltd-title-svg-holder .eltd-title-svg-holder-side',
				'.eltd-title-svg-holder .eltd-title-svg-holder-middle path'
			);
			echo chandelier_elated_dynamic_css($background_color_svg_holder_selector, array(
				'background-color' => chandelier_elated_options()->getOptionValue('page_background_color') . '!important',
				'fill' => chandelier_elated_options()->getOptionValue('page_background_color')
				)
			);
		}

		if (chandelier_elated_options()->getOptionValue('selection_color')) {
			echo chandelier_elated_dynamic_css('::selection', array('background' => chandelier_elated_options()->getOptionValue('selection_color')));
			echo chandelier_elated_dynamic_css('::-moz-selection', array('background' => chandelier_elated_options()->getOptionValue('selection_color')));
		}

		$boxed_background_style = array();
		if (chandelier_elated_options()->getOptionValue('page_background_color_in_box')) {
			$boxed_background_style['background-color'] = chandelier_elated_options()->getOptionValue('page_background_color_in_box');
		}

		if (chandelier_elated_options()->getOptionValue('boxed_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(chandelier_elated_options()->getOptionValue('boxed_background_image')).')';
			$boxed_background_style['background-position'] = 'center 0px';
			$boxed_background_style['background-repeat'] = 'no-repeat';
		}

		if (chandelier_elated_options()->getOptionValue('boxed_pattern_background_image')) {
			$boxed_background_style['background-image'] = 'url('.esc_url(chandelier_elated_options()->getOptionValue('boxed_pattern_background_image')).')';
			$boxed_background_style['background-position'] = '0px 0px';
			$boxed_background_style['background-repeat'] = 'repeat';
		}

		if (chandelier_elated_options()->getOptionValue('boxed_background_image_attachment')) {
			$boxed_background_style['background-attachment'] = (chandelier_elated_options()->getOptionValue('boxed_background_image_attachment'));
		}

		echo chandelier_elated_dynamic_css('.eltd-boxed .eltd-wrapper', $boxed_background_style);

        $error404_style = array();
        if ( (chandelier_elated_options()->getOptionValue('404_background_image') !== '') ) {
            $error404_style['background-image'] = 'url(' . esc_url(chandelier_elated_options()->getOptionValue('404_background_image')) . ')';
            $error404_style['background-size'] = 'cover';
            $error404_style['background-position'] = 'center';
            $error404_style['background-attachment'] = 'fixed';
        }

        echo chandelier_elated_dynamic_css('.error404 .eltd-content', $error404_style);

    }

    add_action('chandelier_elated_style_dynamic', 'chandelier_elated_design_styles');
}

if (!function_exists('chandelier_elated_smooth_page_transition_styles')) {

	function chandelier_elated_smooth_page_transition_styles() {

		$loader_style = array();

		if(chandelier_elated_options()->getOptionValue('smooth_pt_bgnd_color') !== '') {
			$loader_style['background-color'] = chandelier_elated_options()->getOptionValue('smooth_pt_bgnd_color');
		}

		$loader_selector = array('.eltd-smooth-transition-loader');

		if (!empty($loader_style)) {
			echo chandelier_elated_dynamic_css($loader_selector, $loader_style);
		}

		$spinner_style = array();

		if(chandelier_elated_options()->getOptionValue('smooth_pt_spinner_color') !== '') {
			$spinner_style['background-color'] = chandelier_elated_options()->getOptionValue('smooth_pt_spinner_color');
		}

		$spinner_selectors = array(
				'.eltd-st-loader .pulse',
				'.eltd-st-loader .double_pulse .double-bounce1',
				'.eltd-st-loader .double_pulse .double-bounce2',
				'.eltd-st-loader .cube',
				'.eltd-st-loader .rotating_cubes .cube1',
				'.eltd-st-loader .rotating_cubes .cube2',
				'.eltd-st-loader .stripes > div',
				'.eltd-st-loader .wave > div',
				'.eltd-st-loader .two_rotating_circles .dot1',
				'.eltd-st-loader .two_rotating_circles .dot2',
				'.eltd-st-loader .five_rotating_circles .container1 > div',
				'.eltd-st-loader .five_rotating_circles .container2 > div',
				'.eltd-st-loader .five_rotating_circles .container3 > div',
				'.eltd-st-loader .atom .ball-1:before',
				'.eltd-st-loader .atom .ball-2:before',
				'.eltd-st-loader .atom .ball-3:before',
				'.eltd-st-loader .atom .ball-4:before',
				'.eltd-st-loader .clock .ball:before',
				'.eltd-st-loader .mitosis .ball',
				'.eltd-st-loader .lines .line1',
				'.eltd-st-loader .lines .line2',
				'.eltd-st-loader .lines .line3',
				'.eltd-st-loader .lines .line4',
				'.eltd-st-loader .fussion .ball',
				'.eltd-st-loader .fussion .ball-1',
				'.eltd-st-loader .fussion .ball-2',
				'.eltd-st-loader .fussion .ball-3',
				'.eltd-st-loader .fussion .ball-4',
				'.eltd-st-loader .wave_circles .ball',
				'.eltd-st-loader .pulse_circles .ball'
		);

		if (!empty($spinner_style)) {
			echo chandelier_elated_dynamic_css($spinner_selectors, $spinner_style);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_smooth_page_transition_styles');
}

if (!function_exists('chandelier_elated_h1_styles')) {

	function chandelier_elated_h1_styles() {

		$h1_styles = array();

		if(chandelier_elated_options()->getOptionValue('h1_color') !== '') {
			$h1_styles['color'] = chandelier_elated_options()->getOptionValue('h1_color');
		}
		if(chandelier_elated_options()->getOptionValue('h1_google_fonts') !== '-1') {
			$h1_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('h1_google_fonts'));
		}
		if(chandelier_elated_options()->getOptionValue('h1_fontsize') !== '') {
			$h1_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h1_fontsize')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h1_lineheight') !== '') {
			$h1_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h1_lineheight')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h1_texttransform') !== '') {
			$h1_styles['text-transform'] = chandelier_elated_options()->getOptionValue('h1_texttransform');
		}
		if(chandelier_elated_options()->getOptionValue('h1_fontstyle') !== '') {
			$h1_styles['font-style'] = chandelier_elated_options()->getOptionValue('h1_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('h1_fontweight') !== '') {
			$h1_styles['font-weight'] = chandelier_elated_options()->getOptionValue('h1_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('h1_letterspacing') !== '') {
			$h1_styles['letter-spacing'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h1_letterspacing')).'px';
		}

		$h1_selector = array(
				'h1'
		);

		if (!empty($h1_styles)) {
			echo chandelier_elated_dynamic_css($h1_selector, $h1_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_h1_styles');
}

if (!function_exists('chandelier_elated_h2_styles')) {

	function chandelier_elated_h2_styles() {

		$h2_styles = array();

		if(chandelier_elated_options()->getOptionValue('h2_color') !== '') {
			$h2_styles['color'] = chandelier_elated_options()->getOptionValue('h2_color');
		}
		if(chandelier_elated_options()->getOptionValue('h2_google_fonts') !== '-1') {
			$h2_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('h2_google_fonts'));
		}
		if(chandelier_elated_options()->getOptionValue('h2_fontsize') !== '') {
			$h2_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h2_fontsize')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h2_lineheight') !== '') {
			$h2_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h2_lineheight')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h2_texttransform') !== '') {
			$h2_styles['text-transform'] = chandelier_elated_options()->getOptionValue('h2_texttransform');
		}
		if(chandelier_elated_options()->getOptionValue('h2_fontstyle') !== '') {
			$h2_styles['font-style'] = chandelier_elated_options()->getOptionValue('h2_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('h2_fontweight') !== '') {
			$h2_styles['font-weight'] = chandelier_elated_options()->getOptionValue('h2_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('h2_letterspacing') !== '') {
			$h2_styles['letter-spacing'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h2_letterspacing')).'px';
		}

		$h2_selector = array(
				'h2'
		);

		if (!empty($h2_styles)) {
			echo chandelier_elated_dynamic_css($h2_selector, $h2_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_h2_styles');
}

if (!function_exists('chandelier_elated_h3_styles')) {

	function chandelier_elated_h3_styles() {

		$h3_styles = array();

		if(chandelier_elated_options()->getOptionValue('h3_color') !== '') {
			$h3_styles['color'] = chandelier_elated_options()->getOptionValue('h3_color');
		}
		if(chandelier_elated_options()->getOptionValue('h3_google_fonts') !== '-1') {
			$h3_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('h3_google_fonts'));
		}
		if(chandelier_elated_options()->getOptionValue('h3_fontsize') !== '') {
			$h3_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h3_fontsize')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h3_lineheight') !== '') {
			$h3_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h3_lineheight')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h3_texttransform') !== '') {
			$h3_styles['text-transform'] = chandelier_elated_options()->getOptionValue('h3_texttransform');
		}
		if(chandelier_elated_options()->getOptionValue('h3_fontstyle') !== '') {
			$h3_styles['font-style'] = chandelier_elated_options()->getOptionValue('h3_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('h3_fontweight') !== '') {
			$h3_styles['font-weight'] = chandelier_elated_options()->getOptionValue('h3_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('h3_letterspacing') !== '') {
			$h3_styles['letter-spacing'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h3_letterspacing')).'px';
		}

		$h3_selector = array(
				'h3'
		);

		if (!empty($h3_styles)) {
			echo chandelier_elated_dynamic_css($h3_selector, $h3_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_h3_styles');
}

if (!function_exists('chandelier_elated_h4_styles')) {

	function chandelier_elated_h4_styles() {

		$h4_styles = array();

		if(chandelier_elated_options()->getOptionValue('h4_color') !== '') {
			$h4_styles['color'] = chandelier_elated_options()->getOptionValue('h4_color');
		}
		if(chandelier_elated_options()->getOptionValue('h4_google_fonts') !== '-1') {
			$h4_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('h4_google_fonts'));
		}
		if(chandelier_elated_options()->getOptionValue('h4_fontsize') !== '') {
			$h4_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h4_fontsize')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h4_lineheight') !== '') {
			$h4_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h4_lineheight')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h4_texttransform') !== '') {
			$h4_styles['text-transform'] = chandelier_elated_options()->getOptionValue('h4_texttransform');
		}
		if(chandelier_elated_options()->getOptionValue('h4_fontstyle') !== '') {
			$h4_styles['font-style'] = chandelier_elated_options()->getOptionValue('h4_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('h4_fontweight') !== '') {
			$h4_styles['font-weight'] = chandelier_elated_options()->getOptionValue('h4_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('h4_letterspacing') !== '') {
			$h4_styles['letter-spacing'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h4_letterspacing')).'px';
		}

		$h4_selector = array(
				'h4'
		);

		if (!empty($h4_styles)) {
			echo chandelier_elated_dynamic_css($h4_selector, $h4_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_h4_styles');
}

if (!function_exists('chandelier_elated_h5_styles')) {

	function chandelier_elated_h5_styles() {

		$h5_styles = array();

		if(chandelier_elated_options()->getOptionValue('h5_color') !== '') {
			$h5_styles['color'] = chandelier_elated_options()->getOptionValue('h5_color');
		}
		if(chandelier_elated_options()->getOptionValue('h5_google_fonts') !== '-1') {
			$h5_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('h5_google_fonts'));
		}
		if(chandelier_elated_options()->getOptionValue('h5_fontsize') !== '') {
			$h5_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h5_fontsize')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h5_lineheight') !== '') {
			$h5_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h5_lineheight')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h5_texttransform') !== '') {
			$h5_styles['text-transform'] = chandelier_elated_options()->getOptionValue('h5_texttransform');
		}
		if(chandelier_elated_options()->getOptionValue('h5_fontstyle') !== '') {
			$h5_styles['font-style'] = chandelier_elated_options()->getOptionValue('h5_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('h5_fontweight') !== '') {
			$h5_styles['font-weight'] = chandelier_elated_options()->getOptionValue('h5_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('h5_letterspacing') !== '') {
			$h5_styles['letter-spacing'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h5_letterspacing')).'px';
		}

		$h5_selector = array(
				'h5'
		);

		if (!empty($h5_styles)) {
			echo chandelier_elated_dynamic_css($h5_selector, $h5_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_h5_styles');
}

if (!function_exists('chandelier_elated_h6_styles')) {

	function chandelier_elated_h6_styles() {

		$h6_styles = array();

		if(chandelier_elated_options()->getOptionValue('h6_color') !== '') {
			$h6_styles['color'] = chandelier_elated_options()->getOptionValue('h6_color');
		}
		if(chandelier_elated_options()->getOptionValue('h6_google_fonts') !== '-1') {
			$h6_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('h6_google_fonts'));
		}
		if(chandelier_elated_options()->getOptionValue('h6_fontsize') !== '') {
			$h6_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h6_fontsize')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h6_lineheight') !== '') {
			$h6_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h6_lineheight')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('h6_texttransform') !== '') {
			$h6_styles['text-transform'] = chandelier_elated_options()->getOptionValue('h6_texttransform');
		}
		if(chandelier_elated_options()->getOptionValue('h6_fontstyle') !== '') {
			$h6_styles['font-style'] = chandelier_elated_options()->getOptionValue('h6_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('h6_fontweight') !== '') {
			$h6_styles['font-weight'] = chandelier_elated_options()->getOptionValue('h6_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('h6_letterspacing') !== '') {
			$h6_styles['letter-spacing'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('h6_letterspacing')).'px';
		}

		$h6_selector = array(
				'h6'
		);

		if (!empty($h6_styles)) {
			echo chandelier_elated_dynamic_css($h6_selector, $h6_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_h6_styles');
}

if (!function_exists('chandelier_elated_text_styles')) {

	function chandelier_elated_text_styles() {

		$text_styles = array();

		if(chandelier_elated_options()->getOptionValue('text_color') !== '') {
			$text_styles['color'] = chandelier_elated_options()->getOptionValue('text_color');
		}
		if(chandelier_elated_options()->getOptionValue('text_google_fonts') !== '-1') {
			$text_styles['font-family'] = chandelier_elated_get_formatted_font_family(chandelier_elated_options()->getOptionValue('text_google_fonts'));
		}
		if(chandelier_elated_options()->getOptionValue('text_fontsize') !== '') {
			$text_styles['font-size'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('text_fontsize')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('text_lineheight') !== '') {
			$text_styles['line-height'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('text_lineheight')).'px';
		}
		if(chandelier_elated_options()->getOptionValue('text_texttransform') !== '') {
			$text_styles['text-transform'] = chandelier_elated_options()->getOptionValue('text_texttransform');
		}
		if(chandelier_elated_options()->getOptionValue('text_fontstyle') !== '') {
			$text_styles['font-style'] = chandelier_elated_options()->getOptionValue('text_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('text_fontweight') !== '') {
			$text_styles['font-weight'] = chandelier_elated_options()->getOptionValue('text_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('text_letterspacing') !== '') {
			$text_styles['letter-spacing'] = chandelier_elated_filter_px(chandelier_elated_options()->getOptionValue('text_letterspacing')).'px';
		}

		$text_selector = array(
				'p'
		);

		if (!empty($text_styles)) {
			echo chandelier_elated_dynamic_css($text_selector, $text_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_text_styles');
}

if (!function_exists('chandelier_elated_link_styles')) {

	function chandelier_elated_link_styles() {

		$link_styles = array();

		if(chandelier_elated_options()->getOptionValue('link_color') !== '') {
			$link_styles['color'] = chandelier_elated_options()->getOptionValue('link_color');
		}
		if(chandelier_elated_options()->getOptionValue('link_fontstyle') !== '') {
			$link_styles['font-style'] = chandelier_elated_options()->getOptionValue('link_fontstyle');
		}
		if(chandelier_elated_options()->getOptionValue('link_fontweight') !== '') {
			$link_styles['font-weight'] = chandelier_elated_options()->getOptionValue('link_fontweight');
		}
		if(chandelier_elated_options()->getOptionValue('link_fontdecoration') !== '') {
			$link_styles['text-decoration'] = chandelier_elated_options()->getOptionValue('link_fontdecoration');
		}

		$link_selector = array(
				'a',
				'p a'
		);

		if (!empty($link_styles)) {
			echo chandelier_elated_dynamic_css($link_selector, $link_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_link_styles');
}

if (!function_exists('chandelier_elated_link_hover_styles')) {

	function chandelier_elated_link_hover_styles() {

		$link_hover_styles = array();

		if(chandelier_elated_options()->getOptionValue('link_hovercolor') !== '') {
			$link_hover_styles['color'] = chandelier_elated_options()->getOptionValue('link_hovercolor');
		}
		if(chandelier_elated_options()->getOptionValue('link_hover_fontdecoration') !== '') {
			$link_hover_styles['text-decoration'] = chandelier_elated_options()->getOptionValue('link_hover_fontdecoration');
		}

		$link_hover_selector = array(
				'a:hover',
				'p a:hover'
		);

		if (!empty($link_hover_styles)) {
			echo chandelier_elated_dynamic_css($link_hover_selector, $link_hover_styles);
		}

		$link_heading_hover_styles = array();

		if(chandelier_elated_options()->getOptionValue('link_hovercolor') !== '') {
			$link_heading_hover_styles['color'] = chandelier_elated_options()->getOptionValue('link_hovercolor');
		}

		$link_heading_hover_selector = array(
				'h1 a:hover',
				'h2 a:hover',
				'h3 a:hover',
				'h4 a:hover',
				'h5 a:hover',
				'h6 a:hover'
		);

		if (!empty($link_heading_hover_styles)) {
			echo chandelier_elated_dynamic_css($link_heading_hover_selector, $link_heading_hover_styles);
		}
	}

	add_action('chandelier_elated_style_dynamic', 'chandelier_elated_link_hover_styles');
}