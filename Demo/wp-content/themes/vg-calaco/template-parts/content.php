<?php
/**
 * The template part for displaying content
 *
 * @package VG Calaco
 */
if(! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
$vg_calaco_options = get_option("vg_calaco_options");
global $post, $loop;


$column = 1;
$colwidth = 12;
$colclass = 'list';
if(isset($_GET['column']) && $_GET['column']!=''){
	$column = $_GET['column'];
	switch($column) {
		case '3':
			$colwidth = 4;
			break;
		case '2':
			$colwidth = 6;
			break;
		case '1':
			$colwidth = 12;
			$colclass = 'list';
			break;
		default:
			$colwidth = 3;
			break;
	}
}elseif(isset($vg_calaco_options['posts_per_column']) && $vg_calaco_options['posts_per_column']!=''){
	$column = $vg_calaco_options['posts_per_column'];
	switch($column) {
		case '3':
			$colwidth = 4;
			break;
		case '2':
			$colwidth = 6;
			break;
		case '1':
			$colwidth = 12;
			$colclass = 'list';
			break;
		default:
			$colwidth = 3;
			$colclass = 'grid';
			break;
	}
}
// Store loop count we're currently on
$classes = array();

if(empty($loop['loop']))
	$loop['loop'] = 0;

if(empty($loop['columns']))
	$loop['columns'] = $column;

$loop['loop']++;

if(0 === ($loop['loop'] - 1) % $loop['columns'] || 1 === $loop['columns']) {
	$classes[] = 'first';
}
if(0 === $loop['loop'] % $loop['columns']) {
	$classes[] = 'last';
}

$classes[] = 'col-md-'. esc_attr($colwidth) .' col-xs-12 '.esc_attr($colclass).'';
?>
<?php if(!is_single()) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
<?php else : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php endif; ?>	
	<div class="post-wrapper">
		<?php vg_calaco_post_thumbnail(); ?>

		<div class="post-content">
			<header class="entry-header">
				<?php if(is_single()) : ?>
						<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php else : ?>
					<?php if(is_sticky() && is_home() && ! is_paged()) : ?>
						<span class="sticky-post"><?php esc_html_e('Featured', 'vg-calaco'); ?></span>
					<?php endif; ?>

					<?php the_title(sprintf('<h4 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>'); ?>
				<?php endif; ?>
			</header><!-- .entry-header -->
			<div class="position_meta">
				<?php if(function_exists('vg_calaco_entry_meta')) : ?>
				<div class="entry-meta">
					<?php vg_calaco_entry_meta(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</div>
			<?php if(!is_single()) : ?>
				<div class="entry-summary">
					<?php the_excerpt(); ?>
					<div class="more-link">
						<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo esc_html__('Read more', 'vg-calaco'); ?></a>
					</div>
				</div><!-- .entry-summary -->
			<?php else : ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			<?php endif; ?>
			
			<?php if(is_single()) : ?>
				<?php if(function_exists('vg_calaco_entry_tags')) : ?>
					<?php vg_calaco_entry_tags(); ?><!-- .entry-tags -->
				<?php endif; ?>
			<?php endif; ?>
		</div><!-- .post-content -->
	</div><!-- .post-wrapper -->
</article><!-- #post-## -->
