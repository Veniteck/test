<?php
/*
 * This is Quick view HTML code.
 */
 
if(! defined('ABSPATH')) exit;

while(have_posts()) : the_post();

	global $post, $product;
	$vg_calaco_options = get_option("vg_calaco_options");
	
    add_action('woocommerce_before_single_product_summary_sale_flash', 'woocommerce_show_product_sale_flash', 10);
    add_action('woocommerce_before_single_product_summary_product_images', 'woocommerce_show_product_images', 20);
    add_action('woocommerce_single_product_summary_single_title', 'woocommerce_template_single_title', 5);
    add_action('woocommerce_single_product_summary_single_rating', 'woocommerce_template_single_rating', 10);
    add_action('woocommerce_single_product_summary_single_price', 'woocommerce_template_single_price', 10);
    add_action('woocommerce_single_product_summary_single_excerpt', 'woocommerce_template_single_excerpt', 20);
    add_action('woocommerce_single_product_summary_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);
    add_action('woocommerce_single_product_summary_single_meta', 'woocommerce_template_single_meta', 40);
    add_action('woocommerce_single_product_summary_single_sharing', 'woocommerce_template_single_sharing', 50);
    add_action('woocommerce_product_summary_thumbnails', 'woocommerce_show_product_thumbnails', 20);

    function add_product_class($classes) {
	    $classes[] = "product";
	    return $classes;
	}
	add_filter('post_class', 'add_product_class');

	?>

	<?php if(!post_password_required()) : ?>

	<div id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="javascript:void(0)" id="close_quickview"></a>
	    <div class="product_content_wrapper">	    	
	        <div class="row">
	            <div class="col-xs-6 columns">
	                <div class="product-images-wrapper">    
	                	<?php do_action('woocommerce_before_single_product_summary_sale_flash'); ?>
	                    <?php do_action('woocommerce_before_single_product_summary_product_images'); ?>
						<?php if(!$product->is_in_stock()) : ?>            
							<div class="out_of_stock_badge_single <?php if(!$product->is_on_sale()) : ?>first_position<?php endif; ?>"><?php esc_html($vg_calaco_options['out_of_stock_label']); ?></div>            
						<?php endif; ?>
	                </div>
	            </div><!-- .columns -->

	            <div class="col-xs-6 columns">
	                <div class="product_infos">
	                    <a href="<?php the_permalink(); ?>">
							<?php do_action('woocommerce_single_product_summary_single_title'); ?>
	                    </a>

	                    <div class="product-badges">
                            
                            <?php if(!$product->is_in_stock()) : ?>            
                                <div class="out_of_stock"><?php esc_html($vg_calaco_options['out_of_stock_label']); ?></div>            
                            <?php endif; ?>                       

		                    <div class="product_price">
		                        <?php do_action('woocommerce_single_product_summary_single_price'); ?>
		                    </div>
	                    </div>

	                    <div class="product_excerpt">
                        	<?php do_action('woocommerce_single_product_summary_single_excerpt'); ?>
                  		</div>
						
                		<?php do_action('woocommerce_single_product_summary_single_add_to_cart'); ?>
	                </div>
	            </div><!-- .columns -->
	        </div><!-- .row -->
	    </div><!-- .product_content_wrapper -->
	</div><!-- #product-<?php the_ID(); ?> -->

	<?php else: ?>
	<div class="row">
	    <div class="large-9 large-centered columns">
	    <br/><br/><br/><br/>
			<?php echo get_the_password_form(); ?>
		</div>
	</div>	
	<?php endif; ?>
<?php endwhile; // end of the loop.
