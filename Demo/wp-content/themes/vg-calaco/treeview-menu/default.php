<?php
/*
 * This is Treeview Menu theme.
 */
 
if(!count($categories)) return false;

if(! function_exists('vg_calaco_get_category_child'))
{
	function vg_calaco_get_category_child($categories, $type, $counter) 
	{
		$content_html = "";
		
		foreach($categories as $category) 
		{
			$cid 	= $category->term_id;
			$name	= $category->name;
			$count	= $category->count;
			
			if($type == 'postcategory')
				$child = get_terms('category' , array('hide_empty' => false, 'hierarchical' => true, 'parent' => $cid));
			else
				$child = get_terms('product_cat' , array('hide_empty' => false, 'hierarchical' => true, 'parent' => $cid));
				
			$content_html .= '<li>'; // start li menu
			
				if(count($child)) 
				{
					$content_html .= '<a href="'. esc_url(get_category_link($category)) .'" title="'. esc_attr($name) .'">';
						$content_html .= '<span class="catTitle folder">'. esc_attr($name) .'</span>';
					$content_html .= '</a>';
					
					if($counter == 'yes') {
						$content_html .= ' <span class="counter">('. esc_attr($count) .')</span>';
					}
					
					$content_html .= '<ul class="sub-menu">';
						$content_html .= vg_calaco_get_category_child($child, $type, $counter);
					$content_html .= '</ul>';
				}
				else 
				{
					$content_html .= '<a href="'. esc_url(get_category_link($category)) .'" title="'. esc_attr($name) .'">';
						$content_html .= '<span class="catTitle">'. esc_attr($name) .'</span>';
					$content_html .= '</a>';
					
					if($counter == 'yes') {
						$content_html .= ' <span class="counter">('. esc_attr($count) .')</span>';
					}
				}
				
			$content_html .= '</li>'; // end li menu			
		}
		
		return $content_html;
	}
}

// get carousel setting from Widget/shortcode
$unique_id 			= !empty($instance['unique_id']) ? $instance['unique_id'] : "vgw-category-treeview";
$class_suffix 		= !empty($instance['class_suffix']) ? $instance['class_suffix'] : "";
$item_counter		= !empty($instance['item_counter']) ? $instance['item_counter'] : 'no';
$treeview_control	= !empty($instance['treeview_control']) ? $instance['treeview_control'] : 'no';
$animated_speed		= !empty($instance['animated_speed']) ? $instance['animated_speed'] : "normal";
$collapsed			= !empty($instance['collapsed']) ? $instance['collapsed'] : 'yes';
$unique				= !empty($instance['unique']) ? $instance['unique'] : 'no';

$return_content = ""; // reset return content;

$return_content .= '<div id="'. esc_attr($unique_id) .'" class="vg-calaco-category-treeview '. esc_attr($class_suffix) .'">';

	if($treeview_control == 'yes') {
		$return_content .= '<div id="'. esc_attr($unique_id) .'-control" class="treecontrol">';
			$return_content .= '<a href="#" title="'. esc_attr__('Collapse the entire tree below', 'vg-calaco') .'">'. esc_html__('Collapse All', 'vg-calaco') .'</a> | ';
			$return_content .= '<a href="#" title="'. esc_attr__('Expand the entire tree below', 'vg-calaco') .'">'. esc_html__('Expand All', 'vg-calaco') .'</a> | ';
			$return_content .= '<a href="#" title="'. esc_attr__('Toggle the tree below, opening closed branches, closing open branches', 'vg-calaco') .'">'. esc_html__('Toggle All', 'vg-calaco') .'</a>';
		$return_content .= '</div>';
	}
	
	$return_content .= '<ul class="level0 filetree">';
		$return_content .= vg_calaco_get_category_child($categories, $treeview_type, $item_counter);
	$return_content .= '</ul>';
	
$return_content .= '</div>';

// load Javascript for Treeview Menu
$script = '
jQuery(document).ready(function($) {
	$("#'. esc_js($unique_id) .' > ul").treeview({
		animated: 	"' .esc_js($animated_speed). '",
		collapsed: 	'.(($collapsed == 'yes') ? 'true' : 'false') .',
		unique:		'.(($unique == 'yes') ? 'true' : 'false') .',
		persist:	"location",
		'.(($treeview_control == 'yes') ?('control: "#'. esc_attr($unique_id) .'-control",') : '') .'
	});
});
';
wp_add_inline_script('vg-calaco-js', $script);