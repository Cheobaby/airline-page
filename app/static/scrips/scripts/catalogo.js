$(document).ready(function(){

 
    // Realizar una solicitud AJAX al servidor    
    $.ajax({
      url: 'http://localhost/api/webservice/carrito/getproductos', // Reemplaza con la URL de tu endpoint
      method: 'GET',
      dataType: 'json',
      success: function (data){
        // Manejar los datos recibidos
        console.log(appData.id);
        if (data.resultado && data.data) {
          // Limpiar el contenedor de tarjetas
          $('#card-container').empty();

          // Iterar sobre los datos y construir las tarjetas
          $.each(data.data, function (index, item) {
            // Crear una nueva tarjeta
            var card = $('<div class="col-md-4">' +
              '<div class="card mb-4 box-shadow">' +
              '<img data-costo="' + item.costo_vuelo + '" id="' + item.id + '" class="card-img-top" src="' + appData.uri_app + 'static/karma/img/paises/'+item.img_vuelo + '" alt="Card image cap">' +
              '<div class="card-body">' +
              '<p class="card-text">Viaje a ' + item.destino_ciudad + '</p>' +
              '<p class="card-text">Lugar de salida ' + item.origen_nombre +' '+item.origen_ciudad+ '</p>' +
              '<p class="card-text">Fecha de salida: ' + item.fecha_salida + '</p>' +
              '<p class="card-text">Costo del vuelo: $' + item.costo_vuelo + '</p>' +
              '<div class="d-flex justify-content-between align-items-center">' +
              '<div class="btn-group">' +
              '<button type="button" class="btn btn-md btn-primary">' +
              '<i class="fas fa-shopping-cart"></i> <!-- Icono de carrito de compra -->' +
              '</button>' +
              '<button type="button" class="btn btn-md btn-danger">' +
              '<i class="fas fa-heart"></i> <!-- Icono de corazón para la lista de deseos -->' +
              '</button>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>' +
              '</div>');


              card.find('.btn-primary').on('click', function() {
                var productId = $(this).closest('.card').find('img').attr('id');                
                var costo_vuelo = $(this).closest('.card').find('img').data('costo');
                console.log('ID del vuelo (agregar al carrito):', productId);
                console.log('Costo del vuelo:', costo_vuelo);
                var data={
                  id_vuelo : productId,
                  id_usuario : appData.id,
                  costo_vuel : costo_vuelo
                };
                $.ajax({
                  url : "http://localhost/api/webservice/carrito/addCarrito",
                  type : 'POST',
                  data : data,
                  success : function(response){                              
                    alert("Agregado al carrito");                    
                  },
                  error : function(error){
                    console.log("ERROR ",error);
                  }
                });
            });
                        
            card.find('.btn-danger').on('click', function() {
                var productId = $(this).closest('.card').find('img').attr('id');
                console.log('ID del producto (lista de deseos):', productId);
                var data={
                    id_vuelo : productId,
                    id_usuario : appData.id
                };
                // Realizar una solicitud POST al endpoint de la API que agrega un producto a la lista de deseos
                $.ajax({
                    url: 'http://localhost/api/webservice/carrito/agregadeseo',
                    type: 'POST',
                    data: data, // Agrega la variable id de PHP como userId
                    success: function(response) {                      
                        if(response.resultado===true){
                          alert("agregado");
                          //showAlert("success","Agregado");
                          //alert("agregado");                          
                          //console.log('Producto agregado a la lista de deseos:', response);
                          //mensaje("Producto agregado a la lista de deseos");

                        }else{
                          //showAlert("danger","Ya se encuentra en la lista");
                          alert("ya se encuntra en lista");
                          //alert('El producto se ha agregado');
                          //console.log('Producto no agregado', response);

                        }                                              
                        // Aquí puedes agregar lógica adicional si es necesario
                    },
                    error: function(error) {
                        console.error('Error al agregar el producto a la lista de deseos:', error);
                    }
                });
            });                                    
            // Agregar la tarjeta al contenedor
            $('#card-container').append(card);
          });
        } else {
          console.error('Error en la respuesta del servidor');
        }
      },
      error: function () {
        console.error('Error al realizar la solicitud AJAX');
      }
    });
    $.ajax({
      url: 'http://localhost/api/webservice/usuarios/getpaisesfiltrar',
      method: 'GET',
      dataType: 'json',
      success: function (data) {
          console.log(data); // Cambiado de response a data
          if (data.resultado && data.resultado.length > 0) {
              // Limpiar las opciones actuales del menú desplegable
              $('#pais_filtro').empty();
  
              // Agregar una opción por defecto
              $('#pais_filtro').append('<option value="" disabled selected>Seleccionar país</option>');
  
              // Iterar sobre los datos y construir las opciones del menú desplegable
              $.each(data.resultado, function (index, item) {
                  $('#pais_filtro').append('<option value="' + item.pais_destino + '">' + item.pais_destino + '</option>');
              });
          } else {
              console.error('Error en la respuesta del servidor al obtener la lista de países');
          }
      },
      error: function () {
          console.error('Error al realizar la solicitud AJAX para obtener la lista de países');
      }
    });
    $('button.btn-primary').on('click', function () {
      // Obtener el valor seleccionado del país
      var selectedCountry = $('#pais_filtro').val();

      // Validar que se haya seleccionado un país
      if (selectedCountry) {
          // Llamar a la función AJAX con el país seleccionado
          filterByCountry(selectedCountry);
      } else {
          // Manejar el caso en el que no se haya seleccionado un país
          alert('Por favor, selecciona un país antes de filtrar.');
      }
    });
// Función para realizar la llamada AJAX con el país seleccionado
// Función para realizar la llamada AJAX con el país seleccionado
function filterByCountry(country) {
  // Realizar una solicitud AJAX con el país seleccionado
  $.ajax({
      url: 'http://localhost/api/webservice/usuarios/getproductosporpais',
      method: 'POST', // Puedes cambiar a 'GET' si es apropiado
      data: { pais: country },
      dataType: 'json',
      success: function (response) {
          // Manejar la respuesta de la llamada AJAX
          console.log('Respuesta de filtrado por país:', response);

          // Limpiar el contenedor de tarjetas
          $('#card-container').empty();

          // Iterar sobre los datos de la respuesta y construir las tarjetas
          $.each(response.resultado, function (index, item) {
              // Crear una nueva tarjeta
              var card = $('<div class="col-md-4">' +
                  '<div class="card mb-4 box-shadow">' +
                  '<img data-costo="' + item.costo_vuelo + '" id="' + item.id + '" class="card-img-top" src="' + appData.uri_app + 'static/karma/img/paises/' + item.img_vuelo + '" alt="Card image cap">' +
                  '<div class="card-body">' +
                  '<p class="card-text">Viaje a ' + item.destino_ciudad + '</p>' +
                  '<p class="card-text">Fecha de salida: ' + item.fecha_salida + '</p>' +
                  '<p class="card-text">Costo del vuelo: $' + item.costo_vuelo + '</p>' +
                  '<div class="d-flex justify-content-between align-items-center">' +
                  '<div class="btn-group">' +
                  '<button type="button" class="btn btn-md btn-primary">' +
                  '<i class="fas fa-shopping-cart"></i> <!-- Icono de carrito de compra -->' +
                  '</button>' +
                  '<button type="button" class="btn btn-md btn-danger">' +
                  '<i class="fas fa-heart"></i> <!-- Icono de corazón para la lista de deseos -->' +
                  '</button>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '</div>');

              // Evento de clic en el botón de agregar al carrito
              card.find('.btn-primary').on('click', function() {
                var productId = $(this).closest('.card').find('img').attr('id');                
                var costo_vuelo = $(this).closest('.card').find('img').data('costo');
                console.log('ID del vuelo (agregar al carrito):', productId);
                console.log('Costo del vuelo:', costo_vuelo);
                var data={
                  id_vuelo : productId,
                  id_usuario : appData.id,
                  costo_vuel : costo_vuelo
                };
                $.ajax({
                  url : "http://localhost/api/webservice/carrito/addCarrito",
                  type : 'POST',
                  data : data,
                  success : function(response){                              
                    alert("Agregado al carrito");                    
                  },
                  error : function(error){
                    console.log("ERROR ",error);
                  }
                });
            });

              // Evento de clic en el botón de agregar a la lista de deseos
              card.find('.btn-danger').on('click', function () {
                  var productId = $(this).closest('.card').find('img').attr('id');
                  console.log('ID del producto (lista de deseos):', productId);
                  var data = {
                      id_vuelo: productId,
                      id_usuario: appData.id
                  };
                  $.ajax({
                    url: 'http://localhost/api/webservice/carrito/agregadeseo',
                    type: 'POST',
                    data: data, // Agrega la variable id de PHP como userId
                    success: function(response) {                      
                        if(response.resultado===true){
                          alert("agregado");
                          //showAlert("success","Agregado");
                          //alert("agregado");                          
                          //console.log('Producto agregado a la lista de deseos:', response);
                          //mensaje("Producto agregado a la lista de deseos");

                        }else{
                          //showAlert("danger","Ya se encuentra en la lista");
                          alert("ya se encuntra en lista");
                          //alert('El producto se ha agregado');
                          //console.log('Producto no agregado', response);

                        }                                              
                        // Aquí puedes agregar lógica adicional si es necesario
                    },
                    error: function(error) {
                        console.error('Error al agregar el producto a la lista de deseos:', error);
                    }
                });
              });

              // Agregar la tarjeta al contenedor
              $('#card-container').append(card);
          });
      },
      error: function (error) {
          console.error('Error en la llamada AJAX de filtrado por país:', error);
          // Manejar errores si es necesario
      }
    });
  }
  // Asignar el evento de clic al botón de búsqueda
  $('#search-button').on('click', function () {
    // Obtener el valor del campo de búsqueda
    var searchTerm = $('#search-input').val();

    // Llamar a la función que realiza la búsqueda con el término ingresado
    performSearch(searchTerm);
});

// Función para realizar la búsqueda mediante AJAX
// Función para realizar la búsqueda mediante AJAX
// Función para realizar la búsqueda mediante AJAX
function performSearch(searchTerm) {
  // Realizar una solicitud AJAX para buscar con el término proporcionado
  $.ajax({
      url: 'http://localhost/api/webservice/usuarios/buscarvuelo/' + searchTerm,
      method: 'GET',
      dataType: 'json',
      success: function (response) {
          // Verificar si la respuesta es exitosa y si tiene datos
          if (response && response.datos && response.datos.length > 0) {
              // Limpiar el contenedor de tarjetas
              $('#card-container').empty();

              // Iterar sobre los datos de la respuesta y construir las tarjetas
              $.each(response.datos, function (index, item) {
                  // Construir la tarjeta (similar al código anterior)
                  var card = $('<div class="col-md-4">' +
                      '<div class="card mb-4 box-shadow">' +
                      '<img data-costo="' + item.costo_vuelo + '" id="' + item.id + '" class="card-img-top" src="' + appData.uri_app + 'static/karma/img/paises/' + item.img_vuelo + '" alt="Card image cap">' +
                      '<div class="card-body">' +
                      '<p class="card-text">Viaje a ' + item.destino_ciudad + '</p>' +
                      '<p class="card-text">Fecha de salida: ' + item.fecha_salida + '</p>' +
                      '<p class="card-text">Costo del vuelo: $' + item.costo_vuelo + '</p>' +
                      '<div class="d-flex justify-content-between align-items-center">' +
                      '<div class="btn-group">' +
                      '<button type="button" class="btn btn-md btn-primary">' +
                      '<i class="fas fa-shopping-cart"></i> <!-- Icono de carrito de compra -->' +
                      '</button>' +
                      '<button type="button" class="btn btn-md btn-danger">' +
                      '<i class="fas fa-heart"></i> <!-- Icono de corazón para la lista de deseos -->' +
                      '</button>' +
                      '</div>' +
                      '</div>' +
                      '</div>' +
                      '</div>' +
                      '</div>');
                      
                      card.find('.btn-primary').on('click', function() {
                        var productId = $(this).closest('.card').find('img').attr('id');                
                        var costo_vuelo = $(this).closest('.card').find('img').data('costo');
                        console.log('ID del vuelo (agregar al carrito):', productId);
                        console.log('Costo del vuelo:', costo_vuelo);
                        var data={
                          id_vuelo : productId,
                          id_usuario : appData.id,
                          costo_vuel : costo_vuelo
                        };
                        $.ajax({
                          url : "http://localhost/api/webservice/carrito/addCarrito",
                          type : 'POST',
                          data : data,
                          success : function(response){                              
                            alert("Agregado al carrito");                    
                          },
                          error : function(error){
                            console.log("ERROR ",error);
                          }
                        });
                    });
                                
                    card.find('.btn-danger').on('click', function() {
                        var productId = $(this).closest('.card').find('img').attr('id');
                        console.log('ID del producto (lista de deseos):', productId);
                        var data={
                            id_vuelo : productId,
                            id_usuario : appData.id
                        };
                        // Realizar una solicitud POST al endpoint de la API que agrega un producto a la lista de deseos
                        $.ajax({
                            url: 'http://localhost/api/webservice/carrito/agregadeseo',
                            type: 'POST',
                            data: data, // Agrega la variable id de PHP como userId
                            success: function(response) {                      
                                if(response.resultado===true){
                                  alert("agregado");
                                  //showAlert("success","Agregado");
                                  //alert("agregado");                          
                                  //console.log('Producto agregado a la lista de deseos:', response);
                                  //mensaje("Producto agregado a la lista de deseos");
        
                                }else{
                                  //showAlert("danger","Ya se encuentra en la lista");
                                  alert("ya se encuntra en lista");
                                  //alert('El producto se ha agregado');
                                  //console.log('Producto no agregado', response);
        
                                }                                              
                                // Aquí puedes agregar lógica adicional si es necesario
                            },
                            error: function(error) {
                                console.error('Error al agregar el producto a la lista de deseos:', error);
                            }
                        });
                    });   
                  // Eventos de clic en los botones (similar al código anterior)
                  // ...

                  // Agregar la tarjeta al contenedor
                  $('#card-container').append(card);
              });
          } else {
              // Mostrar un mensaje de error si la respuesta no tiene datos
              console.error('Error en la respuesta de la búsqueda: No se encontraron resultados.');
              // Puedes mostrar un mensaje al usuario o manejar el caso según tus necesidades
          }
      },
      error: function (error) {
          // Mostrar un mensaje de error si hay un problema con la solicitud AJAX
          console.error('Error en la llamada AJAX de búsqueda:', error);
          // Puedes mostrar un mensaje al usuario o manejar el caso según tus necesidades
      }
  });
}


});

