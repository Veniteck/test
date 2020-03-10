<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VG Calaco
 */

if(is_active_sidebar('sidebar-shop')) : ?>
<div id="secondary" class="col-xs-12 col-md-3 widget-area" role="complementary">
	<?php dynamic_sidebar('sidebar-shop'); ?>
</div><!-- #secondary -->
<?php endif; ?>