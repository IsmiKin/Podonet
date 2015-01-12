/**
 * Created by ismikin on 6/01/15.
 */

$(document).ready(function(){

    $("#formularioContacto").submit(enviarMensaje);

});

function enviarMensaje(e){
    var formulario = $(this);

    e.preventDefault();
    console.log("llamando");
    console.log(formulario.attr("action"))
    $.ajax({
        type: "POST", url: formulario.attr("action"),
        data: formulario.serialize(),
        success: function(data) {
            console.log('success!');
            if(data.codigo_error==0){
                formulario.hide();
                $(".mensajeOk").show();
            }else
                console.log("error!");
        },
        complete: function(data){

        }
    });
}