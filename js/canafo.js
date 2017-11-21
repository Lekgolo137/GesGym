function canafo(tipo) {
	
	var x = tipo.value;
	var y = document.getElementById("canafo").placeholder;
	
	if (x == "material") {
		y = "Cantidad";
	} else {
		y = "Localización";
	}
	
}