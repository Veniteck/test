<?php
if(! function_exists('vg_calaco_custom_styles'))
{
	function vg_calaco_custom_styles() 
	{
		$vg_calaco_options 	= get_option("vg_calaco_options");
		
		ob_start();
		?>
		<?php if(isset($vg_calaco_options['typography_customize']) && $vg_calaco_options['typography_customize']): ?>
			body{
				font-family: 
				<?php if($vg_calaco_options['font_source'] == "3") echo '\'' . $vg_calaco_options['main_typekit_font_face'] . '\','; ?>
				<?php if($vg_calaco_options['font_source'] == "2") echo '\'' . $vg_calaco_options['main_google_font_face'] . '\','; ?>
				<?php if($vg_calaco_options['font_source'] == "1") echo '\'' . $vg_calaco_options['main_font']['font-family'] . '\','; ?> 
				<?php if($vg_calaco_options['font_source'] == "3") echo '\'' . $vg_calaco_options['secondary_typekit_font_face'] . '\','; ?>
				<?php if($vg_calaco_options['font_source'] == "2") echo '\'' . $vg_calaco_options['secondary_google_font_face'] . '\','; ?>
				<?php if($vg_calaco_options['font_source'] == "1") echo '\'' . $vg_calaco_options['secondary_font']['font-family'] . '\','; ?> 
				sans-serif;
			}
		<?php endif; ?>
		
		<?php if(isset($vg_calaco_options['styling_customize']) && $vg_calaco_options['styling_customize']): ?>
		/* Common Css */
		body{
			color:<?php echo ($vg_calaco_options['body_color']); ?>;
			background-color: <?php echo ($vg_calaco_options['main_background']['background-color']); ?>;
			background-image: url('<?php echo ($vg_calaco_options['main_background']['background-image']); ?>');
			background-repeat: <?php echo ($vg_calaco_options['main_background']['background-repeat']); ?>;
			background-size: <?php echo ($vg_calaco_options['main_background']['background-size']); ?>;
			background-attachment: <?php echo ($vg_calaco_options['main_background']['background-attachment']); ?>;
			background-position: <?php echo ($vg_calaco_options['main_background']['background-position']); ?>;
		}
		.vg-website-wrapper .owl-theme.visible-controls .owl-controls .owl-buttons div:hover{
			color:<?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .s-text b {
			color:<?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .s-btn:hover {
		  background: <?php echo ($vg_calaco_options['main_color']); ?>;
		  border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .wpb_heading:after {
		  background: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .wpb_heading.style5:before,
		.vg-website-wrapper .wpb_heading.style5:after {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .widget-title:after,
		.vg-website-wrapper .woocommerce ul.cart_list li .product-image .quantity,
		.vg-website-wrapper .woocommerce ul.product_list_widget li .product-image .quantity{
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .widget ul li a:hover,
		.vg-website-wrapper .widget ol li a:hover,
		.vg-website-wrapper .widget_product_categories ul li.current-cat > a,
		.vg-website-wrapper .widget_categories ul li.current-cat > a,
		.vg-website-wrapper .widget_product_categories ul li:hover > a,
		.vg-website-wrapper .widget_categories ul li:hover > a {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .widget_product_categories ul li.current-cat > a:before,
		.vg-website-wrapper .widget_categories ul li.current-cat > a:before,
		.vg-website-wrapper .widget_product_categories ul li:hover > a:before,
		.vg-website-wrapper .widget_categories ul li:hover > a:before {
			color: <?php echo ($vg_calaco_options['main_color']); ?> !important;
		}
		.vg-website-wrapper .widget_vgw_social_media a:hover,
		.vg-website-wrapper .widget-footer.widget_vgw_social_media a:hover{
			background: <?php echo ($vg_calaco_options['main_color']); ?>;
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .woocommerce.widget_price_filter .ui-slider .ui-slider-range,
		.vg-website-wrapper .woocommerce.widget_price_filter .ui-slider .ui-slider-handle {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .widget.topbar-widget ul li:hover:before,
		.vg-website-wrapper .widget.topbar-widget ul li:hover > a {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .widget.topbar-widget ul li:hover > ul > li > a {
			color: #393939;
		}
		.vg-website-wrapper .widget.topbar-widget ul li > ul > li:hover > a {
			color: <?php echo ($vg_calaco_options['main_color']); ?> !important;
		}
		.vg-website-wrapper .widget.header-widget ul li.icon-user a:hover:after, 
		.vg-website-wrapper .widget.header-widget ul li.icon-user a:hover:after, 
		.vg-website-wrapper .widget.header-widget ul li.icon-wishlist a:hover:after, 
		.vg-website-wrapper .widget.header-widget ul li.icon-wishlist a:hover:after {
			color: <?php echo ($vg_calaco_options['main_color']); ?> !important;
		}
		.vg-website-wrapper .vina-product-search form button{
			background-color: <?php echo ($vg_calaco_options['main_color']); ?> !important;
		}
		.vg-website-wrapper .vina-product-search form button:hover{
			background-color: #393939 !important;
		}
		.vg-website-wrapper .vg-bottom-bar a:hover {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .widget.header-widget ul li.icon-user a:hover:after,
		.vg-website-wrapper .widget.header-widget ul li.icon-wishlist a:hover:after {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .mini_cart_inner:hover span {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .mini_cart_inner:hover span.cart-quantity {
			color: #fff !important;
		}
		.vg-website-wrapper .click-search:hover i {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .vg-newsletter-form .widget_wysija_cont .wysija-submit-wrap,
		.vg-website-wrapper .ft-contact-info li i,
		.vg-website-wrapper .bottom-footer a {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .block-static.style3 {
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .product-label span.featured {
			background: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .vgw-item-i .product-title a:hover {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .vgw-item-i .button-group a:hover,
		.vg-website-wrapper .vgw-item-i .button-group .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a,
		.vg-website-wrapper .vgw-item-i .button-group .vgw-compare a.added {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .woo-carousel-2 .vgw-item-i .button-group .vgw-quickview a {
			color: #fff;
			border-color: #393939;
			background-color: #393939;
		}
		.vg-website-wrapper .woo-carousel-2 .vgw-item-i .button-group .vgw-quickview a:hover {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .wpb_row .vc_tta.vc_general .vc_tta-tab.vc_active > a,
		.vg-website-wrapper .wpb_row .vc_tta.vc_general .vc_tta-tab:hover > a {
			border-bottom-color: <?php echo ($vg_calaco_options['main_color']); ?> !important;
		}
		.vg-website-wrapper .tab-products-2 .vc_tta.vc_general .vc_tta-tab.vc_active > a span:before,
		.vg-website-wrapper .tab-products-3 .vc_tta.vc_general .vc_tta-tab.vc_active > a span:before,
		.vg-website-wrapper .tab-products-4 .vc_tta.vc_general .vc_tta-tab.vc_active > a span:before,
		.vg-website-wrapper .tab-products-2 .vc_tta.vc_general .vc_tta-tab:hover > a span:before,
		.vg-website-wrapper .tab-products-3 .vc_tta.vc_general .vc_tta-tab:hover > a span:before,
		.vg-website-wrapper .tab-products-4 .vc_tta.vc_general .vc_tta-tab:hover > a span:before,
		.vg-website-wrapper .tab-products-2 .vc_tta.vc_general .vc_tta-tab.vc_active > a span:after,
		.vg-website-wrapper .tab-products-3 .vc_tta.vc_general .vc_tta-tab.vc_active > a span:after,
		.vg-website-wrapper .tab-products-4 .vc_tta.vc_general .vc_tta-tab.vc_active > a span:after,
		.vg-website-wrapper .tab-products-2 .vc_tta.vc_general .vc_tta-tab:hover > a span:after,
		.vg-website-wrapper .tab-products-3 .vc_tta.vc_general .vc_tta-tab:hover > a span:after,
		.vg-website-wrapper .tab-products-4 .vc_tta.vc_general .vc_tta-tab:hover > a span:after {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .tab-products-3 .vc_tta.vc_general .vc_tta-tabs-list:after {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .vgp-item-i .post-meta .post-author {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .vgp-item-i .post-title a:hover {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .banner-text .btn {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
			border: 1px solid <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .banner-text .btn:hover {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			color: #fff;
		}
		.vg-website-wrapper .banner-text.style1 h2 b {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .banner-text.style1 .btn {
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			background-color: transparent;
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .banner-text.style1 .btn:hover {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			color: #fff;
		}
		.vg-website-wrapper .banner-text.style3 .btn {
			border-color: transparent;
			background-color: #fff;
			color: #393939;
		}
		.vg-website-wrapper .banner-text.style3 .btn:hover {
		background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			color: #fff;
		}
		.vg-website-wrapper .title-category .wpb_heading {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper div.vg-calaco-category-treeview .treeview .hover,
		.vg-website-wrapper div.vg-calaco-category-treeview .treeview .hitarea:hover,
		.vg-website-wrapper div.vg-calaco-category-treeview .treeview li a:hover {
			color: <?php echo ($vg_calaco_options['main_color']); ?> !important;
		}
		.vg-website-wrapper #breadcrumbs {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper #breadcrumbs a:hover {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .all-subcategories li h3:hover{
			color:<?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .toolbar .view-mode a.active,
		.vg-website-wrapper .toolbar .view-mode a:hover {
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .toolbar .view-mode a.active i,
		.vg-website-wrapper .toolbar .view-mode a:hover i {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .toolbar .woocommerce-pagination ul.page-numbers li a.current,
		.vg-website-wrapper .toolbar .woocommerce-pagination ul.page-numbers li span.current,
		.vg-website-wrapper .toolbar .woocommerce-pagination ul.page-numbers li a:hover,
		.vg-website-wrapper .toolbar .woocommerce-pagination ul.page-numbers li span:hover {
		background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .single-product-info .in-stock span {
			color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .single-product-info .in-stock span.title {
			color: #393939;
		}
		.vg-website-wrapper .single-product-info .cart .single_add_to_cart_button.alt:hover,
		.vg-website-wrapper .single-product-info .action-buttons a:hover {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
			border-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		.vg-website-wrapper .woocommerce div.product .woocommerce-tabs ul.tabs li.active:after,
		.vg-website-wrapper .woocommerce div.product .woocommerce-tabs ul.tabs li:hover:after {
			background-color: <?php echo ($vg_calaco_options['main_color']); ?>;
		}
		/* Layout */
		
		<?php endif; ?>
		
		/* Top Bar CSS */
		<?php if(isset($vg_calaco_options['top_bar_switch']) && isset($vg_calaco_options['top_bar_customize'])
		&& $vg_calaco_options['top_bar_switch'] && $vg_calaco_options['top_bar_customize']): ?>
		#vg-header-wrapper .top-bar {
			background-color: <?php echo ($vg_calaco_options['top_bar_background']['background-color']); ?>;
			background-image: url('<?php echo ($vg_calaco_options['top_bar_background']['background-image']); ?>');
			background-repeat: <?php echo ($vg_calaco_options['top_bar_background']['background-repeat']); ?>;
			background-size: <?php echo ($vg_calaco_options['top_bar_background']['background-size']); ?>;
			background-attachment: <?php echo ($vg_calaco_options['top_bar_background']['background-attachment']); ?>;
			background-position: <?php echo ($vg_calaco_options['top_bar_background']['background-position']); ?>;
			font-size: <?php echo ($vg_calaco_options['top_bar_text']['font-size']); ?>;
			line-height: <?php echo($vg_calaco_options['top_bar_text']['line-height']); ?>;
			font-weight: <?php echo($vg_calaco_options['top_bar_text']['font-weight']); ?>;
			font-family: <?php echo($vg_calaco_options['top_bar_text']['font-family']); ?>;
			color:<?php echo ($vg_calaco_options['top_bar_text']['color']); ?>;
		}
		#vg-header-wrapper .top-bar a{
			color:<?php echo ($vg_calaco_options['top_bar_link_color']); ?>;
		}
		#vg-header-wrapper .top-bar a:hover{
			color:<?php echo ($vg_calaco_options['top_bar_link_hover_color']); ?>;
		}
		#vg-header-wrapper .top-bar .widget.topbar-widget ul li:before{
			color:<?php echo ($vg_calaco_options['top_bar_link_color']); ?>;
		}
		#vg-header-wrapper .top-bar .widget_pages ul li a, 
		#vg-header-wrapper .top-bar .widget_nav_menu ul li a{
			color:<?php echo ($vg_calaco_options['top_bar_link_color']); ?>;
		}
		#vg-header-wrapper .top-bar .widget.topbar-widget ul li:hover > a{
			color:<?php echo ($vg_calaco_options['top_bar_link_hover_color']); ?> ;
		}
		#vg-header-wrapper .top-bar .widget.topbar-widget ul li:hover > ul > li > a{
			color:#393939;
		}
		#vg-header-wrapper .top-bar .widget.topbar-widget ul li > ul > li:hover > a{
			color:<?php echo ($vg_calaco_options['top_bar_link_hover_color']); ?> !important;
		}
		#vg-header-wrapper .top-bar .widget.topbar-widget ul li:hover:before{
			color:<?php echo ($vg_calaco_options['top_bar_link_hover_color']); ?>;
		}
		<?php endif; ?>
		
		/* Header Bar CSS */
		#logo-wrapper img{
			max-width:<?php echo ($vg_calaco_options['logo_min_height']); ?>px;
			height:<?php echo ($vg_calaco_options['logo_height']); ?>px;
		}
		
		<?php if(isset($vg_calaco_options['middle_bar_customize']) && $vg_calaco_options['middle_bar_customize']): ?>
		#vg-header-wrapper .header{
			background-color: <?php echo ($vg_calaco_options['middle_bar_background']['background-color']); ?>;
			background-image: url('<?php echo ($vg_calaco_options['middle_bar_background']['background-image']); ?>');
			background-repeat: <?php echo ($vg_calaco_options['middle_bar_background']['background-repeat']); ?>;
			background-size: <?php echo ($vg_calaco_options['middle_bar_background']['background-size']); ?>;
			background-attachment: <?php echo ($vg_calaco_options['middle_bar_background']['background-attachment']); ?>;
			background-position: <?php echo ($vg_calaco_options['middle_bar_background']['background-position']); ?>;
			font-size: <?php echo ($vg_calaco_options['middle_bar_text']['font-size']); ?>;
			line-height: <?php echo($vg_calaco_options['middle_bar_text']['line-height']); ?>;
			font-weight: <?php echo($vg_calaco_options['middle_bar_text']['font-weight']); ?>;
			font-family: <?php echo($vg_calaco_options['middle_bar_text']['font-family']); ?>;
			color:<?php echo ($vg_calaco_options['middle_bar_text']['color']); ?>;
		}
		#vg-header-wrapper .header a{
			color:<?php echo ($vg_calaco_options['middle_bar_link_color']); ?>;
		}
		#vg-header-wrapper .header a:hover{
			color:<?php echo ($vg_calaco_options['middle_bar_link_hover_color']); ?>;
		}
		<?php endif; ?>
		
		/* Menu Bar CSS */
		<?php if(isset($vg_calaco_options['menu_bar_customize']) && $vg_calaco_options['menu_bar_customize']): ?>
		#vg-header-wrapper	.vg-bottom-bar{
			background-color: <?php echo ($vg_calaco_options['menu_bar_background']['background-color']); ?>;
			background-image: url('<?php echo ($vg_calaco_options['menu_bar_background']['background-image']); ?>');
			background-repeat: <?php echo ($vg_calaco_options['menu_bar_background']['background-repeat']); ?>;
			background-size: <?php echo ($vg_calaco_options['menu_bar_background']['background-size']); ?>;
			background-attachment: <?php echo ($vg_calaco_options['menu_bar_background']['background-attachment']); ?>;
			background-position: <?php echo ($vg_calaco_options['menu_bar_background']['background-position']); ?>;
			font-size: <?php echo ($vg_calaco_options['menu_bar_text']['font-size']); ?>;
			line-height: <?php echo($vg_calaco_options['menu_bar_text']['line-height']); ?>;
			font-weight: <?php echo($vg_calaco_options['menu_bar_text']['font-weight']); ?>;
			font-family: <?php echo($vg_calaco_options['menu_bar_text']['font-family']); ?>;
			color:<?php echo ($vg_calaco_options['menu_bar_text']['color']); ?>;
		}
		#vg-header-wrapper	.vg-bottom-bar a{
			color:<?php echo ($vg_calaco_options['menu_bar_text']['color']); ?>;
		}
		#vg-header-wrapper	.vg-bottom-bar a:hover{
			color:<?php echo ($vg_calaco_options['menu_bar_text_hover_color']); ?> !important;
		}
		#vg-header-wrapper.fixed .vg-bottom-bar{
			background: #ffffff !important;
		}
		<?php endif; ?>
		
		<?php if(isset($vg_calaco_options['footer_customize']) && $vg_calaco_options['footer_customize']): ?>
		/* Footer CSS */
		.widget-footer ul li a{
			color:<?php echo ($vg_calaco_options['footer_texts_color']); ?>;
		}
		.widget-footer ul li a:hover{
			color:<?php echo ($vg_calaco_options['footer_links_color_hover']); ?>;
		}
		footer{
			background-color: <?php echo ($vg_calaco_options['footer_background']['background-color']); ?>;
			background-image: url('<?php echo ($vg_calaco_options['footer_background']['background-image']); ?>');
			background-repeat: <?php echo ($vg_calaco_options['footer_background']['background-repeat']); ?>;
			background-size: <?php echo ($vg_calaco_options['footer_background']['background-size']); ?>;
			background-attachment: <?php echo ($vg_calaco_options['footer_background']['background-attachment']); ?>;
			background-position: <?php echo ($vg_calaco_options['footer_background']['background-position']); ?>;
			color:<?php echo ($vg_calaco_options['footer_texts_color']); ?>;
		}
		footer .logo-text{
			color:<?php echo ($vg_calaco_options['footer_texts_color']); ?>;
		}
		<?php endif; ?>
		
		
		<?php if(isset($vg_calaco_options['bottom_footer_customize']) && $vg_calaco_options['bottom_footer_customize']): ?>
		/* Bottom Footer CSS */
		.bottom-footer{
			background-color: <?php echo ($vg_calaco_options['bottom_footer_background']['background-color']); ?>;
			background-image: url('<?php echo ($vg_calaco_options['bottom_footer_background']['background-image']); ?>');
			background-repeat: <?php echo ($vg_calaco_options['bottom_footer_background']['background-repeat']); ?>;
			background-size: <?php echo ($vg_calaco_options['bottom_footer_background']['background-size']); ?>;
			background-attachment: <?php echo ($vg_calaco_options['bottom_footer_background']['background-attachment']); ?>;
			background-position: <?php echo ($vg_calaco_options['bottom_footer_background']['background-position']); ?>;
			color:<?php echo ($vg_calaco_options['bottom_footer_texts_color']); ?>;
		}
		.bottom-footer a, .bottom-footer .widget-footer ul li a{
			color:<?php echo ($vg_calaco_options['bottom_footer_links_color']); ?>;
		}
		.bottom-footer a:hover, .bottom-footer .widget-footer ul li a:hover{
			color:<?php echo ($vg_calaco_options['bottom_footer_links_color_hover']); ?>;
		}
		#menu-footer{
			background-color: <?php echo ($vg_calaco_options['footer_menu_background']['background-color']); ?>;
			background-image: url('<?php echo ($vg_calaco_options['footer_menu_background']['background-image']); ?>');
			background-repeat: <?php echo ($vg_calaco_options['footer_menu_background']['background-repeat']); ?>;
			background-size: <?php echo ($vg_calaco_options['footer_menu_background']['background-size']); ?>;
			background-attachment: <?php echo ($vg_calaco_options['footer_menu_background']['background-attachment']); ?>;
			background-position: <?php echo ($vg_calaco_options['footer_menu_background']['background-position']); ?>;
			color:<?php echo ($vg_calaco_options['bottom_footer_texts_color']); ?>;
		}
		<?php endif; ?>
		
		/********************************************************************/
		/* Custom CSS *******************************************************/
		/********************************************************************/
		<?php if((isset($vg_calaco_options['custom_css'])) &&(trim($vg_calaco_options['custom_css']) != "")): ?>
			<?php echo ($vg_calaco_options['custom_css']) ?>
		<?php endif; ?>
		
		<?php		
		$content = ob_get_clean();
		$content = str_replace(array("\r\n", "\r"), "\n", $content);
		
		$lines 		= explode("\n", $content);
		$new_lines 	= array();
		
		foreach($lines as $i => $line) { 
			if(!empty($line)) $new_lines[] = trim($line); 
		}
		$custom_css = implode($new_lines);
		
		wp_enqueue_style('vg-calaco-style', get_stylesheet_uri(), array(), '1.0', 'all');
		wp_add_inline_style('vg-calaco-style', $custom_css);
	}
}

// Only load when Demo Mode = Disabled
$vg_calaco_options 	= get_option("vg_calaco_options");
if(isset($vg_calaco_options['demo_mode']) && empty($vg_calaco_options['demo_mode'])) {
	add_action('wp_enqueue_scripts', 'vg_calaco_custom_styles', 999);
}
if(! function_exists('vg_calaco_custom_code'))
{
	function vg_calaco_custom_code()
	{
		$vg_calaco_options 	= get_option("vg_calaco_options");
		
		/********************************************************************/
		/* Custom CSS *******************************************************/
		/********************************************************************/
		
		if((isset($vg_calaco_options['custom_css'])) &&(trim($vg_calaco_options['custom_css']) != "")) {
			$custom_css = $vg_calaco_options['custom_css'];
			wp_enqueue_style('vg-calaco-style', get_stylesheet_uri(), array(), '1.0', 'all');
			wp_add_inline_style('vg-calaco-style', $custom_css);
		}
		
		/********************************************************************/
		/* Custom JavaScript Code *******************************************/
		/********************************************************************/
		if((isset($vg_calaco_options['custom_js'])) &&(trim($vg_calaco_options['custom_js']) != "")) {
			$custom_js = $vg_calaco_options['custom_js'];
			wp_add_inline_script('vg-calaco-js', $custom_js, 'before');
		}		
	}
}
add_action('wp_enqueue_scripts', 'vg_calaco_custom_code', 1000);
// End