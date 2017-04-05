function agregarDireccion(){
	var registo = document.getElementById('agregarDireccionFrom');

	registo.style.display = 'block';
}

function validateRegisterData() {
	alert("Hola");
	return false;
}

function login() {
	var email = document.getElementById('iEmailIniciar').value
	var pass = document.getElementById('iPasswordIniciar').value

	if (email != '' && pass != '') {
		var valores = {email: email, pass: pass, isLogin: '1'}
		$.ajax({
			type: 'POST',
			url: "index.php",
			data: valores,
			dataType: 'json',
			success: function(r) {
				typeof r
				alert(r)
				if (r) {
					location.reload();
					$('#iniciarsesion').modal('hide')
				} else {
					alert('Datos incorrectos!')
				}
			}
		});
	} else {
		alert('Complete los datos para iniciar sesión.');
	}
}