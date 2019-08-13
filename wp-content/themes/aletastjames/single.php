<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="inner-pages-bg">
<div class="container">
<span class="back-btn custom-closing" onclick="goBack()">  <img src="<?php echo site_url(); ?>/wp-content/themes/aletastjames/images/arrow.png" />  </span>
<h1 class="tittle2"> <?php the_title();?> </h1>
</div>
</div>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="container">
		<div class="row tag-social">
		<div class="col-sm-12">	
		<ul class="tags">

      
		<?php 
			if ( get_post() ) :
				$categories = get_the_category( $post->ID );
				foreach ($categories as $value) {
					?>
                  <li>
					<?php echo $value->name;?>
					</li>
			<?php
				}
			endif;	?>
            
            </ul>
            </div>
            <div class="col-sm-12">
		    <div class="social_icon">
			<span>SHARE</span>
            <ul>
            <li>
			<a href="https://twitter.com/intent/tweet?text=<?php the_title() ?>&url=<?php the_permalink(); ?>" target="_blank"><i class="fab fa-twitter"></i>  </a>
            </li>
                        <li>
			<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"> <i class="fab fa-facebook-f"></i></a>
            </li>
                        <li>
			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"> <i class="fab fa-google-plus"></i> </a>
            </li>
            <li>
			<a href="https://www.linkedin.com/shareArticle?mini=true&url='.<?php the_permalink() ?>.'&amp;title='.<?php the_title(); ?>" target="_blank"> <i class="fab fa-linkedin"></i> </a>
            </li>
         </ul>
		</div>
        </div>
		</div>
		<div class="row">
			<div class="col-md-8 col-xl-9">
				<?php while ( have_posts() ) : the_post();?>
					<?php twentysixteen_post_thumbnail(); ?>
					<div class="content">
						<?php the_content(); ?>
					</div>
				<?php endwhile;	?>	
				<div class="other_post">
					<?php previous_post_link('%link', '<i class="fas fa-long-arrow-alt-left"></i>'); ?> 
					<?php next_post_link('%link', '<i class="fas fa-long-arrow-alt-right"></i>'); ?>
				</div>
			</div>
			<div class="col-md-4 col-xl-3 side-bar">
				<?php echo get_search_form(); ?>
 				<?php get_sidebar( 'sidebar-1' ); ?>
                <div class="tags">
				
				<?php if ( get_post() ) :
					$categories = get_the_category( $post->ID );
					foreach ($categories as $value) {
						// echo "<pre>";
						// print_r($value);
				      //echo $value->name;
							}
					endif;
				$orig_post = $post;
				global $post;
				$categories = get_the_category($post->ID);
				if ($categories) :
					$category_ids = array();
					foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					$args=array(
							'category__in' => $category_ids,
							'post__not_in' => array($post->ID),
							'posts_per_page'=> 2, // Number of related posts that will be shown.
							'caller_get_posts'=>1
					);
					$my_query = new wp_query( $args );
					if($my_query->have_posts()):?> 
                     
						<div id="related_posts">
							<h3>Related Posts</h3>
						 <div class="row">
						<?php while( $my_query->have_posts()) :
							$my_query->the_post();?>
							
                             <div class="col-sm-12 iteams">

          <div class="shop-img" style="background-image:url(<?php echo get_the_post_thumbnail_url();?>);">
                    <div class="shadow"> </div>
           <div class="text">
<h4 class="shop-tittle">  <a href="<?php the_permalink() ?>">   <?php the_title();?> </a>
            </h4>
            <span class="date"><?php echo get_the_date('m.j.y'); ?></span> <a class="btn" href="<?php the_permalink() ?>">Read More</a> </div>
            </div>
            </div>

                            
                            
						<?php  endwhile; ?>
						 </div>
						</div> 
                        
					<?php endif; ?>
				<?php endif; ?>
				<?php $post = $orig_post;
					wp_reset_query(); ?>
			</div>
		</div>
        </div>
</article>

<?php get_footer(); ?>







