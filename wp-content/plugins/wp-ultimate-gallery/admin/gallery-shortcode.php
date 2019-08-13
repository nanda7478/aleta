<?php 

// Registering gallery shortcode
function ultimate_gallery_shortcode($atts){
    
    global $options;
    
    
    extract( shortcode_atts( array(
        'id' => ''
    ), $atts) );
     
    $q = new WP_Query( array('posts_per_page' => 1, 'post_type' => 'wp-ultimate-gallery', 'p' => $id) );      
         
    $wug = '<div id="wug-wrapper-'.$id.'" class="wug-wrapper">';
    
    if( get_query_var('page') ) {
        $page = get_query_var( 'page' );
    } else {
        $page = 1;
    }      
    
    
    while($q->have_posts()) : $q->the_post();
        $idd = get_the_ID();
        $gallery_images = get_post_meta($idd, 'images', true);
        $gallery_images_per_page = get_post_meta($idd, 'per_page', true);
        $owl_autoplay = get_post_meta($idd, 'owl_autoplay', true);
        $owl_autoplay_time = get_post_meta($idd, 'owl_autoplay_time', true);
        $owl_loop = get_post_meta($idd, 'owl_loop', true);
        $owl_nav = get_post_meta($idd, 'owl_nav', true);
        $images_order = get_post_meta($idd, 'images_order', true);
        $gallery_caption = get_post_meta($idd, 'gallery_caption', true);
        $gallery_caption_field = get_post_meta($idd, 'gallery_caption_field', true);
        $img_fullsize = get_post_meta($idd, 'img_fullsize', true);
        $isotope_menu_items = get_post_meta($idd, 'isotope_menu_items', true);
        
    
        if($owl_nav == 'false') {
            $carousel_nav_deactivated = 'carousel-nav-deactivated';
        } else {
            $carousel_nav_deactivated = '';
        }
    
        $owl_items = get_post_meta($idd, 'owl_items', true);
        $owl_margin = get_post_meta($idd, 'owl_margin', true);
        $owl_dots = get_post_meta($idd, 'owl_dots', true);
        $owl_items_tablet = get_post_meta($idd, 'owl_items_tablet', true);
        $owl_items_mobile = get_post_meta($idd, 'owl_items_mobile', true);
        $carousel_link_behabour = get_post_meta($idd, 'carousel_link_behabour', true);
        $per_row_images = get_post_meta($idd, 'per_row_images', true);
        $view_as = get_post_meta($idd, 'view_as', true);
        $slideshow_width = get_post_meta($idd, 'slideshow_width', true);
        $slideshow_height = get_post_meta($idd, 'slideshow_height', true);
        $carousel_width = get_post_meta($idd, 'carousel_width', true);
        $carousel_height = get_post_meta($idd, 'carousel_height', true);
        $filmstrip_width = get_post_meta($idd, 'filmstrip_width', true);
        $filmstrip_height = get_post_meta($idd, 'filmstrip_height', true);
        $filmstrip_thumbnail_margin = get_post_meta($idd, 'filmstrip_thumbnail_margin', true);
        $filmstrip_thumbnail_item = get_post_meta($idd, 'filmstrip_thumbnail_item', true);
        $gallery_preloader = get_post_meta($idd, 'gallery_preloader', true);
        $ajax = get_post_meta($idd, 'ajax_pagination', true);
        if($per_row_images == '1_image'){
            $per_row_images_class = 'wug-per-row-img-1';
        } elseif($per_row_images == '2_image'){
            $per_row_images_class = 'wug-per-row-img-2';
        } elseif($per_row_images == '3_image'){
            $per_row_images_class = 'wug-per-row-img-3';
        } elseif($per_row_images == '4_image'){
            $per_row_images_class = 'wug-per-row-img-4';
        } elseif($per_row_images == '6_image'){
            $per_row_images_class = 'wug-per-row-img-6';
        } else {
            $per_row_images_class = 'wug-flexible';
        }
        $post_content = get_the_content();
    
        $imgno_count = 0;
        $images_per_page  = $gallery_images_per_page;
        $total            = count( $gallery_images );
        $pages            = ceil( $total / $images_per_page );
        $min              = ( ( $page * $images_per_page ) - $images_per_page ) + 1;
        $max              = ( $min + $images_per_page ) - 1;    
    
        $loading_text = __( 'Loading ...', 'wp-ultimate-gallery' );
        $nextpage_text = __( 'Load more', 'wp-ultimate-gallery' );
        $all_gallery_text = __( 'All', 'wp-ultimate-gallery' );
    

    
        $wug .='
        <script>
            jQuery(document).ready(function($){';
    
        if($view_as == 'slideshow' OR $view_as == 'filmstrip') {
            $carousel_items = 1;
            $tablet_carousel_items = 1;
            $mobile_carousel_items = 1;
            $carousel_margin = 0;
        } elseif($view_as == 'carousel') {
            $carousel_items = $owl_items;
            $carousel_margin = $owl_margin;
            $tablet_carousel_items = $owl_items_tablet;
            $mobile_carousel_items = $owl_items_mobile;
        }
    
        if($owl_autoplay == 'true') {
            $owl_autoplay_time_settings = 'pause: '.$owl_autoplay_time.'000,';
        } else {
            $owl_autoplay_time_settings = '';
        }
    
        if($view_as == 'filmstrip') {
            $slider_dots = 'true';
        } else {
            $slider_dots = $owl_dots;
        }

    
        if($view_as != 'slideshow' && wug_get_option('enable_lightbox') != 2) {
            $wug .='
                    $(".single-ug-image-item a").magnificPopup({
                        gallery: {
                            enabled: true
                        },
                        type: \'image\',
                        mainClass: \'mfp-fade\',
                        removalDelay: 300,
                    });';           
        }
    
        if($view_as == 'slideshow' OR $view_as == 'carousel' OR $view_as == 'filmstrip') {
            $wug .='
                    $("#wug-inner-'.$id.'").lightSlider({
                        item:'.$carousel_items.',
                        loop: '.$owl_loop.',
                        auto: '.$owl_autoplay.',
                        
                        
                        pager: '.$slider_dots.',
                        controls: '.$owl_nav.',
                        
                        
                        '.$owl_autoplay_time_settings.'
                        adaptiveHeight: false,
                        slideMargin: '.$carousel_margin.',';
            if($owl_nav == 'true') {
                $wug .='
                        prevHtml: "<i class=\'icomoon icomoon-thin-left\'></i>", 
                        nextHtml: "<i class=\'icomoon icomoon-thin-right\'></i>",';
            }
            
            if($view_as == 'filmstrip') {
                $wug .='
                        gallery:true,
                        thumbMargin: '.$filmstrip_thumbnail_margin.',
                        thumbItem: '.$filmstrip_thumbnail_item.',
                ';
            }
            
            $wug .='
                        responsive: [
                            {
                                breakpoint:768,
                                settings: {
                                    item:'.$tablet_carousel_items.',
                                }
                            },
                            {
                                breakpoint:480,
                                settings: {
                                    item:'.$mobile_carousel_items.',
                                }
                            }
                        ]                       
                    });
            ';
        } elseif($view_as == 'isotope' && wug_get_option('enable_isotope') != 2) {
            $wug .='
                $(".wug-isotope-menu li").click(function(){ 

                  $(".wug-isotope-menu li").removeClass("active");
                  $(this).addClass("active");        

                    var selector = $(this).attr(\'data-filter\'); 
                    $("#wug-inner-'.$id.'").isotope({ 
                        filter: selector, 
                        animationOptions: { 
                            duration: 750, 
                            easing: \'linear\', 
                            queue: false, 
                        } 
                    }); 
                }); 
            ';
        } else {
         
            

            
            if($ajax == 'true') {
                
                if($per_row_images == '1_image' OR $per_row_images == '2_image') {
                    $delay_timing = 3000;
                } else {
                    $delay_timing = 2000;
                }                 
                
                $wug .='
                        $("#wug-wrapper-'.$id.' .wug-inner").infinitescroll({
                            navSelector  	: "#wug-wrapper-'.$id.' .wug-next-page",
                            nextSelector 	: "#wug-wrapper-'.$id.' .wug-next-page a.next",
                            itemSelector 	: "#wug-inner-'.$id.' .single-ug-image-item",
                            loading: {
                                msgText: "<i class=\'icomoon icomoon-spinner icomoon-rotate\'></i> '.$loading_text.'",
                                finishedMsg: "<em>Sorry, no more image left in gallery!</em>",
                                img: "data:image/gif;base64,R0lGODlhAQABAHAAACH5BAUAAAAALAAAAAABAAEAAAICRAEAOw=="
                            },
                            maxPage         : '.$pages.',                
                        },function( newElems ) {
                            $("#wug-wrapper-'.$id.' .wug-next-page").delay('.$delay_timing.').fadeIn();';
                    
                if($view_as == 'masonry') {
                    $wug .='
                        var $newElems = $( newElems ).hide().imagesLoaded( function() {
                            $newElems.show();
                            $("#wug-inner-'.$id.'").masonry( \'appended\', $newElems );
                        });
                    ';
                }
                
                
                if(wug_get_option('enable_lightbox') != 2) {    
                    $wug .='
                                $(".single-ug-image-item a").magnificPopup({
                                    gallery: {
                                        enabled: true
                                    },
                                    type: \'image\',
                                    mainClass: \'mfp-fade\',
                                    removalDelay: 300,
                                });';
                }
                
                $wug .='
                        });

                        $(window).unbind(\'.infscr\');

                        $("#wug-wrapper-'.$id.' .wug-next-page a.next").click(function(){
                            $("#wug-wrapper-'.$id.' .wug-inner").infinitescroll(\'retrieve\');
                            return false;
                        });                     
                ';

            }            
        }

    
        $wug .='
            });
            
            jQuery(window).load(function(){
        ';
        
        if($view_as == 'masonry') {
            $wug .='
                    jQuery("#wug-inner-'.$id.'").masonry({ 
                        itemSelector: \'.single-ug-image-item\',
                        columnWidth: \'.single-ug-image-item\',
                    });
            ';
        } elseif($view_as == 'isotope' && wug_get_option('enable_isotope') != 2) {
            $wug .='
                jQuery("#wug-inner-'.$id.'").isotope({
                    itemSelector: \'.single-ug-image-item\',
                    layoutMode: \'fitRows\',
                }); 
            ';
        }
    
        $wug .='
            jQuery(".wug-second-wrap").addClass("wug-loaded");
            jQuery(".wug-gallery-pagination").delay(1000).fadeIn();
        ';
    
        $wug .='
            });
        </script>
        ';
    
    
        if($ajax == 'true' && $view_as != 'slideshow' && $view_as != 'carousel') {
            $infinite_scroll_active_class = 'wug-infinite-scroll';
            if($view_as == 'masonry') {
                $infinite_scroll_active_class = 'wug-infinite-scroll wug-masonry-activated';
            }
        } elseif($view_as == 'carousel') {
            $infinite_scroll_active_class = 'wug-carousel-activated';
        } elseif($view_as == 'slideshow') {
            $infinite_scroll_active_class = 'wug-slideshow-activated';
        } else {
            $infinite_scroll_active_class = '';
        } 
    
        if($view_as == 'masonry') {
            $masonry_activated_class ='wug-masonry-activated';
        } else {
            $masonry_activated_class ='';
        } 
    
        if($gallery_preloader != 'false') {
            $wug .='<div class="wug-second-wrap"><div class="wpg-loading-wrap"><div class="wpg-loading"><i class="icomoon icomoon-spinner icomoon-rotate"></i><p>loading ...</p></div></div>';
        }
    
        $wug .='<div class="wug-inner '.$per_row_images_class.' '.$infinite_scroll_active_class.' '.$masonry_activated_class.' '.$carousel_nav_deactivated.'">';
    
        if($view_as == 'isotope' && wug_get_option('enable_isotope') != 2) {
            $isotope_menu_items_array = explode(',', $isotope_menu_items);
            
            if($isotope_menu_items_array) {
                $wug .= '<ul class="wug-isotope-menu"><li class="active" data-filter="*">'.$all_gallery_text.'</li>';
                foreach($isotope_menu_items_array as $wug_menu) {
                    $wug .= '<li data-filter=".'.str_replace(' ', '-', strtolower($wug_menu)).'">'.$wug_menu.'</li>';
                }
                $wug .= '</ul>';
            }
        }
    
    
        $wug .='<div id="wug-inner-'.$id.'">';
        
        if($images_order == 'desending') {
            $gallery_images_order = array_reverse($gallery_images, true);
        } else {
            $gallery_images_order = $gallery_images;
        }
    
        foreach( $gallery_images_order as $image => $attachment_id) {
            $imgno_count++;
            $image_meta = wp_prepare_attachment_for_js($image);
            
            $image_video = get_post_meta($image, 'video_url', true);
            $image_external_url = get_post_meta($image, 'extarnal_url', true);
            $wug_tags = get_post_meta($image, 'wug_tags', true);
            
            $full_img_url = wp_get_attachment_url($image);
            
            if($gallery_caption == 'true') {
                if($gallery_caption_field == 'title') {
                    $gallery_caption_content = $image_meta['title'];
                } elseif($gallery_caption_field == 'caption') {
                    $gallery_caption_content = $image_meta['caption'];
                }  elseif($gallery_caption_field == 'alttext') {
                    $gallery_caption_content = $image_meta['alt'];
                } else {
                    $gallery_caption_content = $image_meta['description'];
                }
            } else {
                $gallery_caption_content = '';
            }
            
            
            if($view_as == 'masonry') {
                if($per_row_images == '1_image' OR $per_row_images == '2_image') {
                    $image_thumbnail_source = wp_get_attachment_image_src($image, 'large');
                    $image_thumbnail = $image_thumbnail_source[0];
                } else {
                    $image_thumbnail_source = wp_get_attachment_image_src($image, 'medium');
                    $image_thumbnail = $image_thumbnail_source[0];
                }
            } else {
                if($per_row_images == '1_image'){
                    $image_thumbnail_source = wp_get_attachment_image_src($image, 'large');
                    $image_thumbnail = $image_thumbnail_source[0];
                } elseif($per_row_images == '2_image'){
                    $image_thumbnail = aq_resize( $full_img_url, 480, 300, true, true, true );
                } elseif($per_row_images == '3_image'){
                    $image_thumbnail = aq_resize( $full_img_url, 400, 250, true, true, true );
                } else {
                    $image_thumbnail = aq_resize( $full_img_url, 240, 160, true, true, true );
                }             
            }
            
            
                            
            
            
            if($image_video) {
                $video_link_class = 'mfp-iframe';
                
                if($img_fullsize == 'true') {
                    $item_link_finial = $full_img_url;
                } else {
                    $item_link_finial = $image_video;
                }
            } else {
                $image_link_source = wp_get_attachment_image_src($image, 'large');
                $image_link = $image_link_source[0];
                $video_link_class = '';
                
                if($img_fullsize == 'true') {
                    $item_link_finial = $full_img_url;
                } else {
                    $item_link_finial = $image_link;
                }
            }
            
            
            if($view_as == 'slideshow' OR $view_as == 'carousel' OR $view_as == 'filmstrip') {
                
                
                
                if($view_as == 'carousel') {
                    $resized_image_array = aq_resize( $full_img_url, $carousel_width, $carousel_height, true, true, true );
                    
                } elseif($view_as == 'filmstrip') {
                    $filmstrip_thumb = wp_get_attachment_image_src($image, 'thumbnail');
                    $filmstrip_thumb_src = $filmstrip_thumb[0];
                    $resized_image_array = aq_resize( $full_img_url, $filmstrip_width, $filmstrip_height, true, true, true );
                } else {
                    $resized_image_array = aq_resize( $full_img_url, $slideshow_width, $slideshow_height, true, true, true );
                }
                
                
                if($img_fullsize == 'true') {
                    $resized_image_array_url = $full_img_url;
                } else {
                    $resized_image_array_url = $resized_image_array;
                }
                
                if($view_as == 'filmstrip') {
                    $wug .='<div data-thumb="'.$filmstrip_thumb_src.'" class="single-ug-slide-item">';
                } else {
                    $wug .='<div class="single-ug-slide-item">';
                }
                
                if($view_as == 'carousel' ) {
                    
                    if($carousel_link_behabour == 'external_link') {
                        if($image_external_url) {
                            $wug .='<a href="'.$image_external_url.'" target="_blank"><img src="'.$resized_image_array_url.'" alt="'.$image_meta['title'].'"/></a>';
                            if($gallery_caption == 'true' && $gallery_caption_content) {
                            $wug .='
                                <div class="wug-caption">
                                    '.wpautop($gallery_caption_content).'
                                </div>';
                            }
                        } else {
                            $wug .='<div class="single-ug-image-item">
                                <img src="'.$resized_image_array_url.'" alt="'.$image_meta['title'].'"/>';

                            if($gallery_caption == 'true' && $gallery_caption_content) {
                            $wug .='
                                <div class="wug-caption">
                                    '.wpautop($gallery_caption_content).'
                                </div>';
                            }
                            $wug .='
                            </div>';
                        }                    
                    } elseif($carousel_link_behabour == 'no_link') {
                        $wug .='<div class="single-ug-image-item">
                            <img src="'.$resized_image_array_url.'" alt="'.$image_meta['title'].'"/>';

                            if($gallery_caption == 'true' && $gallery_caption_content) {
                            $wug .='
                                <div class="wug-caption">
                                    '.wpautop($gallery_caption_content).'
                                </div>';
                            }
                            $wug .='
                            </div>'; 
                    } else {
                        if($image_external_url) {
                            $wug .='<a href="'.$image_external_url.'" target="_blank"><img src="'.$resized_image_array_url.'" alt="'.$image_meta['title'].'"/></a>';
                            if($gallery_caption == 'true' && $gallery_caption_content) {
                            $wug .='
                                <div class="wug-caption">
                                    '.wpautop($gallery_caption_content).'
                                </div>';
                            }
                        } else {
                            $wug .='<div class="single-ug-image-item">
                                <a title="'.$image_meta['title'].'" href="'.$item_link_finial.'" class="single-image-item-trigger '.$video_link_class.'"><img src="'.$resized_image_array_url.'" alt="'.$image_meta['title'].'"/></a>';

                            if($gallery_caption == 'true' && $gallery_caption_content) {
                            $wug .='
                                <div class="wug-caption">
                                    '.wpautop($gallery_caption_content).'
                                </div>';
                            }
                            $wug .='
                                </div>';
                        }                    
                    }
                    

                    
                } else {
                    $wug .='<img src="'.$resized_image_array_url.'" alt="'.$image_meta['title'].'"/>';
                }
                
                if($image_meta['title'] && $image_meta['description'] && $view_as != 'carousel') {
                    $wug .='
                        <div class="wug-slideshow-desc">
                            <h3>'.$image_meta['title'].'</h3>';
                    
                            if($gallery_caption == 'true' && $gallery_caption_content) {
                            $wug .='
                                <div class="wug-caption">
                                    '.wpautop($gallery_caption_content).'
                                </div>';
                            }
                            $wug .='
                        </div>';
                }
                $wug .='
                </div>';
            } else {
                
                
                if($img_fullsize == 'true') {
                    $image_src_fix_bottom = $full_img_url;
                } else {
                    $image_src_fix_bottom = $image_thumbnail;
                }
                
              
                
                
                if($view_as == 'isotope' && $wug_tags && wug_get_option('enable_isotope') != 2){
                    
                    $wug_tags_smalercase = strtolower($wug_tags);
                    $wug_tags_space_with_dash = str_replace(' ', '-', $wug_tags_smalercase);
                    $wug_tags_comma_with_space = str_replace(',', ' ', $wug_tags_space_with_dash);
                    
                    $isotope_item_class = $wug_tags_comma_with_space;
                    
                } else {
                    $isotope_item_class = '';
                }
                
                
                if($view_as == 'isotope' && wug_get_option('enable_isotope') != 2) {
                } else {
                    if($imgno_count < $min) { continue; }

                    if($imgno_count > $max) { break; }
                }

                if($per_row_images == '2_image' OR $per_row_images == '3_image') {
                    $wug .='<div class="single-ug-image-item '.$isotope_item_class.'">
                        <a title="'.$image_meta['title'].'" href="'.$item_link_finial.'" class="single-image-item-trigger '.$video_link_class.'"><img src="'.$image_src_fix_bottom.'" alt="'.$image_meta['title'].'"/></a>';
                    
                    if($gallery_caption == 'true' && $gallery_caption_content) {
                    $wug .='
                        <div class="wug-caption">
                            '.wpautop($gallery_caption_content).'
                        </div>';
                    }
                    $wug .='
                    </div>';
                } else {
                $wug .='<div class="single-ug-image-item '.$isotope_item_class.'">
                    <a title="'.$image_meta['title'].'" href="'.$item_link_finial.'" class="single-image-item-trigger '.$video_link_class.'"><img src="'.$image_src_fix_bottom.'" alt="'.$image_meta['title'].'"/></a>';
                    
                    if($gallery_caption == 'true' && $gallery_caption_content) {
                    $wug .='
                        <div class="wug-caption">
                            '.wpautop($gallery_caption_content).'
                        </div>';
                    }
                    $wug .='
                    </div>';
                }
            }
        }
    
        $wug .='</div></div>';
        if($gallery_preloader != 'false') {
            $wug .='</div>';
        }
        
    endwhile;
    wp_reset_query();
    
    $wug .= '<div style="clear:both"></div>';
    
    
    
    if($view_as != 'slideshow' && $view_as != 'carousel' && $view_as != 'filmstrip' && $view_as != 'isotope') {
        $wug .='<div class="wug-gallery-pagination '.$infinite_scroll_active_class.'">';
        if($ajax == 'true') {
            $wug .='<div class="wug-next-page">
            '.paginate_links( array(
                'base'      => get_permalink() . '%#%' . '/',
                'format'    => '?page=%#%',
                'current'   => $page,
                'total'     => $pages,
                'prev_next' => true,
                'next_text' => ''.$nextpage_text.' <i class=\'icomoon icomoon-thin-right\'></i>',
            ) ).'        
            </div>';
        } else {
            $wug .=''.paginate_links( array(
                'base'      => get_permalink() . '%#%' . '/',
                'format'    => '?page=%#%',
                'current'   => $page,
                'total'     => $pages,
                'prev_next' => false,
            ) ).'';   
        }
        $wug .='</div>';
    }
    
    $wug .= '</div>';
    
    return $wug;
}
add_shortcode('ultimate_gallery', 'ultimate_gallery_shortcode');  