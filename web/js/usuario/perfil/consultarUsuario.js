/**
 * Created by ismikin on 6/01/15.
 */

$(document).ready(function(){

    $(".containerBotonAplicarCambiosDatosPersonales").hide();
    $("#formularioDatosPersonales").hide();
    $(".showFormEditar").click(mostrarFormulario);
    $(".cancelFormEditar").click(cancelFormEditar);

});


function mostrarFormulario(){
    var boton = $(this);
    var papito = boton.parent();
    var informacion =boton.data("informacion");
    $("#informacion"+informacion).hide();
    $("#formulario"+informacion).show();
    $(".containerBotonCancelar"+informacion).show();
    $(".containerBotonAplicarCambiosDatosPersonales").show("slow");
    papito.hide();
}

function cancelFormEditar(){
    var boton = $(this);
    var papito = boton.parent();
    var informacion =boton.data("informacion");
    $("#informacion"+informacion).show();
    $("#formulario"+informacion).hide();
    $(".containerBotonEditar"+informacion).show();
    $(".containerBotonAplicarCambiosDatosPersonales").hide("slow");
    papito.hide();
}

