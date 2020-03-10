<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */

if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
$vg_calaco_options = get_option("vg_calaco_options");

if(isset($vg_calaco_options['sharing_options']) && $vg_calaco_options['sharing_options']){
	function vg_calaco_addthis_js(){
		wp_enqueue_script('addthis', 'http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-553dd7dd1ff880d4', array(), '1.0.0', 'all');
	}
	add_action('wp_head', 'vg_calaco_addthis_js', 99);
}
get_header(); 
?>
<div id="vg-main-content-wrapper" class="main-container woocommerce single-product">
	<div class="site-breadcrumb">
		<div class="container">
			<?php
				/**
				 * woocommerce_before_main_content hook.
				 *
				 * @hooked woocommerce_output_content_wrapper - 10(outputs opening divs for the content)
				 * @hooked woocommerce_breadcrumb - 20
				 */
				do_action('woocommerce_before_main_content');
			?>
		</div>
	</div><!-- .site-breadcrumb -->
	
	<div class="container">
		<div class="row">
			<div id="content" class="col-xs-12 col-md-12 site-content">
				<div class="product-view">
					<?php while(have_posts()) : the_post(); ?>

						<?php wc_get_template_part('content', 'single-product'); ?>

					<?php endwhile; // end of the loop. ?>

					<?php
						/**
						 * woocommerce_after_main_content hook.
						 *
						 * @hooked woocommerce_output_content_wrapper_end - 10(outputs closing divs for the content)
						 */
						do_action('woocommerce_after_main_content');
					?>
				</div>
			</div> <!-- #content -->
			
			<?php
				/**
				 * woocommerce_sidebar hook.
				 *
				 * @hooked woocommerce_get_sidebar - 10
				 */
				do_action('woocommerce_sidebar');
			?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
