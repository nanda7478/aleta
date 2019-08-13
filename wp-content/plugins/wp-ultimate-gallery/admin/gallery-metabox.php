<?php



add_action( 'cmb2_admin_init', 'wp_ultimate_gallery_register_metabox' );
function wp_ultimate_gallery_register_metabox() {
    
global $options;
    
$thumb_lang_text = __( 'Thumbnail', 'wp-ultimate-gallery' );    
$masonry_lang_text = __( 'Masonry', 'wp-ultimate-gallery' );    
$slideshow_lang_text = __( 'Slideshow', 'wp-ultimate-gallery' );    
$filmstrip_lang_text = __( 'Filmstrip', 'wp-ultimate-gallery' );    
$carousel_lang_text = __( 'Carousel', 'wp-ultimate-gallery' );    
$lightbox_lang_text = __( 'Lightbox', 'wp-ultimate-gallery' );    
$isotope_lang_text = __( 'Isotope', 'wp-ultimate-gallery' );    
    
if(wug_get_option('enable_lightbox') == 2) {
    $thumbnail_item_text = '';
} else {
    $thumbnail_item_text = ' + '.$lightbox_lang_text.'';
}

if(wug_get_option('enable_owl') != 2) {
    if(wug_get_option('enable_maronry') != 2) {
        if(wug_get_option('enable_isotope') != 2) {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                                'masonry' => ''.$thumb_lang_text.' + '.$masonry_lang_text.''.$thumbnail_item_text.'',
                                'slideshow' => ''.$slideshow_lang_text.'',
                                'filmstrip' => ''.$filmstrip_lang_text.'',
                                'carousel' => ''.$carousel_lang_text.'',
                                'isotope' => ''.$isotope_lang_text.'',
                             ); 
        } else {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                                'masonry' => ''.$thumb_lang_text.' + '.$masonry_lang_text.''.$thumbnail_item_text.'',
                                'slideshow' => ''.$slideshow_lang_text.'',
                                'filmstrip' => ''.$filmstrip_lang_text.'',
                                'carousel' => ''.$carousel_lang_text.'',
                             );
        }
    } else {
        if(wug_get_option('enable_isotope') != 2) {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                                'slideshow' => ''.$slideshow_lang_text.'',
                                'filmstrip' => ''.$filmstrip_lang_text.'',
                                'carousel' => ''.$carousel_lang_text.'',
                                'isotope' => ''.$isotope_lang_text.'',
                             ); 
        } else {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                                'slideshow' => ''.$slideshow_lang_text.'',
                                'filmstrip' => ''.$filmstrip_lang_text.'',
                                'carousel' => ''.$carousel_lang_text.'',
                             );    
        }
    }
    
} else {
    if(wug_get_option('enable_maronry') != 2) {
        if(wug_get_option('enable_isotope') != 2) {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                                'masonry' => ''.$thumb_lang_text.' + '.$masonry_lang_text.''.$thumbnail_item_text.'',
                                'isotope' => ''.$isotope_lang_text.'',
                             );    
        } else {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                                'masonry' => ''.$thumb_lang_text.' + '.$masonry_lang_text.''.$thumbnail_item_text.'',
                             );         
        }
    } else {
        if(wug_get_option('enable_isotope') != 2) {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                                'isotope' => ''.$isotope_lang_text.'',
                             );  
        } else {
            $view_as_array = array(
                                'thumbnail' => ''.$thumb_lang_text.''.$thumbnail_item_text.'',
                             );  
        }
            
    }    
}

