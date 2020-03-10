<?php
/*
 * This is Product Search theme.
 */
 
$active     = isset($_GET['category']) ? array($_GET['category']) : array();
$categories = vg_calaco_get_categories_list(0, $active);
$class      = (!empty($instance['class_suffix'])) ? strip_tags($instance['class_suffix']) : '';

$return_content .= '<div class="vina-product-search '. esc_attr($class) .'">';
	$return_content .= '<form role="search" method="get" action="'. get_permalink(wc_get_page_id('shop')) .'">';
		$return_content .= '<label class="screen-reader-text" for="s">'. esc_html__('Search for:', 'vg-calaco') .'</label>';
		
		$return_content .= '<div class="select-category">';
			$return_content .= '<select name="category">';
				$return_content .= '<option value="0"'.((!isset($_GET['category']) || empty($_GET['category'])) ? ' selected="selected"' : '') .'>'. esc_html__('Select Category', 'vg-calaco') .'</option>';
				$return_content .= $categories;
			$return_content .= '</select>';
		$return_content .= '</div>';
		
		$return_content .= '<input name="s" id="s" type="text" placeholder="'. esc_html__('Search for products', 'vg-calaco') .'" value="'. get_search_query() .'" />';
				
		$return_content .= '<input type="hidden" name="post_type" value="product" />';
		$return_content .= '<button type="submit">'. esc_html__('Search', 'vg-calaco') .'</button>';
	$return_content .= '</form>';
$return_content .= '</div>';
