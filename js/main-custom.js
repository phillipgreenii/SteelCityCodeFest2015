$(document).ready(function(){
	$("body").on("click", "#register", function() {
		window.location.href = "Registration.php";
	});

	$("body").on("click", "#sub_reg", function() {
		//alert("made it");
		$.ajax({
			type: 'POST',
			url: 'rest/Register.php',
			data: $('#reg').serialize()
		})
		.success(function(data){
			window.location.href = "index.php?login=true";
		})
		.fail(function() {
			alert("Unable to process your registration form");
		})
	});

	$("body").on("click", "#login_user", function() {
		//alert("made it");
		$.ajax({
			type: 'POST',
			url: 'rest/Authenticate.php',
			data: $('#login_form').serialize()
		})
		.success(function(data){
			window.location.href = "Portal.php";
		})
		.fail(function(err) {
			if(err.status === 401) {
				alert('Username and Password are not valid');
			} else {
				alert("Unable to authenticate");
			}
		})
	});


});
