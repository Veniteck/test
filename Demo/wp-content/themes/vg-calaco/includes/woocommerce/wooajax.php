<?php
add_action('wp_ajax_vg_calaco_get_productinfo', 'vg_calaco_get_productinfo');
add_action('wp_ajax_nopriv_vg_calaco_get_productinfo', 'vg_calaco_get_productinfo');

function vg_calaco_get_productinfo() {
	global $product;
	$product_id 	= intval($_POST['product_id']);
	$product 		= get_product($product_id);
	?>
	<h3><?php esc_html_e('Product is added to cart', 'vg-calaco');?></h3>
	<div class="product-wrapper">
		<div class="product-image">
			<?php echo ($product->get_image('shop_thumbnail'));?>
		</div>
		<div class="product-info">
			<h4><?php echo esc_html($product->get_title());?></h4>
			<p class="price"><?php echo ($product->get_price_html()); ?></p>
		</div>
	</div>
	<div class="buttons">
		<a class="button" href="<?php echo get_permalink(wc_get_page_id('cart'));?>"><?php esc_html_e('View Cart', 'vg-calaco');?></a>
	</div>
	<?php
	die();
}