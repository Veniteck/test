<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if(! defined('ABSPATH')) exit; // Exit if accessed directly

$vg_calaco_options = get_option("vg_calaco_options");
global $woocommerce;
?>

<?php do_action('woocommerce_before_mini_cart'); ?>
<div class="mini_cart_content">
	<div class="mini_cart_inner">
		<div class="top-cart-title">
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
				<div class="shopping_cart">
					<span class="icon-cart">
						<i class="zmdi zmdi-shopping-cart"></i>
						<?php 
							$totalItem = ($woocommerce->cart->cart_contents_count > 9) ? '9+' : $woocommerce->cart->cart_contents_count;
						?>
						<span class="cart-quantity"><span class="border">(</span><?php echo ($totalItem); ?><span class="border">)</span></span>
					</span>
					<span class="sub-title"><?php echo esc_html__('Cart /', 'vg-calaco'); ?></span>
					<span class="cart-total-price"><?php echo WC()->cart->get_cart_subtotal();?></span>
				</div>
			</a>
		</div>
		<div class="mcart-border">
			<?php if(sizeof(WC()->cart->get_cart()) > 0) : ?>
				<ul class="cart_list product_list_widget <?php echo esc_attr($args['list_class']); ?>">
					<?php
					foreach(WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product     = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id   = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

						if($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key)) {

							$product_name  = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);
							$thumbnail     = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
							$product_price = apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);

							?>
							<li id="mcitem-<?php echo esc_attr($cart_item_key); ?>">
								<a class="product-image" href="<?php echo esc_url(get_permalink($product_id)); ?>">
									<?php echo str_replace(array('http:', 'https:'), '', $thumbnail); ?>
									<?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s', $cart_item['quantity']) . '</span>', $cart_item, $cart_item_key); ?>
								</a>
								<div class="product-details">
									<?php
									echo apply_filters('woocommerce_cart_item_remove_link', sprintf(
										'<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url(wc_get_cart_remove_url($cart_item_key)),
										__('Remove this item', 'vg-calaco'),
										esc_attr($product_id),
										esc_attr($_product->get_sku())
									), $cart_item_key);
									?>
									<a class="product-name" href="<?php echo esc_url(get_permalink($product_id)); ?>"><?php echo esc_html($product_name); ?></a>
									<?php echo WC_GET_FORMATTED_CART_ITEM_DATA($cart_item); ?>
									<?php echo apply_filters('woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf('%s', $product_price) . '</span>', $cart_item, $cart_item_key); ?>
								</div>
							</li>
							<?php
						}
					}
					?>
				</ul><!-- end product list -->
			<?php else: ?>
				<ul class="cart_empty <?php echo esc_attr($args['list_class']); ?>">
					<li><?php esc_html_e('You have no items in your shopping cart', 'vg-calaco'); ?></li>
					<li class="total"><?php esc_html_e('Subtotal', 'vg-calaco'); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></li>
				</ul>
			<?php endif; ?>

			<?php if(sizeof(WC()->cart->get_cart()) > 0) : ?>

				<p class="total"><?php esc_html_e('Subtotal', 'vg-calaco'); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?></p>

				<?php do_action('woocommerce_widget_shopping_cart_before_buttons'); ?>

				<p class="buttons">
					<a href="<?php echo esc_url( wc_get_checkout_url() );?>" class="button checkout wc-forward pull-left"><?php esc_html_e('Checkout', 'vg-calaco'); ?></a>
					<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button wc-forward pull-right"><?php esc_html_e('View Cart', 'vg-calaco'); ?></a>
				</p>

			<?php endif; ?>
			<div class="loading"></div>
			<div class="clearfix"></div>
		</div>
	</div>
</div>
<?php do_action('woocommerce_after_mini_cart'); ?>