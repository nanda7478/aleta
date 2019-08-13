<?php
/*
  Display Template Name: Inner Page Two
*/
get_header();
?>
<?php if (is_page('contact')): ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $image = get_field('header_banner_image'); ?>

<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
  <div class="container inner-pages-content-table">
    <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
     <?php /*?> <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
      <p>
        <?php the_content();?>
      </p><?php */?>
    </div>
  </div>
</div>
<?php endwhile;?>
<div class="container">
  <div class="row row-first"> 
    <div class="col-md-6">
    
    <div class="mobile-headings">
     <h1>
        <?php the_title(); ?>
      </h1>
     <h3> HEALING STUDIO </h3>
     </div>
     
      <?php $image = get_field('contact_image'); ?>
      <img src="<?php echo $image['url'];?>">
       </div>
    <div class="col-md-6">
    <h1>
        <?php the_title(); ?>
      </h1>
      <div class="bg-white2">
      <?php the_field('contact_contents');?>
    </div>
  </div>
  </div>
  <div class="row row-second">
    <div class="col-md-6">
    <div class="custom-mid">
     
      <h3 class="block-tittle">
        <?php the_field('service_title')?>
   </h3>
   <div class="row">
      <?php $parent = new WP_Query( array('post_type' => 'page', 'post_parent' => 11, 'order' => 'ASC'));
			if ( $parent->have_posts() ) : ?>
     
        <?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
       
        <div class="col-sm-6" id="parent-<?php the_ID(); ?>" >  
       
        <div class="shop-img" style="background-image:url(<?php echo get_the_post_thumbnail_url(); ?>);">
        <div class="text">
          <h4 class="shop-tittle">
           <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            <?php the_title(); ?>
            </a>
          </h4>
       
       </div>
       </div>
       </div>
       
     
        <?php endwhile; ?>
       
      <?php endif; wp_reset_postdata(); ?>
    </div>
     </div>
    </div>
    <div class="col-md-6 contact-form">
      <?php the_field('contact_form')?>
    </div>
  </div>
   </div>
  
<?php endif; ?>
<?php if (is_page('blog')): ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
  <div class="container inner-pages-content-table">
    <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
      <h1 class="entry-title">
        <?php the_title(); ?>
      </h1>
      <p><?php the_content();?></p>
    </div>
  </div>
</div>
<?php endwhile;?>
<div class="author-about">
  <div class="small-text text-center">
    <?php the_field('blog_content');?>
  </div>
</div>
<div class="blog-page">
<div class="container2">
  <div class="row">
     
      <?php 
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

			$args = array(
			'posts_per_page' => 6,
			'paged' => $paged
			);
			$wp_query = new WP_Query( $args ); ?>
      <?php if ( $wp_query->have_posts() ) : ?>
     
      
          <?php while ( $wp_query->have_posts() ) : ?>
          <?php $wp_query->the_post(); ?>
          <div class="col-sm-6 iteams">

          <div class="shop-img" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>);">
                    <div class="shadow"> </div>
           <div class="text">
<h4 class="shop-tittle"> 
           <a href="<?php the_permalink() ?>">   <?php the_title();?> </a>
            </h4>
            <span class="date"><?php echo get_the_date('m.j.y'); ?></span> <a class="btn" href="<?php the_permalink() ?>">Read More</a> </div>
            </div>
            </div>
          <?php endwhile; ?>
         
      <?php endif; ?>
       <div class="col-sm-12 text-center">
      <?php wpbeginner_numeric_posts_nav(); ?>
     </div>
  </div>
</div>
</div>
<?php endif; ?>
<?php get_footer(); ?>
