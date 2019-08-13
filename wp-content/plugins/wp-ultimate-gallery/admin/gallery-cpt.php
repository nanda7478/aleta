<?php

// Registering custom post type
add_action( 'init', 'wordpress_ultimate_gallery_cpt' );
function wordpress_ultimate_gallery_cpt() {
    register_post_type( 'wp-ultimate-gallery',
        array(
            'labels' => array(
                'name' => __( 'Galleries', 'wp-ultimate-gallery' ),
                'singular_name' => __( 'Gallery', 'wp-ultimate-gallery' )
            ),
            'supports' => array('title'),
            'menu_icon' => 'dashicons-format-gallery',
            'public' => false,
            'show_ui' => true,
        )
    );
}