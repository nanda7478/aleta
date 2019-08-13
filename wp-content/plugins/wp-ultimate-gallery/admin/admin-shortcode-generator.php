<?php

// Shortcode Generator
function ultimate_gallery_image_count_admin_column($post_ID) {
    $gallery_images_count = get_post_meta($post_ID, 'images', true); 
    if ($gallery_images_count) {
        $total_images_count = count( $gallery_images_count );
        return $total_images_count;
    }
}

$shortcode_column_lang_text = __('Shortcode', 'wp-ultimate-gallery');
$images_column_lang_text = __('Images', 'wp-ultimate-gallery');
$type_column_lang_text = __('Gallery Type', 'wp-ultimate-gallery');




add_filter('manage_wp-ultimate-gallery_posts_columns', 'ultimate_gallery_wp_shortcode_column_head', 10);
add_action('manage_wp-ultimate-gallery_posts_custom_column', 'ultimate_gallery_wp_shortcode_column_content', 10, 2);
function ultimate_gallery_wp_shortcode_column_head($defaults) {
    $defaults['shortcode_generate'] = ''.$shortcode_column_lang_text.'';
    $defaults['gallery_images_count'] = ''.$images_column_lang_text.'';
    $defaults['gallery_type'] = ''.$type_column_lang_text.'';
    return $defaults;
}
function ultimate_gallery_wp_shortcode_column_content($column_name, $post_ID) {
    
    
    $no_image_uploaded_lang_text = __('No image uploaded!', 'wp-ultimate-gallery');
    $no_image_warning_text = __('Shortcode will appear when you upload images.', 'wp-ultimate-gallery');
    
    if ($column_name == 'shortcode_generate') {
        $ug_img_count = ultimate_gallery_image_count_admin_column($post_ID);
        $shortcode_render = '[ultimate_gallery id="'.$post_ID.'"]';
        
        if($ug_img_count < 1) {
        echo ''.$no_image_warning_text.'';
        } else {
        echo '<input style="min-width:210px" type=\'text\' onClick=\'this.setSelectionRange(0, this.value.length)\' value=\''.$shortcode_render.'\' />';
        }
    }
    if ($column_name == 'gallery_images_count') {
        $ug_img_count = ultimate_gallery_image_count_admin_column($post_ID);
        $image_uploaded_lang_text = __('image uploaded.', 'wp-ultimate-gallery');
        $images_uploaded_lang_text = __('images uploaded.', 'wp-ultimate-gallery');
        
        if ($ug_img_count) {
            if($ug_img_count == 1) {
                $img_upload_txt = ' '.$image_uploaded_lang_text.'';
            } else {
                $img_upload_txt = ' '.$images_uploaded_lang_text.'';
            }
            echo $ug_img_count; echo $img_upload_txt;
        } else {
            echo ''.$no_image_uploaded_lang_text.'';
        }
    }
    if ($column_name == 'gallery_type') {
        $gallery_type_value = get_post_meta($post_ID, 'view_as', true);
        
        if($gallery_type_value == 'carousel') {
            $gallery_type_value_text = __('Carousel', 'wp-ultimate-gallery');
        } elseif($gallery_type_value == 'slideshow') {
            $gallery_type_value_text = __('Slideshow', 'wp-ultimate-gallery');
        } elseif($gallery_type_value == 'masonry') {
            $gallery_type_value_text = __('Masonry Thumbnail', 'wp-ultimate-gallery');
        } elseif($gallery_type_value == 'filmstrip') {
            $gallery_type_value_text = __('Filmstrip', 'wp-ultimate-gallery');
        } else {
            $gallery_type_value_text = __('Thumbnail', 'wp-ultimate-gallery');
        }
        
        if ($gallery_type_value) {
            echo ''.$gallery_type_value_text.'';
        }
    }
}