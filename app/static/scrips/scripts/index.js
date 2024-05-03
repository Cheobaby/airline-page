/*$(document).ready(function(){
    $.ajax({
        url: 'http://localhost/api/webservice/carrito/getproductos', // Reemplaza con la URL de tu API
        method: 'GET',
        dataType: 'json',
        success: function(response) {
            // Suponiendo que la respuesta contiene la URL de la imagen
            // var imageUrl = 'http://localhost/api/app/static/karma/img/paises/${response.img_vuelo}';        
            var numeroVuelo = response.data[0].img_vuelo;
            console.log(numeroVuelo);
            var uri= appData.uri_app;
            console.log(uri);
            // Actualizar la fuente de la imagen en tu HTML
            // $('#popo').attr('src', imageUrl);
        },
        error: function(error) {
            console.error('Error al obtener la imagen desde la API:', error);
        }
    });
});*/
// Realizar solicitud Ajax al backend
/*$.ajax({
    url: 'http://localhost/api/webservice/carrito/getproductos', // Reemplaza esto con la URL real del backend
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        // Verificar si la respuesta tiene datos
        if (data.resultado && data.data.length > 0) {
            // Obtén la referencia al contenedor del carrusel
            var productCarousel = $('#product-carousel');

            // Itera sobre los datos y agrega cada producto al carrusel
            data.data.forEach(function(product) {
                // Crea un nuevo elemento div para representar un producto
                var productElement = $('<div class="single-product-slider"></div>');

                // Contenido del producto
                productElement.html(`
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6 text-center">
                                <div class="section-title">
                                    <h1>${product.origen_nombre}</h1>
                                    <p>${product.fecha_salida}</p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="single-product">
                                <img class="img-fluid" src="${appData.uri_app}static/karma/img/paises/${product.img_vuelo}" alt="">
                                    <div class="product-details">
                                        <h6>${product.numero_vuelo}</h6>
                                        <div class="price">
                                            <h6>${product.costo_vuelo}</h6>
                                        </div>
                                        <!-- Agrega otros detalles según sea necesario -->
                                    </div>
                                </div>
                            </div>
                            <!-- Repite la estructura para otros productos -->
                        </div>
                    </div>
                `);

                // Agrega el producto al carrusel
                productCarousel.append(productElement);
            });
        } else {
            console.error('No se recibieron datos del backend.');
        }
    },
    error: function(xhr, status, error) {
        console.error('Error en la solicitud Ajax:', status, error);
    }
});*/
// Realiza una solicitud AJAX para obtener los datos de la API
/*$(document).ready(function () {
    // Hacer una solicitud AJAX para obtener los productos
    $.ajax({
        url: 'http://localhost/api/webservice/carrito/getproductos',
        method: 'GET',
        dataType: 'json',
        success: function (response) {
            // Llamar a la función para construir los productos
            construirProductos(response.data);
        },
        error: function (error) {
            console.error('Error al obtener productos desde la API:', error);
        }
    });

    // Función para construir productos y agregarlos al contenedor
    function construirProductos(productos) {
        // Obtener el contenedor de productos
        var contenedorProductos = $('#product-carousel');

        // Iterar sobre la lista de productos
        productos.forEach(function (producto) {
            // Crear el HTML del producto
            var htmlProducto = `
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" src="${appData.uri_app}static/karma/img/paises/${producto.img_vuelo}" alt="">
                        <div class="product-details">
                            <h6>${producto.origen_ciudad} a ${producto.destino_ciudad}</h6>
                            <div class="price">
                                <h6>$${producto.costo_vuelo}</h6>
                            </div>
                            <div class="prd-bottom">
                                <!-- Agregar más detalles o acciones según sea necesario -->
                            </div>
                        </div>
                    </div>
                </div>
            `;

            // Agregar el producto al contenedor
            contenedorProductos.append(htmlProducto);
        });
    }
});
*/