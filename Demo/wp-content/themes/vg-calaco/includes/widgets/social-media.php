<?php
/*
 * This is Brand Logo Carousel widget
 */

// don't load directly
if(!defined('ABSPATH')) die('-1');

// registered brand logos carousel widget
if(! function_exists('vg_calaco_social_media_widget'))
{
	function vg_calaco_social_media_widget() {
		register_widget('Vina_SocialMedia_Widget');
	}
}
add_action('widgets_init', 'vg_calaco_social_media_widget');

// Vina Product Carousel Widget Class
if(! class_exists('Vina_SocialMedia_Widget')) 
{
	class Vina_SocialMedia_Widget extends WP_Widget 
	{

		public function __construct() 
		{
			parent::__construct(
				'vgw_social_media', // Base ID
				esc_html__('VGW Social Media', 'vg-calaco'), // Name
				array('description' => esc_html__('A widget that displays Social Media Profiles', 'vg-calaco'),) // Args
			);
		}

		public function widget($args, $instance) 
		{
			$title = apply_filters('widget_title', $instance['title']);

			echo ($args['before_widget']);
			
			if(! empty($title))
				echo ($args['before_title']) . esc_html($title) . ($args['after_title']);
			
			$vg_calaco_options = get_option("vg_calaco_options");
			
			$facebook = $pinterest = $linkedin = $twitter = $googleplus = $rss = $tumblr = $instagram = $youtube = $vimeo = $behance = $dribble = $flickr = $git = $skype = $weibo = $foursquare = $soundcloud = $vk = "";
			
			if(isset($vg_calaco_options['facebook_link'])) 		$facebook 	= esc_url($vg_calaco_options['facebook_link']);
			if(isset($vg_calaco_options['pinterest_link'])) 	$pinterest 	= esc_url($vg_calaco_options['pinterest_link']);
			if(isset($vg_calaco_options['linkedin_link'])) 		$linkedin 	= esc_url($vg_calaco_options['linkedin_link']);
			if(isset($vg_calaco_options['twitter_link'])) 		$twitter 	= esc_url($vg_calaco_options['twitter_link']);
			if(isset($vg_calaco_options['googleplus_link'])) 	$googleplus = esc_url($vg_calaco_options['googleplus_link']);
			if(isset($vg_calaco_options['rss_link'])) 			$rss 		= esc_url($vg_calaco_options['rss_link']);
			if(isset($vg_calaco_options['tumblr_link'])) 		$tumblr 	= esc_url($vg_calaco_options['tumblr_link']);
			if(isset($vg_calaco_options['instagram_link'])) 	$instagram 	= esc_url($vg_calaco_options['instagram_link']);
			if(isset($vg_calaco_options['youtube_link']))		$youtube 	= esc_url($vg_calaco_options['youtube_link']);
			if(isset($vg_calaco_options['vimeo_link'])) 		$vimeo 		= esc_url($vg_calaco_options['vimeo_link']);
			if(isset($vg_calaco_options['behance_link'])) 		$behance 	= esc_url($vg_calaco_options['behance_link']);
			if(isset($vg_calaco_options['dribble_link'])) 		$dribble 	= esc_url($vg_calaco_options['dribble_link']);
			if(isset($vg_calaco_options['flickr_link'])) 		$flickr 	= esc_url($vg_calaco_options['flickr_link']);
			if(isset($vg_calaco_options['git_link'])) 			$git 		= esc_url($vg_calaco_options['git_link']);
			if(isset($vg_calaco_options['skype_link'])) 		$skype 		= esc_url($vg_calaco_options['skype_link']);
			if(isset($vg_calaco_options['weibo_link'])) 		$weibo 		= esc_url($vg_calaco_options['weibo_link']);
			if(isset($vg_calaco_options['foursquare_link'])) 	$foursquare = esc_url($vg_calaco_options['foursquare_link']);
			if(isset($vg_calaco_options['soundcloud_link'])) 	$soundcloud = esc_url($vg_calaco_options['soundcloud_link']);
			if(isset($vg_calaco_options['vk_link'])) 			$vk 		= esc_url($vg_calaco_options['vk_link']);
			if(!empty($facebook)) 	echo('<a href="' . esc_url($facebook) . '" target="_blank" class="widget_connect_facebook">Facebook</a>');
			if(!empty($pinterest)) 	echo('<a href="' . esc_url($pinterest) . '" target="_blank" class="widget_connect_pinterest">Pinterest</a>');
			if(!empty($linkedin)) 	echo('<a href="' . esc_url($linkedin) . '" target="_blank" class="widget_connect_linkedin">Linkedin</a>');
			if(!empty($twitter)) 	echo('<a href="' . esc_url($twitter) . '" target="_blank" class="widget_connect_twitter">Twitter</a>');
			if(!empty($googleplus)) echo('<a href="' . esc_url($googleplus) . '" target="_blank" class="widget_connect_googleplus">Google+</a>');
			if(!empty($rss)) 		echo('<a href="' . esc_url($rss) . '" target="_blank" class="widget_connect_rss">RSS</a>');
			if(!empty($tumblr)) 	echo('<a href="' . esc_url($tumblr) . '" target="_blank" class="widget_connect_tumblr">Tumblr</a>');
			if(!empty($instagram)) 	echo('<a href="' . esc_url($instagram) . '" target="_blank" class="widget_connect_instagram">Instagram</a>');
			if(!empty($youtube)) 	echo('<a href="' . esc_url($youtube) . '" target="_blank" class="widget_connect_youtube">Youtube</a>');
			if(!empty($vimeo)) 		echo('<a href="' . esc_url($vimeo) . '" target="_blank" class="widget_connect_vimeo">Vimeo</a>');
			if(!empty($behance)) 	echo('<a href="' . esc_url($behance) . '" target="_blank" class="widget_connect_behance">Behance</a>');
			if(!empty($dribble)) 	echo('<a href="' . esc_url($dribble) . '" target="_blank" class="widget_connect_dribble">Dribble</a>');
			if(!empty($flickr)) 	echo('<a href="' . esc_url($flickr) . '" target="_blank" class="widget_connect_flickr">Flickr</a>');
			if(!empty($git)) 		echo('<a href="' . esc_url($git) . '" target="_blank" class="widget_connect_git">Git</a>');
			if(!empty($skype)) 		echo('<a href="' . esc_url($skype) . '" target="_blank" class="widget_connect_skype">Skype</a>');
			if(!empty($weibo)) 		echo('<a href="' . esc_url($weibo) . '" target="_blank" class="widget_connect_weibo">Weibo</a>');
			if(!empty($foursquare)) echo('<a href="' . esc_url($foursquare) . '" target="_blank" class="widget_connect_foursquare">Foursquare</a>');
			if(!empty($soundcloud)) echo('<a href="' . esc_url($soundcloud) . '" target="_blank" class="widget_connect_soundcloud">Soundcloud</a>');
			if(!empty($vk)) 		echo('<a href="' . esc_url($vk) . '" target="_blank" class="widget_connect_vk">VK</a>');
			
			echo ($args['after_widget']);
		}

		public function form($instance) 
		{
			$title = !empty($instance['title']) ? $instance['title'] : esc_html__('Get Connected', 'vg-calaco');
			?>
			
			<p><em><?php esc_html_e('You can manager Social Media link in VG Calaco >> Social Media.', 'vg-calaco'); ?></em></p>
			<p>
				<label for="<?php echo ($this->get_field_id('title')); ?>"><?php _e('Title:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo ($this->get_field_id('title')); ?>" name="<?php echo ($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
			</p>
			
			<?php 
		}

		public function update($new_instance, $old_instance) 
		{
			$instance = array();
			
			$instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';

			return $instance;
		}
	}
}