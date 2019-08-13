<?php
/*
*
Template Name: Full-Width
*/
get_header(); ?>
<div id="primary" class="content-area">

<?php
  if(is_cart())
  {
 ?>

  <?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
 <div class="container inner-pages-content-table">
 <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
 <h1 class="entry-title">
<?php the_field('cart_content'); ?>
 </h1>
   
</div>
</div>
</div>

  

<?php
  }
?>

<?php
  if(is_checkout())
  {
 ?>

  <?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
 <div class="container inner-pages-content-table">
 <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
 <h1 class="entry-title">
<?php the_field('cart_content'); ?>
 </h1>
   
</div>
</div>
</div>

  

<?php
  }
?>


<?php
if(is_account_page())
{
  ?>


  <?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
 <div class="container inner-pages-content-table">
 <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
 <h1 class="entry-title">
<?php the_field('my_account_content'); ?>
 </h1>
   
</div>
</div>
</div>

<?php } ?>


<?php
if(is_page('thank-you'))
{
  ?>


  <?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
 <div class="container inner-pages-content-table">
 <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
 <h1 class="entry-title">
<?php the_field('thank_page_content'); ?>
 </h1>
   
</div>
</div>
</div>

<?php } ?>




    <main id="main" class="site-main" role="main">
        <?php
        // Start the loop.
        while ( have_posts() ) : the_post();
 
            // Include the page content template.
            get_template_part( 'template-parts/content', 'page' );
 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) {
                comments_template();
            }
 
            // End of the loop.
        endwhile;
        ?>
 
    </main><!-- .site-main -->




</div><!-- .content-area -->

 
<?php get_footer(); ?>