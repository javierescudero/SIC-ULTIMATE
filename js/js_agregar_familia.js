$(document).ready(function () {
	//Evento para agregar Familia
	$('#agregarFamilia').click(function () {
		//Elemento dinamico li
		var familia = document.getElementById('pop_inputAgregaFamilia').value;
		var liFam = $('<li data-icon="false"><a class="ui-btn" href="">'+ familia +'</a></li>');

		if (familia == '') {
			alert('Favor de llenar el campo');
		} else {
			alert(familia + '\n Familia Agregada');
			document.getElementById('pop_inputAgregaFamilia').value = '';
			$('#listFamilia').append(liFam);
		};
	});

	$('#cancelarAgregarFamilia').click(function () {
		document.getElementById('pop_inputAgregaFamilia').value = '';
	});
});