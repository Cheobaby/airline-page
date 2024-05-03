$(document).ready(function(){
    var id = 1;
    
    $.ajax({
        url: 'http://localhost/api/webservice/carrito/getdeseos/'+appData.id,
        method: 'GET',
        dataType: 'json',        
        success: function (response){
            // Limpiar el contenido actual de la tabla
            $('#lista-deseos-table tbody').empty();            
            // Verificar si hay datos en la respuesta
            if (response.resultado && response.lista && response.lista.length > 0) {
                // Recorrer los datos de la respuesta de la API y construir las filas de la tabla
                $.each(response.lista, function(index, deseos) {
                    var newRow = '<tr class="deseo-item">' +
                        '<td><img src="' + appData.uri_app + 'static/karma/img/paises/'+deseos.img_vuelo + '" alt="Deseo ' + deseos.id_listadeseos + '" style="width: 150px; height: 100px;" data-id="' + deseos.id_listadeseos + '"></td>'+
                        '<td>' + deseos.ciudad_destino + ', ' + deseos.pais_destino + '</td>' +
                        '<td>' + deseos.fecha_salida + '</td>' +
                        '<td>$' + deseos.costo_vuelo + '</td>' +
                        //'<td><button class="btn btn-primary">Añadir a la Lista</button></td>' +
                        '<td><button class="btn btn-danger eliminar-btn">Eliminar</button></td>' +
                        '</tr>';
                    $('#lista-deseos-table tbody').append(newRow);
                });
            } else {
                console.error('La respuesta de la API no contiene datos o la lista está vacía.');
            }                     
        },
        error: function (error) {
            console.error('Error al obtener productos desde la API:', error);
        }
    });

    // Controlador de eventos para el botón "Añadir a la Lista"
    /*$('#lista-deseos-table').on('click', '.btn-primary', function() {
        var idDeseos = $(this).closest('.deseo-item').find('img').data('id'); // Obtener el id de deseos
        console.log('ID de deseos (Añadir):', idDeseos);
        agregarCarrito();

        // Realizar las acciones que necesites con el id de deseos
    });*/

    // Controlador de eventos para el botón "Eliminar"
    $('#lista-deseos-table').on('click', '.eliminar-btn', function() {
        var idDeseos = $(this).closest('.deseo-item').find('img').data('id'); // Obtener el id de deseos
        console.log('ID de deseos (Eliminar):', idDeseos);
        eliminarDeseo(idDeseos);
        // Realizar las acciones que necesites con el id de deseos para eliminar
    });
    // Dentro de la función eliminarDeseo(id)
    function eliminarDeseo(id){
        console.log('ELIMINAR DESEO ', id);
        $.ajax({
            url: 'http://localhost/api/webservice/carrito/borradeseo',
            method: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function(response){
                if(response.resultado === true){
                    alert('Elemento eliminado');
                    // Eliminar la fila correspondiente de la tabla en la interfaz de usuario
                    $('#lista-deseos-table tbody').find('tr.deseo-item').has('img[data-id="' + id + '"]').remove();
                }
            },
            error: function(error){
                console.log('Error', error);
            }
        });
    }    
});

