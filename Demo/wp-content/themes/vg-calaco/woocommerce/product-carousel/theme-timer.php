<?php
/*
 * This is Product Carousel theme.
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

$wooHoverEffect = vg_calaco_default_woo_hover_effect(); 

$return_content = ""; // reset return content;

$return_content .= '<div id="'. esc_attr($unique_id) .'" class="owl-carousel '. esc_attr($class_suffix) .' woo-carousel">';
	
	for($i = 0; $i < $total_loop; $i ++)
	{
		$return_content .= '<div class="vgw-item">';
			for($m = 0; $m < $row_carousel; $m ++) 
			{ 
			
				if(!isset($vgw_query->posts[$key_loop])) continue;
				
				$post_id  = $vgw_query->posts[$key_loop]->ID;
				$vgw_query->the_post($post_id); global $product;
				$key_loop = $key_loop + 1;
				
				$featured 	= $product->is_featured();
				$onsale		= $product->is_on_sale();
				$textfeatured = isset($vg_calaco_options['hot_label']) ?  $vg_calaco_options['hot_label'] : esc_html__('Hot', 'vg-calaco'); 
				$textsale = isset($vg_calaco_options['sale_label']) ?  $vg_calaco_options['sale_label'] : esc_html__('Sale', 'vg-calaco');
				
				$thumb		= wp_get_attachment_image_src($product->get_image_id(), 'shop_catalog');
				$thumb_url 	= $thumb['0'];								
				$price 		= $product->get_price_html();	
				$rating	= wc_get_rating_html( $product->get_average_rating());	
				$countdown 		= false;
				$sale_end 		= get_post_meta($product->get_id(), '_sale_price_dates_to', true);				
				
				$trimexcerpt = get_the_excerpt($product);
				$words_short_des = 20;
				$shortexcerpt = wp_trim_words($trimexcerpt, $num_words = $words_short_des, $more = '...'); 
				$excerpt = $shortexcerpt;
				
				/*Check Images Second Product*/
				$attachment_ids = $product->get_gallery_image_ids();
				$image_second   = '';
				if(isset($vg_calaco_options['second_image_product_listing']) && $vg_calaco_options['second_image_product_listing'] && count($attachment_ids)){
					if($attachment_ids[0] &&($attachment_ids[0] != get_post_thumbnail_id(get_the_ID()))) {
						$thumb_second 	 = wp_get_attachment_image_src($attachment_ids[0], 'shop_catalog');
						$thumb_second_url = $thumb_second['0'];
						$image_second = '<span class="second"><img alt="'.get_the_title().'" data-src="'.esc_url($thumb_second_url).'" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="  class="secondary_image lazy"/></span>';
					}
					elseif(isset($attachment_ids[1])){
						$thumb_second 	 = wp_get_attachment_image_src($attachment_ids[1], 'shop_catalog');
						$thumb_second_url = $thumb_second['0'];
						$image_second = '<span class="second"><img alt="'.get_the_title().'" data-src="'.esc_url($thumb_second_url).'" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="  class="secondary_image lazy"/></span>';	
					}	
				}
				
				$return_content .= '<div class="vgw-item-i vgw-timer  hidden-desc '.esc_attr($wooHoverEffect).'">';
					
					// Product Image Block
					$return_content .= '<div class="product-image">';
						$return_content .= '<a href="'. esc_url(get_permalink()) .'" title="'. esc_attr(get_the_title()) .'">';
							if(isset($vg_calaco_options['second_image_product_listing']) && $vg_calaco_options['second_image_product_listing']) :
								$return_content .= '<img alt="'. esc_attr(get_the_title()) .'" data-src="'. esc_url($thumb_url) .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" class="primary_image lazy"/>';
							else : 
								$return_content .= '<img alt="'. esc_attr(get_the_title()) .'" data-src="'. esc_url($thumb_url) .'" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw=="  class="one_image lazy"/>';
							endif;
							$return_content .= $image_second;
						$return_content .= '</a>';
						
						$return_content .= '<div class="product-label">';
							$return_content .= ($featured) ? '<span class="featured">'.esc_html($textfeatured).'</span>' : '';
							$return_content .= ($onsale) ? '<span class="sale">'.esc_html($textsale).'</span>' : '';
						$return_content .= '</div>';

						// HJ20170525 Product Variables Code ----------
						if($product->is_type('variable') && is_plugin_active('variation-swatches-for-woocommerce/variation-swatches-for-woocommerce.php')) 
						{	
							wp_enqueue_script('wc-add-to-cart-variation');
							$attributes	= $product->get_variation_attributes();
							$return_content .= '<div class="variations calaco-product-variables">';
							foreach($attributes as $attribute_name => $options) {
								$return_content .= '<div class="'. esc_attr(sanitize_title($attribute_name)) .'">';
									$return_content .= vg_calaco_variation_attribute_options(array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => '' ));
								$return_content .= '</div>';
							}
							$return_content .= '</div>';							
						}
						// End ----------------------------------------
						
					$return_content .= '</div>';
					
					// Product Content Block
					$return_content .= '<div class="product-content">';
					
						if($sale_end){
								$countdown = true;
								$sale_end = date('Y/m/d',(int)$sale_end);
								$return_content .= '<div class="box-timer"><div class="timer-grid" data-time="'.esc_attr($sale_end).'"></div></div>';
							}
							
							if($product->get_children()){
								$vsale_end = array();
								
								foreach($product->get_children() as $pvariable){
									$vsale_end[] = (int)get_post_meta($pvariable, '_sale_price_dates_to', true);
									
									if(get_post_meta($pvariable, '_sale_price_dates_to', true)){
										$countdown = true;
									}
								}
								if($countdown){
									/* get the latest time */
									$vsale_end_date = max($vsale_end);
									$vsale_end_date = date('Y/m/d', $vsale_end_date);
									$return_content .= '<div class="box-timer"><div class="timer-grid" data-time="'.esc_attr($vsale_end_date).'"></div></div>';
								}
							}	
						if(get_option('woocommerce_enable_review_rating') === 'yes')
							{
								$return_content .= $rating;
							}
						$return_content .= '<h3 class="product-title">';
							$return_content .= '<a href="'. esc_url(get_permalink()) .'" title="'. esc_attr(get_the_title()) .'">';
								$return_content .= get_the_title();
							$return_content .= '</a>';
						$return_content .= '</h3>';
						
						
								
						$return_content .= $price;
						
						$return_content .= '<div class="product-desc">';
							$return_content .= $excerpt;
						$return_content .= '</div>';
						
						
						
						$return_content .= '<div class="button-group">';
							
							
							if(class_exists('YITH_WCWL')){
								$return_content .= '<div class="vgw-wishlist">'.preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')).'</div>';
							}
							if(class_exists('YITH_Woocompare')) {
								$return_content .= '<div class="vgw-compare">'.do_shortcode('[yith_compare_button]').'</div>';
							}
							
							if(isset($vg_calaco_options['quick_view']) && $vg_calaco_options['quick_view']) :
								$return_content .= '<div class="vgw-quickview">';
									$return_content .= '<a href="#" class="button vg_calaco_product_quick_view_button" data-product_id="'. esc_attr($product->get_id()) .'">' . esc_html__('Quick View', 'vg-calaco') . '</a>';
								$return_content .= '</div>';
							endif;
						$return_content .= '</div>';
						
						$return_content .= '<div class="add-to-cart">';
								$return_content .= do_shortcode('[add_to_cart id="'. esc_attr($product->get_id()) .'" style="none" show_price="false"]');
						$return_content .= '</div>';
						
						
					$return_content .= '</div>';
				$return_content .= '</div>';
			}
		$return_content .= '</div>';
	}
	
$return_content .= '</div>';
