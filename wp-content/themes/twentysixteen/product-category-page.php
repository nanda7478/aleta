<?php
/*
 Display Template Name: Product Category Page
*/

get_header();
?>


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

 


<div class="container">
 <div class="row">
<div class="col-sm-12 text-center small-text">
<?php the_field('content_box');?>


</div>
<div class="col-sm-12 text-center">
 <ul class="middle-links">
 <?php

// check if the repeater field has rows of data
if( have_rows('product_category') ):

 	// loop through the rows of data
    while ( have_rows('product_category') ) : the_row();
?>
  <li><a href="<?php the_sub_field('url');?>"><?php the_sub_field('name');?></a> </li>


<?php
    endwhile;

endif;

?>
</ul>
</div>
</div>
</div>

 
<div class="service-page">
<div class="container2">
<div class="row">
<?php
 $args = array( 'post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => 'meditations-intensives', 'order' => 'DESC' );
  $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; 

?>

                <div class="col-sm-6">

                <a href="<?php the_permalink(); ?>"><div class="aleta-img">
                 <?php
                 if ( has_post_thumbnail() ) {
                 $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
                 if ( ! empty( $large_image_url[0] ) ) {
        
		         echo '<img class="img-responsive flsd"  src="' . esc_url( $large_image_url[0] ) . '" />';
        
                     }
                  }
                 ?>
              <div class="shadow blackss"></div>
                    <div class="text">
                    
                    <div class="bottoms">
                 <span class="price"><?php echo $product->get_price_html(); ?></span>
                        <h4><?php the_title(); ?></h4>
                    </div>
                 </div></a>

</div>
               </div>
            <?php endwhile; ?>

</div>
</div>
</div>



<?php
 get_footer();
?>