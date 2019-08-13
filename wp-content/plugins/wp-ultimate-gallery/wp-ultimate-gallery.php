<?php
/*
Plugin Name: WordPress Ultimate Gallery
Plugin URI: http://wpultimategallery.com/
Description: This plugin will multi style gallery in your wordpress site. 
Author: WordPress Ultimate Gallery
Author URI: http://wpultimategallery.com
Version: 1.7
*/

/* Translate direction */
load_plugin_textdomain( 'wp-ultimate-gallery', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

// Registering plugin assets
require_once('admin/plugin-assets.php');

// Adding media extra fields
require_once('admin/media-extra-fields.php');

// Admin shortcode generator on gallery list
require_once('admin/admin-shortcode-generator.php');

// Registering gallery custom post
require_once('admin/gallery-cpt.php');

// Including CMB2
require_once('libs/cmb2/init.php');

// CMB2 metabox condtions
require_once('libs/cmb2-conditions/cmb-conditions.php');

// Register gallery metabox fields
require_once('admin/gallery-metabox.php');

// Including image resizer
require_once('libs/aqua-image-resizer/aq_resizer.php');

// Gallery custom message when save or update gallery
require_once('admin/admin-gallery-custom-messages.php');

// Registering gallery shortcode
require_once('admin/gallery-shortcode.php');

// Plugin option panel
require_once('admin/admin-plugin-settings.php');