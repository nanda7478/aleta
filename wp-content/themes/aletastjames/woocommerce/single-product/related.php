<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

<div class="container clr">
	 <div class="releted-services coutin clr">
    <h3 class="block-tittle text-center"> <?php esc_html_e( 'Continue Shopping', 'woocommerce' ); ?> </h3>
    
		<?php $my_query = new WP_Query('page_id=235');
while ($my_query->have_posts()) : $my_query->the_post();
$do_not_duplicate = $post->ID;?>

 <div class="row shop-grid"> 
<?php while( have_rows('store_boxes') ): the_row(); ?> 
<?php $image01 = get_sub_field('store_box_image'); ?>
<div class="col-sm-4">
       <div class="shop-img" style="background-image:url(<?php echo $image01['url'];?>);">
        <div class="text">
          <h4 class="shop-tittle"><?php the_sub_field( 'store_box_title' ); ?> </h4>

		  <a class="btn" href="<?php the_sub_field( 'store_box_url' ); ?>"><?php the_sub_field( 'store_box_url_title' ); ?></a>
</div>
</div>
</div>
<?php endwhile; ?>

</div>

    <?php
    endwhile;
    ?>

 </div>
 </div>
 </div>
 
<?php endif;
wp_reset_postdata();?>