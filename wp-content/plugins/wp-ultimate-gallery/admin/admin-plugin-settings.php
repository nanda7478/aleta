<?php

class WUG_Settings_Page {
    
    //global $wug_option_page_array;

	private $key = 'wug_options';
    
	private $metabox_id = 'wug_option_metabox';
    
	protected $title = '';
    
	protected $options_page = '';
    
	private static $instance = null;
    
	private function __construct() {
		$this->title = __( 'WP Ultimate Gallery Options', 'wp-ultimate-gallery' );
	}
    
	public static function get_instance() {
		if( is_null( self::$instance ) ) {
			self::$instance = new self();
			self::$instance->hooks();
		}
		return self::$instance;
	}
    
	public function hooks() {
		add_action( 'admin_init', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'add_options_page' ) );
		add_action( 'cmb2_admin_init', array( $this, 'add_options_page_metabox' ) );
	}
    
	public function init() {
		register_setting( $this->key, $this->key );
	}
    
	public function add_options_page() {
        global $wug_option_page_array;
		$this->options_page = $wug_option_page_array = add_menu_page( 
            __('WP Ultimate Gallery Settings', 'wp-ultimate-gallery'), 
            $this->title, 
            'manage_options', 
            $this->key, 
            array( $this, 'admin_page_display' ) 
        );
		add_action( "admin_print_styles-{$this->options_page}", array( 'CMB2_hookup', 'enqueue_cmb_css' ) );
	}
    
	public function admin_page_display() {
		?>
		<div class="wrap cmb2-options-page wug-option-page-area <?php echo $this->key; ?>">
			<h2>WordPress Ultimate Gallery Settings</h2>
			<script> 
                jQuery(document).ready(function ($) {
                    
                    $("#enable_infinite1").attr("data-labelauty","Enable Infiniate Scroll");
                    $("#enable_infinite2").attr("data-labelauty","Disable Infiniate Scroll");
                    
                    $("#enable_lightbox1").attr("data-labelauty","Enable Lightbox");
                    $("#enable_lightbox2").attr("data-labelauty","Disable Lightbox");
                    
                    $("#enable_owl1").attr("data-labelauty","Enable Slideshow & Carousel");
                    $("#enable_owl2").attr("data-labelauty","Disable Slideshow & Carousel");
                    
                    $("#enable_maronry1").attr("data-labelauty","Enable Masonry");
                    $("#enable_maronry2").attr("data-labelauty","Disable Masonry");
                    
                    $("#enable_isotope1").attr("data-labelauty","Enable Isotope");
                    $("#enable_isotope2").attr("data-labelauty","Disable Isotope");
                    
                    $("[name='enable_infinite'], [name='enable_lightbox'], [name='enable_owl'], [name='enable_maronry'], [name='enable_isotope']").labelauty({ minimum_width: "155px" });
                });
            </script>
            
            <style>
                label[for="enable_infinite1"],
                label[for="enable_infinite2"],
                label[for="enable_lightbox1"],
                label[for="enable_lightbox2"],
                label[for="enable_owl1"],
                label[for="enable_owl2"],
                label[for="enable_maronry1"],
                label[for="enable_maronry2"],
                label[for="enable_isotope1"],
                label[for="enable_isotope2"]
                {display: none;}
                
.cmb2-radio-list.cmb2-list li {
  display: inline-block;
  margin-bottom: 0;
}
.labelauty-unchecked, .labelauty-checked {
  padding: 10px 10px 10px 30px;
  font-size: 13px;
}        
input.labelauty:checked + label[for="enable_infinite1"], input.labelauty:checked + label[for="enable_infinite1"]:hover,
input.labelauty:checked + label[for="enable_maronry1"], input.labelauty:checked + label[for="enable_maronry1"]:hover,
input.labelauty:checked + label[for="enable_owl1"], input.labelauty:checked + label[for="enable_owl1"]:hover,
input.labelauty:checked + label[for="enable_lightbox1"], input.labelauty:checked + label[for="enable_lightbox1"]:hover,
input.labelauty:checked + label[for="enable_isotope1"], input.labelauty:checked + label[for="enable_isotope1"]:hover
{
  background-color: #3ed37d;
}      
input.labelauty:checked + label[for="enable_infinite2"], input.labelauty:checked + label[for="enable_infinite2"]:hover,
input.labelauty:checked + label[for="enable_maronry2"], input.labelauty:checked + label[for="enable_maronry2"]:hover,
input.labelauty:checked + label[for="enable_owl2"], input.labelauty:checked + label[for="enable_owl2"]:hover,
input.labelauty:checked + label[for="enable_lightbox2"], input.labelauty:checked + label[for="enable_lightbox2"]:hover,
input.labelauty:checked + label[for="enable_isotope2"], input.labelauty:checked + label[for="enable_isotope2"]:hover
{
  background-color: #e74c3c;
}    
                input.labelauty:checked + label:hover {opacity:.8}                
            </style>
			
			<p><span style="border: 1px solid #ebccd1; color: #a94442; background: #f2dede; display: inline-block; padding: 5px 15px;"><strong>Warning:</strong> This settings applies on all gallery created by <strong>THIS</strong> plugin!</span></p>
			<?php cmb2_metabox_form( $this->metabox_id, $this->key ); ?>
		</div>
		<?php
	}
    
	function add_options_page_metabox() {
		add_action( "cmb2_save_options-page_fields_{$this->metabox_id}", array( $this, 'settings_notices' ), 10, 2 );

		$cmb = new_cmb2_box( array(
			'id'         => $this->metabox_id,
			'hookup'     => false,
			'cmb_styles' => false,
			'show_on'    => array(
				'key'   => 'options-page',
				'value' => array( $this->key, )
			),
		) );
        
		$cmb->add_field( array(
			'name' => __( 'Lightbox', 'wp-ultimate-gallery' ),
			'desc' => __( 'If you want to enable lightbox, enable it here. If you disable, it will stop loading magnific popup files from plugin.', 'wp-ultimate-gallery' ),
			'id'   => 'enable_lightbox',
			'type' => 'radio',
			'default' => '1',
			'options' => array(
                '1' => __('Enable Lightbox', 'wp-ultimate-gallery'),
                '2' => __('Disable Lightbox', 'wp-ultimate-gallery'),
            ),
		) );

		$cmb->add_field( array(
			'name' => __( 'Slideshow & Carousel', 'wp-ultimate-gallery' ),
			'desc' => __( 'If you want to enable slideshow & carousel, enable it here. If you disable, it will stop loading owl carousel files from plugin.', 'wp-ultimate-gallery' ),
			'id'   => 'enable_owl',
			'type' => 'radio',
			'default' => '1',
			'options' => array(
                '1' => __('Enable Slideshow & Carousel', 'wp-ultimate-gallery'),
                '2' => __('Disable Slideshow & Carousel', 'wp-ultimate-gallery'),
            ),
		) );

		$cmb->add_field( array(
			'name' => __( 'Infinite Scroll', 'wp-ultimate-gallery' ),
			'desc' => __( 'If you want to enable infinite scroll, enable it here. If you disable, it will stop loading infinite scroll files from plugin.', 'wp-ultimate-gallery' ),
			'id'   => 'enable_infinite',
			'type' => 'radio',
			'default' => '1',
			'options' => array(
                '1' => __('Enable Infinite Scroll', 'wp-ultimate-gallery'),
                '2' => __('Disable Infinite Scroll', 'wp-ultimate-gallery'),
            ),
		) );

		$cmb->add_field( array(
			'name' => __( 'Masonry', 'wp-ultimate-gallery' ),
			'desc' => __( 'If you want to enable masonry, enable it here. If you disable, it will not enqueue masonry script from WordPress. <br/><b>BTW</b>, if other plugin enqueue masonry script, it will remain active.', 'wp-ultimate-gallery' ),
			'id'   => 'enable_maronry',
			'type' => 'radio',
			'default' => '2',
			'options' => array(
                '1' => __('Enable Masonry', 'wp-ultimate-gallery'),
                '2' => __('Disable Masonry', 'wp-ultimate-gallery'),
            ),
		) );

		$cmb->add_field( array(
			'name' => __( 'Isotope', 'wp-ultimate-gallery' ),
			'desc' => __( 'If you want to enable isotope, enable it here. If you disable, it will not enqueue masonry script from WordPress.', 'wp-ultimate-gallery' ),
			'id'   => 'enable_isotope',
			'type' => 'radio',
			'default' => '1',
			'options' => array(
                '1' => __('Enable Isotope', 'wp-ultimate-gallery'),
                '2' => __('Disable Isotope', 'wp-ultimate-gallery'),
            ),
		) );

	}
    
	public function settings_notices( $object_id, $updated ) {
		if ( $object_id !== $this->key || empty( $updated ) ) {
			return;
		}

		add_settings_error( $this->key . '-notices', '', __( 'Settings updated.', 'wp-ultimate-gallery' ), 'updated' );
		settings_errors( $this->key . '-notices' );
	}
    
	public function __get( $field ) {
		// Allowed fields to retrieve
		if ( in_array( $field, array( 'key', 'metabox_id', 'title', 'options_page' ), true ) ) {
			return $this->{$field};
		}

		throw new Exception( 'Invalid property: ' . $field );
	}

}

