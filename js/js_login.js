$(document).ready(function() {
	$('#btnAceptar').click(function(){
		var user = document.getElementById('user').value;
		var password = document.getElementById('password').value;
		var area = document.getElementById('area').value;

		if (user == '' || password == '') {
			alert('Campos Vacios');
			window.location = 'login.html';
		} else if (user == 'admin' && password == '1234') {
			$.post('php/login.php', {
				area: area
			}, function(data, status) {
				alert(data);
				alert(status);
				if (data == 'electronica' ) {
					alert('Conexion a electronica');
				} else if (data == 'electromecanicos' ) {
					alert('Conexion a electromecanicos');
				} else if (data == 'valvulas' ) {
					alert('Conexion a valvulas');
				}
				else {
					alert('PROBLEMAS');
				}
				//window.location = 'index.html';
			});
		} else {
			alert('Usuario o Password Incorrectos');
			window.location = 'login.html';
		};
	});
});