<?php
/*
 * This is Brand Logo Carousel widget
 */

// don't load directly
if(!defined('ABSPATH')) die('-1');


// registered brand logos carousel widget
if(! function_exists('vg_calaco_brand_carousel_widget'))
{
	function vg_calaco_brand_carousel_widget() {
		register_widget('Vina_BrandCarousel_Widget');
	}
}
add_action('widgets_init', 'vg_calaco_brand_carousel_widget');


// get brand logos carousel theme
if(! function_exists('vg_calaco_brand_carousel_themes'))
{
	function vg_calaco_brand_carousel_themes($active, $type = "list") {
		$themes = ($type == "list") ? "" : array();
		$path 	= get_template_directory() . "/woocommerce/brand-carousel";
		$files 	= vg_calaco_get_all_files($path);
		
		for($i = 0; $i < count($files); $i++) {
			if($type == "list") {
				$themes .= '<option value="'. esc_attr($files[$i]) .'"'.(($files[$i] == $active) ? ' selected="selected"' : '') .'>'. $files[$i] .'</option>';
			}
			else {
				$themes = array_merge($themes, array($files[$i] => $files[$i]));
			}
		}
		
		return $themes;
	}
}

// Vina Product Carousel Widget Class
if(! class_exists('Vina_BrandCarousel_Widget')) 
{
	class Vina_BrandCarousel_Widget extends WP_Widget 
	{	
		/**
		 * Register widget with WordPress.
		 */
		
		public function __construct() 
		{
			parent::__construct(
				'vg_calaco_brand_carousel', // Base ID
				esc_html__('VGW Brand Logos Carousel', 'vg-calaco'), // Name
				array('description' => esc_html__('A widget that display Brand Logos in responsive carousel.', 'vg-calaco')) // Args
			);
		}
		
		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		 
		public function widget($args, $instance) 
		{
			$vg_calaco_options 	= get_option("vg_calaco_options");
			
			$brand_logos    = (isset($vg_calaco_options['brand_logos']) && !empty($vg_calaco_options['brand_logos'])) ? $vg_calaco_options['brand_logos'] : array();			
			$carousel_theme = !empty($instance['carousel_theme']) ? $instance['carousel_theme'] : "default.php";
			$row_carousel	= !empty($instance['row_carousel']) ? intval($instance['row_carousel']) : 1;
			$total_items	= count($brand_logos);
			$total_loop 	= ceil($total_items/$row_carousel);
			$key_loop   	= 0;
			$return_content = esc_html__("No item found. Please check your config(*_*)", "vg-calaco");;
			
			if($total_items && is_file(get_template_directory() . '/woocommerce/brand-carousel/' . $carousel_theme)) {
				include get_template_directory() . '/woocommerce/brand-carousel/' . $carousel_theme;
			}
			
			if($args != 'shortcode') {
				$title = apply_filters('widget_title', $instance['title']);
				
				echo($args['before_widget']);
				
					if(! empty($title)) echo($args['before_title']). esc_html($title) .$args['after_title'];
					echo($return_content);
					
				echo ($args['after_widget']);
			}
			else {
				return $return_content;
			}
		}
		
		/**
		 * Back-end widget form.
		 *
		 * @see WP_Widget::form()
		 *
		 * @param array $instance Previously saved values from database.
		 */
		public function form($instance) 
		{
			$title 			= !empty($instance['title']) ? $instance['title'] : esc_html__('New title', 'vg-calaco');
			$unique_id 		= !empty($instance['unique_id']) ? $instance['unique_id'] : "vgw-brand-carousel";
			$class 			= !empty($instance['class_suffix']) ? $instance['class_suffix'] : "";
						
			$carousel_theme = !empty($instance['carousel_theme']) ? $instance['carousel_theme'] : "default.php";			
			$items_visible  = !empty($instance['items_visible']) ? $instance['items_visible'] : "6";
			$row_carousel	= !empty($instance['row_carousel']) ? $instance['row_carousel'] : "1";
			
			$responsive		= !empty($instance['responsive']) ? $instance['responsive'] : "";
			$items_desktop	= !empty($instance['items_desktop']) ? $instance['items_desktop'] : "[1199,6]";
			$items_sdesktop	= !empty($instance['items_sdesktop']) ? $instance['items_sdesktop'] : "[979,4]";
			$items_tablet	= !empty($instance['items_tablet']) ? $instance['items_tablet'] : "[768,3]";
			$items_stablet	= !empty($instance['items_stablet']) ? $instance['items_stablet'] : "false";
			$items_mobile	= !empty($instance['items_mobile']) ? $instance['items_mobile'] : "[479,2]";
			$items_custom	= !empty($instance['items_custom']) ? $instance['items_custom'] : "false";
			
			$next_preview	= !empty($instance['next_preview']) ? $instance['next_preview'] : "";
			$pagination		= !empty($instance['pagination']) ? $instance['pagination'] : "";
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('unique_id')); ?>"><?php esc_html_e('Unique ID:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('unique_id')); ?>" name="<?php echo esc_attr($this->get_field_name('unique_id')); ?>" type="text" value="<?php echo esc_attr($unique_id); ?>">
				<em><?php _e('Enter unique ID for this carousel. Eg: vgw-brand-carousel, vgw-brand-carousel-1, vgw-brand-carousel-2 ...', 'vg-calaco'); ?></em>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('class_suffix')); ?>"><?php esc_html_e('Class Suffix:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('class_suffix')); ?>" name="<?php echo esc_attr($this->get_field_name('class_suffix')); ?>" type="text" value="<?php echo esc_attr($class); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('carousel_theme')); ?>"><?php esc_html_e('Carousel Theme', 'vg-calaco'); ?></label>
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('carousel_theme')); ?>" id="<?php echo esc_attr($this->get_field_id('carousel_theme')); ?>">				
					<?php echo vg_calaco_brand_carousel_themes($carousel_theme); ?>
				</select>
			</p>			
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('items_visible')); ?>"><?php esc_html_e('Items Visible:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_visible')); ?>" name="<?php echo esc_attr($this->get_field_name('items_visible')); ?>" type="text" value="<?php echo esc_attr($items_visible); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('row_carousel')); ?>"><?php esc_html_e('Row of Carousel:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('row_carousel')); ?>" name="<?php echo esc_attr($this->get_field_name('row_carousel')); ?>" type="text" value="<?php echo esc_attr($row_carousel); ?>">
			</p>
			<p>
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id('responsive')); ?>" name="<?php echo esc_attr($this->get_field_name('responsive')); ?>" type="checkbox" value="1" <?php echo($responsive) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr($this->get_field_id('responsive')); ?>"><?php esc_html_e('Disabled Responsive', 'vg-calaco'); ?></label>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('items_desktop')); ?>"><?php esc_html_e('Items Desktop:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_desktop')); ?>" name="<?php echo esc_attr($this->get_field_name('items_desktop')); ?>" type="text" value="<?php echo esc_attr($items_desktop); ?>">
				<em><?php _e('The format is [x,y] whereby x=browser width and y=number of slides displayed.', 'vg-calaco'); ?></em>
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('items_sdesktop')); ?>"><?php esc_html_e('Items Desktop Small:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_sdesktop')); ?>" name="<?php echo esc_attr($this->get_field_name('items_sdesktop')); ?>" type="text" value="<?php echo esc_attr($items_sdesktop); ?>">				
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('items_tablet')); ?>"><?php esc_html_e('Items Tablet:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_tablet')); ?>" name="<?php echo esc_attr($this->get_field_name('items_tablet')); ?>" type="text" value="<?php echo esc_attr($items_tablet); ?>">				
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('items_stablet')); ?>"><?php esc_html_e('Items Tablet Small:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_stablet')); ?>" name="<?php echo esc_attr($this->get_field_name('items_stablet')); ?>" type="text" value="<?php echo esc_attr($items_stablet); ?>">				
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('items_mobile')); ?>"><?php esc_html_e('Items Mobile:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_mobile')); ?>" name="<?php echo esc_attr($this->get_field_name('items_mobile')); ?>" type="text" value="<?php echo esc_attr($items_mobile); ?>">				
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('items_custom')); ?>"><?php esc_html_e('Items Custom:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('items_custom')); ?>" name="<?php echo esc_attr($this->get_field_name('items_custom')); ?>" type="text" value="<?php echo esc_attr($items_custom); ?>">
				<em><?php _e('Example: [[0, 2], [400, 4], [700, 6], [1000, 8], [1200, 10], [1600, 16]]', 'vg-calaco'); ?></em>
			</p>
			<p>				
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id('next_preview')); ?>" name="<?php echo esc_attr($this->get_field_name('next_preview')); ?>" type="checkbox" value="1" <?php echo($next_preview) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr($this->get_field_id('next_preview')); ?>"><?php esc_html_e('Next & Preview Buttons', 'vg-calaco'); ?></label> 
				<br/>			
				<input class="checkbox" id="<?php echo esc_attr($this->get_field_id('pagination')); ?>" name="<?php echo esc_attr($this->get_field_name('pagination')); ?>" type="checkbox" value="1" <?php echo($pagination) ? 'checked="checked"' : ''; ?>>
				<label for="<?php echo esc_attr($this->get_field_id('pagination')); ?>"><?php esc_html_e('Show Pagination', 'vg-calaco'); ?></label> 
			</p>
			<?php
		}
		
		/**
		 * Sanitize widget form values as they are saved.
		 *
		 * @see WP_Widget::update()
		 *
		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.
		 *
		 * @return array Updated safe values to be saved.
		 */
		public function update($new_instance, $old_instance) 
		{
			$instance = array();
			
			$instance['title'] 		  	= (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
			$instance['unique_id'] 		= (!empty($new_instance['unique_id'])) ? strip_tags($new_instance['unique_id']) : 'vgw-brand-carousel';
			$instance['class_suffix'] 	= (!empty($new_instance['class_suffix'])) ? strip_tags($new_instance['class_suffix']) : '';			
			$instance['carousel_theme'] = (!empty($new_instance['carousel_theme'])) ? strip_tags($new_instance['carousel_theme']) : 'default.php';
			$instance['items_visible'] 	= (!empty($new_instance['items_visible'])) ? intval($new_instance['items_visible']) : '6';
			$instance['row_carousel'] 	= (!empty($new_instance['row_carousel'])) ? intval($new_instance['row_carousel']) : '1';
			
			$instance['responsive']		= !empty($new_instance['responsive']) ? intval($new_instance['responsive']) : "";
			$instance['items_desktop']	= !empty($new_instance['items_desktop']) ? $new_instance['items_desktop'] : "[1199,6]";
			$instance['items_sdesktop']	= !empty($new_instance['items_sdesktop']) ? $new_instance['items_sdesktop'] : "[979,4]";
			$instance['items_tablet']	= !empty($new_instance['items_tablet']) ? $new_instance['items_tablet'] : "[768,3]";
			$instance['items_stablet']	= !empty($new_instance['items_stablet']) ? $new_instance['items_stablet'] : "false";
			$instance['items_mobile']	= !empty($new_instance['items_mobile']) ? $new_instance['items_mobile'] : "[479,2]";
			$instance['items_custom']	= !empty($new_instance['items_custom']) ? $new_instance['items_custom'] : "false";
			
			$instance['next_preview'] 	= (!empty($new_instance['next_preview'])) ? intval($new_instance['next_preview']) : '';
			$instance['pagination'] 	= (!empty($new_instance['pagination'])) ? intval($new_instance['pagination']) : '';
			
			return $instance;
		}
		
		/**
		 * Create Shortcode for this widget
		 * [vgw_brand_carousel class_suffix="WIDGET_CLASS_SUFFIX" ...]
		 */
		 
		public static function shortcode($atts, $content = "")
		{
			$widget = new Vina_BrandCarousel_Widget;
			return $widget->widget('shortcode', $atts);
		}
	}
}


