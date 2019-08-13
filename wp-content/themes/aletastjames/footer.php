<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

</div>
<!-- .site-content End -->

<?php if(is_page(array('home', 'about', 'contact'))){ ?>
<div id="newsletterwidget" class="conted clearfix">
  <div class="container">          
  <h3 class="block-tittle"> STAY CONNECTED WITH ALETA ST. JAMES</h3> </div>
  <div class="forms">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
 

          <div class="input-group">
            <input type="email" class="form-control" placeholder="Enter your email">
            <span class="input-group-btn">
            <button class="btn btn-theme" type="submit">Subscribe</button>
            </span> </div>
 
      </div>
    </div>
    </div>
  </div>
</div>

 <div class="instagram clearfix">

    <?php the_field('instagram_section');?>
     
</div>

<?php } else { ?>


<div id="newsletterwidget" class="conted clearfix">
  <div class="container">          
  <h3 class="block-tittle"> STAY CONNECTED WITH ALETA ST. JAMES</h3> </div>
  <div class="forms">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
 

          <div class="input-group">
            <input type="email" class="form-control" placeholder="Enter your email">
            <span class="input-group-btn">
            <button class="btn btn-theme" type="submit">Subscribe</button>
            </span> </div>
 
      </div>
    </div>
    </div>
  </div>
</div>

<?php } ?>



		<footer class="footer clearfix">
		<div class="container">
		    <div class="row">
		    	<div class="col-sm-6">
					<div class="site-branding">
					 	<?php twentysixteen_the_custom_logo(); ?>					
					</div>
					<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentysixteen' ); ?>">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'social',
						'menu_class'     => 'social-links-menu',
						'depth'          => 1,
						'link_before'    => '<span class="">',
						'link_after'     => '</span>',
					) );
					?>
					</nav><!-- .social-navigation -->
					<?php endif; ?>
		    	</div>
		    	<div class="col-sm-6">
					
					<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Primary Menu', 'twentysixteen' ); ?>">
					<?php
					wp_nav_menu( array(
						'menu'   => 'footer',
						'theme_location' => 'footer',
						'menu_class'     => 'footer-menu',
					 ) );
					?>
					</nav><!-- .main-navigation -->
					
		    	</div>
		    </div>
		    </div>
		</footer>
</div>
<?php wp_footer(); ?>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous"> 
 
</body>
</html>