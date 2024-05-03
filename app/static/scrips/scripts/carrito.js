
$(document).ready(function () {
    // Función para cargar los datos del carrito    
    var costTot;
    function cargarDatosCarrito() {
        $.ajax({
            url: 'http://localhost/api/webservice/carrito/getcarrito',
            method: 'POST',
            dataType: 'json',
            data: { id_usu: appData.id },
            success: function (response) {
                // Limpiar el contenido actual del contenedor del carrito
                console.log(response);
                $('#carrito-container').empty();

                // Verificar si hay datos en la respuesta
                if (response.datos && response.datos.length > 0) {
                    // Agregar la fila de encabezado de la tabla
                    var headerRow = '<div class="row mb-3">' +
                        '<div class="col-md-2"><strong>Imagen</strong></div>' +
                        '<div class="col-md-2"><strong>Vuelo</strong></div>' +
                        '<div class="col-md-2"><strong>Precio</strong></div>' +
                        '<div class="col-md-2"><strong>Cantidad</strong></div>' +
                        '<div class="col-md-2"></div>' +
                        '</div>';

                    // Agregar la fila de encabezado al contenedor del carrito
                    $('#carrito-container').append(headerRow);

                    // Recorrer los datos de la respuesta y construir las filas del carrito
                    $.each(response.datos, function (index, item) {
                        var newRow = '<div class="row mb-3">' +
                            '<div class="col-md-2"><img src="' + appData.uri_app + 'static/karma/img/paises/' + item.img_vuelo + '" alt="Producto ' + item.id + '" class="img-fluid"></div>' +
                            '<div class="col-md-2">' + item.ciudad_destino + '</div>' +
                            '<div class="col-md-2">$' + item.costo_vuelo + '</div>' +
                            '<div class="col-md-2">' +
                            '<input type="number" min="1" max="5" value="' + item.cantidad + '" class="form-control" data-costo="' + item.precio_total + '" data-vuelo="' + item.id_vuelo + '" data-id="' + item.id + '">' +
                            '</div>' +
                            '<div class="col-md-2"><button class="btn btn-danger" data-id="' + item.id + '">Eliminar</button></div>' +
                            '</div>';

                        // Agregar la fila al contenedor del carrito
                        $('#carrito-container').append(newRow);
                    });
                    
                    // Calcular Subtotal, IVA y Total
                    var totales = calcularSubtotalIVAyTotal(response.datos);

                    // Agregar filas para subtotal, IVA y total
                    var subtotalRow = '<div class="row">' +
                        '<div class="col-md-8"></div>' +
                        '<div class="col-md-2"><strong>Subtotal:</strong></div>' +
                        '<div class="col-md-2">$' + totales.subtotal + '</div>' +
                        '</div>';

                    var ivaRow = '<div class="row">' +
                        '<div class="col-md-8"></div>' +
                        '<div class="col-md-2"><strong>IVA (16%):</strong></div>' +
                        '<div class="col-md-2">$' + totales.iva + '</div>' +
                        '</div>';

                    var totalRow = '<div class="row">' +
                        '<div class="col-md-8"></div>' +
                        '<div class="col-md-2"><strong>Total:</strong></div>' +
                        '<div class="col-md-2">$' + totales.total + '</div>' +
                        '</div>';
                        costTot=totales.total;
                    // Agregar filas al contenedor del carrito
                    $('#carrito-container').append(subtotalRow);
                    $('#carrito-container').append(ivaRow);
                    $('#carrito-container').append(totalRow);

                    // ... (resto del código para agregar el checkbox de factura, el botón de PayPal, etc.)
                } else {
                    console.error('La respuesta de la API no contiene datos o la lista está vacía.');
                }
            },
            error: function (error) {
                console.error('Error al obtener datos del carrito desde la API:', error);
            }
        });        
    }
    
    // Función para calcular el subtotal, IVA y total
    function calcularSubtotalIVAyTotal(datos) {
        var subtotal = 0;
        $.each(datos, function (index, item) {
            subtotal += parseFloat(item.costo_vuelo) * parseInt(item.cantidad);
        });

        var iva = subtotal * 0.16; // 16% de IVA en México
        var total = subtotal + iva;

        return {
            subtotal: subtotal.toFixed(2),
            iva: iva.toFixed(2),
            total: total.toFixed(2)
        };
    }

    // Función para actualizar la cantidad mediante Ajax
    function actualizarCantidad(idProducto, nuevaCantidad, costo, numVuelo) {
        var dataCar = {
            id_usuario: appData.id,
            id_vuelo: numVuelo,
            cantidad: nuevaCantidad,
            total: nuevaCantidad * costo
        };
        costTot=dataCar.total;
        $.ajax({
            url: 'http://localhost/api/webservice/carrito/actulizaCantidad',
            method: 'POST',
            dataType: 'json',
            data: dataCar,
            success: function (response) {
                console.log(response);

                if (response.resultado === false) {
                    alert("No quedan asientos disponibles");
                }

                // Después de actualizar la cantidad, volver a cargar los datos del carrito
                cargarDatosCarrito();
            },
            error: function (error) {
                console.log('ERROR ', error);
            }
        });        
    }

      
    // Evento click para el botón de eliminar
    $('#carrito-container').on('click', '.btn-danger', function () {
        var idProducto = $(this).data('id');
        var botonEliminar = $(this);

        console.log('ID del producto a eliminar:', idProducto);

        $.ajax({
            url: 'http://localhost/api/webservice/carrito/borraCarrito',
            method: 'POST',
            dataType: 'json',
            data: { id: idProducto },
            success: function (response) {
                console.log(response);

                botonEliminar.closest('.row').remove();

                // Después de eliminar, volver a cargar los datos del carrito
                cargarDatosCarrito();
            },
            error: function (error) {
                console.log('ERROR ', error);
            }
        });
    });

    // Evento change para actualizar la cantidad mediante Ajax
    $('#carrito-container').on('change', 'input.form-control', function () {
        var idProducto = $(this).data('id');
        var nuevaCantidad = $(this).val();
        var costo = $(this).data('costo');
        var numVuelo = $(this).data('vuelo');

        // Actualizar la cantidad mediante Ajax
        actualizarCantidad(idProducto, nuevaCantidad, costo, numVuelo);
    });

    // Cargar los datos del carrito al cargar la página
    cargarDatosCarrito();

    /*$('#facturaCheckbox').change(function () {
        if ($(this).is(':checked')) {
            $('#facturaForm').show();
        } else {
            $('#facturaForm').hide();
        }
    });   
    $('#generarFactura').on('click', function () {
        // Aquí puedes agregar la lógica para generar la factura
        var rfc = $('#rfc').val();  
        data={
            id : appData.id,
            rfc : rfc
        };
        // Aquí puedes hacer la llamada AJAX para enviar estos datos al servidor
        //alert('Factura generada con éxito');
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
    });*/
     /*$('#pagarButton').on('click', function () {
        // Obtener la información actual del carrito        
        // Muestra la sección de factura cambiando el estilo de display a block
        $('#facturaSection').css('display', 'block');        
        $.ajax({
            url: 'http://localhost/api/webservice/carrito/pagaventa',
            method: 'POST',
            dataType: 'json',
            data: { id: appData.id },
            success: function (response) {
                console.log(response);
                if(response.resultado==true){
                    alert("Compra realizada");
                    $('#carrito-container').empty();
                }
            },
            error: function (error) {
                console.log('ERROR ', error);
            }
        });*/
        // Imprimir la información en la consola
        //console.log('Información del carrito:', carritoInfo);

        // Resto de tu código...

        paypal.Buttons({
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: costTot
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    // Tu lógica AJAX después de que el pago se haya aprobado
                    $.ajax({
                        url: 'http://localhost/api/webservice/carrito/pagaventa',
                        method: 'POST',
                        dataType: 'json',
                        data: { id: appData.id },
                        success: function (response) {
                            console.log(response);
                            if(response.resultado==true){                            
                                $('#carrito-container').empty();
                                window.location.href = 'http://localhost/api/app/frontend/pagoExitoso';
                            }
                        },
                        error: function (error) {
                            console.log('ERROR ', error);
                        }
                    });
                                                
                });
            },
            style: {
                layout: 'vertical',
                color: 'blue',
                shape: 'rect',
                label: 'paypal',
                height: 40
            }
        }).render('#pagarButton');
    });
    // Tu script JavaScript

/*$('#generarFactura').on('click', function () {
    // Obtener datos del formulario
    var nombre = $('#nombre').val();
    var direccion = $('#direccion').val();

    // Realizar solicitud Ajax al controlador
    $.ajax({
        url: 'http://localhost/api/webservice/carrito/getfactura',
        method: 'POST',
        data: { idUsuario: 17 },
        success: function (response) {
            // El PDF se generará y se descargará automáticamente
        },
        error: function (error) {
            console.log('Error:', error);
        }
    });
});*/





