<?php
if( !function_exists('chandelier_elated_get_blog') ) {
	/**
	 * Function which return holder for all blog lists
	 *
	 * @return holder.php template
	 */
	function chandelier_elated_get_blog($type) {

		$sidebar = chandelier_elated_sidebar_layout();

		$params = array(
			"blog_type" => $type,
			"sidebar" => $sidebar
		);
		chandelier_elated_get_module_template_part('templates/lists/holder', 'blog', '', $params);
	}

}

if( !function_exists('chandelier_elated_get_blog_type') ) {

	/**
	 * Function which create query for blog lists
	 *
	 * @return blog list template
	 */

	function chandelier_elated_get_blog_type($type) {
		global $wp_query;

		$id = chandelier_elated_get_page_id();
		$category = get_post_meta($id, "eltd_blog_category_meta", true);
		$post_number = esc_attr(get_post_meta($id, "eltd_show_posts_per_page_meta", true));

		$paged = chandelier_elated_paged();

		if(!is_archive()) {
			$blog_query = new WP_Query('post_type=post&paged=' . $paged . '&cat=' . $category . '&posts_per_page=' . $post_number);
		}else{
			$blog_query = $wp_query;
		}

		if(chandelier_elated_options()->getOptionValue('blog_page_range') != ""){
			$blog_page_range = esc_attr(chandelier_elated_options()->getOptionValue('blog_page_range'));
		} else{
			$blog_page_range = $blog_query->max_num_pages;
		}
		$params = array(
			'blog_query' => $blog_query,
			'paged' => $paged,
			'blog_page_range' => $blog_page_range,
			'blog_type' => $type
		);

		chandelier_elated_get_module_template_part('templates/lists/' .  $type, 'blog', '', $params);
	}

}



if( !function_exists('chandelier_elated_get_post_format_html') ) {

	/**
	 * Function which return html for post formats
	 * @param $type
	 * @return post hormat template
	 */

	function chandelier_elated_get_post_format_html($type = "") {

		$post_format = get_post_format();
		if($post_format === false){
			$post_format = 'standard';
		}
		$slug = '';
		if($type !== ""){
			$slug = $type;
		}

		$params = array();

		$chars_array = chandelier_elated_blog_lists_number_of_chars();
		if(isset($chars_array[$type])) {
			$params['excerpt_length'] = $chars_array[$type];
		} else {
			$params['excerpt_length'] = '';
		}


		chandelier_elated_get_module_template_part('templates/lists/post-formats/' . $post_format, 'blog', $slug, $params);

	}

}

if( !function_exists('chandelier_elated_get_default_blog_list') ) {
	/**
	 * Function which return default blog list for archive post types
	 *
	 * @return post format template
	 */

	function chandelier_elated_get_default_blog_list() {

		$blog_list = chandelier_elated_options()->getOptionValue('blog_list_type');
		return $blog_list;

	}

}


if (!function_exists('chandelier_elated_pagination')) {

	/**
	 * Function which return pagination
	 *
	 * @return blog list pagination html
	 */

	function chandelier_elated_pagination($pages = '', $range = 4, $paged = 1){

		if($pages == ''){
			global $wp_query;
			$pages = $wp_query->max_num_pages;
			if(!$pages){
				$pages = 1;
			}
		}

		if ($pages !== 1) {

			echo '<div class="eltd-pagination clearfix">';
			echo '<div class="eltd-pagination-next">';
			if($paged > 1) {
				echo chandelier_elated_get_button_html(array(
					'type' => 'solid',
						'link' => get_pagenum_link( $paged - 1),
						'text' => 'Newer Posts'
				));
			}
			echo '</div>';
			echo '<div class="eltd-pagination-prev">';
			if($paged < $pages) {
				echo chandelier_elated_get_button_html(array(
						'type' => 'solid',
						'link' => get_pagenum_link( $paged + 1),
						'text' => 'Older Posts'
				));
			}
			echo '</div>';
			echo "</div>";
		}

	}
}

