<?php
/**
 * @version    1.4
 * @package    VG Calaco
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright(C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-wrapper">
		<div class="post-content">
			<div class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(array('before' => '<div class="page-links">' . esc_html__('Pages:', 'vg-calaco'), 'after' => '</div>', 'pagelink' => '<span>%</span>')); ?>
			</div>
			<!-- .entry-content -->
		</div><!-- .post-content -->
	</div><!-- .post-wrapper -->
</article><!-- #post -->