$(document).ready(function(){
    $("#btn-inciarsesion").click(function(){
        // Validación del formulario
        var correo = $("#correo").val().trim();
        var pass = $("#pass").val();

        if (!correo || !pass) {
            alert('Por favor, completa todos los campos.');
            return;
        }

        var dataForm = {
            correo: correo,
            pass: pass
        };

        $.ajax({
            url: 'http://localhost/api/webservice/usuarios/acceso',
            method: 'POST',
            data: dataForm,
            dataType: 'json',
            success: function(response){
                console.log(response);
                if(response.resultado === true){
                    window.location.href = 'http://localhost/api/app/frontend';

                } else {
                    $("#operation").removeClass('d-none');
                }
            },
            error: function(error){
                // Manejo de errores más detallado
                console.log('Error en la solicitud:', error);
                alert('Hubo un error en la solicitud. Por favor, revisa la consola para más detalles.');
            }   
        });
    });
    /*$("#ejemplo").click(function(){
        var correo = $("#correo").val().trim();
        $.ajax({
            url: 'http://localhost/api/webservice/usuarios/get_productos',
            method: 'GET',            
            dataType: 'json',
            success: function(response){
                console.log(response);
                /*if(response.resultado === true){
                   alert('Inicio exitoso');
                } else {
                    alert('Inicio inválido');
                }*/
            //},
            /*error: function(error){
                // Manejo de errores más detallado
                console.log('Error en la solicitud:', error);
                alert('Hubo un error en la solicitud. Por favor, revisa la consola para más detalles.');
            }   
        });
    });*/
});
