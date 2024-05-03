// FUNCIONES JS QUE NO PERTENESEN AL EVENTO JQUERY
function showAlert(tipo, mensaje) {
    if ($("#mensajes").length === 0) {  // Si no existe
        $("body").append($("<div>", {
            "id": "mensajes",
            "class": "d-flex flex-column-reverse position-absolute"
        }));
        $("#mensajes")
            .css("bottom", "20px")
            .css("right", "20px");
    }

    let icono;
    switch(tipo) {
        case "success" : icono = "check-circle"; break;
        case "danger" : icono = "circle-xmark"; break;
        case "warning" : icono = "triangle-exclamation"; break;
        case "dark" : icono = "circle-stop"; break;
        case "info" : 
        case "primary" : icono = "circle-chevron-right"; break;
        case "secondary" : icono = "spinner fa-spin"; break;
        default:
            icono = "info-circle"; break;
    }

    $("#mensajes").append('<div class="alert alert-' +
    tipo +
    ' alert-dismissible fade show" role="alert"><i class="fa-solid fa-'+ 
    icono +
    ' fa-2x"></i>' +
        mensaje +
    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

    setTimeout(function(){
        $(".alert").fadeOut(2000);
    }, 6000);

}

function error_ajax() {
    showAlert("danger", "Error en llamado AJAX.");
}

function error_formulario(campo, mensaje) {
    $("#" + campo)
        .removeClass("is-valid")
        .addClass("is-invalid")

    $("#group-" + campo).append($("<div>", {
        "text" : mensaje,
        "class" : "invalid-feedback"
    }));
}

function borra_mensajes() {
    $(".is-valid, .is-invalid")
        .removeClass("is-valid is-invalid");
    $(".valid-feedback, .invalid-feedback").remove();
}
