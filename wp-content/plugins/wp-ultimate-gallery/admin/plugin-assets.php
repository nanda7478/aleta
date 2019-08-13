<?php

// Adding gallery files
function wordpress_ultimate_gallery_files(){
    
    global $options;
    
    
    wp_enqueue_script('jquery');
    
    if(wug_get_option('enable_masonry') != 2) {
        wp_enqueue_script( 'jquery-masonry', array( 'jquery' ) );
    }
    
    
    wp_enqueue_style('wp-ultimate-gallery-css', plugin_dir_url( __FILE__ ) .'../assets/css/wug-gallery.css');
    
    if(wug_get_option('enable_lightbox') != 2) {
        wp_enqueue_style('wp-ultimate-lb-mp', plugin_dir_url( __FILE__ ) .'../libs/lightboxes/magnific-popup/magnific-popup.css');
        wp_enqueue_script( 'wp-ultimate-lb-mp-js', plugin_dir_url( __FILE__ ) . '../libs/lightboxes/magnific-popup/jquery.magnific-popup.min.js', array(), '20120206', true );
    }
    
    if(wug_get_option('enable_owl') != 2) {
        wp_enqueue_style('wp-ultimate-lightslider', plugin_dir_url( __FILE__ ) .'../libs/light-slider/lightslider.min.css');
        wp_enqueue_script( 'wp-ultimate-lightslider-js', plugin_dir_url( __FILE__ ) . '../libs/light-slider/lightslider.min.js', array(), '20120206', true );
    }
    
    if(wug_get_option('enable_infinite') != 2) {
        wp_enqueue_script( 'wp-ultimate-lb-infinitescroll-js', plugin_dir_url( __FILE__ ) . '../libs/infinite-scroll/jquery.infinitescroll.min.js', array(), '20120206', true );
        wp_enqueue_script( 'wp-ultimate-lb-imgloaded-js', plugin_dir_url( __FILE__ ) . '../libs/infinite-scroll/imagesloaded.pkgd.min.js', array(), '20120206', true );
    }
    
    if(wug_get_option('enable_isotope') != 2) { 
        wp_enqueue_script( 'wp-ultimate-isotope-js', plugin_dir_url( __FILE__ ) . '../libs/isotope/isotope-3.0.1.min.js', array(), '20120206', true );
    }
    
    
}
add_action('wp_enqueue_scripts', 'wordpress_ultimate_gallery_files'); 


add_action( 'admin_print_scripts-post-new.php', 'wug_custom_admin_script', 11 );
add_action( 'admin_print_scripts-post.php', 'wug_custom_admin_script', 11 );

function wug_custom_admin_script() {
    global $post_type;
    if( 'wp-ultimate-gallery' == $post_type ) {
        wp_enqueue_script( 'labelauty-js', plugins_url( 'admin/assets/js/jquery-labelauty.js' , dirname(__FILE__) ), array('jquery'), '1.0', false );
        wp_enqueue_script( 'rangeslider-js', plugins_url( 'admin/assets/js/jquery.range-min.js' , dirname(__FILE__) ), array('jquery'), '1.0', false );
        wp_enqueue_script( 'wug-edit-js', plugins_url( 'admin/assets/js/wug-edit.js' , dirname(__FILE__) ), array('jquery'), '1.0', false );

        wp_enqueue_style( 'rangeslider', plugins_url( 'admin/assets/css/jquery.range.css' , dirname(__FILE__) ) );
        wp_enqueue_style( 'labelauty', plugins_url( 'admin/assets/css/jquery-labelauty.css' , dirname(__FILE__) ) );
        wp_enqueue_style( 'wug-edit', plugins_url( 'admin/assets/css/wug-edit.css' , dirname(__FILE__) ) );
    }
}