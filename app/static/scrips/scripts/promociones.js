$( function(){  // $.ready
    
    carga_promociones();

    $("#btn-json").click(function(){
        $("#modal-formato .modal-body").html("");
        $("#modal-formato .modal-header")
            .removeClass("bg-info text-dark")
            .addClass("bg-primary text-white")
            .find(".modal-title")
            .html("JSON");
        // Consumo de WS en JSON
        $.ajax({
            "url"  : appData.uri_ws + "backend/promociones/json/",
            "dataType"  : "json"
        })
        .done(function(obj){
            $("#modal-formato .modal-body").html(JSON.stringify(obj));
        })
        .fail(error_ajax);
    });

    $("#btn-xml").click(function(){
        $("#modal-formato .modal-body").html("");
        $("#modal-formato .modal-header")
            .removeClass("bg-primary text-white")
            .addClass("bg-info text-dark")
            .find(".modal-title")
            .html("XML");
        // Consumo de WS en XML
        $.ajax({
            "url"  : appData.uri_ws + "backend/promociones/xml/",
            "dataType"  : "xml"
        })
        .done(function(response){
            // Para objetos XML se debe usar la función text() y no html() de JQuery
            $("#modal-formato .modal-body").text(
                new XMLSerializer().serializeToString(response)
            );
        })
        .fail(error_ajax);
    });

});  // FIN del $.ready

// FUNCIONES INDEPENDIENTE JS
function carga_promociones() {
    $("#tabla-personas").find("tbody").html("");

    $.ajax({
        "url"  : appData.uri_ws + "backend/promociones/",
        "dataType"  : "json"
    })
    .done(function(obj){
        showAlert("secondary", "Cargando datos de promociones...");
        //console.log(obj);
        if(obj.resultado) {
            $("#tabla-promociones").find("thead").show();

            // Construir los renglones
            $.each(obj.promociones, function(i, row){
                $("#tabla-promociones")
                .find("tbody")
                .append('<tr id="tr-' + row.idpromocion +'"class="' + (row.vigente == 1 ? "table-success" : "") + '">' +
            '<td>' + row.nomproducto +'</td>' +
            '<td>' + row.descripcion +'</td>' +
            '<td class="text-end pe-5">$' + row.precio +'</td>' +
            '<td class="text-end pe-5">' + row.existencia +'</td>' +

            '<td class="text-center">' +
                '<i class="btn-vigencia fa-2x fa-solid fa-' + (row.vigente == 1 ? "check text-success" : "times text-danger") + '" data-idpromocion="' + row.idpromocion +'"></i>' +
            '</td>' +
            '</tr>');
            });

        }
        else {  // Si no hay datos
            $("#tabla-promociones")
                .find("thead")
                .hide();
        }
        $("#mensajes .alert-secondary").fadeOut(800);
        showAlert( obj.resultado ? "info" : "warning", obj.mensaje);
    })
    .fail(error_ajax);
}
