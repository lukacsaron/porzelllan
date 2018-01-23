<?php

if (!function_exists('chandelier_elated_woocommerce_products_per_page')) {
	/**
	 * Function that sets number of products per page. Default is 12
	 * @return int number of products to be shown per page
	 */
	function chandelier_elated_woocommerce_products_per_page() {

		$products_per_page = 12;

		if (chandelier_elated_options()->getOptionValue('eltd_woo_products_per_page')) {
			$products_per_page = chandelier_elated_options()->getOptionValue('eltd_woo_products_per_page');
		}

		return $products_per_page;

	}

}

if (!function_exists('chandelier_elated_woocommerce_related_products_args')) {
	/**
	 * Function that sets number of displayed related products. Hooks to woocommerce_output_related_products_args filter
	 * @param $args array array of args for the query
	 * @return mixed array of changed args
	 */
	function chandelier_elated_woocommerce_related_products_args($args) {

		if (chandelier_elated_options()->getOptionValue('eltd_woo_product_list_columns')) {

			$related = chandelier_elated_options()->getOptionValue('eltd_woo_product_list_columns');
			switch ($related) {
				case 'eltd-woocommerce-columns-4':
					$args['posts_per_page'] = 4;
					break;
				case 'eltd-woocommerce-columns-3':
					$args['posts_per_page'] = 3;
					break;
				default:
					$args['posts_per_page'] = 3;
			}

		} else {
			$args['posts_per_page'] = 3;
		}

		return $args;

	}

}