if(!function_exists('chandelier_elated_post_info')){
	/**
	 * Function that loads parts of blog post info section
	 * Possible options are:
	 * 1. date
	 * 2. category
	 * 3. author
	 * 4. comments
	 * 5. like
	 * 6. share
	 *
	 * @param $config array of sections to load
	 */
	function chandelier_elated_post_info($config){
		$default_config = array(
			'date' => '',
			'category' => '',
			'author' => '',
			'comments' => '',
			'like' => '',
			'share' => ''
		);

		extract(shortcode_atts($default_config, $config));

		if($date == 'yes'){
			chandelier_elated_get_module_template_part('templates/parts/post-info-date', 'blog');
		}
		if($author == 'yes'){
			chandelier_elated_get_module_template_part('templates/parts/post-info-author', 'blog');
		}
		if($category == 'yes'){
			chandelier_elated_get_module_template_part('templates/parts/post-info-category', 'blog');
		}
		if($comments == 'yes'){
			chandelier_elated_get_module_template_part('templates/parts/post-info-comments', 'blog');
		}
		if($like == 'yes'){
			chandelier_elated_get_module_template_part('templates/parts/post-info-like', 'blog');
		}
		if($share == 'yes'){
			chandelier_elated_get_module_template_part('templates/parts/post-info-share', 'blog');
		}
	}
}

if(!function_exists('chandelier_elated_excerpt')) {
	/**
	 * Function that cuts post excerpt to the number of word based on previosly set global
	 * variable $word_count, which is defined in eltd_set_blog_word_count function.
	 *
	 * It current post has read more tag set it will return content of the post, else it will return post excerpt
	 *
	 */
	function chandelier_elated_excerpt($excerpt_length) {
		global $post;

		if(post_password_required()) {
			echo get_the_password_form();
		}

		//does current post has read more tag set?
		elseif(chandelier_elated_post_has_read_more()) {
			global $more;

			//override global $more variable so this can be used in blog templates
			$more = 0;
			the_content(true);
		}

		//is word count set to something different that 0?
		elseif($excerpt_length != '0') {
			//if word count is set and different than empty take that value, else that general option from theme options
			$word_count = isset($excerpt_length) && $excerpt_length !== "" ? $excerpt_length : esc_attr(chandelier_elated_options()->getOptionValue('number_of_chars'));

			//if post excerpt field is filled take that as post excerpt, else that content of the post
			$post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content);

			//remove leading dots if those exists
			$clean_excerpt = strlen($post_excerpt) && strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;

			//if clean excerpt has text left
			if($clean_excerpt !== '') {
				//explode current excerpt to words
				$excerpt_word_array = explode (' ', $clean_excerpt);

				//cut down that array based on the number of the words option
				$excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);

				//add exerpt postfix
				$excert_postfix		= apply_filters('chandelier_elated_excerpt_postfix', '...');

				//and finally implode words together
				$excerpt 			= implode (' ', $excerpt_word_array).$excert_postfix;

				//is excerpt different than empty string?
				if($excerpt !== '') {
					echo '<p class="eltd-post-excerpt">'.wp_kses_post($excerpt).'</p>';
				}
			}
		}
	}
}

if(!function_exists('chandelier_elated_get_blog_single')) {

	/**
	 * Function which return holder for single posts
	 *
	 * @return single holder.php template
	 */

	function chandelier_elated_get_blog_single() {
		$sidebar = chandelier_elated_sidebar_layout();

		$params = array(
			"sidebar" => $sidebar
		);

		chandelier_elated_get_module_template_part('templates/single/holder', 'blog', '', $params);
	}
}

