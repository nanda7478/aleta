<?php
/*
  Display Template Name: Service Page
*/
  get_header(); ?>


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
<div class="col-sm-12 text-center small-text mt-50">
<?php the_field('service_content');?>
</div>
</div>
</div>

<div class="service-page">
<div class="container2">
<div class="row">
<?php $parent = new WP_Query( array('post_type' => 'page', 'post_parent' => $post->ID, 'order' => 'ASC'));
		if ( $parent->have_posts() ) : ?>
			<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>
			<div class="col-sm-6" id="parent-<?php the_ID(); ?>" >

            <a href="<?php echo get_the_permalink(); ?>" title="<?php the_title(); ?>"><div class="aleta-img">
            
				<img src="<?php echo get_the_post_thumbnail_url(); ?>">
				
                <div class="text">
				<h4><?php the_title(); ?></h4>
 </div>
 </div></a>
			</div>
			<?php endwhile; ?>
		<?php endif; wp_reset_postdata(); ?>

</div>
</div>
</div>
 

<?php get_footer(); ?>