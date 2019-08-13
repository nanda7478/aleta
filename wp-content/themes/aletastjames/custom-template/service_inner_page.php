<?php
/*
  Display Template Name: Service Inner page
*/
  get_header()
?>


<?php while ( have_posts() ) : the_post(); ?>
  <?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
 <div class="container inner-pages-content-table">
 <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
 <h1 class="entry-title">
<?php the_title(); ?>
 </h1>
 <p>
<?php the_content();?>
</p>   
</div>
</div>
</div>
<?php endwhile;?>




<div class="container3">
<div class="row">
<div class="col-sm-12 text-center small-text mt-50">
<?php the_field('service_content');?>

</div>
</div>
</div>


	<?php if (is_page('private-sessions')) : ?>

		<div class="tittle-2 clr">	<div class="container"> <h1><?php the_field('private_sessions_title') ?></h1> </div> </div>
            
            <div class="private-sessions">
            <div class="container">
            		<div class="row">
			<div class="col-sm-6">
				<?php $image = get_field( 'private_sessions_image' ); ?>
				<img src="<?php echo $image['url']; ?>">
			</div>
			<div class="col-sm-6">
			<div class="bgs">
            	<?php the_field('private_sessions_content') ?>
                </div>
                <div class="btnss text-center">
				<a class="btn" href="<?php the_field('schedule_button_url') ?>"><?php the_field('schedule_button_title') ?></a>
                </div>
			</div>
		</div>
        </div>
        </div>
        
        
	<?php endif; ?>

<div class="container">

	<?php if (is_page('additional-spa-services')) : ?>
		<div class="row spa-service-in">
			<div class="col-sm-5">
		<div class="img">		<?php $image1 = get_field( 'meta_image_1' ); ?>
				<img src="<?php echo $image1['url']; ?>">
                  </div>
			</div>
			<div class="col-sm-7">
				<h2><?php the_field('meta_title_1') ?></h2>
				<?php the_field('meta_text_1') ?>
			</div>
		</div>
		<div class="row spa-service-in">
			<div class="col-sm-7">
				<h2><?php the_field('meta_title_2') ?></h2>
				<?php the_field('meta_text_2') ?>
			</div>
						<div class="col-sm-5">
		<div class="img">
				<?php $image2 = get_field( 'meta_image_2' ); ?>
				<img src="<?php echo $image2['url']; ?>">
			</div>
            </div>
		</div>
	<?php endif; ?>

<div class="Crystal-service">
	<?php if (is_page('crystal-healing-bed')) : ?>
		<div class="row">
			<div class="col-sm-6 img">
				<?php $image3 = get_field( 'crystal_image' ); ?>
				<img src="<?php echo $image3['url']; ?>">
			</div>
			<div class="col-sm-6">
			<div class="text">	<?php the_field( 'crystal_image_text' ); ?> </div>
			</div>
		</div>
		<div class="row Crystal-text">
        <div class="col-sm-12">
			<?php the_field( 'crystal_bottom_text' ); ?>
		</div>
        </div>
	<?php endif; ?>
    </div>
    
    </div>

	<?php if (is_page('testimonals')) : ?>
		<div class="testi-pages clr"> 
        <div class="container">
			<h2><?php the_field( 'testimonials_title' ); ?></h2>
            </div>
          
			 <?php while( have_rows('clients_testimonials') ): the_row(); ?> 
				<div class="testimonial clr">
                  <div class="container">
					<p><?php the_sub_field( 'clients_says' ); ?></p>
					<p><?php the_sub_field( 'clients_name' ); ?></p>
					<p>-<?php the_sub_field( 'clients__profactions' ); ?></p>
				</div>       
                </div>  
			<?php endwhile; ?>
            </div>
		
	<?php endif; ?>
    
<div class="container">
	 <div class="releted-services">
    <h3 class="block-tittle text-center">  SERVICES </h3>
    <div class="row shop-grid">
		<?php $parent = new WP_Query( array('post_type' => 'page', 'post_parent' => 11, 'order' => 'ASC'));
		if ( $parent->have_posts() ) : ?>
		<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
			<div class="col-sm-3" id="parent-<?php the_ID(); ?>" >
            
           <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> <div class="shop-img" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);">
        <div class="text">          
			  <h4 class="shop-tittle"><?php the_title(); ?></h4>
              </div>
              </div></a>
			</div>
		<?php endwhile; ?>
		<?php endif; wp_reset_postdata(); ?>
	</div>
	</div>
    </div>

<?php get_footer(); ?>