// Add this widget to Visual Composer
if(! class_exists('VinaBrandCarouselAddonClass')) 
{
	class VinaBrandCarouselAddonClass 
	{
		function __construct() {
			 add_action('init', array($this, 'integrateWithVC'));
		}
		
		public function integrateWithVC() {
			// Check if Visual Composer is installed
			if(! defined('WPB_VC_VERSION')) {
				// Display notice that Visual Compser is required
				add_action('admin_notices', array($this, 'showVcVersionNotice'));
				return;
			}
			
			/*
			Add your Visual Composer logic here.
			Lets call vc_map function to "register" our custom shortcode within Visual Composer interface.

			More info: http://kb.wpbakery.com/index.php?title=Vc_map
			*/
			
			vc_map(array(
				"name" 			=> esc_html__("VGW Brand Logos Carousel", 'vg-calaco'),
				"description" 	=> esc_html__("Brand Logos Carousel.", 'vg-calaco'),
				"base" 			=> "vgw_brand_carousel",
				"class" 		=> "",
				"controls" 		=> "full",
				"icon" 			=> "icon-wpb-wp",
				"category" 		=> esc_html__('VinaGecko Widgets', 'vg-calaco'),
				
				"params" => array(
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Unique ID", 'vg-calaco'),
						"param_name" 	=> "unique_id",
						"value" 		=> "vgw-brand-carousel",
						"admin_label" 	=> true,
						"description" 	=> esc_html__('Enter unique ID for this carousel. Eg: vgw-brand-carousel, vgw-brand-carousel-1, vgw-brand-carousel-2 ...', 'vg-calaco'),
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Class Suffix", 'vg-calaco'),
						"param_name" 	=> "class_suffix",
						"value" 		=> "",
						"description" 	=> ""
					),					
					array(
						"type" 			=> "dropdown",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Carousel Theme", 'vg-calaco'),
						"param_name" 	=> "carousel_theme",
						"value" 		=> vg_calaco_brand_carousel_themes("", "array"),
						"description" 	=> "",
						"admin_label" 	=> true,
					),					
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Items Visible", 'vg-calaco'),
						"param_name" 	=> "items_visible",
						"value" 		=> "6",
						"description" 	=> ""
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Row of Carousel", 'vg-calaco'),
						"param_name" 	=> "row_carousel",
						"value" 		=> "1",
						"description" 	=> ""
					),
					array(
						"type" 			=> "checkbox",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Next & Preview Buttons", 'vg-calaco'),
						"param_name" 	=> "next_preview",
						"value" 		=> array("Show" => 1),
						"description" 	=> "",
					),
					array(
						"type" 			=> "checkbox",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Pagination", 'vg-calaco'),
						"param_name" 	=> "pagination",
						"value" 		=> array("Show" => 1),
						"description" 	=> "",						
					),
					array(
						"type" 			=> "checkbox",
						"save_always" 	=> true,
						"heading" 		=> esc_html__("Responsive", 'vg-calaco'),
						"param_name" 	=> "responsive",
						"value" 		=> array("Disabled" => 1),
						"description" 	=> esc_html__("You can use Owl Carousel on desktop-only websites too! Just check this option to disable resposive capabilities", 'vg-calaco'),
						'group' 		=> esc_html__('Responsive', 'vg-calaco'),
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"heading" 		=> esc_html__("Items Desktop", 'vg-calaco'),
						"param_name" 	=> "items_desktop",
						"value" 		=> "[1199,6]",
						"description" 	=> esc_html__("This allows you to preset the number of slides visible with a particular browser width. The format is [x,y] whereby x=browser width and y=number of slides displayed. For example [1199,4] means that if(window<=1199){ show 4 slides per page}", 'vg-calaco'),
						'group' 		=> esc_html__('Responsive', 'vg-calaco'),
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"heading" 		=> esc_html__("Items Desktop Small", 'vg-calaco'),
						"param_name" 	=> "items_sdesktop",
						"value" 		=> "[979,4]",
						"description" 	=> esc_html__("As above", 'vg-calaco'),
						'group' 		=> esc_html__('Responsive', 'vg-calaco'),
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"heading" 		=> esc_html__("Items Tablet", 'vg-calaco'),
						"param_name" 	=> "items_tablet",
						"value" 		=> "[768,3]",
						"description" 	=> esc_html__("As above", 'vg-calaco'),
						'group' 		=> esc_html__('Responsive', 'vg-calaco'),
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"heading" 		=> esc_html__("Items Tablet Small", 'vg-calaco'),
						"param_name" 	=> "items_stablet",
						"value" 		=> "false",
						"description" 	=> esc_html__("As above. Default value is disabled.", 'vg-calaco'),
						'group' 		=> esc_html__('Responsive', 'vg-calaco'),
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"heading" 		=> esc_html__("Items Mobile", 'vg-calaco'),
						"param_name" 	=> "items_mobile",
						"value" 		=> "[479,2]",
						"description" 	=> esc_html__("As above", 'vg-calaco'),
						'group' 		=> esc_html__('Responsive', 'vg-calaco'),
					),
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,
						"heading" 		=> esc_html__("Items Custom", 'vg-calaco'),
						"param_name" 	=> "items_custom",
						"value" 		=> "false",
						"description" 	=> esc_html__("This allow you to add custom variations of items depending from the width If this option is set, itemsDeskop, itemsDesktopSmall, itemsTablet, itemsMobile etc. are disabled For better preview, order the arrays by screen size, but it's not mandatory Don't forget to include the lowest available screen size, otherwise it will take the default one for screens lower than lowest available.<br>Example:<br>[[0, 2], [400, 4], [700, 6], [1000, 8], [1200, 10], [1600, 16]]", 'vg-calaco'),
						'group' 		=> esc_html__('Responsive', 'vg-calaco'),
					),
				)
			));
		}
		
		
		/*
		Show notice if your plugin is activated but Visual Composer is not
		*/
		public function showVcVersionNotice() {			
		
		}
	}
}
new VinaBrandCarouselAddonClass();