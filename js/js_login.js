$(document).ready(function() {
	$('#btnAceptar').click(function(){
		var user = document.getElementById('user').value;
		var password = document.getElementById('password').value;
		var area = document.getElementById('area').value;

		if (user == '' || password == '') {
			alert('Campos Vacios');
			window.location = 'login.html';
		} else if (user == 'admin' && password == '1234') {
			if (area == 'electronica') {
				alert('ELECTRONICA');
			} else if (area == 'electromecanicos') {
				alert('ELECTROMECANICOS');
			} else if (area == 'valvulas') {
				alert('VALVULAS');
			};
			//window.location='index.html';
		} else {
			alert('Usuario o Password Incorrectos');
			window.location = 'login.html';
		};
	});
});