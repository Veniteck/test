<?php
/*
 * This is Post Carousel theme.
 */

// get carousel setting from Widget/shortcode
$unique_id 		= !empty($instance['unique_id']) ? $instance['unique_id'] : "vgw-product-carousel";
$class_suffix 	= !empty($instance['class_suffix']) ? $instance['class_suffix'] : "";
$items_visible  = !empty($instance['items_visible']) ? intval($instance['items_visible']) : 4;
$navigation		= !empty($instance['next_preview']) ? intval($instance['next_preview']) : 0;
$pagination		= !empty($instance['pagination']) ? intval($instance['pagination']) : 0;

$responsive			= !empty($instance['responsive']) ? intval($instance['responsive']) : 0;
$itemsDesktop		= !empty($instance['items_desktop']) ? $instance['items_desktop'] : "[1199,4]";
$itemsDesktop		= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsDesktop);
$itemsDesktopSmall	= !empty($instance['items_sdesktop']) ? $instance['items_sdesktop'] : "[979,3]";
$itemsDesktopSmall	= str_replace(array('`{`', '`}`'), array('[', ']'), $itemsDesktopSmall);
$itemsTablet		= !empty($instance['items_tablet']) ? $instance['items_tablet'] : "[768,2]";
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

$return_content .= '<div id="'. esc_attr($unique_id) .'" class="owl-carousel '. esc_attr($class_suffix) .' post-carousel">';
	
	for($i = 0; $i < $total_loop; $i ++)
	{
		$return_content .= '<div class="vgp-item">';
			
			for($m = 0; $m < $row_carousel; $m ++) 
			{ 
			
				if(!isset($vgw_query->posts[$key_loop])) continue;
				
				$post_id  = $vgw_query->posts[$key_loop]->ID;
				$vgw_query->the_post($post_id); global $post;
				$key_loop = $key_loop + 1;
									
				$thumb		= wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'vg_calaco_post_carousel');
				$thumb_url 	= $thumb['0'];	
				$post_created	= date_i18n("d F, Y", strtotime($post->post_date));
				$post_created_D	= date_i18n("d", strtotime($post->post_date));
				$post_created_M	= date_i18n("F", strtotime($post->post_date));
				$post_created_Y	= date_i18n("Y", strtotime($post->post_date));

				$num_comments = (int)get_comments_number();
				$author		= get_the_author_meta("display_name", $post->post_author);
				$write_comments = '';
				if(comments_open()) {
					if($num_comments == 0) {
						$comments = esc_html__('0', 'vg-calaco');
					} elseif($num_comments > 1) {
						$comments = $num_comments . esc_html__('0', 'vg-calaco');
					} else {
						$comments = esc_html__('1', 'vg-calaco');
					}
					$write_comments = '<i class="fa fa-comment-o"></i><a href="' . get_comments_link() .'">'. $comments.'</a>';
				}				
				
				$trimexcerpt = get_the_excerpt($post);
				$words_short_des = 20;
				$shortexcerpt = wp_trim_words($trimexcerpt, $num_words = $words_short_des, $more = '...'); 
				$excerpt = $shortexcerpt;
				
				$return_content .= '<div class="vgp-item-i">';
					$return_content .= '<div class="post-image">';
						$return_content .= '<a href="'. esc_url(get_permalink()) .'" title="'. esc_attr(get_the_title()) .'">';
							$return_content .= '<img alt="'. esc_attr(get_the_title()) .'" data-src="'. esc_url($thumb_url) .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="primary_image lazy"/>';
						$return_content .= '</a>';
					$return_content .= '</div>';
					
					$return_content .= '<div class="post-content">';
					
						$return_content .= '<ul class="post-meta">';
							$return_content .= '<li>';
								$return_content .= '<i class="icon-clock icons"></i><span class="post-date">'.$post_created.'</span>';
							$return_content .= '</li>';
							$return_content .= '<li>';
								$return_content .= '<span class="post-comment">'.$write_comments.'</span>';
							$return_content .= '</li>';
							$return_content .= '<li>';
								$return_content .= '<span class="post-author"><i class="zmdi zmdi-edit"></i>'.esc_html__('By: ','vg-calaco').'<b>'.$author.'</b></span>';
							$return_content .= '</li>';
						$return_content .= '</ul>';
						
						$return_content .= '<h3 class="post-title">';
							$return_content .= '<a href="'. esc_url(get_permalink()) .'" title="'. esc_attr(get_the_title()) .'">';
								$return_content .= get_the_title();
							$return_content .= '</a>';
						$return_content .= '</h3>';
						
						
						
						$return_content .= '<div class="post-desc"><p>'. $excerpt .'</p>';
					
							$return_content .= '<div class="post-readmore"><a href="'. esc_url(get_permalink()) .'">'. esc_html__("Continue Reading", "vg-calaco") .'</a></div>';
						$return_content .= '</div>';
					$return_content .= '</div>';
				$return_content .= '</div>';
			}
			
		$return_content .= '</div>';
	}

$return_content .= '</div>';
