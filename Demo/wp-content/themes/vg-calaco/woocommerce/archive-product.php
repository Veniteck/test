<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
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
 * @version     3.4.0
 */

if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
$vg_calaco_options = get_option("vg_calaco_options");

// Find the category + category parent, if applicable 
$term = get_queried_object(); 
$parent_id = empty($term->term_id) ? 0 : $term->term_id; 

// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug(http://core.trac.wordpress.org/ticket/15626) pad_counts won't work
$args = array(
	'child_of'		=> $parent_id,
	'menu_order'	=> 'ASC',
	'hide_empty'	=> 0,
	'hierarchical'	=> 1,
	'taxonomy'		=> 'product_cat',
	'pad_counts'	=> 1
);
$product_subcategories = get_categories($args);

get_header(); ?>
<?php
$shopsidebar = 'right';
$shopclass = 'sidebar-right';
$shopcolclass = 9;
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$shopsidebar = $_GET['sidebar'];
	
	switch($shopsidebar) {
		case 'left':
			$shopclass = 'sidebar-left';
			$shopcolclass = 9;
			$pullContent = 'pull-right';
			break;
		case 'none':
			$shopclass = 'sidebar-none';
			$shopcolclass = 12;
			$shopsidebar = 'none';
			break;
		default:
			$shopclass = 'sidebar-right';
			$shopcolclass = 9;
			$pullContent = 'pull-left';
			break;
	}
}elseif(isset($_GET['column']) && $_GET['column'] == '4') {
	$shopsidebar = 'none';
	$shopclass = 'sidebar-none';
	$shopcolclass = 12;
	$shopsidebar = 'none';
	
}else {
	if(isset($vg_calaco_options['default_shop_sidebar']) && $vg_calaco_options['default_shop_sidebar']!=''){
		$shopsidebar = $vg_calaco_options['default_shop_sidebar'];
	}	
	switch($shopsidebar) {
		case 'left':
			$shopclass = 'sidebar-left';
			$shopcolclass = 9;
			$pullContent = 'pull-right';
			break;
		case 'none':
			$shopclass = 'sidebar-none';
			$shopcolclass = 12;
			$shopsidebar = 'none';
			break;
		default:
			$shopclass = 'sidebar-right';
			$shopcolclass = 9;
			$pullContent = 'pull-left';
			break;
	}
}
$colContent = (is_active_sidebar('sidebar-shop')) ? esc_attr($shopcolclass) : 12;
?>
<div id="vg-main-content-wrapper" class="main-container page-shop archive-product <?php echo esc_attr($shopclass); ?>">
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
			
				
			<div id="content" class="col-xs-12 col-md-<?php echo esc_attr($colContent); ?> site-content <?php echo esc_attr($pullContent); ?>">
				<div class="archive-content">
				<?php
					/**
					 * woocommerce_archive_description hook.
					 *
					 * @hooked woocommerce_taxonomy_archive_description - 10
					 * @hooked woocommerce_product_archive_description - 10
					 */
					do_action('woocommerce_archive_description');
				?>

				<?php if(have_posts()) : ?>
					
					<?php if((is_shop() && '' !== get_option('woocommerce_shop_page_display')) ||(is_product_category() && '' !== get_option('woocommerce_category_archive_display'))) : ?>
					
					<ul class="all-subcategories">
							<?php woocommerce_product_subcategories(); ?>
						<div class="clearfix"></div>
					</ul>				
					
					<?php endif; ?>
								
								
					<?php if((is_shop() && 'subcategories' !== get_option('woocommerce_shop_page_display')) ||(is_product_category() && 'subcategories' !== get_option('woocommerce_category_archive_display')) ||(empty($product_subcategories) && 'subcategories' == get_option('woocommerce_category_archive_display')) || is_product_tag()): ?>
						<div class="toolbar">
							<div class="view-mode">
								<a href="#" class="grid active" title="<?php echo esc_attr__('Grid', 'vg-calaco'); ?>"><i class="fa fa-th-large"></i> <strong><?php echo esc_html__('Grid', 'vg-calaco'); ?></strong></a>
								<a href="#" class="list" title="<?php echo esc_attr__('List', 'vg-calaco'); ?>"><i class="fa fa-th-list"></i> <strong><?php echo esc_html__('List', 'vg-calaco'); ?></strong></a>
							</div>
							<?php
								/**
								 * woocommerce_before_shop_loop hook.
								 *
								 * @hooked woocommerce_result_count - 20
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action('woocommerce_before_shop_loop');
							?>
							
							<?php if((is_shop() && 'subcategories' !== get_option('woocommerce_shop_page_display')) ||(is_product_category() && 'subcategories' !== get_option('woocommerce_category_archive_display')) ||(empty($product_subcategories) && 'subcategories' == get_option('woocommerce_category_archive_display')) || is_product_tag()): ?>
								
									<?php
										/**
										 * woocommerce_after_shop_loop hook.
										 *
										 * @hooked woocommerce_pagination - 10
										 */
										do_action('woocommerce_after_shop_loop');
									?>
								
							<?php endif; ?>
						</div>
					<?php endif; ?>
					
					<?php woocommerce_product_loop_start(); ?>

						<?php while(have_posts()) : the_post(); ?>

							<?php wc_get_template_part('content', 'product'); ?>

						<?php endwhile; // end of the loop. ?>

					<?php woocommerce_product_loop_end(); ?>
					
					<?php if((is_shop() && 'subcategories' !== get_option('woocommerce_shop_page_display')) ||(is_product_category() && 'subcategories' !== get_option('woocommerce_category_archive_display')) ||(empty($product_subcategories) && 'subcategories' == get_option('woocommerce_category_archive_display')) || is_product_tag()): ?>
						<div class="toolbar bottom">		
							<?php
								/**
								 * woocommerce_after_shop_loop hook.
								 *
								 * @hooked woocommerce_pagination - 10
								 */
								do_action('woocommerce_after_shop_loop');
							?>
							<div class="clearfix"></div>
						</div>
					<?php endif; ?>
				<?php elseif(! woocommerce_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

					<?php wc_get_template('loop/no-products-found.php'); ?>

				<?php endif; ?>

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
		<?php if ($shopsidebar == 'left' || $shopsidebar == 'right') : ?>
				<?php get_sidebar('shop'); ?><!-- #secondary -->
			<?php endif; ?>
		</div>
	</div>
</div>
<?php do_action('woocommerce_after_girdview'); ?>
<?php get_footer(); ?>
