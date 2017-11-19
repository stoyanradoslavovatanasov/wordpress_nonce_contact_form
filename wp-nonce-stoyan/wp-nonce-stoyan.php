<?php
/*
 * Plugin Name: WP Nonce Contact Form
 * Description: This is a contact form plugin with nonce anti-spam security.
 * Version: 0.0.1
 * Author:            Stoyan Atanasov
 * Text Domain:       wp-nonce-stoyan
*/
// After the plugin has been activated, it automaticly created page with the name "contactus", redirect_contactus creates redirect to the form, so it can be seen in cotactsus page.
// In this page we load all contact form messages from each xml file so we can view them in the backend, we have a button that allows us to delete all the messages,
// We also can change nonce security code expire time, if we would like the timeframe between each message form a single user to last longer.
	
function nonce_register_fields() {
	register_setting( 'general', 'nonce', 'absint' );
	add_settings_section( 'nonce', '<label for="nonce">' . __( 'Messages from WP Nonce Contact Form', 'nonce-extender' ) . '</label>', 'nonce_extender_render_field', 'general' );
	add_settings_section( 'nonce2', '<label for="nonce">' . __( 'Change the nonce security code expire time (SECONDS).', 'nonce-extender' ) . '</label>', 'nonce_extender_render_field2', 'general' );

}

function nonce_extender_render_field() {
?>	
	<iframe src="/wp-content/plugins/wp-nonce-stoyan/php/delete.php" name="targetframe" allowTransparency="false" scrolling="no" frameborder="0" width="180" height="40"></iframe>
<?php	
	$files = glob(__DIR__ ."/php/messages/*xml");

	if (is_array($files)) {
	echo '<table style="font-family: arial, sans-serif; border-collapse: collapse; width: 100%;"><tr><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>';
		foreach($files as $filename) {
			echo '<tr>';
			$xml=simplexml_load_file($filename);
			
			foreach($xml->children() as $child) {
			echo  '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $child . '</td>';
			}

		}
			echo '</tr></table>';
	}

}

function nonce_extender_render_field2() {
$value = get_option( 'nonce', DAY_IN_SECONDS );
?>


<input type="number" id="nonce" name="nonce" value="<?php echo $value ?>" min="0"/>
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
// Creates redirect to the form
function redirect_contactus()
{
	if(is_page('contactus')){	
		$dir = plugin_dir_path( __FILE__ );
		require($dir."form-template.php");

	}
}

add_action( 'wp', 'redirect_contactus' );


//Add Events page on activation:
function create_contactus(){
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

register_activation_hook(__FILE__, 'create_contactus');
?>

