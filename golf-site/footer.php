<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Templatemela
 * @since Templatemela 1.0
 */
?>
		<?php templatemela_content_after(); ?>
			</div>
		</div><!-- #main -->
	<?php if ( 'page' == get_option('show_on_front') && is_front_page() ) :?>
	</div>
	<?php endif; ?>
		
		<?php tm_go_top(); ?>
		<?php templatemela_footer_before(); ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="footer-main">
				<?php templatemela_footer_inside(); ?>
				<?php if ( is_active_sidebar('footer-banner-widget') ) : ?>
				<div class="footer-banners">
					<?php templatemela_get_widget('footer-banner-widget'); ?>
				</div>
				<?php endif; ?>
				<?php get_sidebar('footer'); ?>
			<div class="footer-bottom-border"><!--Start footer-bottom-border --> 
				<div class="footer-menu-links">				
					<?php
					$tm_footer_menu=array(
					'menu' => 'TM Footer Navigation',
					'depth'=> 1,
					'echo' => false,
					'menu_class'      => 'footer-menu', 
					'container'       => '', 
					'container_class' => '', 
					'theme_location' => 'footer-menu'
					);
					echo wp_nav_menu($tm_footer_menu);				    
					?>					
				</div><!-- #footer-menu-links --> 
				
				<div class="footer-banner"> <!--- Added by Ankur for Footer banner -->
					<span>
					<?php echo '<img alt="'.get_option('tmoption_logo_image_alt').'" src=" '.get_stylesheet_directory_uri(). '/images/footerGraphic.jpg">'; ?> </span>
				</div>
				
				<div class="site-info">
					Copyright &copy; <?php the_time('Y'); ?> <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
					<?php //bloginfo( 'name' ); ?></a><?php echo get_option('tmoption_footer_slog');?>						
					<?php do_action( 'templatemela_credits' ); ?>
					
				</div><!-- .site-info -->
				
				</div><!-- End footer-bottom-border--> 
			</div>
		</footer><!-- #colophon -->
		<?php templatemela_footer_after(); ?>	
	</div><!-- #page -->

<?php 
if(trim(get_option('tmoption_google_analytics_id'))!=''):
?>

<?php endif; ?>
<?php templatemela_get_widget('before-end-body-widget'); ?>
<?php wp_footer(); ?>

</body>
</html>