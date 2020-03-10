<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package VG Calaco
 */
$vg_calaco_options = get_option("vg_calaco_options");
?>
		<?php if(is_active_sidebar('topfooter-1')) : ?>
		<div class="vg-brand-logo">
			<div class="container">
				<div class="brand-inner">
					<?php dynamic_sidebar('topfooter-1'); ?>
				</div>
			</div>
		</div><!-- End Top Footer 01 Widget -->
		<?php endif;?>		
		<footer id="vg-footer-wrapper">
			<?php 
				$colfooter2 = (is_active_sidebar('footer-1')) ? '9' : '12';
				$footer2 = (is_active_sidebar('footer-2')) ? 1 : 0;
				$footer3 = (is_active_sidebar('footer-3')) ? 1 : 0;
				$footer4 = (is_active_sidebar('footer-4')) ? 1 : 0;
				
				$sumfooter = $footer2 + $footer3 + $footer4;
				$colfmenu = '12';
				switch($sumfooter) {
					case "3":
						$colfmenu = "4";
						break;
					case "2":
						$colfmenu = "6";
						break;
					default:
						$colfmenu = "12";
						break;
				} 
			?>
			<?php if(is_active_sidebar('footer-1') || $sumfooter != 0) : ?>		
			<div class="footer">	
				<div class="container">	
					<div class="row">
						
						<?php if(is_active_sidebar('footer-1')) : ?>
						<div class="col-lg-3 col-md-3 col-xs-12 col-footer">
							<div class="ft-about-me">
								<div class="logo-footer">
									
								</div>
								
								<?php dynamic_sidebar('footer-1'); ?>
							</div>
						</div><!-- End Footer 01 Widget -->
						<?php endif;?>
						
						<?php if($sumfooter != 0) : ?>
						<div class="col-lg-<?php echo esc_attr($colfooter2); ?> col-md-<?php echo esc_attr($colfooter2); ?> col-xs-12 col-footer">
							<div class="row">
								<?php if(is_active_sidebar('footer-2')) : ?>
								<div class="col-sm-<?php echo esc_attr($colfmenu); ?> col-xs-12 col-fmenu">
									<?php dynamic_sidebar('footer-2'); ?>
								</div><!-- End Footer 02 Widget -->
								<?php endif;?>
								
								<?php if(is_active_sidebar('footer-3')) : ?>
								<div class="col-sm-<?php echo esc_attr($colfmenu); ?> col-xs-12 col-fmenu style1">
									<?php dynamic_sidebar('footer-3'); ?>
								</div><!-- End Footer 03 Widget -->
								<?php endif;?>
								
								<?php if(is_active_sidebar('footer-4')) : ?>
								<div class="col-sm-<?php echo esc_attr($colfmenu); ?> col-xs-12 col-fmenu vg-newsletter-form">
									<?php dynamic_sidebar('footer-4'); ?>
								</div><!-- End Footer 04 Widget -->
								<?php endif;?>
							</div>
						</div>
						<?php endif;?>
					</div>
				</div>
			</div><!-- .footer -->
			<?php endif; ?>
		
				<?php 
					$menufooter1 = (is_active_sidebar('footer-5')) ? 1 : 0;
					$menufooter2 = (is_active_sidebar('footer-6')) ? 1 : 0;
					$menufooter3 = (is_active_sidebar('footer-7')) ? 1 : 0;
					$menufooter4 = (is_active_sidebar('footer-8')) ? 1 : 0;
					$menufooter5 = (is_active_sidebar('footer-9')) ? 1 : 0;
					$menufooter6 = (is_active_sidebar('footer-10')) ? 1 : 0;
					
					$summenufooter = $menufooter1 + $menufooter2 + $menufooter3 + $menufooter4 + $menufooter5 + $menufooter6;
					$colfmenufooter = '6';
					switch($summenufooter) {
						case "6":
							$colfmenufooter = "2";
							break;
						case "5":
							$colfmenufooter = "2";
							break;
						case "4":
							$colfmenufooter = "3";
							break;
						case "3":
							$colfmenufooter = "4";
							break;
						case "2":
							$colfmenufooter = "6";
							break;
						default:
							$colfmenufooter = "12";
							break;
					} 
				?>
			<?php if($summenufooter != 0) : ?>		
			<div id="menu-footer">
				<div class="container">
					<div class="row">
						<?php if(is_active_sidebar('footer-5')) : ?>
						<div class="colmenuft menuft1 col-xs-12 col-lg-<?php echo esc_attr($colfmenufooter); ?> col-md-<?php echo esc_attr($colfmenufooter); ?> col-sm-4 ">
							<?php
								dynamic_sidebar('footer-5');
							?>
						</div>
						<?php endif; ?>
						<?php if(is_active_sidebar('footer-6')) : ?>
						<div class="colmenuft menuft2 col-xs-12 col-lg-<?php echo esc_attr($colfmenufooter); ?> col-md-<?php echo esc_attr($colfmenufooter); ?> col-sm-4 ">
							<?php
								dynamic_sidebar('footer-6');
							?>
						</div>
						<?php endif; ?>
						<?php if(is_active_sidebar('footer-7')) : ?>
						<div class="colmenuft menuft3 col-xs-12 col-lg-<?php echo esc_attr($colfmenufooter); ?> col-md-<?php echo esc_attr($colfmenufooter); ?> col-sm-4 ">
							<?php
								dynamic_sidebar('footer-7');
							?>
						</div>
						<?php endif; ?>
						<?php if(is_active_sidebar('footer-8')) : ?>
						<div class="colmenuft menuft4 col-xs-12 col-lg-<?php echo esc_attr($colfmenufooter); ?> col-md-<?php echo esc_attr($colfmenufooter); ?> col-sm-4 ">
							<?php
								dynamic_sidebar('footer-8');
							?>
						</div>
						<?php endif; ?>
						<?php if(is_active_sidebar('footer-9')) : ?>
						<div class="colmenuft menuft5 col-xs-12 col-lg-<?php echo esc_attr($colfmenufooter); ?> col-md-<?php echo esc_attr($colfmenufooter); ?> col-sm-4 ">
							<?php
								dynamic_sidebar('footer-9');
							?>
						</div>
						<?php endif; ?>
						<?php if(is_active_sidebar('footer-10')) : ?>
						<div class="colmenuft menuft6 col-xs-12 col-lg-<?php echo esc_attr($colfmenufooter); ?> col-md-<?php echo esc_attr($colfmenufooter); ?> col-sm-4 ">
							<?php
								dynamic_sidebar('footer-10');
							?>
						</div>
						<?php endif; ?>
					</div> 
				</div>
			
			</div><!--.menu-footer-->
			<?php endif;?>
			
			<?php 
				$bottomft1 = (is_active_sidebar('footer-copyright')) ? 1 : 0;
				$bottomft2 = (is_active_sidebar('footer-payment')) ? 1 : 0;

				$sumbottomft = $bottomft1 + $bottomft2;

				$colbottomft = "12";

				switch($sumbottomft) {
					case "2":
						$colbottomft = "6";
						break;
					default:
						$colbottomft = "12 text-center";
						break;
				} 
			?>		
			<?php if($sumbottomft != 0) : ?>
			<div class="bottom-footer">
				<div class="container">
					<div class="row">
						
						<?php if(is_active_sidebar('footer-copyright')) : ?>
						<div class="colbottomft col-xs-12 col-lg-<?php echo esc_attr($colbottomft); ?> col-md-<?php echo esc_attr($colbottomft); ?> copyright">
							<?php
								dynamic_sidebar('footer-copyright');
							?>
						</div>
						<?php endif; ?>
						
						<?php if(is_active_sidebar('footer-payment')) : ?>
						<div class="colbottomft col-xs-12 col-lg-<?php echo esc_attr($colbottomft); ?> col-md-<?php echo esc_attr($colbottomft); ?> col-payment">
							<div class="vg-payment">
								<?php
									dynamic_sidebar('footer-payment');
								?>
							</div>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div><!-- .bottom-footer -->
			<?php endif; ?>
		</footer><!-- #vg-footer-wrapper -->
	</div><!-- .vg-pusher -->
	
	
	<!-- Off canvas from right -->
	<div class="vg-menu slide-from-right">
		<div class="nano">
			<div class="content">
				<div class="offcanvas_content_right">
					<div id="mobiles-menu-offcanvas">
						<nav class="mobile-navigation primary-navigation visible-xs visible-sm">
						<?php 
							wp_nav_menu(array(
								'theme_location'  => 'primary',
								'fallback_cb'     => false,
								'container'       => false,
								'items_wrap'      => '<ul id="%1$s">%3$s</ul>',
							));
						?>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
	
    <!-- Product Quick View -->
    <div id="quick_view_container">
		<div id="placeholder_product_quick_view" class="woocommerce">
			<div class="loading"><?php echo esc_html_e('Loading...', 'vg-calaco'); ?></div>
		</div>
	</div>
	
</div><!-- .vg-website-wrapper -->
<div class="to-top"><i class="zmdi zmdi-long-arrow-up"></i></div>
<?php wp_footer(); ?>

</body>
</html>
