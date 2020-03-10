<?php
add_action( 'after_setup_theme', 'vg_calaco_woo_setup' );
function vg_calaco_woo_setup() {
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action('woocommerce_cart_collaterals', 'woocommerce_cart_totals'); 

//Breadcrumb WooCommerce
function vg_calaco_woocommerce_breadcrumbs() {
    return array(
		'delimiter'   => '<li class="separator"> <i class="fa fa-angle-right" aria-hidden="true"></i> </li>',
		'wrap_before' => '<ul id="breadcrumbs" class="breadcrumbs">',
		'wrap_after'  => '</ul>',
		'before'      => '<li class="item">',
		'after'       => '</li>',
		'home'        => _x('Home', 'breadcrumb', 'vg-calaco'),
	);
}
add_filter('woocommerce_breadcrumb_defaults', 'vg_calaco_woocommerce_breadcrumbs', 20, 0);

// Override woocommerce widgets
if(! function_exists('vg_calaco_override_woocommerce_widgets'))
{
	function vg_calaco_override_woocommerce_widgets() 
	{
		//Show mini cart on all pages
		if(class_exists('WC_Widget_Cart')) 
		{
			unregister_widget('WC_Widget_Cart'); 
			get_template_part('woocommerce/class-wc-widget-cart');
			register_widget('Custom_WC_Widget_Cart');
		}
	}
}
add_action('widgets_init', 'vg_calaco_override_woocommerce_widgets', 15);

//Change rating html
if(! function_exists('vg_calaco_get_rating_html'))
{
	function vg_calaco_get_rating_html($rating_html, $rating) 
	{
		global $product;
		
		if($rating > 0) 
		{
			$title = sprintf(esc_html__('Rated %s out of 5', 'vg-calaco'), $rating);
		} 
		else {
			$title = 'Not yet rated';
			$rating = 0;
		}

		$rating_html  = '<div class="product-rating">';
			$rating_html .= '<div class="star-rating" title="' . esc_attr($title) . '">';
				$rating_html .= '<span style="width:' . esc_attr(($rating / 5) * 100) . '%"><strong class="rating">' . $rating . '</strong> ' . esc_html__('out of 5', 'vg-calaco') . '</span>';
			$rating_html .= '</div>';
			$rating_html .= $product->get_review_count(). esc_html__(" review(s)", "vg-calaco");
		$rating_html .= '</div>';

		return $rating_html;
	}
}
add_filter('woocommerce_product_get_rating_html', 'vg_calaco_get_rating_html', 10, 2);


//Change price html
add_filter('woocommerce_get_price_html', 'vg_calaco_woo_price_html', 100, 2);
function vg_calaco_woo_price_html($price, $product)
{
	if($product->is_type('variable')) {
		return '<div class="product-price price-variable">'. $price .'</div>';
	}
	else {
		return '<div class="product-price">'. $price .'</div>';
	}
}

//Change Sale/Hot Label
function vg_calaco_woo_label_html(){
	
	$vg_calaco_options 	= get_option("vg_calaco_options");
	global $post, $product;
	$label ='';
	
	$featured = isset($vg_calaco_options['hot_label']) ?  $vg_calaco_options['hot_label'] : esc_html__('Hot', 'vg-calaco'); 
	$sale = isset($vg_calaco_options['sale_label']) ?  $vg_calaco_options['sale_label'] : esc_html__('Sale', 'vg-calaco');
	
	?>
	
	<?php if($product->is_featured() || $product->is_on_sale()) : ?>
	<div class="product-label">
		<?php if($product->is_featured()) : ?>
			<?php echo '<span class="featured">' . esc_html($featured) . '</span>'; ?>
		<?php endif; ?>
		
		<?php if($product->is_on_sale()) : ?>
			<?php echo '<span class="sale">' . esc_html($sale) . '</span>'; ?>
		<?php endif; ?>
	</div>
	<?php
	endif;
}
// Change products per page
function vg_calaco_woo_change_per_page() 
{
	$vg_calaco_options 	= get_option("vg_calaco_options");
	$products_per_page 	= isset($vg_calaco_options['products_per_page']) ?  $vg_calaco_options['products_per_page'] : 9; 
	
	return $products_per_page;
}
add_filter('loop_shop_per_page', 'vg_calaco_woo_change_per_page', 20);

// Change number or products per row to 4
function vg_calaco_loop_columns() 
{
	$vg_calaco_options 		= get_option("vg_calaco_options");
	$products_per_column = isset($vg_calaco_options['products_per_column']) ? $vg_calaco_options['products_per_column'] : 3;
	
	if(isset($_GET['column']) && $_GET['column'] != ''){
		$products_per_column = $_GET['column'];
	}
	elseif(isset($_GET['sidebar']) && $_GET['sidebar'] == 'both'){
		$products_per_column = 2;
	}
	else{
		$products_per_column;
	}
	
	return $products_per_column;
}
add_filter('loop_shop_columns', 'vg_calaco_loop_columns', 999);


// View mode
function vg_calaco_view_mode_woocommerce_shop_loop() 
{
	$vg_calaco_options 	= get_option("vg_calaco_options");
	$layout_product 	= isset($vg_calaco_options['default_view_mode']) ? $vg_calaco_options['default_view_mode'] : 'gridview';
	
	$customJSGrid = "
		jQuery(document).ready(function(){
			jQuery('.view-mode').each(function(){
				/* Grid View */					
				jQuery('#content .view-mode').find('.grid').addClass('active');
				jQuery('#content .view-mode').find('.list').removeClass('active');
				
				jQuery('#content .shop-products').removeClass('list-view');
				jQuery('#content .shop-products').addClass('grid-view');
				
				jQuery('#content .list-col4').removeClass('col-xs-12 col-sm-6 col-lg-4');
				jQuery('#content .list-col8').removeClass('col-xs-12 col-sm-6 col-lg-8');
			});
		});
	";
	
	$customJSList = "
		jQuery(document).ready(function(){
			jQuery('.view-mode').each(function(){
				/* List View */								
				jQuery('#content .view-mode').find('.list').addClass('active');
				jQuery('#content .view-mode').find('.grid').removeClass('active');
				
				jQuery('#content .shop-products').addClass('list-view');
				jQuery('#content .shop-products').removeClass('grid-view');
				
				jQuery('#content .list-col4').addClass('col-xs-12 col-sm-6 col-lg-4');
				jQuery('#content .list-col8').addClass('col-xs-12 col-sm-6 col-lg-8');
			});
		});
	";
	
	$customJS = ($layout_product == 'gridview') ? $customJSGrid : $customJSList;
	wp_add_inline_script('vg-calaco-js', $customJS);
}
add_filter('woocommerce_before_shop_loop', 'vg_calaco_view_mode_woocommerce_shop_loop', 5);

//Select Grid Url
function vg_calaco_view_mode_woocommerce_shop_loop_url() {
	$view = 'gridview';
	if(isset($_GET['view']) && $_GET['view']!=''){
		$view = $_GET['view'];
		$customJSGrid = "
			jQuery(document).ready(function(){
				jQuery('.view-mode').each(function(){
					/* Grid View */					
					jQuery('#content .view-mode').find('.grid').addClass('active');
					jQuery('#content .view-mode').find('.list').removeClass('active');
					
					jQuery('#content .shop-products').removeClass('list-view');
					jQuery('#content .shop-products').addClass('grid-view');
					
					jQuery('#content .list-col4').removeClass('col-xs-12 col-sm-6 col-lg-4');
					jQuery('#content .list-col8').removeClass('col-xs-12 col-sm-6 col-lg-8');
				});
			});
		";
		
		$customJSList = "
			jQuery(document).ready(function(){
				jQuery('.view-mode').each(function(){
					/* List View */								
					jQuery('#content .view-mode').find('.list').addClass('active');
					jQuery('#content .view-mode').find('.grid').removeClass('active');
					
					jQuery('#content .shop-products').addClass('list-view');
					jQuery('#content .shop-products').removeClass('grid-view');
					
					jQuery('#content .list-col4').addClass('col-xs-12 col-sm-6 col-lg-4');
					jQuery('#content .list-col8').addClass('col-xs-12 col-sm-6 col-lg-8');
				});
			});
		";
		
		$customJS = ($view == 'gridview') ? $customJSGrid : $customJSList;
		wp_add_inline_script('vg-calaco-js', $customJS);
	}
}
add_filter('woocommerce_after_girdview', 'vg_calaco_view_mode_woocommerce_shop_loop_url', 30);

// For Single Product Page

// Move message to top
remove_action('woocommerce_before_shop_loop', 'wc_print_notices', 10);
add_action('woocommerce_show_message', 'wc_print_notices', 10);

//Column of Thumbnail Images*
function vg_calaco_get_column_thumbnail_images(){
	global $vg_calaco_options;
	$columnRelated = isset($vg_calaco_options['column_thumbnail_images']) ? $vg_calaco_options['column_thumbnail_images'] : '4';
	$slideSpeed = isset($vg_calaco_options['slide_speed']) ? $vg_calaco_options['slide_speed'] : '200';
	$paginationSpeed = isset($vg_calaco_options['pagination_speed']) ? $vg_calaco_options['pagination_speed'] : '800';
	$rewindSpeed = isset($vg_calaco_options['rewind_speed']) ? $vg_calaco_options['rewind_speed'] : '1000';
	$autoPlay = isset($vg_calaco_options['auto_play']) ? $vg_calaco_options['auto_play'] : 'false';
	$stopHover = isset($vg_calaco_options['stop_hover']) ? $vg_calaco_options['stop_hover'] : 'false';
	$mouseDrag = isset($vg_calaco_options['mouse_drag']) ? $vg_calaco_options['mouse_drag'] : 'false';
	$touchDrag = isset($vg_calaco_options['touch_drag']) ? $vg_calaco_options['touch_drag'] : 'false';
	
	$inlineJS = "
		jQuery(document).ready(function($) {
			$('.single-product-image .flex-control-thumbs').owlCarousel({
				items: 				".($columnRelated).",
				itemsDesktop: 		[1170,".($columnRelated - 1)."],
				itemsDesktopSmall: 	[980,".($columnRelated - 1)."],
				itemsTablet: 		[800,3],
				itemsTabletSmall: 	[650,3],
				itemsMobile: 		[599,2],				
				slideSpeed: 		".($slideSpeed).",
				paginationSpeed: 	".($paginationSpeed).",
				rewindSpeed: 		".($rewindSpeed).",				
				autoPlay: 			".(($autoPlay) ? 'true' : 'false').",
				stopOnHover: 		".(($stopHover) ? 'true' : 'false').",			
				navigation: 		true,
				scrollPerPage: 		false,
				pagination: 		false,
				paginationNumbers: 	false,
				mouseDrag: 			".(($mouseDrag) ? 'true' : 'false').",
				touchDrag: 			".(($touchDrag) ? 'true' : 'false').",
				itemsCustom : 		false,
				navigationText: 	['".esc_html__("Prev","vg-calaco")."', '".esc_html__("Next","vg-calaco")."'],
				leftOffSet: 		-14,
			});
		});
	";
	wp_add_inline_script('vg-calaco-js', $inlineJS);
}
add_action('wp_head', 'vg_calaco_get_column_thumbnail_images');

// Change Product Buttons
function vg_calaco_product_buttons(){
	global $product;
	?>
	<?php if(class_exists('YITH_WCWL') || class_exists('YITH_Woocompare')){ ?>
	<div class="action-buttons">
		<?php if(class_exists('YITH_Woocompare')){ ?>
			<div class="vgw-compare">
				<?php echo do_shortcode('[yith_compare_button]') ?>
			</div>
		<?php } ?>
		<?php if(class_exists('YITH_WCWL')) { ?> 
			<div class="vgw-wishlist">
				<?php echo preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')); ?>
			</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php
}
add_action('woocommerce_after_add_to_cart_button', 'vg_calaco_product_buttons', 10);
add_action('woocommerce_single_variation', 'vg_calaco_product_buttons', 40);

//Display stock status on product page
function vg_calaco_product_stock_status(){
	global $product;
	?>
	<div class="in-stock">
		<span class="title"><?php esc_html_e('Availability:', 'vg-calaco');?> </span>
		<?php if($product->is_in_stock()){ ?>
			<span><?php echo($product->get_stock_quantity())." "; ?><?php esc_html_e('In stock', 'vg-calaco');?></span>
		<?php } else { ?>
			<span class="out-stock"><?php esc_html_e('Out of stock', 'vg-calaco');?></span>
		<?php } ?>	
	</div>
	<?php
}
add_action('woocommerce_single_product_summary', 'vg_calaco_product_stock_status', 15); 

//Display Related Product
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
function vg_calaco_single_related(){
	global $vg_calaco_options;
	
	if(isset($vg_calaco_options['related_products']) && $vg_calaco_options['related_products']) {
		add_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	}
}
add_action('init', 'vg_calaco_single_related');

//Column Related Products
function vg_calaco_get_column_related(){
	global $vg_calaco_options;
	$columnRelated = isset($vg_calaco_options['column_related_products']) ? $vg_calaco_options['column_related_products'] : '4';
	$slideSpeed = isset($vg_calaco_options['slide_speed']) ? $vg_calaco_options['slide_speed'] : '200';
	$paginationSpeed = isset($vg_calaco_options['pagination_speed']) ? $vg_calaco_options['pagination_speed'] : '800';
	$rewindSpeed = isset($vg_calaco_options['rewind_speed']) ? $vg_calaco_options['rewind_speed'] : '1000';
	$autoPlay = isset($vg_calaco_options['auto_play']) ? $vg_calaco_options['auto_play'] : 'false';
	$stopHover = isset($vg_calaco_options['stop_hover']) ? $vg_calaco_options['stop_hover'] : 'false';
	$mouseDrag = isset($vg_calaco_options['mouse_drag']) ? $vg_calaco_options['mouse_drag'] : 'false';
	$touchDrag = isset($vg_calaco_options['touch_drag']) ? $vg_calaco_options['touch_drag'] : 'false';
	
	$inlineJS = "
		jQuery(document).ready(function($) {
			$('.related .shop-products, .upsells .shop-products, .cross-sells .shop-products').owlCarousel({
				items: 				".($columnRelated).",
				itemsDesktop: 		[1170,".($columnRelated - 1)."],
				itemsDesktopSmall: 	[980,".($columnRelated - 1)."],
				itemsTablet: 		[800,2],
				itemsTabletSmall: 	[650,2],
				itemsMobile: 		[599,1],				
				slideSpeed: 		".($slideSpeed).",
				paginationSpeed: 	".($paginationSpeed).",
				rewindSpeed: 		".($rewindSpeed).",				
				autoPlay: 			".(($autoPlay) ? 'true' : 'false').",
				stopOnHover: 		".(($stopHover) ? 'true' : 'false').",			
				navigation: 		true,
				scrollPerPage: 		false,
				pagination: 		false,
				paginationNumbers: 	false,
				mouseDrag: 			".(($mouseDrag) ? 'true' : 'false').",
				touchDrag: 			".(($touchDrag) ? 'true' : 'false').",
				itemsCustom : 		false,
				navigationText: 	['".esc_html__("Prev","vg-calaco")."', '".esc_html__("Next","vg-calaco")."'],
				leftOffSet: 		-15,
			});
		});
	";
	wp_add_inline_script('vg-calaco-js', $inlineJS);
}
add_action('wp_head', 'vg_calaco_get_column_related');

//Change number of related products on product page. Set your own value for 'posts_per_page'
function vg_calaco_woo_related_products_limit($args) {
	global $product, $vg_calaco_options;
	
	$relatedAmount = isset($vg_calaco_options['total_related_products']) ? $vg_calaco_options['total_related_products'] : 6;
	$args['posts_per_page'] = $relatedAmount;

	return $args;
}
add_filter('woocommerce_output_related_products_args', 'vg_calaco_woo_related_products_limit');
//Single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );
//Single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 5 );
//Single product
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 15 );
