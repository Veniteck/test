<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
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
 * @version     3.5.0
 */

if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
$vg_calaco_options = get_option("vg_calaco_options");
?>
<?php if(isset($vg_calaco_options['sharing_options']) && $vg_calaco_options['sharing_options']) : ?>
	<div class="addthis_native_toolbox"></div>
<?php endif; ?>
