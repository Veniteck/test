<?php
/**
 * The template for displaying 404 pages(not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package VG Calaco
 */

get_header('404'); ?>
<div class="page-content">
	<h3><?php esc_html_e('PAGE NOT FOUND', 'vg-calaco'); ?></h3>
	<?php get_search_form(); ?>
</div>
<?php get_footer('404'); ?>
