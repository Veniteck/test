<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 *(the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
$vg_calaco_options = get_option("vg_calaco_options");
global $product, $woocommerce_loop, $post;

// Store loop count we're currently on
if(empty($woocommerce_loop['loop'])) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if(empty($woocommerce_loop['columns'])) {
	$woocommerce_loop['columns'] = apply_filters('loop_shop_columns', 4);
}

// Ensure visibility
if(empty($product) || ! $product->is_visible()) {
	return;
}

// Extra post classes
if(0 == ($woocommerce_loop['loop']) % $woocommerce_loop['columns'] || 0 == $woocommerce_loop['columns']) {
 $classes[] = 'first';
}
if(0 == ($woocommerce_loop['loop'] + 1) % $woocommerce_loop['columns']) {
 $classes[] = 'last';
}

if($woocommerce_loop['columns'] == 3) {
	$colwidth = 4;
} elseif($woocommerce_loop['columns'] == 2) {
	$colwidth = 6;
} else{
	$colwidth = 3;
}

$classes[] = 'vgw-item col-md-'. esc_attr($colwidth) .' col-xs-6';?>
<?php $wooHoverEffect = vg_calaco_default_woo_hover_effect(); ?>
<div <?php post_class($classes); ?>>
	
	<div class="vgw-item-i <?php echo esc_attr($wooHoverEffect); ?>">
		<?php
		/**
		 * woocommerce_before_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action('woocommerce_before_shop_loop_item');
		?>
		<div class="list-col4">
			<div class="product-image">
				<a href="<?php echo esc_url(get_permalink($product->get_id())); ?>" title="<?php echo esc_attr($product->get_title()); ?>">
					<?php 
					if(isset($vg_calaco_options['second_image_product_listing']) && $vg_calaco_options['second_image_product_listing']) : 
						echo($product->get_image('shop_catalog', array('class'=>'primary_image')));
					else :
						echo($product->get_image('shop_catalog', array('class'=>'one_image')));
					endif;
					
					$image_second = '';
					if(isset($vg_calaco_options['second_image_product_listing']) && $vg_calaco_options['second_image_product_listing']){
						$attachment_ids = $product->get_gallery_image_ids();
						if((isset($attachment_ids[0]) && $attachment_ids[0]) && ($attachment_ids[0] != get_post_thumbnail_id(get_the_ID()))) {
							$image_second = wp_get_attachment_image($attachment_ids[0], apply_filters('single_product_small_thumbnail_size', 'shop_catalog'), false, array('class'=>'secondary_image'));
						}
						elseif(isset($attachment_ids[1]) && $attachment_ids[1]){
							$image_second = wp_get_attachment_image($attachment_ids[1], apply_filters('single_product_small_thumbnail_size', 'shop_catalog'), false, array('class'=>'secondary_image'));
						}	
					}
					echo ('<span class="second">'.($image_second).'</span>');
					?>
				</a>
				<?php
						// HJ20170525 Product Variables Code ----------					
						if($product->is_type('variable') && is_plugin_active('variation-swatches-for-woocommerce/variation-swatches-for-woocommerce.php')) 
						{
							wp_enqueue_script('wc-add-to-cart-variation');
							
							$attributes	= $product->get_variation_attributes();
							$variation_attributes = '<div class="variations calaco-product-variables">';
							foreach($attributes as $attribute_name => $options) {
								$variation_attributes .= '<div class="'. esc_attr(sanitize_title($attribute_name)) .'">';
									$variation_attributes .= vg_calaco_variation_attribute_options(array( 'options' => $options, 'attribute' => $attribute_name, 'product' => $product, 'selected' => '' ));
								$variation_attributes .= '</div>';
							}
							$variation_attributes .= '</div>';
							
							echo $variation_attributes;
						}
					?>
				<?php vg_calaco_woo_label_html(); ?>
			</div>
		</div>
		<div class="list-col8">
			<div class="gridview">
				<div class="product-content">
					<h3 class="product-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					
					<?php if(get_option('woocommerce_enable_review_rating') === 'yes') { ?>
						<?php echo(wc_get_rating_html( $product->get_average_rating())); ?>
					<?php } ?>	
					
					<?php echo($product->get_price_html()); ?>
							
					<div class="button-group">
						<div class="add-to-cart">
							<?php echo do_shortcode('[add_to_cart id="'.esc_attr($product->get_id()).'" style="none" show_price="false"]'); ?>
						</div>
						
						<?php if(class_exists('YITH_WCWL')){ ?>
							<?php echo '<div class="vgw-wishlist">'.preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')).'</div>'; ?>
						<?php } ?>
						
						<?php  if(class_exists('YITH_Woocompare')) { ?>
							<div class="vgw-compare">
								<?php echo do_shortcode('[yith_compare_button]'); ?>
							</div>
						<?php  } ?>
						
						<?php if(isset($vg_calaco_options['quick_view']) && $vg_calaco_options['quick_view']) : ?>
						<div class="vgw-quickview">
							<?php echo '<a href="#" id="product_id_'. esc_attr($product->get_id()) .'" class="button vg_calaco_product_quick_view_button" data-product_id="'. esc_attr($product->get_id()) .'">' . esc_html__('Quick View', 'vg-calaco') . '</a>'; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="listview">
				<div class="product-content">
					<h3 class="product-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
					
					<?php if(get_option('woocommerce_enable_review_rating') === 'yes') { ?>
						<?php echo(wc_get_rating_html( $product->get_average_rating())); ?>
					<?php } ?>	
					
					<?php echo($product->get_price_html()); ?>
					
					<div class="product-desc">
						<?php 
						 $trimexcerpt = get_the_excerpt();
						 $words_short_des = 40;
						 $shortexcerpt = wp_trim_words($trimexcerpt, $num_words = $words_short_des, $more = '...'); 
						 echo($shortexcerpt);
						?>
					</div>
					
					<div class="button-group">
						<div class="add-to-cart">
							<?php echo do_shortcode('[add_to_cart id="'.esc_attr($product->get_id()).'" style="none" show_price="false"]'); ?>
						</div>
						
						<?php if(class_exists('YITH_WCWL')){ ?>
							<?php echo '<div class="vgw-wishlist">'.preg_replace("/<img[^>]+\>/i", " ", do_shortcode('[yith_wcwl_add_to_wishlist]')).'</div>'; ?>
						<?php } ?>
						
						<?php  if(class_exists('YITH_Woocompare')) { ?>
							<div class="vgw-compare">
								<?php echo do_shortcode('[yith_compare_button]'); ?>
							</div>
						<?php  } ?>
						
						<?php if(isset($vg_calaco_options['quick_view']) && $vg_calaco_options['quick_view']) : ?>
						<div class="vgw-quickview">
							<?php echo '<a href="#" class="button vg_calaco_product_quick_view_button" data-product_id="'. esc_attr($product->get_id()) .'">' . esc_html__('Quick View', 'vg-calaco') . '</a>'; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		/**
		 * woocommerce_after_shop_loop_item hook.
		 *
		 * @hooked woocommerce_template_loop_product_link_close - 5
		 * @hooked woocommerce_template_loop_add_to_cart - 10
		 */
		do_action('woocommerce_after_shop_loop_item');
		?>
	</div>
	
</div>