if( !function_exists('chandelier_elated_get_single_html') ) {

	/**
	 * Function return all parts on single.php page
	 *
	 *
	 * @return single.php html
	 */

	function chandelier_elated_get_single_html() {

		$post_format = get_post_format();
		if($post_format === false){
			$post_format = 'standard';
		}

		//Related posts
		$related_posts_params = array();
		$show_related = (chandelier_elated_options()->getOptionValue('blog_single_related_posts') == 'yes') ? true : false;
		if ($show_related) {
			$hasSidebar = chandelier_elated_sidebar_layout();
			$post_id = get_the_ID();
			$related_post_number = ($hasSidebar == '' || $hasSidebar == 'default' || $hasSidebar == 'no-sidebar') ? 4 : 3;
			$related_posts_options = array(
				'posts_per_page' => $related_post_number
			);
			$related_posts_params = array(
				'related_posts' => chandelier_elated_get_related_post_type($post_id, $related_posts_options)
			);
		}

		chandelier_elated_get_module_template_part('templates/single/post-formats/' . $post_format, 'blog');
		chandelier_elated_get_module_template_part('templates/single/parts/single-navigation', 'blog');
		chandelier_elated_get_module_template_part('templates/single/parts/author-info', 'blog');
		if ($show_related) {
			chandelier_elated_get_module_template_part('templates/single/parts/related-posts', 'blog', '', $related_posts_params);
		}
		if(chandelier_elated_show_comments()){
			comments_template('', true);
		}
	}

}
if( !function_exists('chandelier_elated_additional_post_items') ) {

	/**
	 * Function which return parts on single.php which are just below content
	 */

	function chandelier_elated_additional_post_items() {

		$args_pages = array(
			'before'           => '<div class="eltd-single-links-pages"><div class="eltd-single-links-pages-inner">',
			'after'            => '</div></div>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);

	}
	add_action('chandelier_elated_before_blog_article_closed_tag', 'chandelier_elated_additional_post_items');
}


if (!function_exists('chandelier_elated_comment')) {

	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */

	function chandelier_elated_comment($comment, $args, $depth) {

		$GLOBALS['comment'] = $comment;

		global $post;

		$is_pingback_comment = $comment->comment_type == 'pingback';
		$is_author_comment  = $post->post_author == $comment->user_id;

		$comment_class = 'eltd-comment clearfix';

		if($is_author_comment) {
			$comment_class .= ' eltd-post-author-comment';
		}

		if($is_pingback_comment) {
			$comment_class .= ' eltd-pingback-comment';
		}

		?>

		<li>
		<div class="<?php echo esc_attr($comment_class); ?>">
			<?php if(!$is_pingback_comment) { ?>
				<div class="eltd-comment-image"> <?php echo chandelier_elated_kses_img(get_avatar($comment, 75)); ?> </div>
			<?php } ?>
			<div class="eltd-comment-text">
				<div class="eltd-comment-info clearfix">
					<h6 class="eltd-comment-name">
						<?php if($is_pingback_comment) { esc_html_e('Pingback:', 'chandelier'); } ?>
						<?php echo wp_kses_post(get_comment_author_link()); ?>
					</h6>
				<?php
					comment_reply_link( array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']) ) );
					edit_comment_link();
				?>
			</div>
			<?php if(!$is_pingback_comment) { ?>
				<div class="eltd-text-holder" id="comment-<?php echo comment_ID(); ?>">
					<?php comment_text(); ?>
				</div>
				<span class="eltd-comment-date"><?php comment_time(get_option('date_format')); ?> <?php esc_html_e('at', 'chandelier'); ?> <?php comment_time(get_option('time_format')); ?></span>
			<?php } ?>
		</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>

		<?php
	}
}

if( !function_exists('chandelier_elated_blog_archive_pages_classes') ) {

	/**
	 * Function which create classes for container in archive pages
	 *
	 * @return array
	 */

	function chandelier_elated_blog_archive_pages_classes($blog_type) {

		$classes = array();
		if(in_array($blog_type, chandelier_elated_blog_full_width_types())){
			$classes['holder'] = 'eltd-full-width';
			$classes['inner'] = 'eltd-full-width-inner';
		} elseif(in_array($blog_type, chandelier_elated_blog_grid_types())){
			$classes['holder'] = 'eltd-container';
			$classes['inner'] = 'eltd-container-inner clearfix';
		}

		return $classes;

	}

}

if( !function_exists('chandelier_elated_blog_full_width_types') ) {

	/**
	 * Function which return all full width blog types
	 *
	 * @return array
	 */

	function chandelier_elated_blog_full_width_types() {

		$types = array('masonry-full-width');

		return $types;

	}

}

if( !function_exists('chandelier_elated_blog_grid_types') ) {

	/**
	 * Function which return in grid blog types
	 *
	 * @return array
	 */

	function chandelier_elated_blog_grid_types() {

		$types = array('standard', 'masonry', 'standard-whole-post');

		return $types;

	}

}

if( !function_exists('chandelier_elated_blog_types') ) {

	/**
	 * Function which return all blog types
	 *
	 * @return array
	 */

	function chandelier_elated_blog_types() {

		$types = array_merge(chandelier_elated_blog_grid_types(), chandelier_elated_blog_full_width_types());

		return $types;

	}

}

if( !function_exists('chandelier_elated_blog_templates') ) {

	/**
	 * Function which return all blog templates names
	 *
	 * @return array
	 */

	function chandelier_elated_blog_templates() {

		$templates = array();
		$grid_templates = chandelier_elated_blog_grid_types();
		$full_templates = chandelier_elated_blog_full_width_types();
		foreach($grid_templates as $grid_template){
			array_push($templates, 'blog-'.$grid_template);
		}
		foreach($full_templates as $full_template){
			array_push($templates, 'blog-'.$full_template);
		}

		return $templates;

	}

}

if( !function_exists('chandelier_elated_blog_lists_number_of_chars') ) {

	/**
	 * Function that return number of characters for different lists based on options
	 *
	 * @return int
	 */

	function chandelier_elated_blog_lists_number_of_chars() {

		$number_of_chars = array();
		$number_of_chars['standard'] = (chandelier_elated_options()->getOptionValue('standard_number_of_chars') !== '') ? chandelier_elated_options()->getOptionValue('standard_number_of_chars') : 150;
		$number_of_chars['masonry'] = (chandelier_elated_options()->getOptionValue('masonry_number_of_chars') !== '') ? chandelier_elated_options()->getOptionValue('masonry_number_of_chars') : 50;
		return $number_of_chars;

	}

}

if (!function_exists('chandelier_elated_excerpt_length')) {
	/**
	 * Function that changes excerpt length based on theme options
	 * @param $length int original value
	 * @return int changed value
	 */
	function chandelier_elated_excerpt_length( $length ) {

		if(chandelier_elated_options()->getOptionValue('number_of_chars') !== ''){
			return esc_attr(chandelier_elated_options()->getOptionValue('number_of_chars'));
		} else {
			return 45;
		}
	}

	add_filter( 'excerpt_length', 'chandelier_elated_excerpt_length', 999 );
}

if (!function_exists('chandelier_elated_excerpt_more')) {
	/**
	 * Function that adds three dotes on the end excerpt
	 * @param $more
	 * @return string
	 */
	function chandelier_elated_excerpt_more( $more ) {
		return '...';
	}
	add_filter('excerpt_more', 'chandelier_elated_excerpt_more');
}

if(!function_exists('chandelier_elated_post_has_read_more')) {
	/**
	 * Function that checks if current post has read more tag set
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function chandelier_elated_post_has_read_more() {
		global $post;

		return strpos($post->post_content, '<!--more-->');
	}
}

if(!function_exists('chandelier_elated_post_has_title')) {
	/**
	 * Function that checks if current post has title or not
	 * @return bool
	 */
	function chandelier_elated_post_has_title() {
		return get_the_title() !== '';
	}
}

if (!function_exists('chandelier_elated_modify_read_more_link')) {
	/**
	 * Function that modifies read more link output.
	 * Hooks to the_content_more_link
	 * @return string modified output
	 */
	function chandelier_elated_modify_read_more_link() {
		$link = '<div class="eltd-more-link-container">';
		$link .= chandelier_elated_get_button_html(array(
			'type' => 'transparent',
			'link' => get_permalink().'#more-'.get_the_ID(),
			'text' => esc_html__('Continue reading', 'chandelier'),
			'custom_class'	=> 'eltd-read-more',
			'icon_pack'		=> 'font_elegant',
			'fe_icon'		=> 'arrow_right',
			'font_weight'	=> '700'
		));

		$link .= '</div>';

		return $link;
	}

	add_filter( 'the_content_more_link', 'chandelier_elated_modify_read_more_link');
}


if(!function_exists('chandelier_elated_has_blog_widget')) {
	/**
	 * Function that checks if latest posts widget is added to widget area
	 * @return bool
	 */
	function chandelier_elated_has_blog_widget() {
		$widgets_array = array(
			'eltd_latest_posts_widget'
		);

		foreach ($widgets_array as $widget) {
			$active_widget = is_active_widget(false, false, $widget);

			if($active_widget) {
				return true;
			}
		}

		return false;
	}
}

if(!function_exists('chandelier_elated_has_blog_shortcode')) {
	/**
	 * Function that checks if any of blog shortcodes exists on a page
	 * @return bool
	 */
	function chandelier_elated_has_blog_shortcode() {
		$blog_shortcodes = array(
			'eltd_blog_list',
			'eltd_blog_slider',
			'eltd_blog_carousel'
		);

		$slider_field = get_post_meta(chandelier_elated_get_page_id(), 'eltd_revolution-slider', true); //TODO change

		foreach ($blog_shortcodes as $blog_shortcode) {
			$has_shortcode = chandelier_elated_has_shortcode($blog_shortcode) || chandelier_elated_has_shortcode($blog_shortcode, $slider_field);

			if($has_shortcode) {
				return true;
			}
		}

		return false;
	}
}


if(!function_exists('chandelier_elated_load_blog_assets')) {
	/**
	 * Function that checks if blog assets should be loaded
	 *
	 * @see eltd_is_blog_template()
	 * @see is_home()
	 * @see is_single()
	 * @see eltd_has_blog_shortcode()
	 * @see is_archive()
	 * @see is_search()
	 * @see eltd_has_blog_widget()
	 * @return bool
	 */
	function chandelier_elated_load_blog_assets() {
		return chandelier_elated_is_blog_template() || is_home() || is_single() || chandelier_elated_has_blog_shortcode() || is_archive() || is_search() || chandelier_elated_has_blog_widget();
	}
}

if(!function_exists('chandelier_elated_is_blog_template')) {
	/**
	 * Checks if current template page is blog template page.
	 *
	 *@param string current page. Optional parameter.
	 *
	 *@return bool
	 *
	 * @see chandelier_elated_get_page_template_name()
	 */
	function chandelier_elated_is_blog_template($current_page = '') {

		if($current_page == '') {
			$current_page = chandelier_elated_get_page_template_name();
		}

		$blog_templates = chandelier_elated_blog_templates();

		return in_array($current_page, $blog_templates);
	}
}

if(!function_exists('chandelier_elated_read_more_button')) {
	/**
	 * Function that outputs read more button html if necessary.
	 * It checks if read more button should be outputted only if option for given template is enabled and post does'nt have read more tag
	 * and if post isn't password protected
	 *
	 * @param string $option name of option to check
	 * @param string $class additional class to add to button
	 *
	 */
	function chandelier_elated_read_more_button($option = '', $class = '') {
		if($option != '') {
			$show_read_more_button = chandelier_elated_options()->getOptionValue($option) == 'yes';
		}else {
			$show_read_more_button = 'yes';
		}
		if($show_read_more_button && !chandelier_elated_post_has_read_more() && !post_password_required()) {
			echo chandelier_elated_get_button_html(array(
				'link'         => get_the_permalink(),
				'text'         => esc_html__('Read More', 'chandelier'),
				'custom_class' => $class . ' eltd-read-more',
				'type'			=> 'transparent',
				'icon_pack'		=> 'font_elegant',
				'fe_icon'		=> 'arrow_right',
				'font_weight'	=> '700'
			));
		}
	}
}

if ( ! function_exists('chandelier_elated__comment_form_submit_button')) {
	/**
	 * Override comment form submit button
	 *
	 * @return mixed|string
	 */
	function chandelier_elated__comment_form_submit_button() {

		$comment_form_button = chandelier_elated_get_button_html(array(
			'html_type'     => 'button',
			'type'          => 'solid',
			'text'          => 'Submit',
			'input_name'    => 'submit',
			'custom_attrs'  => array(
				'id'    => 'submit_comment'
			)
		));

		return $comment_form_button;

	}

	add_filter('comment_form_submit_button', 'chandelier_elated__comment_form_submit_button');

}

if(!function_exists('chandelier_elated_get_post_link')){
	/**
	 * Function returns href attribute for post links
	 * Link post format on single pages should take link from meta field
	 * return string
	 */
	function chandelier_elated_get_post_link(){
		
		$post_format = get_post_format();
		$link = '';
		
		if($post_format == 'link' && is_single()){
			
			$meta_field_value = esc_html(get_post_meta(get_the_ID(), "eltd_post_link_link_meta", true));
			if($meta_field_value != ''){
				$link = $meta_field_value;
			}else{
				$link = esc_attr( the_permalink() );
			}
			
		}else{
			$link = esc_attr( the_permalink() );
		}
		print $link;
	}
}

?>