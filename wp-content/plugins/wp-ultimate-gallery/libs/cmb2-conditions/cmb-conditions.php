<?php 

add_action( 'admin_head', 'wp_ultimate_gallery_cmb2_condition' );
function wp_ultimate_gallery_cmb2_condition() {

	
	global $post_type;

    
	if( 'wp-ultimate-gallery' != $post_type )
		return;

    
	?>
   
   
	<script>
        jQuery(document).ready(function($){

<?php 

$slideshow_fields_logic = '
    if($(this).val() == \'slideshow\') {
        $(".cmb2-id-slideshow-width").addClass("show-slideshow-width-field");
        $(".cmb2-id-slideshow-height").addClass("show-slideshow-height-field");
        $(".cmb2-id-per-row-images").addClass("hide-slideshow-row-img-field");
        $(".cmb2-id-ajax-pagination").addClass("hide-slideshow-pagination-field");
        $(".cmb2-id-per-page").addClass("hide-slideshow-perpage-field");
        
        $(".cmb2-id-carousel-width").removeClass("show-carousel-width-field");
        $(".cmb2-id-carousel-height").removeClass("show-carousel-height-field");
        $(".cmb2-id-owl-items-tablet").removeClass("show-cmb2-id-owl-items-tablet");
        $(".cmb2-id-owl-items-mobile").removeClass("show-cmb2-id-owl-items-mobile");
        $(".cmb2-id-carousel-link-behabour").removeClass("show-cmb2-id-carousel-link-behabour");
        
        
        $(".cmb2-id-owl-autoplay").addClass("show-cmb2-id-owl-autoplay");
        $(".cmb2-id-owl-loop").addClass("show-cmb2-id-owl-loop");
        $(".cmb2-id-owl-nav").addClass("show-cmb2-id-owl-nav");
        $(".cmb2-id-owl-dots").addClass("show-cmb2-id-owl-dots");
        $(".cmb2-id-owl-autoplay-time").addClass("show-cmb2-id-owl-autoplay-time");
        
        $(".cmb2-id-owl-items").removeClass("show-cmb2-id-owl-items");
        $(".cmb2-id-owl-margin").removeClass("show-cmb2-id-owl-margin");
        
        $(".cmb2-id-filmstrip-width").removeClass("show-cmb2-id-filmstrip-width");
        $(".cmb2-id-filmstrip-height").removeClass("show-cmb2-id-filmstrip-height");
        $(".cmb2-id-filmstrip-thumbnail-margin").removeClass("show-cmb2-id-filmstrip-thumbnail-margin");
        $(".cmb2-id-filmstrip-thumbnail-item").removeClass("show-cmb2-id-filmstrip-thumbnail-item");
        $(".cmb2-id-isotope-menu-items").removeClass("show-cmb2-id-isotope-menu-items");
        
    } else if($(this).val() == \'filmstrip\') {
        $(".cmb2-id-slideshow-width").removeClass("show-slideshow-width-field");
        $(".cmb2-id-slideshow-height").removeClass("show-slideshow-height-field");
        $(".cmb2-id-per-row-images").addClass("hide-slideshow-row-img-field");
        $(".cmb2-id-ajax-pagination").addClass("hide-slideshow-pagination-field");
        
        $(".cmb2-id-filmstrip-width").addClass("show-cmb2-id-filmstrip-width");
        $(".cmb2-id-filmstrip-height").addClass("show-cmb2-id-filmstrip-height");
        $(".cmb2-id-filmstrip-thumbnail-margin").addClass("show-cmb2-id-filmstrip-thumbnail-margin");
        $(".cmb2-id-filmstrip-thumbnail-item").addClass("show-cmb2-id-filmstrip-thumbnail-item");
        
        $(".cmb2-id-per-page").addClass("hide-slideshow-perpage-field");
        
        $(".cmb2-id-carousel-width").removeClass("show-carousel-width-field");
        $(".cmb2-id-carousel-height").removeClass("show-carousel-height-field");
        $(".cmb2-id-owl-items-tablet").removeClass("show-cmb2-id-owl-items-tablet");
        $(".cmb2-id-owl-items-mobile").removeClass("show-cmb2-id-owl-items-mobile");
        $(".cmb2-id-carousel-link-behabour").removeClass("show-cmb2-id-carousel-link-behabour");
        
        
        $(".cmb2-id-owl-autoplay").addClass("show-cmb2-id-owl-autoplay");
        $(".cmb2-id-owl-loop").addClass("show-cmb2-id-owl-loop");
        $(".cmb2-id-owl-nav").addClass("show-cmb2-id-owl-nav");
        $(".cmb2-id-owl-dots").removeClass("show-cmb2-id-owl-dots");
        $(".cmb2-id-owl-autoplay-time").addClass("show-cmb2-id-owl-autoplay-time");
        
        $(".cmb2-id-owl-items").removeClass("show-cmb2-id-owl-items");
        $(".cmb2-id-owl-margin").removeClass("show-cmb2-id-owl-margin");    
        $(".cmb2-id-isotope-menu-items").removeClass("show-cmb2-id-isotope-menu-items");
    } else if($(this).val() == \'carousel\') {
        $(".cmb2-id-carousel-width").addClass("show-carousel-width-field");
        $(".cmb2-id-carousel-height").addClass("show-carousel-height-field");
        $(".cmb2-id-per-row-images").addClass("hide-slideshow-row-img-field");
        $(".cmb2-id-ajax-pagination").addClass("hide-slideshow-pagination-field");
        $(".cmb2-id-per-page").addClass("hide-slideshow-perpage-field");  
        $(".cmb2-id-carousel-link-behabour").addClass("show-cmb2-id-carousel-link-behabour");
        
        $(".cmb2-id-slideshow-width").removeClass("show-slideshow-width-field");
        $(".cmb2-id-slideshow-height").removeClass("show-slideshow-height-field");
        
        
        
        $(".cmb2-id-owl-autoplay").addClass("show-cmb2-id-owl-autoplay");
        $(".cmb2-id-owl-loop").addClass("show-cmb2-id-owl-loop");
        $(".cmb2-id-owl-nav").addClass("show-cmb2-id-owl-nav");
        $(".cmb2-id-owl-dots").addClass("show-cmb2-id-owl-dots");
        $(".cmb2-id-owl-autoplay-time").addClass("show-cmb2-id-owl-autoplay-time");
        $(".cmb2-id-owl-items-tablet").addClass("show-cmb2-id-owl-items-tablet");
        $(".cmb2-id-owl-items-mobile").addClass("show-cmb2-id-owl-items-mobile");
        
        $(".cmb2-id-owl-items").addClass("show-cmb2-id-owl-items");
        $(".cmb2-id-owl-margin").addClass("show-cmb2-id-owl-margin");
        
        $(".cmb2-id-filmstrip-width").removeClass("show-cmb2-id-filmstrip-width");
        $(".cmb2-id-filmstrip-height").removeClass("show-cmb2-id-filmstrip-height");
        $(".cmb2-id-filmstrip-thumbnail-margin").removeClass("show-cmb2-id-filmstrip-thumbnail-margin");
        $(".cmb2-id-filmstrip-thumbnail-item").removeClass("show-cmb2-id-filmstrip-thumbnail-item");
        $(".cmb2-id-isotope-menu-items").removeClass("show-cmb2-id-isotope-menu-items");
    } else if($(this).val() == \'isotope\') {
        $(".cmb2-id-carousel-width").removeClass("show-carousel-width-field");
        $(".cmb2-id-carousel-height").removeClass("show-carousel-height-field");
        $(".cmb2-id-slideshow-width").removeClass("show-slideshow-width-field");
        $(".cmb2-id-slideshow-height").removeClass("show-slideshow-height-field");
        $(".cmb2-id-per-row-images").removeClass("hide-slideshow-row-img-field");
        $(".cmb2-id-ajax-pagination").addClass("hide-slideshow-pagination-field");
        $(".cmb2-id-per-page").addClass("hide-slideshow-perpage-field");
        $(".cmb2-id-carousel-link-behabour").removeClass("show-cmb2-id-carousel-link-behabour");
        
        
        $(".cmb2-id-owl-autoplay").removeClass("show-cmb2-id-owl-autoplay");
        $(".cmb2-id-owl-loop").removeClass("show-cmb2-id-owl-loop");
        $(".cmb2-id-owl-nav").removeClass("show-cmb2-id-owl-nav");
        $(".cmb2-id-owl-dots").removeClass("show-cmb2-id-owl-dots");
        $(".cmb2-id-owl-autoplay-time").removeClass("show-cmb2-id-owl-autoplay-time");
        $(".cmb2-id-owl-items-tablet").removeClass("show-cmb2-id-owl-items-tablet");
        $(".cmb2-id-owl-items-mobile").removeClass("show-cmb2-id-owl-items-mobile");
        
        $(".cmb2-id-owl-items").removeClass("show-cmb2-id-owl-items");
        $(".cmb2-id-owl-margin").removeClass("show-cmb2-id-owl-margin");
        
        $(".cmb2-id-filmstrip-width").removeClass("show-cmb2-id-filmstrip-width");
        $(".cmb2-id-filmstrip-height").removeClass("show-cmb2-id-filmstrip-height");
        $(".cmb2-id-filmstrip-thumbnail-margin").removeClass("show-cmb2-id-filmstrip-thumbnail-margin");
        $(".cmb2-id-filmstrip-thumbnail-item").removeClass("show-cmb2-id-filmstrip-thumbnail-item");
        $(".cmb2-id-isotope-menu-items").addClass("show-cmb2-id-isotope-menu-items");
    } else {
        $(".cmb2-id-carousel-width").removeClass("show-carousel-width-field");
        $(".cmb2-id-carousel-height").removeClass("show-carousel-height-field");
        $(".cmb2-id-slideshow-width").removeClass("show-slideshow-width-field");
        $(".cmb2-id-slideshow-height").removeClass("show-slideshow-height-field");
        $(".cmb2-id-per-row-images").removeClass("hide-slideshow-row-img-field");
        $(".cmb2-id-ajax-pagination").removeClass("hide-slideshow-pagination-field");
        $(".cmb2-id-per-page").removeClass("hide-slideshow-perpage-field");
        $(".cmb2-id-carousel-link-behabour").removeClass("show-cmb2-id-carousel-link-behabour");
        
        
        $(".cmb2-id-owl-autoplay").removeClass("show-cmb2-id-owl-autoplay");
        $(".cmb2-id-owl-loop").removeClass("show-cmb2-id-owl-loop");
        $(".cmb2-id-owl-nav").removeClass("show-cmb2-id-owl-nav");
        $(".cmb2-id-owl-dots").removeClass("show-cmb2-id-owl-dots");
        $(".cmb2-id-owl-autoplay-time").removeClass("show-cmb2-id-owl-autoplay-time");
        $(".cmb2-id-owl-items-tablet").removeClass("show-cmb2-id-owl-items-tablet");
        $(".cmb2-id-owl-items-mobile").removeClass("show-cmb2-id-owl-items-mobile");
        
        $(".cmb2-id-owl-items").removeClass("show-cmb2-id-owl-items");
        $(".cmb2-id-owl-margin").removeClass("show-cmb2-id-owl-margin");
        
        $(".cmb2-id-filmstrip-width").removeClass("show-cmb2-id-filmstrip-width");
        $(".cmb2-id-filmstrip-height").removeClass("show-cmb2-id-filmstrip-height");
        $(".cmb2-id-filmstrip-thumbnail-margin").removeClass("show-cmb2-id-filmstrip-thumbnail-margin");
        $(".cmb2-id-filmstrip-thumbnail-item").removeClass("show-cmb2-id-filmstrip-thumbnail-item");
        $(".cmb2-id-isotope-menu-items").removeClass("show-cmb2-id-isotope-menu-items");
    }  
'; 
    
$slideshow_autoplay_logic = '
    if($(this).val() == \'true\') {
        $(".cmb2-id-owl-autoplay-time").addClass("show-cmb2-id-owl-autoplay-time");
    } else {
        $(".cmb2-id-owl-autoplay-time").removeClass("show-cmb2-id-owl-autoplay-time");
    }
';
    
$caption_field_logic = '
    if($(this).val() == \'true\') {
        $(".cmb2-id-gallery-caption-field").addClass("show-cmb2-id-gallery-caption-field");
    } else {
        $(".cmb2-id-gallery-caption-field").removeClass("show-cmb2-id-gallery-caption-field");
    }
';    
    
?>
            
 
            
$('.cmb2-id-owl-autoplay input[type=radio][name=owl_autoplay]:checked').each(function(){
    <?php echo $slideshow_autoplay_logic; ?>
});   
            
$(".cmb2-id-owl-autoplay input[type=radio][name=owl_autoplay]").change(function(){
    <?php echo $slideshow_autoplay_logic; ?>
});
            

$('.cmb2-id-gallery-caption input[type=radio][name=gallery_caption]:checked').each(function(){
    <?php echo $caption_field_logic; ?>
});   
            
$(".cmb2-id-gallery-caption input[type=radio][name=gallery_caption]").change(function(){
    <?php echo $caption_field_logic; ?>
});            
            
$('.cmb2-id-view-as input[type=radio][name=view_as]:checked').each(function(){
    <?php echo $slideshow_fields_logic; ?>
});   
            
$(".cmb2-id-view-as input[type=radio][name=view_as]").change(function(){
    <?php echo $slideshow_fields_logic; ?>
});
            



            
        });
    </script>   
   
    
    <style>
        .cmb2-id-carousel-width,
        .cmb2-id-carousel-height,
        .cmb2-id-slideshow-width,
        .cmb2-id-slideshow-height,
        .cmb2-id-owl-autoplay,
        .cmb2-id-owl-loop,
        .cmb2-id-owl-nav,
        .cmb2-id-owl-dots,
        .cmb2-id-owl-items,
        .cmb2-id-owl-margin,
        .cmb2-id-owl-autoplay-time,
        .cmb2-id-owl-items-tablet,
        .cmb2-id-owl-items-mobile,
        .cmb2-id-carousel-link-behabour,
        .cmb2-id-per-row-images.hide-slideshow-row-img-field,
        .cmb2-id-ajax-pagination.hide-slideshow-pagination-field,
        .cmb2-id-per-page.hide-slideshow-perpage-field,
        .cmb2-id-filmstrip-width,
        .cmb2-id-filmstrip-height,
        .cmb2-id-filmstrip-thumbnail-margin,
        .cmb2-id-gallery-caption-field,
        .cmb2-id-isotope-menu-items,
        .cmb2-id-filmstrip-thumbnail-item {display:none}
        
        .cmb2-id-carousel-width.show-carousel-width-field,
        .cmb2-id-carousel-height.show-carousel-height-field,
        .cmb2-id-carousel-link-behabour.show-cmb2-id-carousel-link-behabour,
        .cmb2-id-slideshow-width.show-slideshow-width-field,
        .cmb2-id-slideshow-height.show-slideshow-height-field,
        .cmb2-id-owl-autoplay.show-cmb2-id-owl-autoplay,
        .cmb2-id-owl-loop.show-cmb2-id-owl-loop,
        .cmb2-id-owl-nav.show-cmb2-id-owl-nav,
        .cmb2-id-owl-dots.show-cmb2-id-owl-dots,
        .cmb2-id-owl-items.show-cmb2-id-owl-items,
        .cmb2-id-owl-margin.show-cmb2-id-owl-margin,
        .cmb2-id-owl-autoplay-time.show-cmb2-id-owl-autoplay-time,
        .cmb2-id-owl-items-tablet.show-cmb2-id-owl-items-tablet,
        .cmb2-id-owl-items-mobile.show-cmb2-id-owl-items-mobile,
        .cmb2-id-filmstrip-width.show-cmb2-id-filmstrip-width,
        .cmb2-id-filmstrip-height.show-cmb2-id-filmstrip-height,
        .cmb2-id-filmstrip-thumbnail-margin.show-cmb2-id-filmstrip-thumbnail-margin,
        .cmb2-id-gallery-caption-field.show-cmb2-id-gallery-caption-field,
        .cmb2-id-isotope-menu-items.show-cmb2-id-isotope-menu-items,
        .cmb2-id-filmstrip-thumbnail-item.show-cmb2-id-filmstrip-thumbnail-item {display:block}
    </style>
	<?php
}