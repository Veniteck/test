<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
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
?>
<div class="quantity">
	<span class="section-title"><?php echo esc_html__('Qty : ', 'vg-calaco'); ?></span>
	<button type="button" value="-" class="minus"><span class="fa fa-minus"></span></button>
	<input type="text" data-step="<?php echo esc_attr($step); ?>" <?php if(is_numeric($min_value)) : ?>data-min="<?php echo esc_attr($min_value); ?>"<?php endif; ?> <?php if(is_numeric($max_value)) : ?>data-max="<?php echo esc_attr($max_value); ?>"<?php endif; ?> name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($input_value); ?>" title="<?php echo esc_attr_x('Qty', 'Product quantity input tooltip', 'vg-calaco') ?>" class="input-text qty text" size="4" />
	<button type="button" value="+" class="plus"><span class="fa fa-plus"></span></button>
</div>
