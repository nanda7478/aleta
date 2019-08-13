<?php
/*
  Display Template Name: Inner Page
*/
  get_header(); ?>

<?php if (is_page('about')): ?>


<?php while ( have_posts() ) : the_post(); ?>
  <?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
 <div class="container inner-pages-content-table mt-50">
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

<div class="container">
<div class="row">
<div class="col-sm-12 col-md-6 about-img">
<div class="saf">
<?php $image1 = get_field('about_image'); ?>
<img src="<?php echo $image1['url']; ?>" alt="<?php echo $image1['alt']; ?>" />
</div>
</div>

<div class="col-sm-12 col-md-6 about-text">
<?php the_field('about_content');?>
</div>
</div>

</div>


<?php endif; ?>  
  



<?php if (is_page('store')): ?>

<?php while ( have_posts() ) : the_post(); ?>
  <?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
 <div class="container inner-pages-content-table">
 <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
 <h1 class="entry-title"> <?php the_content();?> </h1>
  
</div>
</div>
</div>
<?php endwhile;?>


<div class="container">
<div class="row">
<div class="col-sm-12 text-center small-text mt-50">
<?php the_field('store_content');?>
</div>
</div>	

<div class="row shop-grid mt-50">
<?php while( have_rows('store_boxes') ): the_row(); ?> 
<?php $image01 = get_sub_field('store_box_image'); ?>
<div class="col-sm-4">
<div class="shop-img" style="background-image:url(<?php echo $image01['url'];?>);">
        <div class="text">
          <h4 class="shop-tittle">
           <?php the_sub_field( 'store_box_title' ); ?>
          </h4>
         
<a class="btn" href="<?php the_sub_field( 'store_box_url' ); ?>"><?php the_sub_field( 'store_box_url_title' ); ?></a> </div>
      </div>
</div>
 
<?php endwhile; ?>


</div>
</div>

<?php endif; ?>  




<?php if (is_page('press')): ?>

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
  

<div class="container">
<div class="row">
<div class="col-sm-12 small-text mt-50"> 
<?php the_field('press_content');?>
</div>
</div>

<div class="press-gal">
<div class="row">
<div class="col-sm-12">		
<?php echo do_shortcode('[ultimate_gallery id="287"]');?>
</div>
</div>
</div>
 
</div>


<?php endif; ?> 


<?php get_footer(); ?>
