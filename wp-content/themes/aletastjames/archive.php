<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>


<?php $image = get_field('header_banner_image'); ?>
<div class="inner-pages-banner" style="background-image:url(<?php echo $image['url'];?>);">
  <div class="container inner-pages-content-table">
    <div id="post-<?php the_ID(); ?>" class="inner-pages-content-table-cell text-left">
      <h1 class="entry-title"><?php
    printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
?></h1>
    </div>
  </div>
</div>




	<div class="blog-page">
<div class="container2">
  <div class="row">
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

			?>

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
			
			
				
			
              <?php
				
			endwhile;	
	        ?>
 <div class="col-sm-12 text-center">
      <?php wpbeginner_numeric_posts_nav(); ?>
     </div>	        
</div>
</div>
</div>

<?php get_footer(); ?>
