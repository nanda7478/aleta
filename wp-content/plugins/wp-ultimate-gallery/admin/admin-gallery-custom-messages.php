<?php

// Gallery custom messages
add_filter( 'post_updated_messages', 'wp_ultimate_gallery_updated_messages' );
function wp_ultimate_gallery_updated_messages( $messages ){
        
    global $post;
    
    $post_ID = $post->ID;
    
    $ug_img_count = ultimate_gallery_image_count_admin_column($post_ID);
    if($ug_img_count < 1) {
        $messages['wp-ultimate-gallery'] = array(
            0 => '', 
            1 => __('Gallery updated. Upload images to generate shortcode.', 'wp-ultimate-gallery'),
            2 => __('Gallery field updated.', 'wp-ultimate-gallery'),
            3 => __('Gallery field deleted.', 'wp-ultimate-gallery'),
            4 => __('Gallery updated.'),
            5 => isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s', 'wp-ultimate-gallery'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => __('Gallery published. Upload images to generate shortcode.', 'wp-ultimate-gallery'),
            7 => __('Gallery saved.', 'wp-ultimate-gallery'),
            8 => sprintf( __('Gallery submitted.', 'wp-ultimate-gallery'), esc_url( add_query_arg( 'preview', 'true',get_permalink($post_ID) ) ) ),
            9 => sprintf( __('Gallery scheduled for: <strong>%1$s</strong>.', 'wp-ultimate-gallery'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
            10 => sprintf( __('Gallery draft updated.', 'wp-ultimate-gallery'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
    } else {
        $messages['wp-ultimate-gallery'] = array(
            0 => '', 
            1 => sprintf( __('Gallery updated. Shortcode is: %s', 'wp-ultimate-gallery'), '[ultimate_gallery id="'.$post_ID.'"]' ),
            2 => __('Gallery field updated.', 'wp-ultimate-gallery'),
            3 => __('Gallery field deleted.', 'wp-ultimate-gallery'),
            4 => __('Gallery updated.', 'wp-ultimate-gallery'),
            5 => isset($_GET['revision']) ? sprintf( __('Gallery restored to revision from %s', 'wp-ultimate-gallery'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
            6 => sprintf( __('Gallery published. Shortcode is: %s', 'wp-ultimate-gallery'), '[ultimate_gallery id="'.$post_ID.'"]' ),
            7 => __('Gallery saved.'),
            8 => sprintf( __('Gallery submitted.', 'wp-ultimate-gallery'), esc_url( add_query_arg( 'preview', 'true',get_permalink($post_ID) ) ) ),
            9 => sprintf( __('Gallery scheduled for: <strong>%1$s</strong>.', 'wp-ultimate-gallery'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
            10 => sprintf( __('Gallery draft updated.', 'wp-ultimate-gallery'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        );
    }
    
    return $messages;
        
}