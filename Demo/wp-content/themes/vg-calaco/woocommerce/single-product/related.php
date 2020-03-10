<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 *(the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if(! defined('ABSPATH')) {
	exit;
}

$vg_calaco_options = get_option("vg_calaco_options");
global $product, $woocommerce_loop;

if(empty($product) || ! $product->exists()) {
	return;
}

$related = wc_get_related_products( $product->get_id(), $limit = $posts_per_page, $exclude_ids = array() );

if(sizeof($related) == 0) return;

$args = apply_filters('woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array($product->get_id())
));

$products                    = new WP_Query($args);
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters('woocommerce_related_products_columns', $columns);

if ( $related_products ) : ?>

	<div class="related products">

		<h2 class="wpb_heading"><?php echo esc_html__('Related Products', 'vg-calaco'); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php foreach ( $related_products as $related_product ) : ?>

				<?php
				 	$post_object = get_post( $related_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object );

					wc_get_template_part( 'content', 'product' ); ?>

			<?php endforeach; ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>

<?php endif;

wp_reset_postdata();
