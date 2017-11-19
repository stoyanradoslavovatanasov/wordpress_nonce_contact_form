// In this JS file we validate the form and collect the values form the form with AJAX.
// the AJAX sends the values to form-sender.php
// We also check if the it the script in form-sender.php succeeded.

$("#contactForm").validator().on("submit", function (event) {
    if (event.isDefaultPrevented()) {
        // invalid form
        formError();
        submitMSG(false, "Something in this form is wrong. Please check!");
    } else {
        // looks good
        event.preventDefault();
        submitForm();
    }
});


function submitForm(){
    // Get the all the variables from the form
    var name = $("#name").val();
    var email = $("#email").val();
    var message = $("#message").val();
	var date = $("#date").val();
    var nonce = $("#nonce").val(); // Get nonce values from the form

    $.ajax({
        type: "POST",
        url: "php/form-sender.php",
        data: "name=" + name + "&email=" + email + "&message=" + message  + "&date=" + date + "&nonce=" + nonce,
        success : function(text){
            if (text == "Your Nonce ID did not verify."){

				formError();
                submitMSG(false,text);
            } else {
                formSuccess();
				submitMSG(true,text);
            }
        }
    });
}

function formSuccess(){
    $("#contactForm")[0].reset();
}

function formError(){
    $("#contactForm").removeClass().addClass('shake animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
		$(this).removeClass(); 
    });
}

function submitMSG(valid, msg){
    if(valid){
        var msgClasses = "h3 text-center tada animated text-success";
    } else {
        var msgClasses = "h3 text-center text-danger";
    }
    $("#msgSubmit").removeClass().addClass(msgClasses).text(msg);
}