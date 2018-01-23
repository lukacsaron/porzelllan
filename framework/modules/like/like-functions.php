<?php

if ( ! function_exists('chandelier_elated_like') ) {
	/**
	 * Returns ChandelierLike instance
	 *
	 * @return ChandelierLike
	 */
	function chandelier_elated_like() {
		return ChandelierLike::get_instance();
	}

}

function chandelier_elated_get_like() {

	echo wp_kses(chandelier_elated_like()->add_like(), array(
		'span' => array(
			'class' => true,
			'aria-hidden' => true,
			'style' => true,
			'id' => true
		),
		'i' => array(
			'class' => true,
			'style' => true,
			'id' => true
		),
		'a' => array(
			'href' => true,
			'class' => true,
			'id' => true,
			'title' => true,
			'style' => true
		)
	));
}

if ( ! function_exists('chandelier_elated_like_latest_posts') ) {
	/**
	 * Add like to latest post
	 *
	 * @return string
	 */
	function chandelier_elated_like_latest_posts() {
		return chandelier_elated_like()->add_like();
	}

}

if ( ! function_exists('chandelier_elated_like_portfolio_list') ) {
	/**
	 * Add like to portfolio project
	 *
	 * @param $portfolio_project_id
	 * @return string
	 */
	function chandelier_elated_like_portfolio_list($portfolio_project_id) {
		return chandelier_elated_like()->add_like_portfolio_list($portfolio_project_id);
	}

}