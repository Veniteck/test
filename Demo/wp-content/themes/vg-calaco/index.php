<?php
/**
 * The main template file
 *
 * @package VG Calaco
 *
 */
 
get_header();
$vg_calaco_options = get_option("vg_calaco_options");

$sidebar 		= 'left';
$blogColClass 	= 9;
$blogSidebar 	= 'left';
$blogClass 		= '';
$contentClass = 'pull-right';
if(isset($_GET['sidebar']) && $_GET['sidebar']!='')
{
	$sidebar = $_GET['sidebar'];
	
	switch($sidebar)
	{
		case 'right':
			$blogClass 		= 'sidebar-right';
			$blogColClass 	= 9;
			$blogSidebar 	= 'right';
			$contentClass = 'pull-left';
			break;
		case 'none':
			$blogClass 		= 'sidebar-none';
			$blogColClass 	= 12;
			$blogSidebar 	= 'none';
		break;
		default:
			$blogColClass 	= 9;
		break;
	}
}
elseif(isset($_GET['column']) && $_GET['column'] !='1')
{
	$blogClass 		= 'sidebar-none';
	$blogColClass 	= 12;
	$blogSidebar 	= 'none';
}
elseif(isset($_GET['column']) && $_GET['column'] =='1')
{
	$blogClass 		= 'sidebar-right';
	$blogColClass 	= 9;
	$blogSidebar 	= 'right';
	$contentClass = 'pull-left';
}
elseif(isset($vg_calaco_options['default_blog_sidebar']) && $vg_calaco_options['default_blog_sidebar']!='')
{
	$sidebar = $vg_calaco_options['default_blog_sidebar'];
	
	switch($sidebar) 
	{
		case 'right':
			$blogClass 		= 'sidebar-right';
			$blogColClass 	= 9;
			$blogSidebar 	= 'right';
			$contentClass = 'pull-left';
		break;
		case 'none':
			$blogClass 		= 'sidebar-none';
			$blogColClass 	= 12;
			$blogSidebar 	= 'none';
		break;
		default:
			$blogColClass 	= 9;
		break;
	}
}
$colContent = (is_active_sidebar('sidebar-1')) ? esc_attr($blogColClass) : 12;
?>
<div id="vg-main-content-wrapper" class="main-container blog-page <?php echo esc_attr($blogClass); ?>">
	<div class="site-breadcrumb">
		<div class="container">
			<header class="page-header">
				<h1 class="page-title">
					<?php
						echo esc_html__('Home', 'vg-calaco');
					?>
				</h1>
			</header><!-- .page-header -->
			<?php vg_calaco_breadcrumbs(); ?>
		</div>
	</div><!-- .site-breadcrumb -->
	
	<div class="container">
		<div class="row">
			
			<div id="content" class="col-xs-12 col-md-<?php echo esc_attr($colContent); ?> site-content <?php echo esc_attr($contentClass); ?>">
			<?php 
				if(have_posts()) {
					// Start the loop.
					?>
					<div class="row">
					<?php
					while(have_posts()) : the_post();
						get_template_part('template-parts/content', get_post_format());
					// End the loop.
					endwhile;
					?>
					</div>
					<?php 
					// Previous/next page navigation.
					the_posts_pagination(array(
						'prev_text'          => __('Previous', 'vg-calaco'),
						'next_text'          => __('Next', 'vg-calaco'),
						'before_page_number' => '',
					));
				} 
				else {
					get_template_part('template-parts/content', 'none');
				}
			?>
			</div><!-- #content -->
			
			<?php if($blogSidebar == 'left') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			
			<?php if($blogSidebar=='right') : ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</div><!-- #vg-main-content-wrapper -->
<?php get_footer(); ?>