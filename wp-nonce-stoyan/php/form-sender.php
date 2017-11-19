<?php
// The Script Collects the values from the form,
// first its checking if there is a file with the same nonce security code, 
// and if there isn't checkes is the security code is the same as the client's, and if it is creates a new xml file.
require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
$filename = __DIR__ . '/messages/message_'.$_POST['nonce'].'.xml';
// Checkes if a file with the same name exist. 
if (file_exists($filename)) {
	print 'You have already submitted this form. Thanks!';	
}
else{
// Checkes is the Nonce Security Code is Valid.
	if ( 
		! isset( $_POST['nonce'] ) 
		|| ! wp_verify_nonce( $_POST['nonce'], 'my_action' ) 
		) {
			echo "Verification Failed! Your Nonce Security Code is not valid.";
// Creates the xml file with the values from the form.
	} else {
		$name = $_POST["name"];
		$email = $_POST["email"];
		$message = $_POST["message"];
		$date = $_POST["date"];
		$file = fopen( __DIR__ . '/messages/message_' .$_POST['nonce'].'.xml', 'w'); 
		$content = '<?xml version="1.0" encoding="UTF-8"?><form><name>' .$name. '</name><email>' .$email.'</email><message>' .$message. '</message><date>' .$date. '</date></form>';
		fwrite($file , $content); 
		fclose($file ); 
		
		print 'Contact form has been send, and your Security Code has been verified. Your Nonce ID is: ' .$_POST['nonce'];

}
}
?>