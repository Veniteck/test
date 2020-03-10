<?php
/**
 * Template Name: Home Template
 *
 * Description: Home template
 *
 * @package    VG Calaco
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright(C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */

get_header();
?>
<div id="vg-main-content-wrapper" class="main-container front-page">
	<div class="page-content">
		<div class="container">
			<?php if(have_posts()) : ?>
				<?php while(have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php the_content(); ?>
					</article>
				<?php endwhile; ?>
			<?php endif; ?>
		</div>
	</div>
</div><!-- .vg-main-content-wrapper -->

<?php get_footer(); ?>