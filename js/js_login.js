$(document).ready(function() {
	$('#btnAceptar').click(function(){
		var user = document.getElementById('user').value;
		var password = document.getElementById('password').value;

		if (user == '' || password == '') {
			alert('Campos Vacios');
			window.location = '../index.html';
		} else if (user == 'admin' && password == '1234') {
			window.location = '..php/index.php';
		} else {
			alert('Usuario o Password Incorrectos');
			window.location = '../index.html';
		};
	});
});