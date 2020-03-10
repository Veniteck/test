<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VG Calaco
 */

get_header(); ?>
<div id="vg-main-content-wrapper" class="main-container page-site">
	<div class="page-content">
		<div class="site-breadcrumb">
			<div class="container">
				<?php vg_calaco_breadcrumbs(); ?>
			</div>
		</div><!-- .site-breadcrumb -->
		<div class="container">
			<div class="row">
				<div id="content" class="col-xs-12 col-md-9 site-content">
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

				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</div><!-- #vg-main-content-wrapper -->
<?php get_footer(); ?>
