/**
 * Created by ismikin on 6/01/15.
 */

$(document).ready(function(){

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
    papito.hide();
}

function cancelFormEditar(){
    var boton = $(this);
    var papito = boton.parent();
    var informacion =boton.data("informacion");
    $("#informacion"+informacion).show();
    $("#formulario"+informacion).hide();
    $(".containerBotonEditar"+informacion).show();
    papito.hide();
}

