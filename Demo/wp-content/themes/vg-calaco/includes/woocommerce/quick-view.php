<?php
/*
 * This is function product quickview for WooCommerce.
 */

// don't load directly
if(!defined('ABSPATH')) die('-1');
 
if(!class_exists('WooCommerce')) return;


// Enqueue wc-add-to-cart-variation
function vg_calaco_product_quick_view_scripts() 
{	
	wp_enqueue_script('wc-add-to-cart-variation');
}
add_action('wp_enqueue_scripts', 'vg_calaco_product_quick_view_scripts');


// Load The Product
function vg_calaco_product_quick_view_fn() 
{		
	if(!isset($_REQUEST['product_id'])) {
		die();
	}
	
	$product_id = intval($_REQUEST['product_id']);
	
	// wp_query for the product
	wp('p='.$product_id.'&post_type=product');
	
	ob_start();
	get_template_part('woocommerce/quick-view');
	
	echo ob_get_clean();
	
	die();
}	
add_action('wp_ajax_vg_calaco_product_quick_view', 'vg_calaco_product_quick_view_fn');
add_action('wp_ajax_nopriv_vg_calaco_product_quick_view', 'vg_calaco_product_quick_view_fn');


// Show Quick View Button
function vg_calaco_product_quick_view_button() 
{
	global $product;
	$vg_calaco_options = get_option("vg_calaco_options");
	
	if((isset($vg_calaco_options['quick_view'])) &&($vg_calaco_options['quick_view'] == 1)) {
		echo '<a href="#" id="product_id_'. esc_attr($product->get_id()) .'" class="button vg_calaco_product_quick_view_button" data-product_id="'. esc_attr($product->get_id()) .'">' . esc_html__('Quick View', 'vg-calaco') . '</a>';
	}
}
add_action('woocommerce_after_shop_loop_item_title', 'vg_calaco_product_quick_view_button', 5);
