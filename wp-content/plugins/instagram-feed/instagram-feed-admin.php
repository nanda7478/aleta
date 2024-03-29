<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function sb_instagram_menu() {
    add_menu_page(
        __( 'Instagram Feed', 'instagram-feed' ),
        __( 'Instagram Feed', 'instagram-feed' ),
        'manage_options',
        'sb-instagram-feed',
        'sb_instagram_settings_page'
    );
    add_submenu_page(
        'sb-instagram-feed',
        __( 'Settings', 'instagram-feed' ),
        __( 'Settings', 'instagram-feed' ),
        'manage_options',
        'sb-instagram-feed',
        'sb_instagram_settings_page'
    );
}
add_action('admin_menu', 'sb_instagram_menu');

function sb_instagram_settings_page() {

    //Hidden fields
    $sb_instagram_settings_hidden_field = 'sb_instagram_settings_hidden_field';
    $sb_instagram_configure_hidden_field = 'sb_instagram_configure_hidden_field';
    $sb_instagram_customize_hidden_field = 'sb_instagram_customize_hidden_field';

    //Declare defaults
    $sb_instagram_settings_defaults = array(
        'sb_instagram_at'                   => '',
        'sb_instagram_user_id'              => '',
        'sb_instagram_preserve_settings'    => '',
        'sb_instagram_ajax_theme'           => false,
        'sb_instagram_cache_time'           => 1,
        'sb_instagram_cache_time_unit'      => 'hours',
        'sb_instagram_width'                => '100',
        'sb_instagram_width_unit'           => '%',
        'sb_instagram_feed_width_resp'      => false,
        'sb_instagram_height'               => '',
        'sb_instagram_num'                  => '20',
        'sb_instagram_height_unit'          => '',
        'sb_instagram_cols'                 => '4',
        'sb_instagram_disable_mobile'       => false,
        'sb_instagram_image_padding'        => '5',
        'sb_instagram_image_padding_unit'   => 'px',
        'sb_instagram_sort'                 => 'none',
        'sb_instagram_background'           => '',
        'sb_instagram_show_btn'             => true,
        'sb_instagram_btn_background'       => '',
        'sb_instagram_btn_text_color'       => '',
        'sb_instagram_btn_text'             => __( 'Load More...', 'instagram-feed' ),
        'sb_instagram_image_res'            => 'auto',
        //Header
        'sb_instagram_show_header'          => true,
        'sb_instagram_header_color'         => '',
        //Follow button
        'sb_instagram_show_follow_btn'      => true,
        'sb_instagram_folow_btn_background' => '',
        'sb_instagram_follow_btn_text_color' => '',
        'sb_instagram_follow_btn_text'      => __( 'Follow on Instagram', 'instagram-feed' ),
        //Misc
        'sb_instagram_custom_css'           => '',
        'sb_instagram_custom_js'            => '',
        'sb_instagram_cron'                 => 'no',
        'check_api'         => false,
        'sb_instagram_backup' => true,
        'enqueue_css_in_shortcode' => false,
        'sb_instagram_disable_mob_swipe' => false,
        'sbi_font_method' => 'svg',
        'sb_instagram_disable_awesome'      => false
    );
    //Save defaults in an array
    $options = wp_parse_args(get_option('sb_instagram_settings'), $sb_instagram_settings_defaults);
    update_option( 'sb_instagram_settings', $options );

    //Set the page variables
    $sb_instagram_at = $options[ 'sb_instagram_at' ];
    $sb_instagram_user_id = $options[ 'sb_instagram_user_id' ];
    $sb_instagram_preserve_settings = $options[ 'sb_instagram_preserve_settings' ];
    $sb_instagram_ajax_theme = $options[ 'sb_instagram_ajax_theme' ];
	$sb_instagram_cache_time = $options[ 'sb_instagram_cache_time' ];
	$sb_instagram_cache_time_unit = $options[ 'sb_instagram_cache_time_unit' ];

	$sb_instagram_width = $options[ 'sb_instagram_width' ];
    $sb_instagram_width_unit = $options[ 'sb_instagram_width_unit' ];
    $sb_instagram_feed_width_resp = $options[ 'sb_instagram_feed_width_resp' ];
    $sb_instagram_height = $options[ 'sb_instagram_height' ];
    $sb_instagram_height_unit = $options[ 'sb_instagram_height_unit' ];
    $sb_instagram_num = $options[ 'sb_instagram_num' ];
    $sb_instagram_cols = $options[ 'sb_instagram_cols' ];
    $sb_instagram_disable_mobile = $options[ 'sb_instagram_disable_mobile' ];
    $sb_instagram_image_padding = $options[ 'sb_instagram_image_padding' ];
    $sb_instagram_image_padding_unit = $options[ 'sb_instagram_image_padding_unit' ];
    $sb_instagram_sort = $options[ 'sb_instagram_sort' ];
    $sb_instagram_background = $options[ 'sb_instagram_background' ];
    $sb_instagram_show_btn = $options[ 'sb_instagram_show_btn' ];
    $sb_instagram_btn_background = $options[ 'sb_instagram_btn_background' ];
    $sb_instagram_btn_text_color = $options[ 'sb_instagram_btn_text_color' ];
    $sb_instagram_btn_text = $options[ 'sb_instagram_btn_text' ];
    $sb_instagram_image_res = $options[ 'sb_instagram_image_res' ];
    //Header
    $sb_instagram_show_header = $options[ 'sb_instagram_show_header' ];
    $sb_instagram_show_bio = isset( $options[ 'sb_instagram_show_bio' ] ) ? $options[ 'sb_instagram_show_bio' ] : true;
    $sb_instagram_header_color = $options[ 'sb_instagram_header_color' ];
    //Follow button
    $sb_instagram_show_follow_btn = $options[ 'sb_instagram_show_follow_btn' ];
    $sb_instagram_folow_btn_background = $options[ 'sb_instagram_folow_btn_background' ];
    $sb_instagram_follow_btn_text_color = $options[ 'sb_instagram_follow_btn_text_color' ];
    $sb_instagram_follow_btn_text = $options[ 'sb_instagram_follow_btn_text' ];
    //Misc
    $sb_instagram_custom_css = $options[ 'sb_instagram_custom_css' ];
    $sb_instagram_custom_js = $options[ 'sb_instagram_custom_js' ];
	$sb_instagram_cron = $options[ 'sb_instagram_cron' ];
	$check_api = $options[ 'check_api' ];
	$sb_instagram_backup = $options[ 'sb_instagram_backup' ];
	$sbi_font_method = $options[ 'sbi_font_method' ];
	$sb_instagram_disable_awesome = $options[ 'sb_instagram_disable_awesome' ];


    //Check nonce before saving data
    if ( ! isset( $_POST['sb_instagram_settings_nonce'] ) || ! wp_verify_nonce( $_POST['sb_instagram_settings_nonce'], 'sb_instagram_saving_settings' ) ) {
        //Nonce did not verify
    } else {
        // See if the user has posted us some information. If they did, this hidden field will be set to 'Y'.
        if( isset($_POST[ $sb_instagram_settings_hidden_field ]) && $_POST[ $sb_instagram_settings_hidden_field ] == 'Y' ) {

            if( isset($_POST[ $sb_instagram_configure_hidden_field ]) && $_POST[ $sb_instagram_configure_hidden_field ] == 'Y' ) {

                $sb_instagram_at = sanitize_text_field( $_POST[ 'sb_instagram_at' ] );
                $sb_instagram_user_id = sanitize_text_field( $_POST[ 'sb_instagram_user_id' ] );

                isset($_POST[ 'sb_instagram_preserve_settings' ]) ? $sb_instagram_preserve_settings = sanitize_text_field( $_POST[ 'sb_instagram_preserve_settings' ] ) : $sb_instagram_preserve_settings = '';
                isset($_POST[ 'sb_instagram_ajax_theme' ]) ? $sb_instagram_ajax_theme = sanitize_text_field( $_POST[ 'sb_instagram_ajax_theme' ] ) : $sb_instagram_ajax_theme = '';
	            isset($_POST[ 'sb_instagram_cache_time' ]) ? $sb_instagram_cache_time = sanitize_text_field( $_POST[ 'sb_instagram_cache_time' ] ) : $sb_instagram_cache_time = '';
	            isset($_POST[ 'sb_instagram_cache_time_unit' ]) ? $sb_instagram_cache_time_unit = sanitize_text_field( $_POST[ 'sb_instagram_cache_time_unit' ] ) : $sb_instagram_cache_time_unit = '';

                $options[ 'sb_instagram_at' ] = $sb_instagram_at;
                $options[ 'sb_instagram_user_id' ] = $sb_instagram_user_id;
                $options[ 'sb_instagram_preserve_settings' ] = $sb_instagram_preserve_settings;
                $options[ 'sb_instagram_ajax_theme' ] = $sb_instagram_ajax_theme;

	            $options[ 'sb_instagram_cache_time' ] = $sb_instagram_cache_time;
	            $options[ 'sb_instagram_cache_time_unit' ] = $sb_instagram_cache_time_unit;

	            //Delete all SBI transients
	            global $wpdb;
	            $table_name = $wpdb->prefix . "options";
	            $wpdb->query( "
                    DELETE
                    FROM $table_name
                    WHERE `option_name` LIKE ('%\_transient\_sbi\_%')
                    " );
	            $wpdb->query( "
                    DELETE
                    FROM $table_name
                    WHERE `option_name` LIKE ('%\_transient\_timeout\_sbi\_%')
                    " );
	            $wpdb->query( "
			        DELETE
			        FROM $table_name
			        WHERE `option_name` LIKE ('%\_transient\_&sbi\_%')
			        " );
	            $wpdb->query( "
			        DELETE
			        FROM $table_name
			        WHERE `option_name` LIKE ('%\_transient\_timeout\_&sbi\_%')
			        " );
            } //End config tab post

            if( isset($_POST[ $sb_instagram_customize_hidden_field ]) && $_POST[ $sb_instagram_customize_hidden_field ] == 'Y' ) {
                
                //Validate and sanitize width field
                $safe_width = intval( sanitize_text_field( $_POST['sb_instagram_width'] ) );
                if ( ! $safe_width ) $safe_width = '';
                if ( strlen( $safe_width ) > 4 ) $safe_width = substr( $safe_width, 0, 4 );
                $sb_instagram_width = $safe_width;

                $sb_instagram_width_unit = sanitize_text_field( $_POST[ 'sb_instagram_width_unit' ] );
                isset($_POST[ 'sb_instagram_feed_width_resp' ]) ? $sb_instagram_feed_width_resp = sanitize_text_field( $_POST[ 'sb_instagram_feed_width_resp' ] ) : $sb_instagram_feed_width_resp = '';

                //Validate and sanitize height field
                $safe_height = intval( sanitize_text_field( $_POST['sb_instagram_height'] ) );
                if ( ! $safe_height ) $safe_height = '';
                if ( strlen( $safe_height ) > 4 ) $safe_height = substr( $safe_height, 0, 4 );
                $sb_instagram_height = $safe_height;

                $sb_instagram_height_unit = sanitize_text_field( $_POST[ 'sb_instagram_height_unit' ] );

                //Validate and sanitize number of photos field
                $safe_num = intval( sanitize_text_field( $_POST['sb_instagram_num'] ) );
                if ( ! $safe_num ) $safe_num = '';
                if ( strlen( $safe_num ) > 4 ) $safe_num = substr( $safe_num, 0, 4 );
                $sb_instagram_num = $safe_num;

                $sb_instagram_cols = sanitize_text_field( $_POST[ 'sb_instagram_cols' ] );
                isset($_POST[ 'sb_instagram_disable_mobile' ]) ? $sb_instagram_disable_mobile = sanitize_text_field( $_POST[ 'sb_instagram_disable_mobile' ] ) : $sb_instagram_disable_mobile = '';

                //Validate and sanitize padding field
                $safe_padding = intval( sanitize_text_field( $_POST['sb_instagram_image_padding'] ) );
                if ( ! $safe_padding ) $safe_padding = '';
                if ( strlen( $safe_padding ) > 4 ) $safe_padding = substr( $safe_padding, 0, 4 );
                $sb_instagram_image_padding = $safe_padding;

                $sb_instagram_image_padding_unit = sanitize_text_field( $_POST[ 'sb_instagram_image_padding_unit' ] );
                $sb_instagram_sort = sanitize_text_field( $_POST[ 'sb_instagram_sort' ] );
                $sb_instagram_background = sanitize_text_field( $_POST[ 'sb_instagram_background' ] );
                isset($_POST[ 'sb_instagram_show_btn' ]) ? $sb_instagram_show_btn = sanitize_text_field( $_POST[ 'sb_instagram_show_btn' ] ) : $sb_instagram_show_btn = '';
                $sb_instagram_btn_background = sanitize_text_field( $_POST[ 'sb_instagram_btn_background' ] );
                $sb_instagram_btn_text_color = sanitize_text_field( $_POST[ 'sb_instagram_btn_text_color' ] );
	            $sb_instagram_btn_text = sanitize_text_field( $_POST[ 'sb_instagram_btn_text' ] );
                $sb_instagram_image_res = sanitize_text_field( $_POST[ 'sb_instagram_image_res' ] );
                //Header
                isset($_POST[ 'sb_instagram_show_header' ]) ? $sb_instagram_show_header = sanitize_text_field( $_POST[ 'sb_instagram_show_header' ] ) : $sb_instagram_show_header = '';
                isset($_POST[ 'sb_instagram_show_bio' ]) ? $sb_instagram_show_bio = sanitize_text_field( $_POST[ 'sb_instagram_show_bio' ] ) : $sb_instagram_show_bio = '';

                $sb_instagram_header_color = sanitize_text_field( $_POST[ 'sb_instagram_header_color' ] );
                //Follow button
                isset($_POST[ 'sb_instagram_show_follow_btn' ]) ? $sb_instagram_show_follow_btn = sanitize_text_field( $_POST[ 'sb_instagram_show_follow_btn' ] ) : $sb_instagram_show_follow_btn = '';
                $sb_instagram_folow_btn_background = sanitize_text_field( $_POST[ 'sb_instagram_folow_btn_background' ] );
                $sb_instagram_follow_btn_text_color = sanitize_text_field( $_POST[ 'sb_instagram_follow_btn_text_color' ] );
                $sb_instagram_follow_btn_text = sanitize_text_field( $_POST[ 'sb_instagram_follow_btn_text' ] );
                //Misc
                $sb_instagram_custom_css = $_POST[ 'sb_instagram_custom_css' ];
                $sb_instagram_custom_js = $_POST[ 'sb_instagram_custom_js' ];
	            if (isset($_POST[ 'sb_instagram_cron' ]) ) $sb_instagram_cron = $_POST[ 'sb_instagram_cron' ];
	            isset($_POST[ 'check_api' ]) ? $check_api = $_POST[ 'check_api' ] : $check_api = '';
	            isset($_POST[ 'sb_instagram_backup' ]) ? $sb_instagram_backup = $_POST[ 'sb_instagram_backup' ] : $sb_instagram_backup = '';
	            isset($_POST[ 'sbi_font_method' ]) ? $sbi_font_method = $_POST[ 'sbi_font_method' ] : $sbi_font_method = 'svg';
	            isset($_POST[ 'sb_instagram_disable_awesome' ]) ? $sb_instagram_disable_awesome = sanitize_text_field( $_POST[ 'sb_instagram_disable_awesome' ] ) : $sb_instagram_disable_awesome = '';

                $options[ 'sb_instagram_width' ] = $sb_instagram_width;
                $options[ 'sb_instagram_width_unit' ] = $sb_instagram_width_unit;
                $options[ 'sb_instagram_feed_width_resp' ] = $sb_instagram_feed_width_resp;
                $options[ 'sb_instagram_height' ] = $sb_instagram_height;
                $options[ 'sb_instagram_height_unit' ] = $sb_instagram_height_unit;
                $options[ 'sb_instagram_num' ] = $sb_instagram_num;
                $options[ 'sb_instagram_cols' ] = $sb_instagram_cols;
                $options[ 'sb_instagram_disable_mobile' ] = $sb_instagram_disable_mobile;
                $options[ 'sb_instagram_image_padding' ] = $sb_instagram_image_padding;
                $options[ 'sb_instagram_image_padding_unit' ] = $sb_instagram_image_padding_unit;
                $options[ 'sb_instagram_sort' ] = $sb_instagram_sort;
                $options[ 'sb_instagram_background' ] = $sb_instagram_background;
                $options[ 'sb_instagram_show_btn' ] = $sb_instagram_show_btn;
                $options[ 'sb_instagram_btn_background' ] = $sb_instagram_btn_background;
                $options[ 'sb_instagram_btn_text_color' ] = $sb_instagram_btn_text_color;
	            $options[ 'sb_instagram_btn_text' ] = $sb_instagram_btn_text;
                $options[ 'sb_instagram_image_res' ] = $sb_instagram_image_res;
                //Header
                $options[ 'sb_instagram_show_header' ] = $sb_instagram_show_header;
                $options[ 'sb_instagram_show_bio' ] = $sb_instagram_show_bio;
                $options[ 'sb_instagram_header_color' ] = $sb_instagram_header_color;
                //Follow button
                $options[ 'sb_instagram_show_follow_btn' ] = $sb_instagram_show_follow_btn;
                $options[ 'sb_instagram_folow_btn_background' ] = $sb_instagram_folow_btn_background;
                $options[ 'sb_instagram_follow_btn_text_color' ] = $sb_instagram_follow_btn_text_color;
                $options[ 'sb_instagram_follow_btn_text' ] = $sb_instagram_follow_btn_text;
                //Misc
                $options[ 'sb_instagram_custom_css' ] = $sb_instagram_custom_css;
                $options[ 'sb_instagram_custom_js' ] = $sb_instagram_custom_js;
	            $options[ 'sb_instagram_cron' ] = $sb_instagram_cron;
	            $options[ 'check_api' ] = $check_api;
	            $options['sb_instagram_backup'] = $sb_instagram_backup;
	            $options['sbi_font_method'] = $sbi_font_method;
	            $options[ 'sb_instagram_disable_awesome' ] = $sb_instagram_disable_awesome;

	            //Delete all SBI transients
	            global $wpdb;
	            $table_name = $wpdb->prefix . "options";
	            $wpdb->query( "
                    DELETE
                    FROM $table_name
                    WHERE `option_name` LIKE ('%\_transient\_sbi\_%')
                    " );
	            $wpdb->query( "
                    DELETE
                    FROM $table_name
                    WHERE `option_name` LIKE ('%\_transient\_timeout\_sbi\_%')
                    " );
	            $wpdb->query( "
			        DELETE
			        FROM $table_name
			        WHERE `option_name` LIKE ('%\_transient\_&sbi\_%')
			        " );
	            $wpdb->query( "
			        DELETE
			        FROM $table_name
			        WHERE `option_name` LIKE ('%\_transient\_timeout\_&sbi\_%')
			        " );

	            if( $sb_instagram_cron == 'no' ) wp_clear_scheduled_hook('sb_instagram_cron_job');

	            //Run cron when Misc settings are saved
	            if( $sb_instagram_cron == 'yes' ){
		            //Clear the existing cron event
		            wp_clear_scheduled_hook('sb_instagram_cron_job');

		            $sb_instagram_cache_time = $options[ 'sb_instagram_cache_time' ];
		            $sb_instagram_cache_time_unit = $options[ 'sb_instagram_cache_time_unit' ];

		            //Set the event schedule based on what the caching time is set to
		            $sb_instagram_cron_schedule = 'hourly';
		            if( $sb_instagram_cache_time_unit == 'hours' && $sb_instagram_cache_time > 5 ) $sb_instagram_cron_schedule = 'twicedaily';
		            if( $sb_instagram_cache_time_unit == 'days' ) $sb_instagram_cron_schedule = 'daily';

		            wp_schedule_event(time(), $sb_instagram_cron_schedule, 'sb_instagram_cron_job');

		            sb_instagram_clear_page_caches();
	            }
                
            } //End customize tab post
            
            //Save the settings to the settings array
            update_option( 'sb_instagram_settings', $options );

        ?>
        <div class="updated"><p><strong><?php _e( 'Settings saved.', 'instagram-feed' ); ?></strong></p></div>
        <?php } ?>

    <?php } //End nonce check ?>


    <div id="sbi_admin" class="wrap">

        <div id="header">
            <h1><?php _e( 'Instagram Feed', 'instagram-feed' ); ?></h1>
        </div>
    
        <form name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $sb_instagram_settings_hidden_field; ?>" value="Y">
            <?php wp_nonce_field( 'sb_instagram_saving_settings', 'sb_instagram_settings_nonce' ); ?>

            <?php $sbi_active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'configure'; ?>
            <h2 class="nav-tab-wrapper">
                <a href="?page=sb-instagram-feed&amp;tab=configure" class="nav-tab <?php echo $sbi_active_tab == 'configure' ? 'nav-tab-active' : ''; ?>"><?php _e( '1. Configure', 'instagram-feed' ); ?></a>
                <a href="?page=sb-instagram-feed&amp;tab=customize" class="nav-tab <?php echo $sbi_active_tab == 'customize' ? 'nav-tab-active' : ''; ?>"><?php _e( '2. Customize', 'instagram-feed' ); ?></a>
                <a href="?page=sb-instagram-feed&amp;tab=display"   class="nav-tab <?php echo $sbi_active_tab == 'display'   ? 'nav-tab-active' : ''; ?>"><?php _e( '3. Display Your Feed', 'instagram-feed' ); ?></a>
                <a href="?page=sb-instagram-feed&amp;tab=support"   class="nav-tab <?php echo $sbi_active_tab == 'support'   ? 'nav-tab-active' : ''; ?>"><?php _e( 'Support', 'instagram-feed' ); ?></a>
            </h2>

            <?php if( $sbi_active_tab == 'configure' ) { //Start Configure tab ?>
            <input type="hidden" name="<?php echo $sb_instagram_configure_hidden_field; ?>" value="Y">

            <table class="form-table">
                <tbody>
                    <h3><?php _e( 'Configure', 'instagram-feed' ); ?></h3>

                    <div id="sbi_config">
                        <!-- <a href="https://instagram.com/oauth/authorize/?client_id=1654d0c81ad04754a898d89315bec227&redirect_uri=https://smashballoon.com/instagram-feed/instagram-token-plugin/?return_uri=<?php echo admin_url('admin.php?page=sb-instagram-feed'); ?>&response_type=token" class="sbi_admin_btn"><?php _e( 'Log in and get my Access Token and User ID', 'instagram-feed' ); ?></a> -->
                        <a href="https://instagram.com/oauth/authorize/?client_id=3a81a9fa2a064751b8c31385b91cc25c&scope=basic+public_content&redirect_uri=https://smashballoon.com/instagram-feed/instagram-token-plugin/?return_uri=<?php echo admin_url('admin.php?page=sb-instagram-feed'); ?>&response_type=token" class="sbi_admin_btn"><?php _e( 'Log in and get my Access Token and User ID', 'instagram-feed' ); ?></a>
                        <a href="https://smashballoon.com/instagram-feed/token/" target="_blank" style="position: relative; top: 14px; left: 15px;"><?php _e( 'Button not working?', 'instagram-feed' ); ?></a>
                    </div>
                    
                    <tr valign="top">
                        <th scope="row"><label><?php _e( 'Access Token', 'instagram-feed' ); ?></label></th>
                        <td>
                            <input name="sb_instagram_at" id="sb_instagram_at" type="text" value="<?php echo esc_attr( $sb_instagram_at ); ?>" size="60" maxlength="60" placeholder="Click button above to get your Access Token" />
                            &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("In order to display your photos you need an Access Token from Instagram. To get yours, simply click the button above and log into Instagram. You can also use the button on <a href='https://smashballoon.com/instagram-feed/token/' target='_blank'>this page</a>.", 'instagram-feed'); ?></p>
                        </td>
                    </tr>

                    <tr valign="top" class="sbi_feed_type">
                        <th scope="row"><label><?php _e('Show Photos From:', 'instagram-feed'); ?></label><code class="sbi_shortcode"> type
                            Eg: type=user id=12986477
                        </code></th>
                        <td>
                            <span>
                                <?php $sb_instagram_type = 'user'; ?>
                                <input type="radio" name="sb_instagram_type" id="sb_instagram_type_user" value="user" <?php if($sb_instagram_type == "user") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_user"><?php _e( 'User ID(s):', 'instagram-feed' ); ?></label>
                                <input name="sb_instagram_user_id" id="sb_instagram_user_id" type="text" value="<?php echo esc_attr( $sb_instagram_user_id ); ?>" size="25" />
                                &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed' ); ?></a>
                                <p class="sbi_tooltip"><?php _e("These are the IDs of the Instagram accounts you want to display photos from. To get your ID simply click on the button above and log into Instagram.<br /><br />You can also display photos from other peoples Instagram accounts. To find their User ID you can use <a href='https://smashballoon.com/instagram-feed/find-instagram-user-id/' target='_blank'>this tool</a>. You can separate multiple IDs using commas.", 'instagram-feed'); ?></p><br />
                            </span>

                            <div class="sbi_notice sbi_user_id_error">
                                <?php _e("<p>Please be sure to enter your numeric <b>User ID</b> and not your Username. You can find your User ID by clicking the blue Instagram Login button above, or by entering your username into <a href='https://smashballoon.com/instagram-feed/find-instagram-user-id/' target='_blank'>this tool</a>.</p>", 'instagram-feed'); ?>
                            </div>
                            
                            <span class="sbi_pro sbi_row">
                                <input disabled type="radio" name="sb_instagram_type" id="sb_instagram_type_hashtag" value="hashtag" <?php if($sb_instagram_type == "hashtag") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_hashtag"><?php _e( 'Hashtag:', 'instagram-feed' ); ?></label>
                                <input readonly type="text" size="25" />
                                &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed' ); ?></a><span class="sbi_note"> - <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to show posts by Hashtag</a></span>
                                <p class="sbi_tooltip"><?php _e( 'Display posts from a specific hashtag instead of from a user', 'instagram-feed' ); ?></p>
                            </span>

                            <div class="sbi_pro sbi_row">
                                <input disabled type="radio" name="sb_instagram_type" id="sb_instagram_type_self_likes" value="liked" <?php if($sb_instagram_type == "liked") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_self_likes"><?php _e( 'Liked:', 'instagram-feed' ); ?></label>
                                <input readonly type="text" size="25" />
                                    &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed' ); ?></a><span class="sbi_note"> - <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to show posts that you've Liked</a></span>
                                <p class="sbi_tooltip"><?php _e("Display posts that your user account has liked."); ?></p>
                            </div>

                            <div class="sbi_pro sbi_row">
                                <input disabled type="radio" />
                                <label class="sbi_radio_label"><?php _e( 'Single:', 'instagram-feed' ); ?></label>
                                <input readonly type="text" size="25" />
                                    &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed' ); ?></a><span class="sbi_note"> - <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to show single posts</a></span>
                                <p class="sbi_tooltip"><?php _e("Display a feed comprised of specific single posts."); ?></p>
                            </div>

                            <span class="sbi_pro sbi_row">
                                <input disabled type="radio" name="sb_instagram_type" id="sb_instagram_type_location" value="location" <?php if($sb_instagram_type == "location") echo "checked"; ?> />
                                <label class="sbi_radio_label" for="sb_instagram_type_location"><?php _e( 'Location:', 'instagram-feed' ); ?></label>
                                <input readonly type="text" size="25" />
                                &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed' ); ?></a><span class="sbi_note"> - <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to show posts by Location</a></span>
                                <p class="sbi_tooltip"><?php _e( 'Display posts from an Instagram location ID or location coordinates.', 'instagram-feed' ); ?></p>
                            </span>

                            <span class="sbi_note" style="margin: 10px 0 0 0; display: block;"><?php _e('Separate multiple IDs using commas', 'instagram-feed' ); ?></span>
                           
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="sb_instagram_preserve_settings" class="bump-left"><?php _e("Preserve settings when plugin is removed", 'instagram-feed'); ?></label></th>
                        <td>
                            <input name="sb_instagram_preserve_settings" type="checkbox" id="sb_instagram_preserve_settings" <?php if($sb_instagram_preserve_settings == true) echo "checked"; ?> />
                            <label for="sb_instagram_preserve_settings"><?php _e('Yes', 'instagram-feed'); ?></label>
                            <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e('When removing the plugin your settings are automatically erased. Checking this box will prevent any settings from being deleted. This means that you can uninstall and reinstall the plugin without losing your settings.', 'instagram-feed'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th class="bump-left"><label for="sb_instagram_ajax_theme" class="bump-left"><?php _e("Are you using an Ajax powered theme?", 'instagram-feed'); ?></label></th>
                        <td>
                            <input name="sb_instagram_ajax_theme" type="checkbox" id="sb_instagram_ajax_theme" <?php if($sb_instagram_ajax_theme == true) echo "checked"; ?> />
                            <label for="sb_instagram_ajax_theme"><?php _e('Yes', 'instagram-feed'); ?></label>
                            <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?', 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("When navigating your site, if your theme uses Ajax to load content into your pages (meaning your page doesn't refresh) then check this setting. If you're not sure then please check with the theme author.", 'instagram-feed'); ?></p>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"><label><?php _e('Check for new posts every'); ?></label></th>
                        <td>
                            <input name="sb_instagram_cache_time" type="text" value="<?php esc_attr_e( $sb_instagram_cache_time ); ?>" size="4" />
                            <select name="sb_instagram_cache_time_unit">
                                <option value="minutes" <?php if($sb_instagram_cache_time_unit == "minutes") echo 'selected="selected"' ?> ><?php _e('Minutes'); ?></option>
                                <option value="hours" <?php if($sb_instagram_cache_time_unit == "hours") echo 'selected="selected"' ?> ><?php _e('Hours'); ?></option>
                                <option value="days" <?php if($sb_instagram_cache_time_unit == "days") echo 'selected="selected"' ?> ><?php _e('Days'); ?></option>
                            </select>
                            <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                            <p class="sbi_tooltip"><?php _e('Your Instagram posts are temporarily cached by the plugin in your WordPress database. You can choose how long the posts should be cached for. If you set the time to 1 hour then the plugin will clear the cache after that length of time and check Instagram for posts again.'); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button(); ?>
        </form>

        <p><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp; <?php _e('Next Step: <a href="?page=sb-instagram-feed&tab=customize">Customize your Feed</a>', 'instagram-feed'); ?></p>

        <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('Need help setting up the plugin? Check out our <a href="https://smashballoon.com/instagram-feed/free/" target="_blank">setup directions</a>', 'instagram-feed'); ?></p>


    <?php } // End Configure tab ?>



    <?php if( $sbi_active_tab == 'customize' ) { //Start Configure tab ?>

    <p class="sb_instagram_contents_links" id="general">
        <span><?php _e( 'Quick links:', 'instagram-feed' ); ?> </span>
        <a href="#general"><?php _e( 'General', 'instagram-feed' ); ?></a>
        <a href="#layout"><?php _e( 'Layout', 'instagram-feed' ); ?></a>
        <a href="#photos"><?php _e( 'Photos', 'instagram-feed' ); ?></a>
        <a href="#headeroptions"><?php _e( 'Header', 'instagram-feed' ); ?></a>
        <a href="#loadmore"><?php _e( "'Load More' Button", 'instagram-feed' ); ?></a>
        <a href="#follow"><?php _e( "'Follow' Button", 'instagram-feed' ); ?></a>
        <a href="#customcss"><?php _e( 'Custom CSS', 'instagram-feed' ); ?></a>
        <a href="#customjs"><?php _e( 'Custom JavaScript', 'instagram-feed' ); ?></a>
    </p>

    <input type="hidden" name="<?php echo $sb_instagram_customize_hidden_field; ?>" value="Y">

        <h3><?php _e( 'General', 'instagram-feed' ); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Width of Feed', 'instagram-feed'); ?></label><code class="sbi_shortcode"> width  widthunit
                        Eg: width=50 widthunit=%</code></th>
                    <td>
                        <input name="sb_instagram_width" type="text" value="<?php echo esc_attr( $sb_instagram_width ); ?>" id="sb_instagram_width" size="4" maxlength="4" />
                        <select name="sb_instagram_width_unit" id="sb_instagram_width_unit">
                            <option value="px" <?php if($sb_instagram_width_unit == "px") echo 'selected="selected"' ?> ><?php _e('px', 'instagram-feed'); ?></option>
                            <option value="%" <?php if($sb_instagram_width_unit == "%") echo 'selected="selected"' ?> ><?php _e('%', 'instagram-feed'); ?></option>
                        </select>
                        <div id="sb_instagram_width_options">
                            <input name="sb_instagram_feed_width_resp" type="checkbox" id="sb_instagram_feed_width_resp" <?php if($sb_instagram_feed_width_resp == true) echo "checked"; ?> /><label for="sb_instagram_feed_width_resp"><?php _e('Set to be 100% width on mobile?', 'instagram-feed'); ?></label>
                            <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e( 'What does this mean?', 'instagram-feed' ); ?></a>
                            <p class="sbi_tooltip"><?php _e("If you set a width on the feed then this will be used on mobile as well as desktop. Check this setting to set the feed width to be 100% on mobile so that it is responsive.", 'instagram-feed'); ?></p>
                        </div>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Height of Feed', 'instagram-feed'); ?></label><code class="sbi_shortcode"> height  heightunit
                        Eg: height=500 heightunit=px</code></th>
                    <td>
                        <input name="sb_instagram_height" type="text" value="<?php echo esc_attr( $sb_instagram_height ); ?>" size="4" maxlength="4" />
                        <select name="sb_instagram_height_unit">
                            <option value="px" <?php if($sb_instagram_height_unit == "px") echo 'selected="selected"' ?> ><?php _e('px', 'instagram-feed'); ?></option>
                            <option value="%" <?php if($sb_instagram_height_unit == "%") echo 'selected="selected"' ?> ><?php _e('%', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Background Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> background
                        Eg: background=d89531</code></th>
                    <td>
                        <input name="sb_instagram_background" type="text" value="<?php echo esc_attr( $sb_instagram_background ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
            </tbody>
        </table>

        <hr id="layout" />
        <h3><?php _e('Layout', 'instagram-feed'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Number of Photos', 'instagram-feed'); ?></label><code class="sbi_shortcode"> num
                        Eg: num=6</code></th>
                    <td>
                        <input name="sb_instagram_num" type="text" value="<?php echo esc_attr( $sb_instagram_num ); ?>" size="4" maxlength="4" />
                        <span class="sbi_note"><?php _e('Number of photos to show initially. Maximum of 33.', 'instagram-feed'); ?></span>
                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("Using multiple IDs or hashtags?", 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("If you're displaying photos from multiple User IDs or hashtags then this is the number of photos which will be displayed from each.", 'instagram-feed'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Number of Columns', 'instagram-feed'); ?></label><code class="sbi_shortcode"> cols
                        Eg: cols=3</code></th>
                    <td>
                        <select name="sb_instagram_cols">
                            <option value="1" <?php if($sb_instagram_cols == "1") echo 'selected="selected"' ?> ><?php _e('1', 'instagram-feed'); ?></option>
                            <option value="2" <?php if($sb_instagram_cols == "2") echo 'selected="selected"' ?> ><?php _e('2', 'instagram-feed'); ?></option>
                            <option value="3" <?php if($sb_instagram_cols == "3") echo 'selected="selected"' ?> ><?php _e('3', 'instagram-feed'); ?></option>
                            <option value="4" <?php if($sb_instagram_cols == "4") echo 'selected="selected"' ?> ><?php _e('4', 'instagram-feed'); ?></option>
                            <option value="5" <?php if($sb_instagram_cols == "5") echo 'selected="selected"' ?> ><?php _e('5', 'instagram-feed'); ?></option>
                            <option value="6" <?php if($sb_instagram_cols == "6") echo 'selected="selected"' ?> ><?php _e('6', 'instagram-feed'); ?></option>
                            <option value="7" <?php if($sb_instagram_cols == "7") echo 'selected="selected"' ?> ><?php _e('7', 'instagram-feed'); ?></option>
                            <option value="8" <?php if($sb_instagram_cols == "8") echo 'selected="selected"' ?> ><?php _e('8', 'instagram-feed'); ?></option>
                            <option value="9" <?php if($sb_instagram_cols == "9") echo 'selected="selected"' ?> ><?php _e('9', 'instagram-feed'); ?></option>
                            <option value="10" <?php if($sb_instagram_cols == "10") echo 'selected="selected"' ?> ><?php _e('10', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Padding around Images', 'instagram-feed'); ?></label><code class="sbi_shortcode"> imagepadding  imagepaddingunit</code></th>
                    <td>
                        <input name="sb_instagram_image_padding" type="text" value="<?php echo esc_attr( $sb_instagram_image_padding ); ?>" size="4" maxlength="4" />
                        <select name="sb_instagram_image_padding_unit">
                            <option value="px" <?php if($sb_instagram_image_padding_unit == "px") echo 'selected="selected"' ?> ><?php _e('px', 'instagram-feed'); ?></option>
                            <option value="%" <?php if($sb_instagram_image_padding_unit == "%") echo 'selected="selected"' ?> ><?php _e('%', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Disable mobile layout", 'instagram-feed'); ?></label><code class="sbi_shortcode"> disablemobile
                        Eg: disablemobile=true</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_disable_mobile" id="sb_instagram_disable_mobile" <?php if($sb_instagram_disable_mobile == true) echo 'checked="checked"' ?> />
                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e( 'What does this mean?', 'instagram-feed' ); ?></a>
                            <p class="sbi_tooltip"><?php _e("By default on mobile devices the layout automatically changes to use fewer columns. Checking this setting disables the mobile layout.", 'instagram-feed'); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr id="photos" />
        <h3><?php _e('Photos', 'instagram-feed'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Sort Photos By', 'instagram-feed'); ?></label><code class="sbi_shortcode"> sortby
                        Eg: sortby=random</code></th>
                    <td>
                        <select name="sb_instagram_sort">
                            <option value="none" <?php if($sb_instagram_sort == "none") echo 'selected="selected"' ?> ><?php _e('Newest to oldest', 'instagram-feed'); ?></option>
                            <option value="random" <?php if($sb_instagram_sort == "random") echo 'selected="selected"' ?> ><?php _e('Random', 'instagram-feed'); ?></option>
                        </select>
                    </td>
                </tr>                
                <tr valign="top">
                    <th scope="row"><label><?php _e('Image Resolution', 'instagram-feed'); ?></label><code class="sbi_shortcode"> imageres
                        Eg: imageres=thumb</code></th>
                    <td>

                        <select name="sb_instagram_image_res">
                            <option value="auto" <?php if($sb_instagram_image_res == "auto") echo 'selected="selected"' ?> ><?php _e('Auto-detect (recommended)', 'instagram-feed'); ?></option>
                            <option value="thumb" <?php if($sb_instagram_image_res == "thumb") echo 'selected="selected"' ?> ><?php _e('Thumbnail (150x150)', 'instagram-feed'); ?></option>
                            <option value="medium" <?php if($sb_instagram_image_res == "medium") echo 'selected="selected"' ?> ><?php _e('Medium (306x306)', 'instagram-feed'); ?></option>
                            <option value="full" <?php if($sb_instagram_image_res == "full") echo 'selected="selected"' ?> ><?php _e('Full size (640x640)', 'instagram-feed'); ?></option>
                        </select>

                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e( 'What does Auto-detect mean?', 'instagram-feed'); ?></a>
                            <p class="sbi_tooltip"><?php _e("Auto-detect means that the plugin automatically sets the image resolution based on the size of your feed.", 'instagram-feed'); ?></p>

                    </td>
                </tr>
            </tbody>
        </table>

        <span><a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a></span>

        <div class="sbi-pro-options">
            <p class="sbi-upgrade-link">
                <i class="fa fa-rocket" aria-hidden="true"></i>&nbsp; <a href="https://smashballoon.com/instagram-feed/" target="_blank"><?php _e('Upgrade to Pro to enable these settings', 'instagram-feed'); ?></a>
            </p>
            <table class="form-table">
                <tbody>
                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e('Media Type to Display'); ?></label></th>
                    <td>
                        <select name="sb_instagram_media_type" disabled>
                            <option value="all"><?php _e('All'); ?></option>
                            <option value="photos"><?php _e('Photos only'); ?></option>
                            <option value="videos"><?php _e('Videos only'); ?></option>
                        </select>
                    </td>
                </tr>

                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e("Enable Pop-up Lightbox", 'instagram-feed'); ?></label></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_captionlinks" id="sb_instagram_captionlinks" disabled />
                    </td>
                </tr>

                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e("Link Posts to URL in Caption (Shoppable feed)"); ?></label></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_captionlinks" id="sb_instagram_captionlinks" disabled />
                        &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e("What will this do?"); ?></a>
                        <p class="sbi_tooltip"><?php _e("Checking this box will change the link for each post to any url included in the caption for that Instagram post. The lightbox will be disabled. Visit <a href='https://smashballoon.com/make-a-shoppable-feed'>this link</a> to learn how this works."); ?></p>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>


        <hr />
        <h3><?php _e('Photo Hover Style'); ?></h3>

        <p style="padding-bottom: 18px;">
            <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Photo Hover styles</a><br />
            <a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a>
        </p>

        <div class="sbi-pro-options" style="margin-top: -15px;">
            <table class="form-table">
                <tbody>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Hover Background Color'); ?></label></th>
                        <td>
                            <input name="sb_hover_background" type="text" disabled class="sbi_colorpick" />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Hover Text Color'); ?></label></th>
                        <td>
                            <input name="sb_hover_text" type="text" disabled class="sbi_colorpick" />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Information to display'); ?></label></th>
                        <td>
                            <div>
                                <input name="sbi_hover_inc_username" type="checkbox" disabled />
                                <label for="sbi_hover_inc_username"><?php _e('Username'); ?></label>
                            </div>
                            <div>
                                <input name="sbi_hover_inc_icon" type="checkbox" disabled />
                                <label for="sbi_hover_inc_icon"><?php _e('Expand Icon'); ?></label>
                            </div>
                            <div>
                                <input name="sbi_hover_inc_date" type="checkbox" disabled />
                                <label for="sbi_hover_inc_date"><?php _e('Date'); ?></label>
                            </div>
                            <div>
                                <input name="sbi_hover_inc_instagram" type="checkbox" disabled />
                                <label for="sbi_hover_inc_instagram"><?php _e('Instagram Icon/Link'); ?></label>
                            </div>
                            <div>
                                <input name="sbi_hover_inc_location" type="checkbox" disabled />
                                <label for="sbi_hover_inc_location"><?php _e('Location'); ?></label>
                            </div>
                            <div>
                                <input name="sbi_hover_inc_caption" type="checkbox" disabled />
                                <label for="sbi_hover_inc_caption"><?php _e('Caption'); ?></label>
                            </div>
                            <div>
                                <input name="sbi_hover_inc_likes" type="checkbox" disabled />
                                <label for="sbi_hover_inc_likes"><?php _e('Like/Comment Icons'); ?></label>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>


        <hr />
        <h3><?php _e( 'Carousel', 'instagram-feed' ); ?></h3>
        <p style="padding-bottom: 18px;">
            <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Carousels</a><br />
            <a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a>
        </p>

        <div class="sbi-pro-options" style="margin-top: -15px;">
            <table class="form-table">
                <tbody>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Enable Carousel"); ?></label></th>
                        <td>
                            <input type="checkbox" disabled />
                            &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?"); ?></a>
                                <p class="sbi_tooltip"><?php _e("Enable this setting to create a carousel slider out of your photos."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Show Navigation Arrows"); ?></label></th>
                        <td>
                            <input type="checkbox" disabled />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Show Pagination"); ?></label></th>
                        <td>
                            <input type="checkbox" disabled />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Enable Autoplay"); ?></label></th>
                        <td>
                            <input type="checkbox" disabled />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Interval Time"); ?></label></th>
                        <td>
                            <input name="sb_instagram_carousel_interval" type="text" disabled size="6" /><?php _e("miliseconds"); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>



        <hr id="headeroptions" />
        <h3><?php _e("Header", 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the Header", 'instagram-feed'); ?></label><code class="sbi_shortcode"> showheader
                        Eg: showheader=false</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_show_header" id="sb_instagram_show_header" <?php if($sb_instagram_show_header == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show Bio Text"); ?></label><code class="sbi_shortcode"> showbio
                        Eg: showbio=false</code></th>
                    <td>
                        <?php $sb_instagram_show_bio = isset( $sb_instagram_show_bio ) ? $sb_instagram_show_bio  : true; ?>
                        <input type="checkbox" name="sb_instagram_show_bio" id="sb_instagram_show_bio" <?php if($sb_instagram_show_bio == true) echo 'checked="checked"' ?> />
                        <span class="sbi_note"><?php _e("This only applies for User IDs with bios"); ?></span>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Header Text Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> headercolor
                        Eg: headercolor=fff</code></th>
                    <td>
                        <input name="sb_instagram_header_color" type="text" value="<?php echo esc_attr( $sb_instagram_header_color ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
            </tbody>
        </table>

        <span><a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a></span>

        <div class="sbi-pro-options">
            <p class="sbi-upgrade-link">
                <i class="fa fa-rocket" aria-hidden="true"></i>&nbsp; <a href="https://smashballoon.com/instagram-feed/" target="_blank"><?php _e('Upgrade to Pro to enable these settings', 'instagram-feed'); ?></a>
            </p>
            <table class="form-table">
                <tbody>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Header Style'); ?></label></th>
                        <td>
                            <select name="sb_instagram_header_style" style="float: left;" disabled>
                                <option value="circle"><?php _e('Circle'); ?></option>
                                <option value="boxed"><?php _e('Boxed'); ?></option>
                            </select>
                            <div id="sb_instagram_header_style_boxed_options">
                                <div class="sbi_row">
                                    <div class="sbi_col sbi_one">
                                        <label><?php _e('Primary Color'); ?></label>
                                        <input name="sb_instagram_header_primary_color" type="text" class="sbi_colorpick" />
                                    </div>
                                    <div class="sbi_col sbi_one">
                                        <label><?php _e('Secondary Color'); ?></label>
                                        <input name="sb_instagram_header_secondary_color" type="text" class="sbi_colorpick" />
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Show Number of Followers"); ?></label></th>
                        <td>
                            <input type="checkbox" disabled />
                            <span class="sbi_note"><?php _e("This only applies when displaying photos from a User ID"); ?></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <?php submit_button(); ?>


        <hr />
        <h3><?php _e("Caption", 'instagram-feed'); ?></h3>
        <p style="padding-bottom: 18px;">
            <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Photo Captions</a><br />
            <a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a>
        </p>

        <div class="sbi-pro-options" style="margin-top: -15px;">
            <table class="form-table">
                <tbody>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Show Caption"); ?></label></th>
                        <td>
                            <input type="checkbox" disabled />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Maximum Text Length"); ?></label></th>
                        <td>
                            <input disabled size="4" />Characters
                            &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?"); ?></a>
                                <p class="sbi_tooltip"><?php _e("The number of characters of text to display in the caption. An elipsis link will be added to allow the user to reveal more text if desired."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Text Color'); ?></label></th>
                        <td>
                            <input type="text" disabled class="sbi_colorpick" />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Text Size'); ?></label></th>
                        <td>
                            <select name="sb_instagram_caption_size" style="width: 180px;" disabled>
                                <option value="inherit"  ><?php _e('Inherit from theme'); ?></option>
                                <option value="10" ><?php _e('10px'); ?></option>
                                <option value="11" ><?php _e('11px'); ?></option>
                                <option value="12" ><?php _e('12px'); ?></option>
                                <option value="13" ><?php _e('13px'); ?></option>
                                <option value="14" ><?php _e('14px'); ?></option>
                                <option value="16" ><?php _e('16px'); ?></option>
                                <option value="18" ><?php _e('18px'); ?></option>
                                <option value="20" ><?php _e('20px'); ?></option>
                                <option value="24" ><?php _e('24px'); ?></option>
                                <option value="28" ><?php _e('28px'); ?></option>
                                <option value="32" ><?php _e('32px'); ?></option>
                                <option value="36" ><?php _e('36px'); ?></option>
                                <option value="40" ><?php _e('40px'); ?></option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <hr />
        <h3><?php _e("Likes &amp; Comments", 'instagram-feed'); ?></h3>
        <p style="padding-bottom: 18px;">
            <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Likes &amp; Comments</a><br />
            <a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a>
        </p>

        <div class="sbi-pro-options" style="margin-top: -15px;">
            <table class="form-table">
                <tbody>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e("Show Icons"); ?></label></th>
                        <td>
                            <input type="checkbox" disabled />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Icon Color'); ?></label></th>
                        <td>
                            <input type="text" disabled class="sbi_colorpick" />
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Icon Size'); ?></label></th>
                        <td>
                            <select disabled name="sb_instagram_meta_size" style="width: 180px;">
                                <option value="inherit"><?php _e('Inherit from theme'); ?></option>
                                <option value="10" ><?php _e('10px'); ?></option>
                                <option value="11" ><?php _e('11px'); ?></option>
                                <option value="12" ><?php _e('12px'); ?></option>
                                <option value="13" ><?php _e('13px'); ?></option>
                                <option value="14" ><?php _e('14px'); ?></option>
                                <option value="16" ><?php _e('16px'); ?></option>
                                <option value="18" ><?php _e('18px'); ?></option>
                                <option value="20" ><?php _e('20px'); ?></option>
                                <option value="24" ><?php _e('24px'); ?></option>
                                <option value="28" ><?php _e('28px'); ?></option>
                                <option value="32" ><?php _e('32px'); ?></option>
                                <option value="36" ><?php _e('36px'); ?></option>
                                <option value="40" ><?php _e('40px'); ?></option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <hr />
        <h3><?php _e('Lightbox Comments'); ?></h3>

        <p style="padding-bottom: 18px;">
            <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Comments</a><br />
            <a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a>
        </p>

        <div class="sbi-pro-options" style="margin-top: -15px;">
            <table class="form-table">
                <tbody>

                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e('Show Comments in Lightbox'); ?></label></th>
                    <td style="padding: 5px 10px 0 10px;">
                        <input type="checkbox" disabled style="margin-right: 15px;" />
                        <input class="button-secondary" style="margin-top: -5px;" disabled value="<?php esc_attr_e( 'Clear Comment Cache' ); ?>" />
                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?"); ?></a>
                        <p class="sbi_tooltip"><?php _e("This will remove the cached comments saved in the database"); ?></p>
                    </td>
                </tr>
                <tr valign="top" class="sbi_pro">
                    <th scope="row"><label><?php _e('Number of Comments'); ?></label></th>
                    <td>
                        <input name="sb_instagram_num_comments" type="text" disabled size="4" />
                        <span class="sbi_note"><?php _e('Max number of latest comments.'); ?></span>
                        &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?"); ?></a>
                        <p class="sbi_tooltip"><?php _e("This is the maximum number of comments that will be shown in the lightbox. If there are more comments available than the number set, only the latest comments will be shown"); ?></p>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>


        <hr id="loadmore" />
        <h3><?php _e("'Load More' Button", 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the 'Load More' button", 'instagram-feed'); ?></label><code class="sbi_shortcode"> showbutton
                        Eg: showbutton=false</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_show_btn" id="sb_instagram_show_btn" <?php if($sb_instagram_show_btn == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Background Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> buttoncolor
                        Eg: buttoncolor=8224e3</code></th>
                    <td>
                        <input name="sb_instagram_btn_background" type="text" value="<?php echo esc_attr( $sb_instagram_btn_background ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> buttontextcolor
                        Eg: buttontextcolor=eeee22</code></th>
                    <td>
                        <input name="sb_instagram_btn_text_color" type="text" value="<?php echo esc_attr( $sb_instagram_btn_text_color ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text', 'instagram-feed'); ?></label><code class="sbi_shortcode"> buttontext
                        Eg: buttontext="Show more.."</code></th>
                    <td>
                        <input name="sb_instagram_btn_text" type="text" value="<?php echo esc_attr( stripslashes( $sb_instagram_btn_text ) ); ?>" size="20" />
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

        <hr id="follow" />
        <h3><?php _e("'Follow' Button", 'instagram-feed'); ?></h3>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Show the Follow button", 'instagram-feed'); ?></label><code class="sbi_shortcode"> showfollow
                        Eg: showfollow=true</code></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_show_follow_btn" id="sb_instagram_show_follow_btn" <?php if($sb_instagram_show_follow_btn == true) echo 'checked="checked"' ?> />
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Background Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> followcolor
                        Eg: followcolor=28a1bf</code></th>
                    <td>
                        <input name="sb_instagram_folow_btn_background" type="text" value="<?php echo esc_attr( $sb_instagram_folow_btn_background ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text Color', 'instagram-feed'); ?></label><code class="sbi_shortcode"> followtextcolor
                        Eg: followtextcolor=000</code></th>
                    <td>
                        <input name="sb_instagram_follow_btn_text_color" type="text" value="<?php echo esc_attr( $sb_instagram_follow_btn_text_color ); ?>" class="sbi_colorpick" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label><?php _e('Button Text', 'instagram-feed'); ?></label><code class="sbi_shortcode"> followtext
                        Eg: followtext="Follow me"</code></th>
                    <td>
                        <input name="sb_instagram_follow_btn_text" type="text" value="<?php echo esc_attr( stripslashes( $sb_instagram_follow_btn_text ) ); ?>" size="30" />
                    </td>
                </tr>
            </tbody>
        </table>

        <hr id="filtering" />
        <h3><?php _e('Post Filtering', 'instagram-feed'); ?></h3>

        <p style="padding-bottom: 18px;">
            <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Post Filtering options</a><br />
            <a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a>
        </p>

        <div class="sbi-pro-options" style="margin-top: -15px;">

            <table class="form-table">
                <tbody>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Remove photos containing these words or hashtags', 'instagram-feed'); ?></label></th>
                        <td>
                            <div class="sb_instagram_apply_labels">
                                <p>Apply to:</p>
                                <input class="sb_instagram_incex_one_all" type="radio" value="all" disabled /><label>All feeds</label>
                                <input class="sb_instagram_incex_one_all" type="radio" value="one" disabled /><label>One feed</label>
                            </div>

                           <input disabled name="sb_instagram_exclude_words" id="sb_instagram_exclude_words" type="text" style="width: 70%;" value="" />
                            <br />
                            <span class="sbi_note" style="margin-left: 0;"><?php _e('Separate words/hashtags using commas', 'instagram-feed'); ?></span>
                            &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed'); ?></a>
                                <p class="sbi_tooltip"><?php _e("You can use this setting to remove photos which contain certain words or hashtags in the caption. Separate multiple words or hashtags using commas.", 'instagram-feed'); ?></p>
                        </td>
                    </tr>

                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Show photos containing these words or hashtags', 'instagram-feed'); ?></label></th>
                        <td>
                            <div class="sb_instagram_apply_labels">
                                <p>Apply to:</p>
                                <input class="sb_instagram_incex_one_all" type="radio" value="all" disabled /><label>All feeds</label>
                                <input class="sb_instagram_incex_one_all" type="radio" value="one" disabled /><label>One feed</label>
                            </div>

                            <input disabled name="sb_instagram_include_words" id="sb_instagram_include_words" type="text" style="width: 70%;" value="" />
                            <br />
                            <span class="sbi_note" style="margin-left: 0;"><?php _e('Separate words/hashtags using commas', 'instagram-feed'); ?></span>
                            &nbsp;<a class="sbi_tooltip_link sbi_pro" href="JavaScript:void(0);"><?php _e( 'What is this?', 'instagram-feed'); ?></a>
                                <p class="sbi_tooltip"><?php _e("You can use this setting to only show photos which contain certain words or hashtags in the caption. For example, adding <code>sheep, cow, dog</code> will show any photos which contain either the word sheep, cow, or dog. Separate multiple words or hashtags using commas.", 'instagram-feed'); ?></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <hr id="moderation" />
        <h3><?php _e('Moderation', 'instagram-feed'); ?></h3>

        <p style="padding-bottom: 18px;">
            <a href="https://smashballoon.com/instagram-feed/" target="_blank">Upgrade to Pro to enable Moderation options</a><br />
            <a href="javascript:void(0);" class="button button-secondary sbi-show-pro"><b>+</b> Show Pro Options</a>
        </p>

        <div class="sbi-pro-options" style="margin-top: -15px;">
            <table class="form-table">
                <tbody>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Moderation Type'); ?></label></th>
                        <td>
                            <input class="sb_instagram_moderation_mode" checked="checked" disabled type="radio" value="visual" style="margin-top: 0;" /><label>Visual</label>
                            <input class="sb_instagram_moderation_mode" disabled type="radio" value="manual" style="margin-top: 0; margin-left: 10px;"/><label>Manual</label>

                            <p class="sbi_tooltip" style="display: block;"><?php _e("<b>Visual Moderation Mode</b><br />This adds a button to each feed that will allow you to hide posts, block users, and create white lists from the front end using a visual interface. Visit <a href='https://smashballoon.com/guide-to-moderation-mode/' target='_blank'>this page</a> for details"); ?></p>

                        </td>
                    </tr>

                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('Only show posts by these users'); ?></label></th>
                        <td>
                            <input type="text" style="width: 70%;" disabled /><br />
                            <span class="sbi_note" style="margin-left: 0;"><?php _e('Separate usernames using commas'); ?></span>

                            &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e("What is this?"); ?></a>
                            <p class="sbi_tooltip"><?php _e("You can use this setting to show photos only from certain users in your feed. Just enter the usernames here which you want to show. Separate multiple usernames using commas."); ?></p>
                        </td>
                    </tr>
                    <tr valign="top" class="sbi_pro">
                        <th scope="row"><label><?php _e('White lists'); ?></label></th>
                        <td>
                            <div class="sbi_white_list_names_wrapper">
                                <?php _e("No white lists currently created"); ?>
                            </div>
                            
                            <input disabled class="button-secondary" type="submit" value="<?php esc_attr_e( 'Clear White Lists' ); ?>" />
                            &nbsp;<a class="sbi_tooltip_link" href="JavaScript:void(0);" style="display: inline-block; margin-top: 5px;"><?php _e("What is this?"); ?></a>
                            <p class="sbi_tooltip"><?php _e("This will remove all of the white lists from the database"); ?></p>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>



        <hr id="customcss" />
        <h3><?php _e('Misc', 'instagram-feed'); ?></h3>

        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <td style="padding-bottom: 0;">
                    <?php _e('<strong style="font-size: 15px;">Custom CSS</strong><br />Enter your own custom CSS in the box below', 'instagram-feed'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>
                        <textarea name="sb_instagram_custom_css" id="sb_instagram_custom_css" style="width: 70%;" rows="7"><?php echo esc_textarea( stripslashes($sb_instagram_custom_css), 'instagram-feed' ); ?></textarea>
                    </td>
                </tr>
                <tr valign="top" id="customjs">
                    <td style="padding-bottom: 0;">
                    <?php _e('<strong style="font-size: 15px;">Custom JavaScript</strong><br />Enter your own custom JavaScript/jQuery in the box below', 'instagram-feed'); ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>
                        <textarea name="sb_instagram_custom_js" id="sb_instagram_custom_js" style="width: 70%;" rows="7"><?php echo esc_textarea( stripslashes($sb_instagram_custom_js), 'instagram-feed' ); ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="form-table">
            <tbody>
            <tr valign="top">
                <th scope="row"><label><?php _e('Cache error API recheck'); ?></label></th>
                <td>
                    <input type="checkbox" name="check_api" id="sb_instagram_check_api" <?php if($check_api == true) echo 'checked="checked"' ?> />
                    <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                    <p class="sbi_tooltip"><?php _e("If your site uses caching, minification, or JavaScript concatenation, this option can help prevent missing cache problems with the feed."); ?></p>
                </td>
            </tr>
                <tr valign="top">
                    <th><label><?php _e("Enable Backup Caching"); ?></label></th>
                    <td class="sbi-customize-tab-opt">
                        <input name="sb_instagram_backup" type="checkbox" id="sb_instagram_backup" <?php if($sb_instagram_backup == true) echo "checked"; ?> />
                        <input id="sbi_clear_backups" class="button-secondary" type="submit" style="position: relative; top: -4px;" value="<?php esc_attr_e( 'Clear Backup Cache' ); ?>" />
                        <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                        <p class="sbi_tooltip"><?php _e('Every feed will save a duplicate version of itself in the database to be used if the normal cache is not available.'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th class="bump-left">
                        <label for="sb_instagram_cron" class="bump-left"><?php _e("Force cache to clear on interval"); ?></label>
                    </th>
                    <td>
                        <select name="sb_instagram_cron">
                            <option value="unset" <?php if($sb_instagram_cron == "unset") echo 'selected="selected"' ?> ><?php _e(' - '); ?></option>
                            <option value="yes" <?php if($sb_instagram_cron == "yes") echo 'selected="selected"' ?> ><?php _e('Yes'); ?></option>
                            <option value="no" <?php if($sb_instagram_cron == "no") echo 'selected="selected"' ?> ><?php _e('No'); ?></option>
                        </select>

                        <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                        <p class="sbi_tooltip"><?php _e("If you're experiencing an issue with the plugin not auto-updating then you can set this to 'Yes' to run a scheduled event behind the scenes which forces the plugin cache to clear on a regular basis and retrieve new data from Instagram."); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><label><?php _e("Disable Icon Font", 'instagram-feed'); ?></label></th>
                    <td>
                        <input type="checkbox" name="sb_instagram_disable_awesome" id="sb_instagram_disable_awesome" <?php if($sb_instagram_disable_awesome == true) echo 'checked="checked"' ?> /> <?php _e( 'Yes', 'instagram-feed' ); ?>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="sbi_font_method"><?php _e("Icon Method"); ?></label></th>
                    <td>
                        <select name="sbi_font_method" id="sbi_font_method" class="default-text">
                            <option value="svg" id="sbi-font_method" class="default-text" <?php if($sbi_font_method == 'svg') echo 'selected="selected"' ?>>SVG</option>
                            <option value="fontfile" id="sbi-font_method" class="default-text" <?php if($sbi_font_method == 'fontfile') echo 'selected="selected"' ?>><?php _e("Font File"); ?></option>
                        </select>
                        <a class="sbi_tooltip_link" href="JavaScript:void(0);"><?php _e('What does this mean?'); ?></a>
                        <p class="sbi_tooltip"><?php _e("This plugin uses SVGs for all icons in the feed. Use this setting to switch to font icons."); ?></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php submit_button(); ?>

    </form>

    <p><i class="fa fa-chevron-circle-right" aria-hidden="true"></i>&nbsp; <?php _e('Next Step: <a href="?page=sb-instagram-feed&tab=display">Display your Feed</a>', 'instagram-feed'); ?></p>

    <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('Need help setting up the plugin? Check out our <a href="https://smashballoon.com/instagram-feed/free/" target="_blank">setup directions</a>', 'instagram-feed'); ?></p>


    <?php } //End Customize tab ?>



    <?php if( $sbi_active_tab == 'display' ) { //Start Display tab ?>

        <h3><?php _e('Display your Feed', 'instagram-feed'); ?></h3>
        <p><?php _e("Copy and paste the following shortcode directly into the page, post or widget where you'd like the feed to show up:", 'instagram-feed'); ?></p>
        <input type="text" value="[instagram-feed]" size="16" readonly="readonly" style="text-align: center;" onclick="this.focus();this.select()" title="<?php _e('To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac).', 'instagram-feed'); ?>" />

        <h3 style="padding-top: 10px;"><?php _e( 'Multiple Feeds', 'instagram-feed' ); ?></h3>
        <p><?php _e("If you'd like to display multiple feeds then you can set different settings directly in the shortcode like so:", 'instagram-feed'); ?>
        <code>[instagram-feed num=9 cols=3]</code></p>
        <p><?php _e( 'You can display as many different feeds as you like, on either the same page or on different pages, by just using the shortcode options below. For example:', 'instagram-feed' ); ?><br />
        <code>[instagram-feed]</code><br />
        <code>[instagram-feed id="ANOTHER_USER_ID"]</code><br />
        <code>[instagram-feed id="ANOTHER_USER_ID, YET_ANOTHER_USER_ID" num=4 cols=4 showfollow=false]</code>
        </p>
        <p><?php _e("See the table below for a full list of available shortcode options:", 'instagram-feed'); ?></p>

        <p><span class="sbi_table_key"></span><?php _e('Pro version only', 'instagram-feed'); ?></p>

        <table class="sbi_shortcode_table">
            <tbody>
                <tr valign="top">
                    <th scope="row"><?php _e('Shortcode option', 'instagram-feed'); ?></th>
                    <th scope="row"><?php _e('Description', 'instagram-feed'); ?></th>
                    <th scope="row"><?php _e('Example', 'instagram-feed'); ?></th>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Configure Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>type</td>
                    <td><?php _e("Display photos from a User ID (user)<br />Display posts from a Hashtag (hashtag)<br />Display posts from a Location (location)<br />Display posts from Coordinates (coordinates)", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed type=user]</code><br /><code>[instagram-feed type=hashtag]</code><br/><code>[instagram-feed type=location]</code><br /><code>[instagram-feed type=coordinates]</code></td>
                </tr>
                <tr>
                    <td>id</td>
                    <td><?php _e('An Instagram User ID. Separate multiple IDs by commas.', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed id="1234567"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>hashtag</td>
                    <td><?php _e('Any hashtag. Separate multiple IDs by commas.', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed hashtag="#awesome"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>location</td>
                    <td><?php _e('The ID of the location. Separate multiple IDs by commas.', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed location="213456451"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>coordinates</td>
                    <td><?php _e('The coordinates to display photos from. Separate multiple sets of coordinates by commas.<br />The format is (latitude,longitude,distance).', 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed coordinates="(25.76,-80.19,500)"]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Customize Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>width</td>
                    <td><?php _e("The width of your feed. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed width=50]</code></td>
                </tr>
                <tr>
                    <td>widthunit</td>
                    <td><?php _e("The unit of the width. 'px' or '%'", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed widthunit=%]</code></td>
                </tr>
                <tr>
                    <td>height</td>
                    <td><?php _e("The height of your feed. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed height=250]</code></td>
                </tr>
                <tr>
                    <td>heightunit</td>
                    <td><?php _e("The unit of the height. 'px' or '%'", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed heightunit=px]</code></td>
                </tr>
                <tr>
                    <td>background</td>
                    <td><?php _e("The background color of the feed. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed background=#ffff00]</code></td>
                </tr>
                <tr>
                    <td>class</td>
                    <td><?php _e("Add a CSS class to the feed container", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed class=feedOne]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Photos Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>sortby</td>
                    <td><?php _e("Sort the posts by Newest to Oldest (none) or Random (random)", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed sortby=random]</code></td>
                </tr>
                <tr>
                    <td>num</td>
                    <td><?php _e("The number of photos to display initially. Maximum is 33.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed num=10]</code></td>
                </tr>
                <tr>
                    <td>cols</td>
                    <td><?php _e("The number of columns in your feed. 1 - 10.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed cols=5]</code></td>
                </tr>
                <tr>
                    <td>imageres</td>
                    <td><?php _e("The resolution/size of the photos. 'auto', full', 'medium' or 'thumb'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed imageres=full]</code></td>
                </tr>
                <tr>
                    <td>imagepadding</td>
                    <td><?php _e("The spacing around your photos", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed imagepadding=10]</code></td>
                </tr>
                <tr>
                    <td>imagepaddingunit</td>
                    <td><?php _e("The unit of the padding. 'px' or '%'", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed imagepaddingunit=px]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>disablelightbox</td>
                    <td><?php _e("Whether to disable the photo Lightbox. It is enabled by default.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed disablelightbox=true]</code></td>
                </tr>
                <tr>
                    <td>disablemobile</td>
                    <td><?php _e("Disable the mobile layout. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed disablemobile=true]</code></td>
                </tr>

                <tr class="sbi_pro">
                    <td>hovercolor</td>
                    <td><?php _e("The background color when hovering over a photo. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed hovercolor=#ff0000]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>hovertextcolor</td>
                    <td><?php _e("The text/icon color when hovering over a photo. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed hovertextcolor=#fff]</code></td>
                </tr>


                <tr class="sbi_table_header"><td colspan=3><?php _e("Carousel Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>carousel</td>
                    <td><?php _e("Display this feed as a carousel", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carousel=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouselarrows</td>
                    <td><?php _e("Display directional arrows on the carousel", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouselarrows=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouselpag</td>
                    <td><?php _e("Display pagination links below the carousel", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouselpag=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouselautoplay</td>
                    <td><?php _e("Make the carousel autoplay", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouselautoplay=true]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>carouseltime</td>
                    <td><?php _e("The interval time between slides for autoplay. Time in miliseconds.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed carouseltime=8000]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Header Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>showheader</td>
                    <td><?php _e("Whether to show the feed Header. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showheader=false]</code></td>
                </tr>
                <tr>
                    <td>showbio</td>
                    <td><?php _e("Display the bio in the header. 'true' or 'false'."); ?></td>
                    <td><code>[instagram-feed showbio=true]</code></td>
                </tr>
                <tr>
                    <td>headercolor</td>
                    <td><?php _e("The color of the Header text. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed headercolor=#333]</code></td>
                </tr>
                
                <tr class="sbi_table_header"><td colspan=3><?php _e("'Load More' Button Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>showbutton</td>
                    <td><?php _e("Whether to show the 'Load More' button. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showbutton=false]</code></td>
                </tr>
                <tr>
                    <td>buttoncolor</td>
                    <td><?php _e("The background color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed buttoncolor=#000]</code></td>
                </tr>
                <tr>
                    <td>buttontextcolor</td>
                    <td><?php _e("The text color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed buttontextcolor=#fff]</code></td>
                </tr>
                <tr>
                    <td>buttontext</td>
                    <td><?php _e("The text used for the button.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed buttontext="Load More Photos"]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("'Follow on Instagram' Button Options", 'instagram-feed'); ?></td></tr>
                <tr>
                    <td>showfollow</td>
                    <td><?php _e("Whether to show the 'Follow on Instagram' button. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showfollow=false]</code></td>
                </tr>
                <tr>
                    <td>followcolor</td>
                    <td><?php _e("The background color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed followcolor=#ff0000]</code></td>
                </tr>
                <tr>
                    <td>followtextcolor</td>
                    <td><?php _e("The text color of the button. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed followtextcolor=#fff]</code></td>
                </tr>
                <tr>
                    <td>followtext</td>
                    <td><?php _e("The text used for the button.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed followtext="Follow me"]</code></td>
                </tr>
                
                <tr class="sbi_table_header"><td colspan=3><?php _e("Caption Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>showcaption</td>
                    <td><?php _e("Whether to show the photo caption. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showcaption=false]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>captionlength</td>
                    <td><?php _e("The number of characters of the caption to display", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed captionlength=50]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>captioncolor</td>
                    <td><?php _e("The text color of the caption. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed captioncolor=#000]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>captionsize</td>
                    <td><?php _e("The size of the caption text. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed captionsize=24]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Likes &amp; Comments Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>showlikes</td>
                    <td><?php _e("Whether to show the Likes &amp; Comments. 'true' or 'false'.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed showlikes=false]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>likescolor</td>
                    <td><?php _e("The color of the Likes &amp; Comments. Any hex color code.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed likescolor=#FF0000]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>likessize</td>
                    <td><?php _e("The size of the Likes &amp; Comments. Any number.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed likessize=14]</code></td>
                </tr>

                <tr class="sbi_table_header"><td colspan=3><?php _e("Post Filtering Options", 'instagram-feed'); ?></td></tr>
                <tr class="sbi_pro">
                    <td>excludewords</td>
                    <td><?php _e("Remove posts which contain certain words or hashtags in the caption.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed excludewords="bad, words"]</code></td>
                </tr>
                <tr class="sbi_pro">
                    <td>includewords</td>
                    <td><?php _e("Only display posts which contain certain words or hashtags in the caption.", 'instagram-feed'); ?></td>
                    <td><code>[instagram-feed includewords="sunshine"]</code></td>
                </tr>

            </tbody>
        </table>

        <p><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <?php _e('Need help setting up the plugin? Check out our <a href="https://smashballoon.com/instagram-feed/free/" target="_blank">setup directions</a>', 'instagram-feed'); ?></p>

    <?php } //End Display tab ?>


    <?php if( $sbi_active_tab == 'support' ) { //Start Support tab ?>

	    <div class="sbi_support">

		    <br/>
		    <h3 style="padding-bottom: 10px;">Need help?</h3>

		    <p>
			    <span class="sbi-support-title"><i class="fa fa-life-ring" aria-hidden="true"></i>&nbsp; <a
					    href="https://smashballoon.com/instagram-feed/free/"
					    target="_blank"><?php _e( 'Setup Directions' ); ?></a></span>
			    <?php _e( 'A step-by-step guide on how to setup and use the plugin.' ); ?>
		    </p>

		    <p>
			    <span class="sbi-support-title"><i class="fa fa-youtube-play" aria-hidden="true"></i>&nbsp; <a
					    href="https://www.youtube.com/embed/V_fJ_vhvQXM" target="_blank"
					    id="sbi-play-support-video"><?php _e( 'Watch a Video' ); ?></a></span>
			    <?php _e( "Watch a short video demonstrating how to set up, customize and use the plugin.<br /><b>Please note</b> that the video shows the set up and use of the <b><a href='https://smashballoon.com/instagram-feed/' target='_blank'>PRO version</a></b> of the plugin, but the process is the same for this free version. The only difference is some of the features available." ); ?>

			    <iframe id="sbi-support-video"
			            src="//www.youtube.com/embed/V_fJ_vhvQXM?theme=light&amp;showinfo=0&amp;controls=2" width="960"
			            height="540" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
		    </p>

		    <p>
			    <span class="sbi-support-title"><i class="fa fa-question-circle" aria-hidden="true"></i>&nbsp; <a
					    href="https://smashballoon.com/instagram-feed/support/faq/"
					    target="_blank"><?php _e( 'FAQs and Docs' ); ?></a></span>
			    <?php _e( 'View our expansive library of FAQs and documentation to help solve your problem as quickly as possible.' ); ?>
		    </p>

		    <div class="sbi-support-faqs">

			    <ul>
				    <li><b>FAQs</b></li>
				    <li>&bull;&nbsp; <?php _e( '<a href="https://smashballoon.com/instagram-feed/find-instagram-user-id/" target="_blank">How to find an Instagram User ID</a>' ); ?></li>
				    <li>&bull;&nbsp; <?php _e( '<a href="https://smashballoon.com/my-instagram-access-token-keep-expiring/" target="_blank">My Access Token Keeps Expiring</a>' ); ?></li>
				    <li>&bull;&nbsp; <?php _e( '<a href="https://smashballoon.com/my-photos-wont-load/" target="_blank">My Instagram Feed Won\'t Load</a>' ); ?></li>
				    <li style="margin-top: 8px; font-size: 12px;"><a
						    href="https://smashballoon.com/instagram-feed/support/faq/" target="_blank">See All<i
							    class="fa fa-chevron-right" aria-hidden="true"></i></a></li>
			    </ul>

			    <ul>
				    <li><b>Documentation</b></li>
				    <li>&bull;&nbsp; <?php _e( '<a href="https://smashballoon.com/instagram-feed/free" target="_blank">Installation and Configuration</a>' ); ?></li>
				    <li>&bull;&nbsp; <?php _e( '<a href="https://smashballoon.com/display-multiple-instagram-feeds/" target="_blank">Displaying multiple feeds</a>' ); ?></li>
				    <li>&bull;&nbsp; <?php _e( '<a href="https://smashballoon.com/instagram-feed-faq/customization/" target="_blank">Customizing your Feed</a>' ); ?></li>
			    </ul>
		    </div>

		    <p>
			    <span class="sbi-support-title"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp; <a
					    href="https://smashballoon.com/instagram-feed/support/"
					    target="_blank"><?php _e( 'Request Support' ); ?></a></span>
			    <?php _e( 'Still need help? Submit a ticket and one of our support experts will get back to you as soon as possible.<br /><b>Important:</b> Please include your <b>System Info</b> below with all support requests.' ); ?>
		    </p>
	    </div>

	    <hr />

	    <h3><?php _e('System Info &nbsp; <i style="color: #666; font-size: 11px; font-weight: normal;">Click the text below to select all</i>'); ?></h3>




        <?php $sbi_options = get_option('sb_instagram_settings'); ?>
        <textarea readonly="readonly" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)." style="width: 100%; max-width: 960px; height: 500px; white-space: pre; font-family: Menlo,Monaco,monospace;">
## SITE/SERVER INFO: ##
Site URL:                 <?php echo site_url() . "\n"; ?>
Home URL:                 <?php echo home_url() . "\n"; ?>
WordPress Version:        <?php echo get_bloginfo( 'version' ) . "\n"; ?>
PHP Version:              <?php echo PHP_VERSION . "\n"; ?>
Web Server Info:          <?php echo $_SERVER['SERVER_SOFTWARE'] . "\n"; ?>

## ACTIVE PLUGINS: ##
<?php
$plugins = get_plugins();
$active_plugins = get_option( 'active_plugins', array() );

foreach ( $plugins as $plugin_path => $plugin ) {
    // If the plugin isn't active, don't show it.
    if ( ! in_array( $plugin_path, $active_plugins ) )
        continue;

    echo $plugin['Name'] . ': ' . $plugin['Version'] ."\n";
}
?>

## PLUGIN SETTINGS: ##
sb_instagram_plugin_type => Instagram Feed Free
<?php 
while (list($key, $val) = each($sbi_options)) {
    echo "$key => $val\n";
}
?>

## API RESPONSE: ##
<?php
$url = isset( $sbi_options['sb_instagram_at'] ) ? 'https://api.instagram.com/v1/users/self/?access_token=' . $sbi_options['sb_instagram_at'] : 'no_at';
if ( $url !== 'no_at' ) {
    $args = array(
        'timeout' => 60,
        'sslverify' => false
    );
    $result = wp_remote_get( $url, $args );

    $data = json_decode( $result['body'] );

    if ( isset( $data->data->id ) ) {
        echo 'id: ' . $data->data->id . "\n";
        echo 'username: ' . $data->data->username . "\n";
        echo 'posts: ' . $data->data->counts->media . "\n";

        $url = 'https://api.instagram.com/v1/users/13460080?access_token=' . $sbi_options['sb_instagram_at'];
        $args = array(
            'timeout' => 60,
            'sslverify' => false
        );
        $search_result = wp_remote_get( $url, $args );
        $search_data = json_decode( $search_result['body'] );

        if ( isset( $data->meta->code ) ) {
            echo "\n" . 'Instagram Response' . "\n";
            echo 'code: ' . $search_data->meta->code . "\n";
            if ( isset( $search_data->meta->error_message ) ) {
                echo 'error_message: ' . $search_data->meta->error_message . "\n";
            }
        }

    } else {
        echo 'No id returned' . "\n";
        echo 'code: ' . $data->meta->code . "\n";
        if ( isset( $data->meta->error_message ) ) {
            echo 'error_message: ' . $data->meta->error_message . "\n";
        }
    }

} else {
    echo 'No Access Token';
}?>
        </textarea>

<?php 
} //End Support tab 
?>


    <div class="sbi_quickstart">
        <h3><i class="fa fa-rocket" aria-hidden="true"></i>&nbsp; Display your feed</h3>
        <p>Copy and paste this shortcode directly into the page, post or widget where you'd like to display the feed:        <input type="text" value="[instagram-feed]" size="15" readonly="readonly" style="text-align: center;" onclick="this.focus();this.select()" title="To copy, click the field then press Ctrl + C (PC) or Cmd + C (Mac)."></p>
        <p>Find out how to display <a href="?page=sb-instagram-feed&amp;tab=display">multiple feeds</a>.</p>
    </div>

    <a href="https://smashballoon.com/instagram-feed/demo" target="_blank" class="sbi-pro-notice">
        <img src="<?php echo plugins_url( 'img/instagram-pro-promo.png' , __FILE__ ) ?>" alt="<?php esc_attr_e( 'Instagram Feed Pro', 'instagram-feed' ); ?>">
    </a>

    <p class="sbi_plugins_promo dashicons-before dashicons-admin-plugins"> <?php _e('Check out our other free plugins:', 'instagram-feed' ); ?> <a href="https://wordpress.org/plugins/custom-facebook-feed/" target="_blank">Facebook</a> and <a href="https://wordpress.org/plugins/custom-twitter-feeds/" target="_blank">Twitter</a>.</p>

    <div class="sbi_share_plugin">
        <h3><?php _e('Like the plugin? Help spread the word!', 'instagram-feed'); ?></h3>

        <!-- TWITTER -->
        <a href="https://twitter.com/share" class="twitter-share-button" data-url="https://wordpress.org/plugins/instagram-feed/" data-text="Display beautifully clean, customizable, and responsive feeds from multiple Instagram accounts" data-via="smashballoon" data-dnt="true">Tweet</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        <style type="text/css">
        #twitter-widget-0{ float: left; width: 100px !important; }
        .IN-widget{ margin-right: 20px; }
        </style>

        <!-- FACEBOOK -->
        <div id="fb-root" style="display: none;"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=640861236031365&version=v2.0";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        <div class="fb-like" data-href="https://wordpress.org/plugins/instagram-feed/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true" style="display: block; float: left; margin-right: 20px;"></div>

        <!-- LINKEDIN -->
        <script src="//platform.linkedin.com/in.js" type="text/javascript">
          lang: en_US
        </script>
        <script type="IN/Share" data-url="https://wordpress.org/plugins/instagram-feed/"></script>

        <!-- GOOGLE + -->
        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <div class="g-plusone" data-size="medium" data-href="https://wordpress.org/plugins/instagram-feed/"></div>
    </div>

</div> <!-- end #sbi_admin -->

<?php } //End Settings page

function sb_instagram_admin_style() {
        wp_register_style( 'sb_instagram_admin_css', plugins_url('css/sb-instagram-admin.css', __FILE__), array(), SBIVER );
        wp_enqueue_style( 'sb_instagram_font_awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
        wp_enqueue_style( 'sb_instagram_admin_css' );
        wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'sb_instagram_admin_style' );

function sb_instagram_admin_scripts() {
    wp_enqueue_script( 'sb_instagram_admin_js', plugins_url( 'js/sb-instagram-admin.js' , __FILE__ ), array(), SBIVER );
    wp_localize_script( 'sb_instagram_admin_js', 'sbiA', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'sbi_nonce' => wp_create_nonce( 'sbi-smash-balloon' )
        )
    );
    if( !wp_script_is('jquery-ui-draggable') ) { 
        wp_enqueue_script(
            array(
            'jquery',
            'jquery-ui-core',
            'jquery-ui-draggable'
            )
        );
    }
    wp_enqueue_script(
        array(
        'hoverIntent',
        'wp-color-picker'
        )
    );
}
add_action( 'admin_enqueue_scripts', 'sb_instagram_admin_scripts' );

// Add a Settings link to the plugin on the Plugins page
$sbi_plugin_file = 'instagram-feed/instagram-feed.php';
add_filter( "plugin_action_links_{$sbi_plugin_file}", 'sbi_add_settings_link', 10, 2 );
 
//modify the link by unshifting the array
function sbi_add_settings_link( $links, $file ) {
    $sbi_settings_link = '<a href="' . admin_url( 'admin.php?page=sb-instagram-feed' ) . '">' . __( 'Settings', 'instagram-feed' ) . '</a>';
    array_unshift( $links, $sbi_settings_link );
 
    return $links;
}


//REVIEW REQUEST NOTICE

// checks $_GET to see if the nag variable is set and what it's value is
function sbi_check_nag_get( $get, $nag, $option, $transient ) {
    if ( isset( $_GET[$nag] ) && $get[$nag] == 1 ) {
        update_option( $option, 'dismissed' );
    } elseif ( isset( $_GET[$nag] ) && $get[$nag] == 'later' ) {
        $time = 2 * WEEK_IN_SECONDS;
        set_transient( $transient, 'waiting', $time );
        update_option( $option, 'pending' );
    }
}

// will set a transient if the notice hasn't been dismissed or hasn't been set yet
function sbi_maybe_set_transient( $transient, $option ) {
    $sbi_rating_notice_waiting = get_transient( $transient );
    $notice_status = get_option( $option, false );

    if ( ! $sbi_rating_notice_waiting && !( $notice_status === 'dismissed' || $notice_status === 'pending' ) ) {
        $time = 2 * WEEK_IN_SECONDS;
        set_transient( $transient, 'waiting', $time );
        update_option( $option, 'pending' );
    }
}

// generates the html for the admin notice
function sbi_rating_notice_html() {

    //Only show to admins
    if ( current_user_can( 'manage_options' ) ){

        global $current_user;
        $user_id = $current_user->ID;

        /* Check that the user hasn't already clicked to ignore the message */
        if ( ! get_user_meta( $user_id, 'sbi_ignore_rating_notice') ) {

            _e("
            <div class='sbi_notice sbi_review_notice'>
                <img src='". plugins_url( 'instagram-feed/img/sbi-icon.png' ) ."' alt='Instagram Feed'>
                <div class='ctf-notice-text'>
                    <p>It's great to see that you've been using the <strong>Instagram Feed</strong> plugin for a while now. Hopefully you're happy with it!&nbsp; If so, would you consider leaving a positive review? It really helps to support the plugin and helps others to discover it too!</p>
                    <p class='links'>
                        <a class='sbi_notice_dismiss' href='https://wordpress.org/support/plugin/instagram-feed/reviews/' target='_blank'>Sure, I'd love to!</a>
                        &middot;
                        <a class='sbi_notice_dismiss' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', '1' ) ). "'>No thanks</a>
                        &middot;
                        <a class='sbi_notice_dismiss' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', '1' ) ). "'>I've already given a review</a>
                        &middot;
                        <a class='sbi_notice_dismiss' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', 'later' ) ). "'>Ask Me Later</a>
                    </p>
                </div>
                <a class='sbi_notice_close' href='" .esc_url( add_query_arg( 'sbi_ignore_rating_notice_nag', '1' ) ). "'><i class='fa fa-close'></i></a>
            </div>
            ");

        }

    }
}
function sb_instagram_clear_page_caches() {
	if ( isset( $GLOBALS['wp_fastest_cache'] ) && method_exists( $GLOBALS['wp_fastest_cache'], 'deleteCache' ) ){
		/* Clear WP fastest cache*/
		$GLOBALS['wp_fastest_cache']->deleteCache();
	}

	if ( function_exists( 'wp_cache_clear_cache' ) ) {
		wp_cache_clear_cache();
	}

	if ( class_exists('W3_Plugin_TotalCacheAdmin') ) {
		$plugin_totalcacheadmin = & w3_instance('W3_Plugin_TotalCacheAdmin');

		$plugin_totalcacheadmin->flush_all();
	}

	if ( class_exists( 'autoptimizeCache' ) ) {
		/* Clear autoptimize */
		autoptimizeCache::clearall();
	}
}
/**
 * Called via ajax to automatically save access token and access token secret
 * retrieved with the big blue button
 */
function sbi_auto_save_tokens() {
    if ( current_user_can( 'edit_posts' ) ) {
        wp_cache_delete ( 'alloptions', 'options' );

        $options = get_option( 'sb_instagram_settings', array() );
        $options['sb_instagram_at'] = isset( $_POST['access_token'] ) ? sanitize_text_field( $_POST['access_token'] ) : '';

        update_option( 'sb_instagram_settings', $options );
    }
    die();
}
add_action( 'wp_ajax_sbi_auto_save_tokens', 'sbi_auto_save_tokens' );

// variables to define certain terms
$transient = 'instagram_feed_rating_notice_waiting';
$option = 'sbi_rating_notice';
$nag = 'sbi_ignore_rating_notice_nag';

sbi_check_nag_get( $_GET, $nag, $option, $transient );
sbi_maybe_set_transient( $transient, $option );
$notice_status = get_option( $option, false );

// only display the notice if the time offset has passed and the user hasn't already dismissed it
if ( get_transient( $transient ) !== 'waiting' && $notice_status !== 'dismissed' ) {
    add_action( 'admin_notices', 'sbi_rating_notice_html' );
}