function wug_settings_page() {
	return WUG_Settings_Page::get_instance();
}

function wug_get_option( $key = '' ) {
	return cmb2_get_option( wug_settings_page()->key, $key );
}

wug_settings_page();

// Hiding menu from wp menu
function remove_menus(){
    remove_menu_page( 'wug_options' );
}
add_action( 'admin_menu', 'remove_menus' );

// Adding redirecting menu on gallery CPT
add_action('admin_menu', 'wug_custom_submenu_page');
function wug_custom_submenu_page() {
    add_submenu_page(
        'edit.php?post_type=wp-ultimate-gallery',
        __('WP Ultimate Gallery Settings', 'wp-ultimate-gallery'),
        __('Gallery Settings', 'wp-ultimate-gallery'),
        'manage_options',
        'gallery-settings',
        'wp_ultimate_gallery_fake_page' );
}

// Set redirect function
function wp_ultimate_gallery_fake_page() {
   ?>
   <p><?php __('Please wait ...', 'wp-ultimate-gallery'); ?></p>
   <script>
       window.location.replace("admin.php?page=wug_options");
    </script>
   <?php
}


function wug_option_scripts($hook) {
 
	global $wug_option_page_array;
 
	if( $hook != $wug_option_page_array ) 
		return;
 
	wp_enqueue_script( 'bootstrap-switch-js', plugins_url( 'admin/assets/js/jquery-labelauty.js' , dirname(__FILE__) ), array('jquery'), '1.0', false );
	wp_enqueue_style( 'bootstrap-switch', plugins_url( 'admin/assets/css/jquery-labelauty.css' , dirname(__FILE__) ) );
}
add_action('admin_enqueue_scripts', 'wug_option_scripts');