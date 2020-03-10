<?php
/**
 * Custom VG Calaco template tags
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package VG Calaco
 */


if(! function_exists('vg_calaco_entry_meta')) :
/**
 * Prints HTML with meta information for the categories, tags.
 *
 * Create your own vg_calaco_entry_meta() function to override in a child theme.
 *
 */

function vg_calaco_entry_meta() {
	if(in_array(get_post_type(), array('post', 'attachment'))) {
		vg_calaco_entry_date();
	}
	if (is_single() || has_post_thumbnail() && get_the_post_thumbnail() != NULL) {
		vg_calaco_entry_format();
	}
	
	if ( has_post_thumbnail() && get_the_post_thumbnail() != NULL) {
		if('post' === get_post_type()) {
			vg_calaco_entry_author();
		}		
	}
	if ( has_post_thumbnail() && get_the_post_thumbnail() != NULL) {
		if(! is_singular() && ! post_password_required() &&(comments_open() || get_comments_number())) {
			echo '<span class="meta comments-link"><i class="fa fa-comment-o"></i>';
			comments_popup_link(sprintf(__('Leave a comment<span class="screen-reader-text"> on %s</span>', 'vg-calaco'), get_the_title()));
			echo '</span>';
		}
	}
	
	
	if('post' === get_post_type()) {
		vg_calaco_entry_category();
	}
	
	
}
endif;


if(! function_exists('vg_calaco_entry_author')) :
/**
 * Prints HTML with date information for current author.
 *
 * Create your own vg_calaco_entry_author() function to override in a child theme.
 *
 */
function vg_calaco_entry_author() {
	printf('<span class="meta byline"><span class="author vcard"><i class="fa fa-edit"></i><span class="screen-reader-text">%1$s </span> <a class="url fn n" href="%2$s">%3$s</a></span></span>',
		_x('Author', 'Used before post author name.', 'vg-calaco'),
		esc_url(get_author_posts_url(get_the_author_meta('ID'))),
		get_the_author()
	);
}
endif;

if(! function_exists('vg_calaco_entry_date')) :
/**
 * Prints HTML with date information for current post.
 *
 * Create your own vg_calaco_entry_date() function to override in a child theme.
 *
 */
function vg_calaco_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s"><span class="date">%2$s</span>%3$s</time>';

	if(get_the_time('U') !== get_the_modified_time('U')) {
		$time_string = '<time class="entry-date published" datetime="%1$s"><span class="date">%2$s</span>%3$s</time><time class="updated" datetime="%4$s">%5$s</time>';
	}

	$time_string = sprintf($time_string,
		esc_attr(get_the_date('c')),
		get_the_date('d'),
		get_the_date('M-Y'),
		esc_attr(get_the_modified_date('c')),
		get_the_modified_date()
	);

	printf('<span class="meta posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x('Posted on', 'Used before publish date.', 'vg-calaco'),
		esc_url(get_permalink()),
		$time_string
	);
}
endif;

if(! function_exists('vg_calaco_entry_category')) :
/**
 * Prints HTML with post format for current post.
 *
 * Create your own vg_calaco_entry_format() function to override in a child theme.
 *
 */
function vg_calaco_entry_format() {
	$format = get_post_format();
	$icon='';
	//var_dump($vgpc_format);
	switch($format) {
		case 'aside':
			$icon = 'icon-aside';
			break;
		case 'image':
			$icon = 'icon-image';
			break;
		case 'video':
			$icon = 'icon-video';
			break;
		case 'audio':
			$icon = 'icon-audio';
			break;
		case 'quote':
			$icon = 'icon-quote';
			break;
		case 'link':
			$icon = 'icon-link';
			break;
		default : 
			break;
	}
	printf('<span class="meta entry-format '.$icon.'"><span class="screen-reader-text">%1$s </span>%2$s</span>',
		_x('Categories', 'Used before post format names.', 'vg-calaco'),
		$format
	);
}
endif;

if(! function_exists('vg_calaco_entry_category')) :
/**
 * Prints HTML with category for current post.
 *
 * Create your own vg_calaco_entry_category() function to override in a child theme.
 *
 */
function vg_calaco_entry_category() {
	$categories_list = get_the_category_list(_x('| ', 'Used between list items, there is a space after the comma.', 'vg-calaco'));
	if($categories_list && vg_calaco_categorized_blog()) {
		printf('<span class="meta cat-links"><i class="fa fa-folder"></i><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x('Categories', 'Used before category names.', 'vg-calaco'),
			$categories_list
		);
	}
}
endif;

if(! function_exists('vg_calaco_entry_tags')) :
/**
 * Prints HTML with tags for current post.
 *
 * Create your own vg_calaco_entry_tags() function to override in a child theme.
 *
 */
