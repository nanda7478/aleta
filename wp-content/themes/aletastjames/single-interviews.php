<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>


add_action('init', 'interviews_custom_init');  
 
/*-- Custom Post Init Begin --*/
function interviews_custom_init()
{
  $labels = array(
    'name' => _x('Interviews', 'post type general name'),
    'singular_name' => _x('Interviews', 'post type singular name'),
    'add_new' => _x('Add New', 'Interviews'),
    'add_new_item' => __('Add New Interviews'),
    'edit_item' => __('Edit Interviews'),
    'new_item' => __('New Interviews'),
    'view_item' => __('View Interviews'),
    'search_items' => __('Search Interviews'),
    'not_found' =>  __('No Interviews found'),
    'not_found_in_trash' => __('No Interviews found in Trash'),
    'parent_item_colon' => '',
    'menu_name' => 'Interviews'
 
  );
   
 $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'has_archive' => true,
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','author','thumbnail','excerpt','comments')
  );
  // The following is the main step where we register the post.
  register_post_type('interviews',$args);
   
  // Initialize New Taxonomy Labels
  $labels = array(
    'name' => _x( 'Interviews Category', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ),
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
  );
    // Custom taxonomy for Project Tags
    register_taxonomy('interviews_category',array('interviews'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'interviews-category' ),
  ));

    //register taxonomy for custom post tags
register_taxonomy( 
'custom-tags', //taxonomy 
'interviews', //post-type
array( 
    'hierarchical'  => false, 
    'label'         => __( 'My Custom Tags','taxonomy general name'), 
    'singular_name' => __( 'Tag', 'taxonomy general name' ), 
    'rewrite'       => true, 
    'query_var'     => true 
));
   
}
/*-- Custom Post Init End --*/




<?php 
  $loop = new WP_Query( array( 
      'post_type' => 'interviews',   /* edit this line */
      'posts_per_page' => 15 ) );
?>

<h2>Programme</h2>

<ul class="present">
<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>  
<li>
  <?php the_post_thumbnail( 'thumbnail' ); 
        //the_post_thumbnail( 'single-post-thumbnail' ); ?>
        <h5>
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
        <?php echo get_the_title(); ?>
    </a></h5>
</li>
<?php endwhile; ?> 

</ul>




  <div id="primary" class="site-content">
    <div id="content" role="main">
<h1>THE EXTRAORDANARY SHOW</h1>
      <?php while ( have_posts() ) : the_post(); ?>
      <div class="row">
        <div class="col-sm-6">
          <?php the_post_thumbnail( 'medium' ); ?>
        </div>

         
        </div>
        
      </div>
      <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
  </div><!-- #primary -->


 


<?php get_footer(); ?>