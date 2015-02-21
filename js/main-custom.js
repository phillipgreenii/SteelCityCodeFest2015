$(document).ready(function(){ 
	$("body").on("click", "#register", function() { 
		window.location.href = "Registration.php";
	});
	
	$("body").on("click", "#sub_reg", function() {
		alert("made it");
		$.ajax({ 
			type: 'POST',
			url: 'rest/Register.php', 
			data: $('#reg').serialize()
		})
		.success(function(data){  
			alert(data);
		})
		.fail(function() {
			alert(data);
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
			alert(data);
		})
		.fail(function(data) {
			alert(data);
		})
	});
	
	
});