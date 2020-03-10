<?php
/*
 * This is Post Carousel theme.
 */

// get carousel setting from Widget/shortcode
$unique_id 		= !empty($instance['unique_id']) ? $instance['unique_id'] : "vgw-product-carousel";
$class_suffix 	= !empty($instance['class_suffix']) ? $instance['class_suffix'] : "";
$items_visible  = !empty($instance['items_visible']) ? intval($instance['items_visible']) : 1;
$navigation		= !empty($instance['next_preview']) ? intval($instance['next_preview']) : 0;
$pagination		= !empty($instance['pagination']) ? intval($instance['pagination']) : 0;

$responsive			= !empty($instance['responsive']) ? intval($instance['responsive']) : 0;
$itemsDesktop		= !empty($instance['items_desktop']) ? $instance['items_desktop'] : "[1199,1]";
$itemsDesktop		= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsDesktop);
$itemsDesktopSmall	= !empty($instance['items_sdesktop']) ? $instance['items_sdesktop'] : "[979,1]";
$itemsDesktopSmall	= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsDesktopSmall);
$itemsTablet		= !empty($instance['items_tablet']) ? $instance['items_tablet'] : "[768,1]";
$itemsTablet		= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsTablet);
$itemsTabletSmall	= !empty($instance['items_stablet']) ? $instance['items_stablet'] : "false";
$itemsTabletSmall	= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsTabletSmall);
$itemsMobile		= !empty($instance['items_mobile']) ? $instance['items_mobile'] : "[479,1]";
$itemsMobile		= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsMobile);
$itemsCustom		= !empty($instance['items_custom']) ? $instance['items_custom'] : "false";
$itemsCustom		= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsCustom);

// get carousel setting from Theme Options
$vg_calaco_options 	= get_option("vg_calaco_options");
$slideSpeed			= $vg_calaco_options['slide_speed'];
$paginationSpeed	= $vg_calaco_options['pagination_speed'];
$rewindSpeed		= $vg_calaco_options['rewind_speed'];
$autoPlay			= $vg_calaco_options['auto_play'];
$autoPlaySpeed		= $vg_calaco_options['autoplay_speed'];
$stopOnHover		= $vg_calaco_options['stop_hover'];
$rewindNav			= $vg_calaco_options['rewind_nav'];
$scrollPerPage		= $vg_calaco_options['scroll_page'];
$mouseDrag			= $vg_calaco_options['mouse_drag'];
$touchDrag			= $vg_calaco_options['touch_drag'];

$script = '
	jQuery(window).load(function() {
		jQuery("#'. esc_js($unique_id) .'").owlCarousel({
			items : '. esc_js($items_visible) .',
			navigation: '.($navigation ? 'true' : 'false') .',
			pagination: '.($pagination ? 'true' : 'false') .',
			slideSpeed: '. esc_js($slideSpeed) .',
			paginationSpeed: '. esc_js($paginationSpeed) .',
			rewindSpeed: '. esc_js($pagination) .',
			autoPlay: '.($autoPlay ? $autoPlaySpeed : 'false') .',
			stopOnHover: '.($stopOnHover ? 'true' : 'false') .',
			rewindNav: '.($rewindNav ? 'true' : 'false') .',
			scrollPerPage: '.($scrollPerPage ? 'true' : 'false') .',
			mouseDrag: '.($mouseDrag ? 'true' : 'false') .',
			touchDrag: '.($touchDrag ? 'true' : 'false') .',
			responsive: '.(!$responsive ? 'true' : 'false') .',
			itemsDesktop: '. esc_js($itemsDesktop) .',
			itemsDesktopSmall: '. esc_js($itemsDesktopSmall) .',
			itemsTablet: '. esc_js($itemsTablet) .',
			itemsTabletSmall: '. esc_js($itemsTabletSmall) .',
			itemsMobile: '. esc_js($itemsMobile) .',
			itemsCustom: '. esc_js($itemsCustom) .',
			leftOffSet: -15,
		});
	});
';	
wp_add_inline_script('vg-calaco-js', $script);

$return_content = ""; // reset return content;

$return_content .= '<div id="'. esc_attr($unique_id) .'" class="vgw-testimonial owl-carousel '. esc_attr($class_suffix) .'">';
	
	for($i = 0; $i < $total_loop; $i ++)
	{
		$return_content .= '<div class="testimonials">';
			
			for($m = 0; $m < $row_carousel; $m ++) 
			{ 
			
				if(!isset($vgw_query->posts[$key_loop])) continue;
				
				$post_id  = $vgw_query->posts[$key_loop]->ID;
				$vgw_query->the_post($post_id); global $post;
				$key_loop = $key_loop + 1;
									
				$thumb		= wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'vg_calaco_testimonial');
				$thumb_url 	= $thumb['0'];

				$return_content .= '<div class="testimonial-i">';
					$return_content .= '<div class="testimonial-content">';
						$return_content .= '<h3 class="title">';
							$return_content .= get_the_title();
						$return_content .= '</h3>';
						
						$return_content .= '<div class="description">'. get_the_content() .'</div>';
						
					$return_content .= '</div>';
						
					
					$return_content .= '<div class="testimonial-info">';
						$return_content .= '<div class="client-image">';
							$return_content .= '<img alt="'. esc_attr(get_the_title()) .'" data-src="'. esc_url($thumb_url) .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="primary_image lazy"/>';
						$return_content .= '</div>';
					
						$return_content .= '<div class="client-name">'. get_post_meta($post->ID, 'client_name', true) .'</div>';
						
						$return_content .= '<div class="client-position">('. get_post_meta($post->ID, 'client_position', true) .')</div>';
					$return_content .= '</div>';
				$return_content .= '</div>';
			}
			
		$return_content .= '</div>';
	}

$return_content .= '</div>';
