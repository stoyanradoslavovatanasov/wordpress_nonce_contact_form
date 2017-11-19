
jQuery('#delete').click(function($) {
$.ajax({
    url:'/php/delete.php',
    type:'GET',
    data: { action: 'call_this' },
    success: function (html) {alert(html);
	}
});
});
