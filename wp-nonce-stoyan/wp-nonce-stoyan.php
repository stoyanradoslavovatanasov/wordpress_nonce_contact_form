<?php

/*
 * Plugin Name: WP Nonce Contact Form
 * Description: This is a contact form plugin with nonce anti-spam security.
 * Version: 0.0.1
 * Author:            Stoyan Atanasov
 * Text Domain:       wp-nonce-stoyan
*/
// In this page we load all contact form messages from each xml file so we can view them in the backend (furhter things to be done deleting and editing messages).
// We also can change nonce security code expire time, if we would like the timeframe between each message form a single user to last longer.

		
function nonce_register_fields() {
	register_setting( 'general', 'nonce', 'absint' );
	add_settings_section( 'nonce', '<label for="nonce">' . __( 'Messages from WP Nonce Contact Form', 'nonce-extender' ) . '</label>', 'nonce_extender_render_field', 'general' );
}

function nonce_extender_render_field() {
	$value = get_option( 'nonce', DAY_IN_SECONDS );

	$files = glob(__DIR__ ."/php/messages/*xml");

	if (is_array($files)) {
	
		foreach($files as $filename) {
			$xml=simplexml_load_file($filename);
			
			foreach($xml->children() as $child) {
					echo $child->getName() . ": " . $child . "; ";
			}
			echo '<p>';
		}
	}

?>

    <input type="number" id="nonce" name="nonce" value="<?php echo $value ?>" min="0"/>
    <p class="description" id="nonce-description"><?php echo ( 'Change the nonce security code expire time (SECONDS).' ); ?></p>

<?php
}

function nonce_filter( $lifetime ) {
	$nonce = get_option( 'nonce' );
	if ( false !== $nonce && ! ( defined( 'DISABLE_NONCE_EXTENDER' ) && DISABLE_NONCE_EXTENDER ) ) {
		$lifetime = absint( $nonce );
	}
	return $lifetime;
}

add_filter( 'admin_init', 'nonce_register_fields' );
add_filter( 'nonce_life', 'nonce_filter' );

function elegance_referal_init()
{
	if(is_page('contactus')){	
		$dir = plugin_dir_path( __FILE__ );
		require($dir."form-template.php");

	}
}

add_action( 'wp', 'elegance_referal_init' );


//Add Events page on activation:
function install_events_pg(){
        $new_page_title = 'contactus';
        $new_page_content = '';
        $new_page_template = ''; 
        $page_check = get_page_by_title($new_page_title);
        $new_page = array(
                'post_type' => 'page',
                'post_title' => $new_page_title,
                'post_content' => $new_page_content,
                'post_status' => 'publish',
                'post_author' => 1,
        );
        if(!isset($page_check->ID)){
                $new_page_id = wp_insert_post($new_page);
                if(!empty($new_page_template)){
                        update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
                }
        }
}

register_activation_hook(__FILE__, 'install_events_pg');
