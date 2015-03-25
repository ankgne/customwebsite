<?php
/* Template Name: Home Page Golf*/ 
?>
<?php get_header(); ?>

<div class="homepage full-width" >
  <div id="primary" class="content-area">
    <div id="content" class="site-content" role="main">
	
	  
      <?php if ( is_active_sidebar( 'homepage-cmsblock-area' ) ) : ?>
      <div class="cmsblock_content">
        <?php templatemela_get_widget('homepage-cmsblock-area');?>
      </div>
      <?php endif; ?>
      <?php if ( is_active_sidebar('homepage-blog') ) : ?>
      <div class="homepage_blog">
        <?php templatemela_get_widget('homepage-blog');?>
      </div>
      <?php endif; ?>
      <?php if ( is_active_sidebar('home-products-widget') ) : ?>
      <div id="featured" class="home-products block products_block">
        <div class="customNavigation"> <a class="btn prev">&nbsp;</a> <a class="btn next">&nbsp;</a> </div>        
          <?php templatemela_get_widget('home-products-widget'); ?>         
        <span class="featured_default_width" style="display:none; visibility:hidden"></span> </div>
      <?php endif; ?>
      <?php if ( is_active_sidebar('logo-partner-widget') ) : ?>
      <div id="brand" class="home-logo-slider block products_block">
        <div class="customNavigation"> <a class="btn prev"> </a> <a class="btn next"> </a> </div>
        <div class="brand-logo products">
          <ul class="products">
            <?php templatemela_get_widget('logo-partner-widget');?>
          </ul>
        </div>
        <span class="brand_default_width" style="display:none; visibility:hidden"></span> </div>
      <?php endif; ?>
    </div>
    <!-- #content -->
  </div>
  <!-- #primary -->
</div>
<?php get_footer(); ?>
