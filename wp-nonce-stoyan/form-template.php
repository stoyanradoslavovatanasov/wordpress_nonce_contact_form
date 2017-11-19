<?php
// This is the template page for our form.
?>
<!DOCTYPE html>
<html>
<head>
    <title>WP Nonce Contact From</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

<?php 
wp_head();
	get_header( $name );
?>
</head>
<body>
<div class="site-content-contain">
<div id="content" class="site-content">
<div class="wrap">	
<div id="primary" class="content-area">
<main id="main" class="site-main" role="main">
<div class="row">
<iframe src="/wp-content/plugins/wp-nonce-stoyan/form.php" name="targetframe" allowTransparency="false" scrolling="no" frameborder="0" ></iframe>
</div>
</main>
</div>
</div>
</div>
</div>
</body>
<style>
embed, iframe, object {
    margin-bottom: 1.5em;
    width: 100%;
    height: 600px;
    max-height: 600px;
}
</style>
<?php
//call the wp foooter
wp_footer();
get_footer( $name );
?>
</html>