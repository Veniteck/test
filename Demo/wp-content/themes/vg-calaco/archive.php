<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package VG Calaco
 */
$vg_calaco_options = get_option("vg_calaco_options");
get_header(); ?>
<?php
$sidebar = 'left';
$blogColClass = 9;
$blogSidebar = 'left';
$blogClass = 'sidebar-right';
$pullContent = 'pull-left';

if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$sidebar = $_GET['sidebar'];
	switch($sidebar) {
		case 'left':
			$blogClass = 'sidebar-left';
			$blogColClass = 9;
			$pullContent = 'pull-right';
			break;
		case 'none':
			$blogClass = 'sidebar-none';
			$blogColClass = 12;
			break;
		default:
			$blogClass = 'sidebar-right';
			$blogColClass = 9;
			$pullContent = 'pull-left';
			break;
	}
}elseif(isset($_GET['column']) && $_GET['column'] =='1'){
	$blogClass = 'sidebar-right';
	$blogColClass = 9;
	$blogSidebar = 'right';
}
elseif(isset($vg_calaco_options['default_blog_sidebar']) && $vg_calaco_options['default_blog_sidebar']!=''){
	$sidebar = $vg_calaco_options['default_blog_sidebar'];
	switch($sidebar) {
		case 'left':
			$blogClass = 'sidebar-left';
			$blogColClass = 9;
			$pullContent = 'pull-right';
			break;
		case 'none':
			$blogClass = 'sidebar-none';
			$blogColClass = 12;
			break;
		default:
			$blogClass = 'sidebar-right';
			$blogColClass = 9;
			$pullContent = 'pull-left';
			break;
	}
}
$colContent = (is_active_sidebar('sidebar-1')) ? esc_attr($blogColClass) : 12;
?>
<div id="vg-main-content-wrapper" class="main-container blog-page <?php echo esc_attr($blogClass); ?>">
	<div class="site-breadcrumb">
		<div class="container">
			<?php vg_calaco_breadcrumbs(); ?>
		</div>
	</div><!-- .site-breadcrumb -->
	<div class="container">
		<div class="row">
		
			<div id="content" class="col-xs-12 col-md-<?php echo esc_attr($colContent); ?> site-content <?php echo esc_attr($pullContent); ?>">
				<main id="main" class="site-main" role="main">
					<?php if(have_posts()) : ?>
						<?php /* Start the Loop */ ?>
						<div class="row">
							<?php while(have_posts()) : the_post(); ?>

								<?php

									/*
									 * Include the Post-Format-specific template for the content.
									 * If you want to override this in a child theme, then include a file
									 * called content-___.php(where ___ is the Post Format name) and that will be used instead.
									 */
									get_template_part('template-parts/content', get_post_format());
								?>

							<?php endwhile; ?>
						</div>
						
						<?php the_posts_navigation(); ?>

					<?php else : ?>

						<?php get_template_part('template-parts/content', 'none'); ?>

					<?php endif; ?>
				</main><!-- #main -->
			</div><!-- #content -->

			<?php if($sidebar == 'left' || $sidebar == 'right' ) : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
