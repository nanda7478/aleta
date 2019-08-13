<?php
/*
  Display Template Name: Home Page
*/
  get_header(); ?>


<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal"> <i class="fas fa-times-circle"></i> </button>
        
      <video autobuffer controls>
     <source id="mp4" src="<?php echo get_site_url();?>" type="video/mp4">
     </video>

      </div>

    </div>
  </div>
</div>

  <div id="primary">
    <div class="wireship_slider">
      <div id="slider" class="flexslider">
        <ul class="slides">
          <?php
while( have_rows('home_slider') ): the_row();            
$image = get_sub_field( 'image' );
?>
          <li> <img src="<?php echo $image['url']; ?>" />
            <div class="slide-text">
              <h2>
                <?php the_sub_field('title');?>
              </h2>
              <div class="slider-button"> <a class="btn" href="<?php the_sub_field('button_url');?>">
                <?php the_sub_field('button_title');?>
                </a> </div>
            </div>
          </li>
          <?php  endwhile; ?>
        </ul>
      </div>
    </div>
  </div>
 
<div class="meet-aleta">
  <div class="container">
    <div class="row">
      <div class="col-sm-5">
        <?php $image = get_field( 'home_image' ); ?>
        <div class="aleta-img"> <img src="<?php echo $image['url']; ?>">
          <a href="<?php the_field('home_image_title_url') ?>"><div class="text">
            <h4><?php the_field('home_image_title') ?></h4>
          </div></a>
        </div>
      </div>
      <div class="col-sm-7">
        <?php //the_field('home_video') ?>
        <?php  $file = get_field('home_video'); ?>
        <span id="videoPlaybtn" class="v-center" data-toggle="modal" data-target="#myModal"><i class="fas fa-play-circle"></i></span>
        <?php if( $file ): ?>
        <video class="video-file" preload="auto" playsinline="" id="videoPlay" width="100%" height="100%"  poster="http://demosrvr.com/wp/aletastjames/wp-content/themes/aletastjames/images/aa.png">
          <source src="<?php echo $file['url']; ?>" type="video/mp4">
        </video>
        <?php endif; ?>

    

      </div>
      <h3 class="block-tittle">
        <?php the_field('shop_block') ?>
      </h3>
    </div>
  </div>
</div>
<div class="container">
  <div class="row shop-grid">
    <?php while( have_rows('store_boxes') ): the_row(); ?>
    <?php $image01 = get_sub_field('store_box_image'); ?>
    <div class="col-md-4">
      <div class="shop-img" style="background-image:url(<?php echo $image01['url'];?>);">
        <div class="text">
          <h4 class="shop-tittle">
            <?php the_sub_field( 'store_box_title' ); ?>
          </h4>
          <a class="btn" href="<?php the_sub_field( 'store_box_url' ); ?>">
          <?php the_sub_field( 'store_box_url_title' ); ?>
          </a> </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>


<?php get_footer(); ?>
