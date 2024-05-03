$(document).ready(function() {
    $("#contra").keyup(function() {
        console.log("Tecla presionada");
        console.log($("#contra2")); // Verifica si selecciona correctamente el elemento
        $("#contra2").parent().removeClass("d-none");
    });
    $("#contra2").keyup(function() {
        let operation = $("#contra").val() !== $("#contra2").val();
        if(operation){
            $("#pasIncorrect").removeClass("d-none");
        }else{
            $("#pasIncorrect").addClass("d-none");
        }     
    }); 
    $("#btn-createAccount").click(function(){
        let operation = $("#contra").val() !== $("#contra2").val();
        var dataForm={
            nombre : $("#name").val().trim(),
            email : $("#email").val().trim(),            
            direccion : $("#direccion").val().trim(),
            telefono : $("#phone").val().trim(),            
            contrasena :  $("#contra").val()
        };
        if(dataForm.nombre!=''&&dataForm.email!=''&&dataForm.email!=''&&dataForm.direccion!=''&&dataForm.telefono!=''&&!operation){
            $.ajax({
                url: "http://localhost/api/webservice/usuarios/registrausuario",                
                dataType: "text",
                method : "POST",
                data: dataForm,
                success: function(response){                    
                    console.log(response);
                    cleanData();
                },
                error: function(error){
                    console.log(error);                    
                }
            });
        }else if(operation){
            alert("La contraseña no coinciden");
        }
        else{
            alert('FALTAN CAMPOS POR LLENAR');
        }
    });    
    function cleanData(){
        $("#name").val('');
        $("#email").val('');  
        $("#direccion").val('');
        $("#phone").val('');
        $("#contra").val('');
        $("#contra2").val('');
        $("#contra2").parent().addClass('d-none');
        $("#operation").removeClass('d-none');
    }

});
