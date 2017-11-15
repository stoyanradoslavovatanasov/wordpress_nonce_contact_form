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
	add_settings_field( 'nonce', '<label for="nonce">' . __( 'Messages from WP Nonce Contact Form', 'nonce-extender' ) . '</label>', 'nonce_extender_render_field', 'general' );
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


