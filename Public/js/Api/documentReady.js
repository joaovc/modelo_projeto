$(document).ready(function(){
    $(".modal").modal({
        dismissible: false
    });
    initEventos(enventosGet);
    initEventos(cadastroUsuarios);
});