<?php
/**
 * Checkout login form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}
?>

<div class="login-register-button">
<div class="container">
<div class="row">
<div class="col-sm-6">
<p>Already have an account? Login below or continue to check out as a guest</p>
<div class="login-regi"> <a class="btn-2" href="<?php echo site_url();?>/my-account">Login/register</a> </div>
</div>
</div></div></div>


<?php
// $info_message  = apply_filters( 'woocommerce_checkout_login_message', __( 'Returning customer?', 'woocommerce' ) );
// $info_message .= ' <a href="'.site_url().'/my-account/" class="showlogin">' . __( 'Login/register', 'woocommerce' ) . '</a>';
// wc_print_notice( $info_message, 'notice' );

// woocommerce_login_form(
// 	array(
// 		'message'  => __( 'If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing &amp; Shipping section.', 'woocommerce' ),
// 		'redirect' => wc_get_page_permalink( 'checkout' ),
// 		'hidden'   => true,
// 	)
// );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
