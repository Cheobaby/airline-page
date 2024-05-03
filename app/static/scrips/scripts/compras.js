// Realiza la petición AJAX
/*$.ajax({
    url: 'http://localhost/api/webservice/carrito/getcompras/4',
    method: 'GET',    
    success: function(response) {
        // Verifica que el resultado sea verdadero y que existan compras
        if (response.resultado && response.compras.length > 0) {
            console.log("ID USUARIO",appData.id);
            // Itera sobre cada compra
            $.each(response.compras, function(index, compra) {
                // Completa la URL de la imagen
                var imgUrl =  appData.uri_app + 'static/karma/img/paises/' + compra.img_vuelo;

                // Construye el HTML para cada compra
                var compraHTML = `
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img src="${imgUrl}" class="card-img" alt="Vuelo Image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">${compra.numero_vuelo} <i class="fas fa-plane"></i></h5>
                                    <p class="card-text"><strong>Ruta:</strong> ${compra.ciudad_origen}, ${compra.pais_origen} &rarr; ${compra.ciudad_destino}, ${compra.pais_destino}</p>
                                    <p class="card-text"><strong>Costo del Vuelo:</strong> $${compra.costo_vuelo}</p>
                                    <p class="card-text"><strong>Método de Pago:</strong> <i class="fas fa-credit-card"></i> ${compra.metodo_pago}</p>
                                    <p class="card-text"><strong>Monto Pagado:</strong> $${compra.monto}</p>
                                    <p class="card-text"><strong>Fecha de Pago:</strong> ${compra.fecha_pago}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `;

                // Agrega el HTML de la compra al contenedor
                $('.container').append(compraHTML);
            });
        } else {
            // Maneja el caso en el que no hay compras o el resultado es falso
            // Por ejemplo, muestra un mensaje de error o realiza alguna otra acción
        }
    },
    error: function(xhr, status, error) {
        // Maneja el error de la petición AJAX
        console.error("Error en la petición AJAX: " + status, error);
    }
});
*/
/*$(document).ready(function() {
    // Realiza la petición AJAX
    console.log(appData.id);
    var id=appData.id;
    $.ajax({
        url: 'http://localhost/api/webservice/carrito/getcompras/'+id,
        method: 'GET',
        success: function(response) {
            // Verifica que el resultado sea verdadero y que existan compras
            if (response.resultado && response.compras.length > 0) {
                // Itera sobre cada compra
                $.each(response.compras, function(index, compra) {
                    // Completa la URL de la imagen
                    var imgUrl =  appData.uri_app + 'static/karma/img/paises/' + compra.img_vuelo;

                    // Construye el HTML para cada compra
                    var compraHTML = `
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="${imgUrl}" class="card-img" alt="Vuelo Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${compra.numero_vuelo} <i class="fas fa-plane"></i></h5>
                                        <p class="card-text"><strong>Ruta:</strong> ${compra.ciudad_origen}, ${compra.pais_origen} &rarr; ${compra.ciudad_destino}, ${compra.pais_destino}</p>
                                        <p class="card-text"><strong>Costo del Vuelo:</strong> $${compra.costo_vuelo}</p>
                                        <p class="card-text"><strong>Método de Pago:</strong> <i class="fas fa-credit-card"></i> ${compra.metodo_pago}</p>
                                        <p class="card-text"><strong>Monto Pagado:</strong> $${compra.monto}</p>
                                        <p class="card-text"><strong>Fecha de Pago:</strong> ${compra.fecha_pago}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    // Agrega el HTML de la compra al contenedor
                    $('.container').append(compraHTML);
                });
            } else {
                // Maneja el caso en el que no hay compras o el resultado es falso
                // Por ejemplo, muestra un mensaje de error o realiza alguna otra acción
            }
        },
        error: function(xhr, status, error) {
            // Maneja el error de la petición AJAX
            console.error("Error en la petición AJAX: " + status, error);
        }
    });
});
*/
// Definir la función fuera del $(document).ready
// Definir la función fuera del $(document).ready
function factura(fechaCompra){
    var data={
        fecha : fechaCompra,
        id : appData.id        
    };
    $.ajax({
        url: 'http://localhost/api/webservice/carrito/generarFacturaXML/',
        method: 'POST',
        dataType: 'text',            
        data : data,
        success: function (xmlContent) {
            // Eliminar la declaración XML si existe
            xmlContent = xmlContent.replace(/^<\?xml[\s\S]*?\?>/, '');

            // Crear un enlace de descarga
            var link = document.createElement('a');
            link.href = 'data:text/xml;charset=utf-8,' + encodeURIComponent(xmlContent);
            link.download = 'factura.xml';

            // Agregar el enlace al documento
            document.body.appendChild(link);

            // Simular un clic en el enlace para iniciar la descarga
            link.click();

            // Limpiar el enlace y liberar recursos
            document.body.removeChild(link);
        },
        error: function (error) {
            console.log('ERROR ', error);
        }
    });
}
function mostrarDetalles(fechaCompra) {
    console.log('Función mostrarDetalles llamada');
    console.log('Fecha de compra:', fechaCompra);

    $.ajax({
        url: 'http://localhost/api/webservice/carrito/detallecompras/' + appData.id + '/' + fechaCompra,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            if (response.resultado && response.compras.length > 0) {
                // Limpiar el contenedor antes de agregar nuevos elementos
                $('#detalle-compra-container').empty();
                $('#detalles').empty();
              
                $.each(response.compras, function(index, compra) {
                    // Completa la URL de la imagen
                    var imgUrl =  appData.uri_app + 'static/karma/img/paises/' + compra.img_vuelo;

                    // Construye el HTML para cada compra
                    var compraHTML = `
                        <div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-4">
                                    <img src="${imgUrl}" class="card-img" alt="Vuelo Image">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title">${compra.numero_vuelo} <i class="fas fa-plane"></i></h5>
                                        <p class="card-text"><strong>Ruta:</strong> ${compra.ciudad_origen}, ${compra.aeropuerto_origen} &rarr; ${compra.ciudad_destino}, ${compra.aeropuerto_destino}</p>
                                        <p class="card-text"><strong>Costo del Vuelo:</strong> $${compra.costo_vuelo}</p>
                                        <p class="card-text"><strong>Método de Pago:</strong> <i class="fas fa-credit-card"></i>Paypal</p>
                                        <p class="card-text"><strong>Monto Pagado:</strong> $${compra.monto_total}</p>
                                        <p class="card-text"><strong>Fecha de Pago:</strong> ${compra.fecha_emision}</p>
                                        <p class="card-text"><strong>Asientos asignado(s):</strong> ${compra.asientos_asignados}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    // Agrega el HTML de la compra al contenedor
                    $('#detalles').append(compraHTML);
                });
            }
        },
        error: function (error) {
            console.error('Error al obtener datos de compras desde la API:', error);
        }
    });
}


$(document).ready(function () {
    $.ajax({
        url: 'http://localhost/api/webservice/carrito/historialcompras/' + appData.id,
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            console.log(response);
            // Limpiar solo el contenido del tbody
            $('#carrito-container tbody').empty();
            var i = 0;
            // Verificar si hay datos en la respuesta
            if (response.resultado && response.compras.length > 0) {
                // Recorrer los datos de la respuesta y construir las filas del carrito
                $.each(response.compras, function (index, item) {
                    i++;
                    var newRow = '<tr>' +
                        '<th scope="row">' + i + '</th>' +
                        '<td>' + item.fecha_compra.substring(0, 10) + '</td>' +
                        '<td>$' + item.monto_total + '</td>' +
                        '<td><button class="btn btn-primary" data-toggle="modal" data-target="#detallesModal" onclick="mostrarDetalles(\'' + item.fecha_compra + '\')">Ver detalles</button></td>' +
                        '<td><button class="btn btn-primary" data-toggle="modal" data-target="#detallesModal" onclick="factura(\'' + item.fecha_compra + '\')">Factura XML</button></td>' +
                        '</tr>';

                    // Agregar la fila al cuerpo de la tabla
                    $('#carrito-container tbody').append(newRow);
                });
            } else {
                console.error('La respuesta de la API no contiene datos o la lista está vacía.');
            }
        },
        error: function (error) {
            console.error('Error al obtener datos de compras desde la API:', error);
        }
    });
});

    

