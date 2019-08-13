<?php 

// Add extra field on media
function wug_media_extra_fields( $form_fields, $post ) {
    
    global $options;
    
	$form_fields['video-url'] = array(
		'label' => __('Video URL', 'wp-ultimate-gallery'),
		'input' => 'text',
		'value' => get_post_meta( $post->ID, 'video_url', true ),
		'helps' => __('Type video URL, if have.', 'wp-ultimate-gallery'),
	);
    
    if(wug_get_option('enable_owl') != 2) {
        $form_fields['external-url'] = array(
            'label' => __('External Link', 'wp-ultimate-gallery'),
            'input' => 'text',
            'value' => get_post_meta( $post->ID, 'extarnal_url', true ),
            'helps' => __('Image external URL. Used in carousel view.', 'wp-ultimate-gallery'),
        );
    }
    
    if(wug_get_option('enable_isotope') != 2) {
        $form_fields['wug-tags'] = array(
            'label' => __('Image tags', 'wp-ultimate-gallery'),
            'input' => 'text',
            'value' => get_post_meta( $post->ID, 'wug_tags', true ),
            'helps' => __('Add image tag comma seprated. <span style="color:#E74C3C">Do not use space before or after comma</span>', 'wp-ultimate-gallery'),
        );
    }

	return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'wug_media_extra_fields', 10, 2 );

function wug_media_extra_fields_save( $post, $attachment ) {
    
    global $options;
    
	if( isset( $attachment['video-url'] ) )
		update_post_meta( $post['ID'], 'video_url', $attachment['video-url'] );
    
    if(wug_get_option('enable_owl') != 2) {
        if( isset( $attachment['external-url'] ) )
            update_post_meta( $post['ID'], 'extarnal_url', $attachment['external-url'] );
    }
    
    if(wug_get_option('enable_isotope') != 2) {
        if( isset( $attachment['wug-tags'] ) )
            update_post_meta( $post['ID'], 'wug_tags', $attachment['wug-tags'] );
    }

	return $post;
}

add_filter( 'attachment_fields_to_save', 'wug_media_extra_fields_save', 10, 2 );