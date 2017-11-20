<?php
// Plugin Unit test. The script includes 3 functions. If form nonce id exists, if nonce id is invalid, and if the id is valid.

// This test if the nonce id was already created and it should return: string(46) " You have already submitted this form. Thanks!" 

function nonce_used (){
$curl = curl_init();
$httmheader = array(
	'name'=>'Test Nonce',
	'email'=>'test@nonce.com',
	'message'=>'This is a test function create from function nonce_used() in test.php file.',
	'date'=>'00/00/0000',
	'nonce'=>'621f1ce269'
	);
 curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/wp-content/plugins/wp-nonce-stoyan/php/form-sender.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
			CURLOPT_POST => TRUE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($httmheader),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
 $response = curl_exec($curl);
 $err = curl_error($curl);
 curl_close($curl);
 var_dump($response);
};
nonce_used();

// This test if the nonce id is wrong and it should return: string(60) " Verification Failed! Your Nonce Security Code is not valid." 

function nonce_wrong(){
$curl = curl_init();
$httmheader = array(
	'name'=>'Test Nonce',
	'email'=>'test@nonce.com',
	'message'=>'This is a test function create from function nonce_wrong() in test.php file.',
	'date'=>'00/00/0000',
	'nonce'=>'wrongnonce'
	);
 curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/wp-content/plugins/wp-nonce-stoyan/php/form-sender.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
			CURLOPT_POST => TRUE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => http_build_query($httmheader),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
 $response = curl_exec($curl);
 $err = curl_error($curl);
 curl_close($curl);
 var_dump($response);
};
echo "<br>";
nonce_wrong();

// This checks if nonce id is valid and it creates new message is it is. This should return: string(99) " Contact form has been send, and your Security Code has been verified. Your Nonce ID is: 3722300e24" 

function nonce_new(){

require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
$nonce = wp_create_nonce( 'my_action'.$post->ID );
$httmheader = array(
	'name'=>'Test Nonce',
	'email'=>'test@nonce.com',
	'message'=>'This is a test function create from function nonce_new() in test.php file.',
	'date'=>'00/00/0000',
	'nonce'=>$nonce
	);
$curl = curl_init();
 curl_setopt_array($curl, array(
            CURLOPT_URL => "http://localhost/wp-content/plugins/wp-nonce-stoyan/php/form-sender.php",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
			CURLOPT_POST => TRUE,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query($httmheader),
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded"
            ),
        ));
 $response = curl_exec($curl);
 $err = curl_error($curl);
 curl_close($curl);
 var_dump($response);

};
echo "<br>";
nonce_new();

?>