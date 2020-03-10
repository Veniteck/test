<?php
/*
 * This is Product Search widget
 */

// don't load directly
if(!defined('ABSPATH')) die('-1');
 
// advanced search functionality
if(! function_exists('vg_calaco_advanced_search_query'))
{
	function vg_calaco_advanced_search_query($query) {
		if($query->is_search()) {
			// category terms search.
			if(isset($_GET['category']) && !empty($_GET['category'])) {
				$query->set('tax_query', array(array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => array($_GET['category']))
				));
			}    
			return $query;
		}
	}
}
add_action('pre_get_posts', 'vg_calaco_advanced_search_query', 1000);


// get product search theme
if(! function_exists('vg_calaco_product_carousel_themes'))
{
	function vg_calaco_product_search_themes($active, $type = "list") {
		$themes = ($type == "list") ? "" : array();
		$path 	= get_template_directory() . "/woocommerce/product-search";
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


// registered product search widget
if(! function_exists('vg_calaco_product_search_widget'))
{
	function vg_calaco_product_search_widget() {
		register_widget('Vina_ProductSearch_Widget');
	}
}
add_action('widgets_init', 'vg_calaco_product_search_widget');


// function get WooCommerce categories
if(! function_exists('vg_calaco_get_categories_list'))
{
	function vg_calaco_get_categories_list($parent = 0, $active = array(), $level = "") 
	{
		$return = isset($return) ? $return : "";
		
		$cats = get_terms('product_cat' , array('hide_empty' => false, 'hierarchical' => true, 'parent' => $parent));
		
		if(!empty($cats)) {
			foreach($cats as $cat) {
				$return  .= '<option value="'.$cat->slug.'"'.((in_array($cat->slug, $active)) ? ' selected="selected"' : '').'>'.$level.$cat->name.'</option>';
				$return  .= vg_calaco_get_categories_list($cat->term_id, $active, $level . "--");
			}		
		}
		
		return $return;
	}
}


// Vina Product Search Widget Class
if(! class_exists('Vina_ProductSearch_Widget')) 
{
	class Vina_ProductSearch_Widget extends WP_Widget 
	{	
		/**
		 * Register widget with WordPress.
		 */
		 
		public function __construct() 
		{
			parent::__construct(
				'vg_calaco_product_search', // Base ID
				esc_html__('VGW Product Search', 'vg-calaco'), // Name
				array('description' => esc_html__('A widget that display search form for WooCommerce with dropdown of product categories.', 'vg-calaco')) // Args
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
			$search_theme 	= !empty($instance['search_theme']) ? $instance['search_theme'] : "default.php";
			$return_content = "";
			
			if(is_file(get_template_directory() . '/woocommerce/product-search/' . $search_theme)) {
				include get_template_directory() . '/woocommerce/product-search/' . $search_theme;
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
			$class 			= !empty($instance['class_suffix']) ? $instance['class_suffix'] : "";
			$search_theme 	= !empty($instance['search_theme']) ? $instance['search_theme'] : "";
			?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('class_suffix')); ?>"><?php esc_html_e('Class Suffix:', 'vg-calaco'); ?></label> 
				<input class="widefat" id="<?php echo esc_attr($this->get_field_id('class_suffix')); ?>" name="<?php echo esc_attr($this->get_field_name('class_suffix')); ?>" type="text" value="<?php echo esc_attr($class); ?>">
			</p>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id('search_theme')); ?>"><?php esc_html_e('Search Theme', 'vg-calaco'); ?></label>
				<select class="widefat" name="<?php echo esc_attr($this->get_field_name('search_theme')); ?>" id="<?php echo esc_attr($this->get_field_id('search_theme')); ?>">				
					<?php echo vg_calaco_product_search_themes($search_theme); ?>
				</select>
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
			
			$instance['title'] 		  = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
			$instance['class_suffix'] = (!empty($new_instance['class_suffix'])) ? strip_tags($new_instance['class_suffix']) : '';
			$instance['search_theme'] = (!empty($new_instance['search_theme'])) ? strip_tags($new_instance['search_theme']) : 'default.php';
			
			return $instance;
		}
		
		/**
		 * Create Shortcode for this widget
		 * [vgw_product_search class_suffix="WIDGET_CLASS_SUFFIX"]
		 */
		 
		public static function shortcode($atts, $content = "")
		{
			$widget = new Vina_ProductSearch_Widget;
			return $widget->widget('shortcode', $atts);
		}
	}
}


// Add this widget to Visual Composer
if(! class_exists('VinaProductSearchAddonClass')) 
{
	class VinaProductSearchAddonClass 
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
				"name" 			=> esc_html__("VGW Search", 'vg-calaco'),
				"description" 	=> esc_html__("A search form for WooCommerce.", 'vg-calaco'),
				"base" 			=> "vgw_product_search",
				"class" 		=> "",
				"controls" 		=> "full",
				"icon" 			=> "icon-wpb-woocommerce",
				"category" 		=> esc_html__('VinaGecko Widgets', 'vg-calaco'),
				
				"params" => array(
					array(
						"type" 			=> "textfield",
						"save_always" 	=> true,						
						"class" 		=> "",
						"heading" 		=> esc_html__("Class Suffix", 'vg-calaco'),
						"param_name" 	=> "class_suffix",
						"value" 		=> "",
						"description" 	=> "",
						"admin_label" 	=> true,
					),
					array(
						"type" 			=> "dropdown",
						"save_always" 	=> true,
						"class" 		=> "",
						"heading" 		=> esc_html__("Search Theme", 'vg-calaco'),
						"param_name" 	=> "search_theme",
						"value" 		=> vg_calaco_product_search_themes("", "array"),
						"description" 	=> "",
						"admin_label" 	=> true,
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
new VinaProductSearchAddonClass();