if(wug_get_option('enable_lightbox') == 2) {
    $carousel_link_behabour_array = array(
                                        'large_size_image' => 'Link to large size image',
                                        'external_link' => 'External link only',
                                        'no_link' => 'No link',
                                    );  
} else {    
    $carousel_link_behabour_array = array(
                                        'lightbox' => 'Link to lightbox image or video',
                                        'external_link' => 'External link only',
                                        'no_link' => 'No link',
                                    );  
}
    
    
    
	$wp_ultimate_gallery_metabox = new_cmb2_box( array(
		'id'            => 'wp_ug_metabox_id',
		'title'         => __( 'Configure Gallery', 'wp-ultimate-gallery' ),
		'object_types'  => array( 'wp-ultimate-gallery', )
	) );
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Upload Images', 'wp-ultimate-gallery'),
        'desc'          => __('Upload gallery images here. You can upload all at once.', 'wp-ultimate-gallery'),
        'id'          => 'images',
        'type'        => 'file_list',
    ) );
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('View as', 'wp-ultimate-gallery'),
        'desc'          => __('Select how you want to view gallery.', 'wp-ultimate-gallery'),
        'id'          => 'view_as',
        'type'        => 'radio',
        'default'        => 'thumbnail',
        'options'        => $view_as_array,
    ) );
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Isotope menu items', 'wp-ultimate-gallery'),
        'desc'          => __('Type Isotope menu items comma seprated. Make sure you used those on image tags.<span style="color:#E74C3C">Do not use space before or after comma</span>', 'wp-ultimate-gallery'),
        'id'          => 'isotope_menu_items',
        'type'        => 'text',
    ) );     
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Carousel width', 'wp-ultimate-gallery'),
        'desc'          => __('Select carousel width in px. Don\'t worry, slideshow will responsive. This is just used for image crop. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'carousel_width',
        'type'        => 'text',
        'default'        => '600',
    ) );      
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Carousel height', 'wp-ultimate-gallery'),
        'desc'          => __('Select carousel height in px. Don\'t worry, slideshow will responsive. This is just used for image crop. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'carousel_height',
        'type'        => 'text',
        'default'        => '450',
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Gallery width', 'wp-ultimate-gallery'),
        'desc'          => __('Select filmstrip gallery width in px. Don\'t worry, slideshow will responsive. This is just used for image crop. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'filmstrip_width',
        'type'        => 'text',
        'default'        => '800',
    ) );      
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Gallery height', 'wp-ultimate-gallery'),
        'desc'          => __('Select filmstrip gallery height in px. Don\'t worry, slideshow will responsive. This is just used for image crop. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'filmstrip_height',
        'type'        => 'text',
        'default'        => '500',
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Slideshow width', 'wp-ultimate-gallery'),
        'desc'          => __('Select slideshow width in px. Don\'t worry, slideshow will responsive. This is just used for image crop. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'slideshow_width',
        'type'        => 'text',
        'default'        => '1140',
    ) );      
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Slideshow height', 'wp-ultimate-gallery'),
        'desc'          => __('Select slideshow height in px. Don\'t worry, slideshow will responsive. This is just used for image crop. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'slideshow_height',
        'type'        => 'text',
        'default'        => '450',
    ) ); 
    
  
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Images per row', 'wp-ultimate-gallery'),
        'desc'          => __('If you select flexible here, it will take 160px width each image & display columns automatically with your page container width. Alternatively, you can select images per row.', 'wp-ultimate-gallery'),
        'id'          => 'per_row_images',
        'default'          => 'flexible',
        'type'        => 'radio',
        'options'        => array(
            'flexible' => __('Flexible', 'wp-ultimate-gallery'),
            '1_image' => __('1 Image per row', 'wp-ultimate-gallery'),
            '2_image' => __('2 Images per row', 'wp-ultimate-gallery'),
            '3_image' => __('3 Images per row', 'wp-ultimate-gallery'),
            '4_image' => __('4 Images per row', 'wp-ultimate-gallery'),
            '6_image' => __('6 Images per row', 'wp-ultimate-gallery'),
        ),
    ) );
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Images order', 'wp-ultimate-gallery'),
        'desc'          => __('Select images order here. <strong>Asending</strong> means images will show images order above & <strong>Desending</strong> means reverse.', 'wp-ultimate-gallery'),
        'id'          => 'images_order',
        'type'        => 'radio',
        'default'        => 'asending',
        'options'        => array(
            'asending' => __('Ascending', 'wp-ultimate-gallery'),
            'desending' => __('Descending', 'wp-ultimate-gallery')
        ),
    ) );    
    
    
    if(wug_get_option('enable_infinite') != 2) {
        $wp_ultimate_gallery_metabox->add_field( array(
            'name'          => __('Enable AJAX navigation?', 'wp-ultimate-gallery'),
            'desc'          => __('If you want to enable AJAX pagination on gallery, select yes here.', 'wp-ultimate-gallery'),
            'id'          => 'ajax_pagination',
            'type'        => 'radio',
            'default'        => 'false',
            'options'        => array(
                'false' => __('No', 'wp-ultimate-gallery'),
                'true' => __('Yes', 'wp-ultimate-gallery')
            ),
        ) );
    }
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Images per page', 'wp-ultimate-gallery'),
        'desc'          => __('Type a number how many images will show per page. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'per_page',
        'type'        => 'text',
        'default'        => '12',
    ) );
    
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Enable autoplay?', 'wp-ultimate-gallery'),
        'desc'          => __('If you want to enable autoplay, select Yes here.', 'wp-ultimate-gallery'),
        'id'          => 'owl_autoplay',
        'type'        => 'radio',
        'default'        => 'true',
        'options'        => array(
            'true' => __('Yes', 'wp-ultimate-gallery'),
            'false' => __('No', 'wp-ultimate-gallery'),
        ),
    ) );
    
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Autoplay Time', 'wp-ultimate-gallery'),
        'desc'          => __('Set autoplay time here.', 'wp-ultimate-gallery'),
        'id'          => 'owl_autoplay_time',
        'default'          => '5',
        'type'        => 'text',
    ) );
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Enable loop?', 'wp-ultimate-gallery'),
        'desc'          => __('If you want loop infinite, select Yes here.', 'wp-ultimate-gallery'),
        'id'          => 'owl_loop',
        'type'        => 'radio',
        'default'        => 'true',
        'options'        => array(
            'true' => __('Yes', 'wp-ultimate-gallery'),
            'false' => __('No', 'wp-ultimate-gallery'),
        ),
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Enable navigation arrows', 'wp-ultimate-gallery'),
        'desc'          => __('If you want enable next previous arrow, select Yes here.', 'wp-ultimate-gallery'),
        'id'          => 'owl_nav',
        'type'        => 'radio',
        'default'        => 'false',
        'options'        => array(
            'true' => __('Yes', 'wp-ultimate-gallery'),
            'false' => __('No', 'wp-ultimate-gallery'),
        ),
    ) );
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Enable bullets?', 'wp-ultimate-gallery'),
        'desc'          => __('If you want enable bullets, select Yes here.', 'wp-ultimate-gallery'),
        'id'          => 'owl_dots',
        'type'        => 'radio',
        'default'        => 'true',
        'options'        => array(
            'true' => __('Yes', 'wp-ultimate-gallery'),
            'false' => __('No', 'wp-ultimate-gallery'),
        ),
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Carousel items per row', 'wp-ultimate-gallery'),
        'desc'          => __('Select carousel items per row', 'wp-ultimate-gallery'),
        'id'          => 'owl_items',
        'type'        => 'text',
        'default'        => '5',
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Carousel tablet items per row', 'wp-ultimate-gallery'),
        'desc'          => __('Select carousel tablet items per row', 'wp-ultimate-gallery'),
        'id'          => 'owl_items_tablet',
        'type'        => 'text',
        'default'        => '3',
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Carousel mobile items per row', 'wp-ultimate-gallery'),
        'desc'          => __('Select carousel mobile items per row', 'wp-ultimate-gallery'),
        'id'          => 'owl_items_mobile',
        'type'        => 'text',
        'default'        => '1',
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Carousel items margin', 'wp-ultimate-gallery'),
        'desc'          => __('Type items between margin in px. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'owl_margin',
        'type'        => 'text',
        'default'        => '30',
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Gallery thumbnail count', 'wp-ultimate-gallery'),
        'desc'          => __('Type how many thumbnail item you want to show. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'filmstrip_thumbnail_item',
        'type'        => 'text',
        'default'        => '10',
    ) );
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Gallery thumbnail margin', 'wp-ultimate-gallery'),
        'desc'          => __('Type thumbnail items between margin in px. Numbers only.', 'wp-ultimate-gallery'),
        'id'          => 'filmstrip_thumbnail_margin',
        'type'        => 'text',
        'default'        => '5',
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Carousel item link behabour', 'wp-ultimate-gallery'),
        'desc'          => __('Select carousel items link behabour here.', 'wp-ultimate-gallery'),
        'id'          => 'carousel_link_behabour',
        'type'        => 'radio',
        'default'        => 'external_link',
        'options'        => $carousel_link_behabour_array,
    ) );  
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Enable caption?', 'wp-ultimate-gallery'),
        'desc'          => __('If you want to enable caption, select Yes here.', 'wp-ultimate-gallery'),
        'id'          => 'gallery_caption',
        'type'        => 'radio',
        'default'        => 'false',
        'options'        => array(
            'true' => __('Yes', 'wp-ultimate-gallery'),
            'false' => __('No', 'wp-ultimate-gallery'),
        ),
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Select caption field', 'wp-ultimate-gallery'),
        'desc'          => __('Which field will show as caption? Select here.', 'wp-ultimate-gallery'),
        'id'          => 'gallery_caption_field',
        'type'        => 'radio',
        'default'        => 'desc',
        'options'        => array(
            'title' => __('Title', 'wp-ultimate-gallery'),
            'caption' => __('Caption', 'wp-ultimate-gallery'),
            'desc' => __('Description', 'wp-ultimate-gallery'),
            'alttext' => __('Alt Text', 'wp-ultimate-gallery'),
        ),
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Enable full sized image?', 'wp-ultimate-gallery'),
        'desc'          => __('If you want to enable full sized image, select Yes here.', 'wp-ultimate-gallery'),
        'id'          => 'img_fullsize',
        'type'        => 'radio',
        'default'        => 'false',
        'options'        => array(
            'true' => __('Yes', 'wp-ultimate-gallery'),
            'false' => __('No', 'wp-ultimate-gallery'),
        ),
    ) ); 
    
    $wp_ultimate_gallery_metabox->add_field( array(
        'name'          => __('Enable preloader?', 'wp-ultimate-gallery'),
        'desc'          => __('If you want to enable preloader, select Yes here.', 'wp-ultimate-gallery'),
        'id'          => 'gallery_preloader',
        'type'        => 'radio',
        'default'        => 'true',
        'options'        => array(
            'true' => __('Yes', 'wp-ultimate-gallery'),
            'false' => __('No', 'wp-ultimate-gallery'),
        ),
    ) );     
};