function vg_calaco_entry_tags() {
	$tags_list = get_the_tag_list('', _x(', ', 'Used between list items, there is a space after the comma.', 'vg-calaco'));
	if($tags_list) {
		printf('<span class="tags-links"><i class="fa fa-tags" aria-hidden="true"></i>: <span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x('Tags', 'Used before tag names.', 'vg-calaco'),
			$tags_list
		);
	}
}
endif;

if(! function_exists('vg_calaco_post_thumbnail')) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own vg_calaco_post_thumbnail() function to override in a child theme.
 *
 */
function vg_calaco_post_thumbnail() {
	if(post_password_required() || is_attachment() || ! has_post_thumbnail()) {
		return;
	}

	if(is_singular()) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>
	<div class="post-thumbnail">
		<a class="link-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php the_post_thumbnail('vg_calaco_post_full', array('alt' => the_title_attribute('echo=0'))); ?>
		</a>
	</div><!-- .post-thumbnail -->

	<?php endif; // End is_singular()
}
endif;

if(! function_exists('vg_calaco_excerpt')) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own vg_calaco_excerpt() function to override in a child theme.
	 *
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function vg_calaco_excerpt($class = 'entry-summary') {
		$class = esc_attr($class);

		if(has_excerpt() || is_search()) : ?>
			<div class="<?php echo ($class); ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo ($class); ?> -->
		<?php endif;
	}
endif;

if(! function_exists('vg_calaco_excerpt_more') && ! is_admin()) :
/**
 * Replaces "[...]"(appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * Create your own vg_calaco_excerpt_more() function to override in a child theme.
 *
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function vg_calaco_excerpt_more() {
	$link = sprintf('<a href="%1$s" class="more-link">%2$s</a>',
		esc_url(get_permalink(get_the_ID())),
		/* translators: %s: Name of current post */
		sprintf(__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'vg-calaco'), get_the_title(get_the_ID()))
	);
	return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'vg_calaco_excerpt_more');
endif;

if(! function_exists('vg_calaco_categorized_blog')) :
/**
 * Determines whether blog/site has more than one category.
 *
 * Create your own vg_calaco_categorized_blog() function to override in a child theme.
 *
 *
 * @return bool True if there is more than one category, false otherwise.
 */
function vg_calaco_categorized_blog() {
	if(false === ($all_the_cool_cats = get_transient('vg_calaco_categories'))) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories(array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		));

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count($all_the_cool_cats);

		set_transient('vg_calaco_categories', $all_the_cool_cats);
	}

	if($all_the_cool_cats > 1) {
		// This blog has more than 1 category so vg_calaco_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so vg_calaco_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in vg_calaco_categorized_blog().
 *
 */
function vg_calaco_category_transient_flusher() {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient('vg_calaco_categories');
}
add_action('edit_category', 'vg_calaco_category_transient_flusher');
add_action('save_post',     'vg_calaco_category_transient_flusher');

if(! function_exists('vg_calaco_the_custom_logo')) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function vg_calaco_the_custom_logo() {
	if(function_exists('the_custom_logo')) {
		the_custom_logo();
	}
}
endif;


//Change search form
function vg_calaco_search_form($form) {
	if(get_search_query()!=''){
		$search_str = get_search_query();
	} else {
		$search_str = esc_html__('Search...', 'vg-calaco');
	}
	
	$form = '<form role="search" method="get" id="blogsearchform" class="searchform" action="' . esc_url(home_url('/')). '" >
	<div class="form-input">
		<input class="input_text" type="text" value="'.esc_attr($search_str).'" name="s" id="search_input" />
		<button class="button" type="submit" id="blogsearchsubmit"><i class="fa fa-search"></i></button>
		<input type="hidden" name="post_type" value="post" />
		</div>
	</form>';
	
	$inlineJS = '
		jQuery(document).ready(function(){
			jQuery("#search_input").focus(function(){
				if(jQuery(this).val()=="'. esc_html__('Search...', 'vg-calaco').'"){
					jQuery(this).val("");
				}
			});
			jQuery("#search_input").focusout(function(){
				if(jQuery(this).val()==""){
					jQuery(this).val("'. esc_html__('Search...', 'vg-calaco').'");
				}
			});
			jQuery("#blogsearchsubmit").on("click", function(){
				if(jQuery("#search_input").val()=="'. esc_html__('Search...', 'vg-calaco').'" || jQuery("#search_input").val()==""){
					jQuery("#search_input").focus();
					return false;
				}
			});
		});
	';
	wp_add_inline_script('vg-calaco-js', $inlineJS);
	return $form;
} 
//add_action('wp_enqueue_scripts', 'vg_calaco_search_form');
add_filter('get_search_form', 'vg_calaco_search_form');

