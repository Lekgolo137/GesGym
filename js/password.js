function check(input) {
	if (input.value != document.getElementById("password").value) {
		if(document.title.valueOf() == "Apunta - Register"){
			input.setCustomValidity("Passwords do not match.");
		}else{
			input.setCustomValidity("Las contraseñas no coinciden.");
		}
	} else {
		input.setCustomValidity("");
	}
}