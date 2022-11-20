function validateRegister() {
	var fname = $('#fname').val();
	var lname = $('#lname').val();
	var email = $('#email').val();
	
	var pass = $('#pass').val();
	var pass2 = $('#pass2').val();
	
	var contact = $('#contact').val();

	var passError = $('#invalid_pass');
	var nameError = $('#invalid_name');
	var emailError = $('#invalid_email');
	var countryError = $('#invalid_country');
	var cityError = $('#invalid_city');
	var contactError = $('#invalid_contact');

	if(pass2 !== pass) {
		passError.html("Passwords do not match");
		passError.css("display", "inline-block");
		return;
	} else {
		passError.css("display", "none");
	}

	if(pass.length > 150 || pass.length < 8) {
		passError.html("Enter a password between 8 and 24 characters");
		passError.css("display", "inline-block");
		return;
	} else {
		passError.css("display", "none");
	}


	if(email.length > 50 || email.length < 3) {
		emailError.html("Enter an email of length between 3 and 50");
		emailError.css("display", "inline-block");
		return;
	} else {
		emailError.css("display", "none");
	}


	if(contact.length >= 15 || contact.length < 10) {
		contactError.html("Enter a phone number between 10 and 15 numbers");
		contactError.css("display", "inline-block");
		return;
	} else {
		contactError.css("display", "none");
	} 

	// $('#theForm').submit();
	$('#submitButton').click();
	// console.log(email);
	return;
}