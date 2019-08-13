jQuery(document).ready(function($){
    $("#owl_autoplay1, #owl_loop1, #owl_nav1, #owl_dots1, #gallery_preloader1, #ajax_pagination1, #gallery_caption1, #img_fullsize1").attr("data-labelauty","Yes");
    $("#owl_autoplay2, #owl_loop2, #owl_nav2, #owl_dots2, #gallery_preloader2, #ajax_pagination2, #gallery_caption2, #img_fullsize2").attr("data-labelauty","No");
    
    $("#carousel_link_behabour1").attr("data-labelauty","Link to lightbox image or video");
    $("#carousel_link_behabour2").attr("data-labelauty","External link only");
    $("#carousel_link_behabour3").attr("data-labelauty","No link");
    $("#gallery_caption_field1").attr("data-labelauty","Title");
    $("#gallery_caption_field2").attr("data-labelauty","Caption");
    $("#gallery_caption_field3").attr("data-labelauty","Description");
    $("#gallery_caption_field4").attr("data-labelauty","Alt Text");
    
    $("#images_order1").attr("data-labelauty","Asending");
    $("#images_order2").attr("data-labelauty","Desending");
    
    $("#per_row_images1").attr("data-labelauty","Flexible");
    $("#per_row_images2").attr("data-labelauty","1 Image");
    $("#per_row_images3").attr("data-labelauty","2 Images");
    $("#per_row_images4").attr("data-labelauty","3 Images");
    $("#per_row_images5").attr("data-labelauty","4 Images");
    $("#per_row_images6").attr("data-labelauty","6 Images");
    
    $("input[value=thumbnail]").attr("data-labelauty","Thumbnail");
    $("input[value=masonry]").attr("data-labelauty","Masonry");
    $("input[value=slideshow]").attr("data-labelauty","Slideshow");
    $("input[value=filmstrip]").attr("data-labelauty","Filmstrip");
    $("input[value=carousel]").attr("data-labelauty","Carousel");
    $("input[value=isotope]").attr("data-labelauty","Isotope");

    $("[name='owl_autoplay'], [name='owl_loop'], [name='owl_nav'], [name='owl_dots'], [name='gallery_preloader'], [name='ajax_pagination'], [name='carousel_link_behabour'], [name='view_as'], [name='per_row_images'], [name='images_order'], [name='gallery_caption'], [name='img_fullsize'], [name='gallery_caption_field']").labelauty({ minimum_width: "80px" });
    
    
    $('#per_page').jRange({
        from: 1,
        to: 100,
        step: 1,
        format: '%s items',
        width: 500,
        showLabels: true,
        snap: true,
        isRange : false,
        showScale : false,
    });
    
    $('#owl_autoplay_time').jRange({
        from: 1,
        to: 15,
        step: 1,
        width: 500,
        showLabels: true,
        format: '%s Seconds',
        snap: true,
        isRange : false,
        showScale : false,
    });
    
    $('#slideshow_width, #slideshow_height, #filmstrip_width, #filmstrip_height, #carousel_width, #carousel_height').jRange({
        from: 100,
        to: 1500,
        step: 50,
        width: 500,
        showLabels: true,
        format: '%s Pixels',
        snap: true,
        isRange : false,
        showScale : false,
    });
    
    $('#filmstrip_thumbnail_item').jRange({
        from: 1,
        to: 20,
        step: 1,
        width: 500,
        showLabels: true,
        format: '%s Items',
        snap: true,
        isRange : false,
        showScale : false,
    });
    
    $('#filmstrip_thumbnail_margin, #owl_margin').jRange({
        from: 5,
        to: 50,
        step: 5,
        width: 500,
        showLabels: true,
        format: '%s Pixels',
        snap: true,
        isRange : false,
        showScale : false,
    });
    
    $('#owl_items').jRange({
        from: 1,
        to: 10,
        step: 1,
        width: 500,
        showLabels: true,
        format: '%s Items',
        snap: true,
        isRange : false,
        showScale : false,
    });
    
    $('#owl_items_tablet').jRange({
        from: 1,
        to: 7,
        step: 1,
        width: 500,
        showLabels: true,
        format: '%s Items',
        snap: true,
        isRange : false,
        showScale : false,
    });
    
    $('#owl_items_mobile').jRange({
        from: 1,
        to: 3,
        step: 1,
        width: 500,
        showLabels: true,
        format: '%s Items',
        snap: true,
        isRange : false,
        showScale : false,
    });
});