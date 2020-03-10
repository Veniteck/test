/**
 * The Javascript for our theme.
 *
 * @package VG Calaco
 */
 (function($) {
	"use strict"; 
		jQuery(document).ready(function($) {
		// Off Canvas Navigation ---------------------------------------
		var offcanvas_open = false;
		var offcanvas_from_left = false;
		var offcanvas_from_right = false;
		var window_width = $(window).innerWidth();
		
		// Submenu adjustments ---------------------------------------
		function submenu_adjustments() {
			$(".main-navigation > ul > .menu-item").mouseenter(function() {
				if($(this).children(".sub-menu").length > 0) {
					var submenu = $(this).children(".sub-menu");
					var window_width = parseInt($(window).outerWidth());
					var submenu_width = parseInt(submenu.outerWidth());
					var submenu_offset_left = parseInt(submenu.offset().left);
					var submenu_adjust = window_width - submenu_width - submenu_offset_left;
					var dir = $('html').attr("dir");
					
					if(dir == "rtl"){
						if(submenu_adjust < 0) {
							submenu.css("right", submenu_adjust-30 + "px");
							submenu.addClass("active");
						}
					}else{
						if(submenu_adjust < 0) {
							submenu.css("left", submenu_adjust-30 + "px");
						}
					}
				}
			});
		}
		
		submenu_adjustments();
		
		function offcanvas_left() {
			$(".vg-website-wrapper").removeClass("slide-from-right");
			$(".vg-website-wrapper").addClass("slide-from-left");
			$(".vg-website-wrapper").addClass("vg-menu-open");
			
			offcanvas_open = true;
			offcanvas_from_left = true;
			
			$(".vg-menu").addClass("open");
			$("body").addClass("offcanvas_open offcanvas_from_left");
			
			$(".nano").nanoScroller();
		}
		
		function offcanvas_right() {
			$(".vg-website-wrapper").removeClass("slide-from-left");
			$(".vg-website-wrapper").addClass("slide-from-right");
			$(".vg-website-wrapper").addClass("vg-menu-open");		
			
			offcanvas_open = true;
			offcanvas_from_right = true;
			
			$(".vg-menu").addClass("open");
			$("body").addClass("offcanvas_open offcanvas_from_right");

			$(".nano").nanoScroller();
		}
		
		function offcanvas_close() {
			if(offcanvas_open === true) {	
				$(".vg-website-wrapper").removeClass("slide-from-left");
				$(".vg-website-wrapper").removeClass("slide-from-right");
				$(".vg-website-wrapper").removeClass("vg-menu-open");
				
				offcanvas_open = false;
				offcanvas_from_left = false;
				offcanvas_from_right = false;
							
				$(".vg-menu").removeClass("open");
				$("body").removeClass("offcanvas_open offcanvas_from_left offcanvas_from_right");
			}
		}
		
		$(".offcanvas-menu-button, .open-offcanvas").click(function() {
			offcanvas_right();
		});
		
		$("#button_offcanvas_sidebar_left").click(function() {
			offcanvas_left();
		});
		
		$(".vg-website-wrapper").on("click", ".vg-pusher-after", function(e) {
			offcanvas_close();
		});
		
		$(".vg-pusher-after").swipe({
			swipeLeft:function(event, direction, distance, duration, fingerCount) {
				offcanvas_close();
			},
			swipeRight:function(event, direction, distance, duration, fingerCount) {
				offcanvas_close();
			},
			tap:function(event, direction, distance, duration, fingerCount) {
				offcanvas_close();
			},
			threshold:0
		});
		
		// Mobile menu ---------------------------------------
		$(".mobile-navigation .menu-item-has-children").append('<div class="more"><i class="fa fa-plus-circle"></i></div>');
		
		$(".mobile-navigation").on("click", ".more", function(e) {
			e.stopPropagation();
			
			$(this).parent().toggleClass("current")
							.children(".sub-menu").toggleClass("open");
							
			$(this).html($(this).html() == '<i class="fa fa-plus-circle"></i>' ? '<i class="fa fa-minus-circle"></i>' : '<i class="fa fa-plus-circle"></i>');
			$(".nano").nanoScroller();
		});
		
		$(".mobile-navigation").on("click", "a", function(e) {
			if(($(this).attr('href') === "#") ||($(this).attr('href') === "")) {
				$(this).parent().children(".more").trigger("click");
			} else {
				offcanvas_close();
			}
		});
		
		// Toogle Search Box ---------------------------------------
		var product_search  = $(".vina-product-search");
		
		$(".click-search").on("click", function(e) {
			e.stopPropagation();
			
			if(product_search.hasClass("active")){
				product_search.removeClass("active");
				$(this).removeClass("active");
			}
			else{
				product_search.addClass("active");
				$(this).addClass("active");
			}
			e.preventDefault();
		});
		
		$(product_search).on("click", function(e){
			e.stopPropagation();
		});
		
		$(document).on("click", function(e) {
			e.stopPropagation();
			
			if(product_search.hasClass('active')){
				product_search.removeClass('active');
				$(".click-search").removeClass("active");
			}
				
		});
		
		
		$(".widget_wysija_cont .wysija-submit").wrap('<span class="wysija-submit-wrap"></span>');
		
		
		// Quickview JS ---------------------------------------
		function product_quick_view_ajax(id) 
		{
			$.ajax({
				url: vg_calaco_ajaxurl,
				data: {
					"action" 	 : "vg_calaco_product_quick_view",
					"product_id" : id
				},
				success: function(results) {
					
					$("#placeholder_product_quick_view").html(results);

					var curent_dragging_item;
			
					$("#placeholder_product_quick_view .featured_img_temp").hide();
					
					$("#placeholder_product_quick_view .thumbnails").owlCarousel({
						singleItem : false,
						autoHeight : true,
						transitionStyle:"fade",
						lazyLoad : true,
						slideSpeed : 300,
						dragBeforeAnimFinish: false,
						navigation: true,
					});

					$("#quick_view_container").show();
					
					var form_variation = $("#placeholder_product_quick_view").find('.variations_form');
					var form_variation_select = $("#placeholder_product_quick_view").find('.variations_form .variations select');
					
					form_variation.wc_variation_form();
					form_variation_select.change();
				},
				error: function(errorThrown) { console.log(errorThrown); }
			});
		}
		
		$(document).on('click', '.vg_calaco_product_quick_view_button', function(e) {
			e.preventDefault();
			var product_id = $(this).data('product_id');
			product_quick_view_ajax(product_id);
		});
		
		$(window).mouseup(function(e) {	    
			var container = $("#placeholder_product_quick_view");
			if(! container.is(e.target) && container.has(e.target).length === 0) {	    
				$('#quick_view_container').hide();
			}
		});

		$(document).on("click", "#close_quickview", function(){
			$('#quick_view_container').hide();
		});

		$("#quick_view_container").on('click', '.zoom', function(e){
			e.preventDefault();
		});
		
		/* For add to card button */
		$('body').append('<div class="atc-notice-wrapper"><div class="atc-notice"></div><div class="close"><i class="fa fa-times-circle"></i></div></div>');
		
		$('.atc-notice-wrapper .close').on("click", function(){
			$('.atc-notice-wrapper').fadeOut();
			$('.atc-notice').html('');
		});
		
		$('body').on('adding_to_cart', function(event, button, data) {
			var ajaxPId = button.attr('data-product_id');
			//get product info by ajax
			$.post(
				vg_calaco_ajaxurl, 
				{
					'action': 'vg_calaco_get_productinfo',
					'product_id':  ajaxPId
				},
				function(response){
					$('.atc-notice').html(response);
					$(".lazy").lazy();
				}
			);
		});
		
		$('body').on('added_to_cart', function(event, fragments, cart_hash) {			
			$('.atc-notice-wrapper').fadeIn();
		});
		
		// Countdown
		$('.timer-grid').each(function(){
			var countTime = $(this).attr('data-time');
			$(this).countdown(countTime, function(event) {
				$(this).html(
					'<div class="day"><span class="number">'+event.strftime('%D')+' </span><i>days</i></div> <div class="hour"><span class="number">'+event.strftime('%H')+'</span><i>Hrs</i></div><div class="min"><span class="number">'+event.strftime('%M')+'</span> <i>Mins</i></div> <div class="sec"><span class="number">'+event.strftime('%S')+' </span><i>Secs</i></div>'
				);
			});
		});
		
		$('.timer-grid-2').each(function(){
			var countTime = $(this).attr('data-time');
			$(this).countdown(countTime, function(event) {
				$(this).html(
					'<div class="day"><i>days</i><span class="number">'+event.strftime('%D')+' </span></div> <div class="hour"><i>Hours</i><span class="number">'+event.strftime('%H')+'</span></div><div class="min"><i>Mins</i><span class="number">'+event.strftime('%M')+'</span> </div> <div class="sec"><i>Secconds</i><span class="number">'+event.strftime('%S')+' </span></div>'
				);
			});
		});
		
		//Testimonials carousel
			jQuery('.testimonials .wpb_wrapper > h3').each(function(){
				var pwidgetTitle = jQuery(this).html();
				jQuery(this).html('<span>'+pwidgetTitle+'</span>');
			});
			
			$(".testimonials-list").owlCarousel({
				items: 				1,
				itemsDesktop: 		[1170,1],
				itemsDesktopSmall: 	[980,1],
				itemsTablet: 		[800,1],
				itemsTabletSmall: 	[650,1],
				itemsMobile: 		[450,1],				
				slideSpeed: 		200,
				paginationSpeed: 	800,
				rewindSpeed: 		1000,				
				autoPlay: 			false,
				stopOnHover: 		false,				
				navigation: 		false,
				scrollPerPage: 		false,
				pagination: 		true,
				paginationNumbers: 	false,
				mouseDrag: 			false,
				touchDrag: 			false,
				navigationText: 	["Prev", "Next"],
				leftOffSet: 		0,
			});
		
		//Max Menu Category
		var menuWrapper = $('.vgw-category');
		
		$('.title-category h2').on("click", function(){
			if(menuWrapper.hasClass('open')) {
				menuWrapper.removeClass('open');
				menuWrapper.animate({'height': 440}, 'fast');
			} else {
				menuWrapper.addClass('open');
			}
		});
		// Menu Category Home3 VG Calaco
		$(".cateproductmenu .header-widget-title").on("click", function() {
			$(this).parents('.cateproductmenu').find(" .menu-menu-category-container,.mobile-mega-menu").slideToggle("fast");
			$(this).parents('.cateproductmenu').toggleClass("open");
		});
		//Woocommerce
		
		/* Category Product View Module */
		$('.view-mode').each(function(){
			/* Grid View */
			$(this).find('.grid').on("click", function(event){
				event.preventDefault();
				
				$('#content .view-mode').find('.grid').addClass('active');
				$('#content .view-mode').find('.list').removeClass('active');
				
				$('#content .shop-products').removeClass('list-view');
				$('#content .shop-products').addClass('grid-view');
				
				$('#content .list-col4').removeClass('col-xs-12 col-sm-6 col-lg-4');
				$('#content .list-col8').removeClass('col-xs-12 col-sm-6 col-lg-8');
			});
			
			/* List View */
			$(this).find('.list').on("click", function(event){
				event.preventDefault();
			
				$('#content .view-mode').find('.list').addClass('active');
				$('#content .view-mode').find('.grid').removeClass('active');
				
				$('#content .shop-products').addClass('list-view');
				$('#content .shop-products').removeClass('grid-view');
				
				$('#content .list-col4').addClass('col-xs-12 col-sm-6 col-lg-4');
				$('#content .list-col8').addClass('col-xs-12 col-sm-6 col-lg-8');
			});
		});
		
		// Search toggle.
		$( '.search-toggle' ).on( 'click.break', function( event ) {
			$( '.search-overlay' ).toggleClass( 'hidden' );
			$( '.search-inside' ).addClass( 'active' );
			$(this).parents(".search-wrap").addClass( 'active' );
			$( '.left-scroll' ).addClass( 'hidden' );
		} );
		$( '.search-popup-bg' ).on( 'click.break', function( event ) {
			$( '.search-overlay' ).addClass( 'hidden' );
			$( '.search-inside' ).removeClass( 'active' );
			$(this).parents(".search-wrap").removeClass( 'active' );
			$( '.left-scroll' ).removeClass( 'hidden' );
		} );
		
		// Scroll Sticky Menu
		var currentP = 0;
		var stickyOffset = 0;
		if(sticky_menu==true && $('#vg-header-wrapper').length > 0){
			stickyOffset = $('#vg-header-wrapper').outerHeight(true);
			
			$(window).scroll(function(){
				var scrollP = $(window).scrollTop();
				if($(window).width() >= 1024){
					if(scrollP != currentP){
						//Sticky header
						if(sticky_menu==true){
							
							if(scrollP >= (stickyOffset  - $('.vg-bottom-bar').outerHeight(true))){
								$('#vg-header-wrapper').addClass('fixed');
								$('#vg-header-wrapper').css("top", $('#wpadminbar').outerHeight());
								$('#vg-header-wrapper').parent().css('margin-top', stickyOffset + 23);
							} else {
								$('#vg-header-wrapper').removeClass('fixed');
								$('#vg-header-wrapper').removeAttr("style");
								$('#vg-header-wrapper').parent().css('margin-top', 0);
							}
						}
						currentP = $(window).scrollTop();
					}
				}
			});
			$(window).resize(function(event) {
				if($(window).width() < 1024){
					$('#vg-header-wrapper').removeClass('fixed');
				}
			});
		}
		// Add none loading when click to cart
		$('a.ajax_add_to_cart').addClass('no-preloader');
		$('a.compare').addClass('no-preloader');
		$('a.add_to_wishlist').addClass('no-preloader');
		$('.single-product-image .images a').addClass('no-preloader');
		
		// Add loading when click to any link
		$('body a').click(function() {
			var link   = $(this).attr('href');
			var loader = $(this).hasClass('no-preloader');
			if(!loader && typeof link !== "undefined" && link.toLowerCase().indexOf("/") >= 0) {
				jQuery('#pageloader').show();
			}
		});
		//Counter About Us
		$('.statistic').appear(function() {
			$('.timer').countTo({
				speed: 4000,
				refreshInterval: 60,
				formatter: function(value, options) {
					return value.toFixed(options.decimals);
				}
			});
		});
		// Quantity buttons
		$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added');
		
		$(document).on('click', '.plus, .minus', function() {
			// Get values
			var $qty		= $(this).closest('.quantity').find('.qty'),
				currentVal	= parseFloat($qty.val()),
				max			= '',
				min			= 1,
				step		= 1;

			// Format values
			if(! currentVal || currentVal === '' || currentVal === 'NaN') currentVal = 0;
			if(max === '' || max === 'NaN') max = '';
			if(min === '' || min === 'NaN') min = 0;
			if(step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') step = 1;

			// Change the value
			if($(this).is('.plus')) {
				if(max &&(max == currentVal || currentVal > max)) {
					$qty.val(max);
				} else {
					$qty.val(currentVal + parseFloat(step));
				}
			} else {
				if(min &&(min == currentVal || currentVal < min)) {
					$qty.val(min);
				} else if(currentVal > 0) {
					$qty.val(currentVal - parseFloat(step));
				}
			}

			// Trigger change event
			$qty.trigger('change');
		});
		
		//Fix Mini Cart Safari
		$('.mini_cart_inner').on("hover", function(){
			$(".lazy").lazy();
			var minicart = $('.mcart-border');
			if(minicart.hasClass('active')){
				minicart.removeClass('active');
				minicart.css('visibility', 'hidden');
			}else{
				minicart.addClass('active');
				minicart.css('visibility', 'visible');
			}
		});
		
		/*To Top*/
		$(".to-top").hide();
		/* fade in #back-top */
		$(function() {
			$(window).scroll(function() {
				if($(this).scrollTop() > 100) {
					$('.to-top').fadeIn();
				} else {
					$('.to-top').fadeOut();
				}
			});
			// scroll body to 0px on click
			$('.to-top').on("click", function() {
				$('body,html').animate({
					scrollTop: 0
				}, 800);
				return false;
			});
		});
		//Category Products
		$.fn.extend({  
			 accordion: function() {       
				return this.each(function() {
					
					var $jqul = $(this);
					
					if($jqul.data('accordiated'))
						return false;
														
					$.each($jqul.find('ul, li>div'), function(){
						$(this).data('accordiated', true);
						$(this).hide();
					});
					
					$.each($jqul.find('span.head'), function(){
						$(this).on('click',function(e){
							activate(this);
							return void(0);
						});
					});
					
					var active = (location.hash)?$(this).find('a[href=' + location.hash + ']')[0]:'';

					if(active){
						activate(active, 'toggle');
						$(active).parents().show();
					}
					
					function activate(el,effect){
						$(el).parent('li').toggleClass('active').siblings().removeClass('active').children('ul, div').slideUp('fast');
						$(el).siblings('ul, div')[(effect || 'slideToggle')]((!effect)?'fast':null);
					}
					
				});
			} 
		}); 
		
		$('.product-categories li a').wrapInner( "<span class='cat-title'></span>");
		$("ul.product-categories li.cat-parent").each(function(){
			$(this).append('<span class="head"><a href="javascript:void(0)"></a></span>');
		});
		
		$('ul.product-categories').accordion();
		
		$("ul.product-categories li.active").each(function(){
			$(this).children().next("ul").css('display', 'block');
		});
		// Remove loading when click on loading 
		$('#pageloader').click(function() {
			$('#pageloader').fadeOut('slow');
		});
		// HieuJa add Lazy Load
		$(".lazy").lazy();
	});
})(jQuery);	

jQuery(window).load(function($) {
	jQuery(".lazy").lazy();
	jQuery('#pageloader').fadeOut('slow');
});

/* Remove item from mini cart by ajax */
function vinageckoMiniCartRemove(url, itemid) {
	jQuery('.mcart-border').addClass('loading');
	jQuery('.cart-form').addClass('loading');
	jQuery.get(url, function(data,status){
		if(status=='success'){
			//update mini cart info
			jQuery.post(
				ajaxurl,
				{
					'action': 'petshop_get_cartinfo'
				}, 
				function(response){
					var cartinfo = response.split("|");
					if( cartinfo[0] > 9){
						var itemAmount = '9+';
					}
					else {
						var itemAmount = cartinfo[0];
					}
					var cartTotal = cartinfo[1];
					var orderTotal = cartinfo[2];
					var cartQuantity = cartinfo[3];
					
					jQuery('.mcart-number').html(cartQuantity);
					jQuery('.cart-quantity').html(itemAmount);
					jQuery('.item-cart .amount').html(cartTotal);
					jQuery('.total .amount').html(cartTotal);
					
					jQuery('.cart-subtotal .amount').html(cartTotal);
					jQuery('.order-total .amount').html(orderTotal);
				}
			);
			//remove item line from mini cart & cart page
			jQuery('#mcitem-' + itemid).animate({'height': '0', 'margin-bottom': '0', 'padding-bottom': '0', 'padding-top': '0'});
			setTimeout(function(){
				jQuery('#mcitem-' + itemid).remove();
				jQuery('#lcitem-' + itemid).remove();
			}, 1000);
			
			jQuery('.mcart-border').removeClass('loading');
			jQuery('.cart-form').removeClass('loading');
		}
	});
}