if (!function_exists('chandelier_elated_woocommerce_template_loop_product_title')) {
	/**
	 * Function for overriding product title template in Product List Loop
	 */
	function chandelier_elated_woocommerce_template_loop_product_title() {

		$tag = chandelier_elated_options()->getOptionValue('eltd_products_list_title_tag');
		the_title('<' . $tag . ' class="eltd-product-list-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('chandelier_elated_woocommerce_template_single_title')) {
	/**
	 * Function for overriding product title template in Single Product template
	 */
	function chandelier_elated_woocommerce_template_single_title() {

		$tag = chandelier_elated_options()->getOptionValue('eltd_single_product_title_tag');
		the_title('<' . $tag . '  itemprop="name" class="eltd-single-product-title">', '</' . $tag . '>');

	}

}

if (!function_exists('chandelier_elated_woocommerce_sale_flash')) {
	/**
	 * Function for overriding Sale Flash Template
	 *
	 * @return string
	 */
	function chandelier_elated_woocommerce_sale_flash() {

		return '<span class="eltd-onsale"><span class="eltd-onsale-inner">' . esc_html__('Sale', 'chandelier') . '</span></span>';

	}

}

if (!function_exists('chandelier_elated_custom_override_checkout_fields')) {
	/**
	 * Overrides placeholder values for checkout fields
	 * @param array all checkout fields
	 * @return array checkout fields with overriden values
	 */
	function chandelier_elated_custom_override_checkout_fields($fields) {
		//billing fields
		$args_billing = array(
			'first_name'	=> esc_html__('First name','chandelier'),
			'last_name'		=> esc_html__('Last name','chandelier'),
			'company'		=> esc_html__('Company name','chandelier'),
			'address_1'		=> esc_html__('Address','chandelier'),
			'email'			=> esc_html__('Email','chandelier'),
			'phone'			=> esc_html__('Phone','chandelier'),
			'postcode'		=> esc_html__('Postcode / ZIP','chandelier'),
			'state'			=> esc_html__('State / County', 'chandelier'),
			'city'			=> esc_html__('Town / City', 'chandelier')
		);

		//shipping fields
		$args_shipping = array(
			'first_name' => esc_html__('First name','chandelier'),
			'last_name'  => esc_html__('Last name','chandelier'),
			'company'    => esc_html__('Company name','chandelier'),
			'address_1'  => esc_html__('Address','chandelier'),
			'postcode'   => esc_html__('Postcode / ZIP','chandelier')
		);

		//override billing placeholder values
		foreach ($args_billing as $key => $value) {
			$fields["billing"]["billing_{$key}"]["placeholder"] = $value;
		}

		//override shipping placeholder values
		foreach ($args_shipping as $key => $value) {
			$fields["shipping"]["shipping_{$key}"]["placeholder"] = $value;
		}

		return $fields;
	}

}

if (!function_exists('chandelier_elated_woocommerce_loop_add_to_cart_link')) {
	/**
	 * Function that overrides default woocommerce add to cart button on product list
	 * Uses HTML from eltd_button
	 *
	 * @return mixed|string
	 */
	function chandelier_elated_woocommerce_loop_add_to_cart_link() {

		global $product;

		$button_url = $product->add_to_cart_url();
		$button_classes = sprintf('%s product_type_%s',
			$product->is_purchasable() && $product->is_in_stock() && $product->get_type() !== 'variable' ? 'add_to_cart_button ajax_add_to_cart' : '',
			esc_attr( $product->get_type() )
		);
		$button_text = $product->add_to_cart_text();
		$button_attrs = array(
			'rel' => 'nofollow',
			'data-product_id' => esc_attr( $product->get_id() ),
			'data-product_sku' => esc_attr( $product->get_sku() ),
			'data-quantity' => esc_attr( isset( $quantity ) ? $quantity : 1 )
		);
		$button_icon = ($product->is_in_stock()) ? 'icon-handbag' : 'icon-action-redo';
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);
		
		$add_to_cart_button = chandelier_elated_get_button_html(
			array(
				'type'			=> 'solid',
				'icon_pack'		=> 'simple_line_icons',
				'simple_line_icons' => $button_icon,
				'background_color' => $button_back_color,
				'link'			=> $button_url,
				'custom_class'	=> $button_classes,
				'text'			=> $button_text,
				'custom_attrs'	=> $button_attrs
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('chandelier_elated_get_woocommerce_add_to_cart_button')) {
	/**
	 * Function that overrides default woocommerce add to cart button on simple and grouped product single template
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_get_woocommerce_add_to_cart_button() {

		global $product;
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);

		$add_to_cart_button = chandelier_elated_get_button_html(
			array(
				'type'			=> 'solid',
				'icon_pack'		=> 'simple_line_icons',
				'simple_line_icons' => 'icon-handbag',
				'background_color' => $button_back_color,
				'custom_class'	=> 'single_add_to_cart_button eltd-single-product-add-to-cart alt',
				'text'			=> $product->single_add_to_cart_text(),
				'html_type'		=> 'button',
				'custom_attrs'	=> array(
					'name'          => 'add-to-cart',
					'value'         => $product->get_id(),
				)
			)
		);

		print $add_to_cart_button;

	}

}

if (!function_exists('chandelier_elated_get_woocommerce_add_to_cart_button_external')) {
	/**
	 * Function that overrides default woocommerce add to cart button on external product single template
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_get_woocommerce_add_to_cart_button_external() {

		global $product;
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);
		
		$add_to_cart_button = chandelier_elated_get_button_html(
			array(
				'type'			=> 'solid',
				'icon_pack'		=> 'simple_line_icons',
				'simple_line_icons' => 'icon-handbag',
				'background_color' => $button_back_color,
				'link'			=> $product->add_to_cart_url(),
				'custom_class'	=> 'single_add_to_cart_button eltd-single-product-add-to-cart alt',
				'text'			=> $product->single_add_to_cart_text(),
				'custom_attrs'	=> array(
					'rel' 		=> 'nofollow',
					'name'          => 'add-to-cart',
					'value'         => $product->get_id(),
				)
			)
		);

		print $add_to_cart_button;

	}

}

if ( ! function_exists('chandelier_elated_woocommerce_single_variation_add_to_cart_button') ) {
	/**
	 * Function that overrides default woocommerce add to cart button on variable product single template
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_woocommerce_single_variation_add_to_cart_button() {
		global $product;
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);
		
		$html = '<div class="variations_button">';
		woocommerce_quantity_input( array( 'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 ) );

		$button = chandelier_elated_get_button_html(array(
			'type'			=> 'solid',
			'icon_pack'		=> 'simple_line_icons',
			'simple_line_icons' => 'icon-handbag',
			'background_color' => $button_back_color,
			'html_type'		=> 'button',
			'custom_class'	=> 'single_add_to_cart_button eltd-single-product-add-to-cart alt',
			'text'			=> $product->single_add_to_cart_text(),
			'custom_attrs'	=> array(
				'name'          => 'add-to-cart',
				'value'         => $product->get_id(),
			)

		));

		$html .= $button;

		$html .= '<input type="hidden" name="add-to-cart" value="' . absint( $product->get_id() ) . '" />';
		$html .= '<input type="hidden" name="product_id" value="' . absint( $product->get_id() ) . '" />';
		$html .= '<input type="hidden" name="variation_id" class="variation_id" value="" />';
		$html .= '</div>';

		print $html;

	}

}

if (!function_exists('chandelier_elated_get_woocommerce_apply_coupon_button')) {
	/**
	 * Function that overrides default woocommerce apply coupon button
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_get_woocommerce_apply_coupon_button() {
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);

		$coupon_button = chandelier_elated_get_button_html(array(
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'html_type'		=> 'input',
			'input_name'	=> 'apply_coupon',
			'text'			=> esc_html__( 'Apply Coupon', 'chandelier' ),
		));

		print $coupon_button;

	}

}

if (!function_exists('chandelier_elated_get_woocommerce_update_cart_button')) {
	/**
	 * Function that overrides default woocommerce update cart button
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_get_woocommerce_update_cart_button() {
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);

		$update_cart_button = chandelier_elated_get_button_html(array(
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'html_type'		=> 'input',
			'input_name'	=> 'update_cart',
			'text'			=> esc_html__( 'Update Cart', 'chandelier' )
		));

		print $update_cart_button;

	}

}

if (!function_exists('chandelier_elated_woocommerce_button_proceed_to_checkout')) {
	/**
	 * Function that overrides default woocommerce proceed to checkout button
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_woocommerce_button_proceed_to_checkout() {

		$proceed_to_checkout_button = chandelier_elated_get_button_html(array(
			'type'			=> 'solid',
			'link'			=> wc_get_checkout_url(),
			'custom_class'	=> 'checkout-button alt wc-forward',
			'text'			=> esc_html__( 'Proceed to Checkout', 'chandelier' )
		));

		print $proceed_to_checkout_button;

	}

}

if (!function_exists('chandelier_elated_get_woocommerce_update_totals_button')) {
	/**
	 * Function that overrides default woocommerce update totals button
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_get_woocommerce_update_totals_button() {
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);

		$update_totals_button = chandelier_elated_get_button_html(array(
			'html_type'		=> 'button',
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'text'			=> esc_html__( 'Update Totals', 'chandelier' ),
			'custom_attrs'	=> array(
				'value'		=> 1,
				'name'		=> 'calc_shipping'
			)
		));

		print $update_totals_button;

	}

}

if (!function_exists('chandelier_elated_woocommerce_pay_order_button_html')) {
	/**
	 * Function that overrides default woocommerce pay order button on checkout page
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_woocommerce_pay_order_button_html() {

		$pay_order_button_text = esc_html__('Pay for order', 'chandelier');
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);

		$place_order_button = chandelier_elated_get_button_html(array(
			'html_type'		=> 'input',
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'custom_class'	=> 'alt',
			'custom_attrs'	=> array(
				'id'			=> 'place_order',
				'data-value'	=> $pay_order_button_text
			),
			'text'			=> $pay_order_button_text,
		));

		return $place_order_button;

	}

}

if (!function_exists('chandelier_elated_woocommerce_order_button_html')) {
	/**
	 * Function that overrides default woocommerce place order button on checkout page
	 * Uses HTML from eltd_button
	 */
	function chandelier_elated_woocommerce_order_button_html() {

		$pay_order_button_text = esc_html__('Place Order', 'chandelier');
		
		$id = chandelier_elated_get_page_id();
		$button_back_color = chandelier_elated_get_page_main_color($id);

		$place_order_button = chandelier_elated_get_button_html(array(
			'html_type'		=> 'input',
			'type'			=> 'solid',
			'background_color' => $button_back_color,
			'custom_class'	=> 'alt',
			'custom_attrs'	=> array(
				'id'			=> 'place_order',
				'data-value'	=> $pay_order_button_text,
				'name'			=> 'woocommerce_checkout_place_order'
			),
			'text'			=> $pay_order_button_text,
		));

		return $place_order_button;

	}

}

if ( ! function_exists( 'chandelier_elated_woocommerce_loop_out_of_stock' ) ) {

	function chandelier_elated_woocommerce_loop_out_of_stock() {

		global $product;

		if ( ! $product->is_in_stock() ) {
			echo '<span class="eltd-out-of-stock"><span class="eltd-out-of-stock-inner">' . esc_html__('Out', 'chandelier') . '<span class="eltd-out-of-stock-inner-small">' . esc_html__('of Stock', 'chandelier') . '</span></span></span>';
		}

	}

}

if ( ! function_exists( 'chandelier_elated_woocommerce_template_single_category' ) ) {

	/**
	 * Add product categories before product title on single product page
	 */
	function chandelier_elated_woocommerce_template_single_category() {

		global $product;

		$categories = wc_get_product_category_list($product->get_id());

		echo '<div class="eltd-single-product-categories">';
		echo wp_kses($categories, array(
			'a' => array(
				'href' => true,
				'rel' => true
			)
		));
		echo '</div>';

	}

}

if ( ! function_exists( 'chandelier_elated_woocommerce_template_loop_lightbox' ) ) {

	function chandelier_elated_woocommerce_template_loop_lightbox() {

		$lightbox_html = '';
		if ( chandelier_elated_options()->getOptionValue('eltd_woo_products_lightbox') == 'yes' ) {

			global $product;

			$image_id = $product->get_image_id();
			$image = wp_get_attachment_image_src($image_id, 'full');
			$image_title = $product->get_title();

			$lightbox_html = '<a class="eltd-woocommerce-lightbox" data-rel="prettyPhoto[single_pretty_photo]" href="'. $image[0] .'" title="'. $image_title .'">';
			$lightbox_html .= '<i class="icon-magnifier-add"></i>';
			$lightbox_html .= '</a>';

		}

		print $lightbox_html;

	}

}