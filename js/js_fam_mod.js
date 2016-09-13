$(document).ready(function() {
    //Evento para agregar Familia
    $('#agregarFamilia').click(function() {
        //Elemento dinamico li
        var familia = document.getElementById('pop_inputAgregaFamilia').value;
        var liFam = $('<li data-icon="false"><a class="ui-btn" href="" id="">' + familia + '</a></li>');

        if (familia == '') {
            alert('Favor de llenar el campo');
        } else {
            alert(familia + '\n Familia Agregada');
            document.getElementById('pop_inputAgregaFamilia').value = '';
            $('#listFamilia').append(liFam);
        };
    });

    /*Evento para cancelar popup agregar familia
    $('#cancelarAgregarFamilia').click(function() {
        document.getElementById('pop_inputAgregaFamilia').value = '';
    });

    //Evento para eliminar familia
    /*$('li a').click(function() {
        var ida = $(this).attr('id');
        alert(ida)
    });

    //Evento para agregar modelo
    $('#agregarMod').click(function() {
        //Elemento dinamico li
        var modelo = document.getElementById('pop_inputAgregaModelo_FM').value;
        var liMod = $('<li data-icon="false"><a class="ui-btn" href="">' + modelo + '</a></li>');

        //alert(modelo);
        if (modelo == '') {
            alert('Favor de llenar el campo');
        } else {
            alert(modelo + '\n Modelo Agregado');
            document.getElementById('pop_inputAgregaModelo_FM').value = '';
            $('#listModelos').append(liMod);
        };
    });

    //Evento para cancelar popup agregar modelo
    $('#cancelarAgregarModelo').click(function() {
        document.getElementById('pop_inputAgregaModelo_FM').value = '';
    });*/
});