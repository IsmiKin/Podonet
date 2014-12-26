/**
 * Created by root on 23/12/14.
 */

$(document).ready(function(){

    $(".form-gabinete").submit(submitFormGabinete); // Para la creacion
    $(".submitEditarGabinete").click(submitEditarFormGabinete);
    $(".habilitarGabineteButton").click(habilitarGabinete);
});

function submitFormGabinete(e){
    e.preventDefault();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            if(data.codigo_error==0){
                var gabinete = $.parseJSON(data.gabinete);
                var htmlNuevaFila = Handlebars.templates.nuevafila_gabinete(gabinete);
                $(".table-gabinetes tr:last").after(htmlNuevaFila);
                $(".habilitarGabineteButton").click(habilitarGabinete);
                resetearForm();
                $(".cancelarGabineteForm").click();
            }else
                console.log("error!");

        }
    });

}

function resetearForm(){
    $(".form-gabinete")[0].reset();
}

function habilitarGabinete(){
    var boton = $(this);
    var accion = $(this).data("habilitar");
    var row = $(this).parent().parent().parent();
    var nuevoColor = (accion) ? "success" : "danger";
    var antiguoColor = (accion) ? "danger" : "success";

    $.ajax({
        type: "PUT",
        url: Routing.generate('habilitar_gabinete'),
        data: {idGabinete:row.data("idgabinete"), habilitar:accion},
        success: function(data) {
            if(data.codigo_error==0){
                row.find(".habilitarGabineteButton:hidden").parent().show();
                boton.parent().hide();
                row.removeClass(antiguoColor).addClass(nuevoColor);
            }else
                console.log("error!");

        }
    });

}

function submitEditarFormGabinete(e){
    e.preventDefault();
    $.ajax({
        type: $(this).data('method'),
        url: $(this).data('action'),
        data: $(".form-gabinete").serialize(),
        success: function(data) {
            if(data.codigo_error==0){
                var gabinete = $.parseJSON(data.gabinete);
                var htmlNuevaFila = Handlebars.templates.nuevafila_gabinete(gabinete);
                $(".table-gabinetes tr:last").after(htmlNuevaFila);
                $(".habilitarGabineteButton").click(habilitarGabinete);
                resetearForm();
                $(".cancelarGabineteForm").click();
            }else
                console.log("error!");

        }
    });

}