<?php
/**
 * Template Name: Account Page
 *
 * Description: Account Page
 *
 * @package    VG Calaco
 * @author     VinaGecko <support@vinagecko.com>
 * @copyright  Copyright(C) 2015 VinaGecko.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://vinagecko.com
 */


get_header(); ?>
<div id="vg-main-content-wrapper" class="main-container page-account">
	<div class="page-content">
		<div class="site-breadcrumb">
			<div class="container">
				<?php vg_calaco_breadcrumbs(); ?>
			</div>
		</div><!-- .site-breadcrumb -->
		<div class="container">
			<div class="row">
				<div id="content" class="col-xs-12 col-md-12 site-content">
					<main id="main" class="site-main" role="main">

						<?php while(have_posts()) : the_post(); ?>

							<?php get_template_part('template-parts/content', 'page'); ?>

							<?php
								// If comments are open or we have at least one comment, load up the comment template.
								if(comments_open() || get_comments_number()) :
									comments_template();
								endif;
							?>

						<?php endwhile; // End of the loop. ?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>
</div><!-- #vg-main-content-wrapper -->
<?php get_footer(); ?>
