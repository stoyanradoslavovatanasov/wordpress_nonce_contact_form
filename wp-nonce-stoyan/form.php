<?php
//This is our frontend page for the contact form

require_once $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php';
require_once(realpath(dirname(__FILE__) . '/wp-nonce-stoyan.php'));

//Includes form.php in the contactus page.

?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/animate.css">

<h3>WP Nonce Contact From</h3>
<form role="form" id="contactForm">
	 <div class="row">
            <div class="form-group col-sm-6">
                <label for="name" class="h4">Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
				<div class="help-block with-errors"></div>
            </div>
            <div class="form-group col-sm-6">
                <label for="email" class="h4">Email</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
				<div class="help-block with-errors"></div>
            </div>
        </div>
        <div class="form-group">
            <label for="message" class="h4 ">Message</label>
            <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" name="message" required></textarea>
			<div class="help-block with-errors"></div>
        </div>
		<input name="date"  id="date" value="<?php echo date("Y/m/d h:i:sa") ?>" type="hidden">

		<?php wp_nonce_field( 'my_action', 'nonce' ); ?>
		
        <button type="submit" id="form-submit" class="btn btn-success btn-lg pull-right ">Submit</button>
<div id="msgSubmit" class="h3 text-center hidden"></div>
</form>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/validator.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>