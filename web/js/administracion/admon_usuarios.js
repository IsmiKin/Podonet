/**
 * Created by kuku on 30/12/14.
 */


$(document).ready(function(){

    $(".habilitarUsuarioButton").click(activarUsuario);

});

function activarUsuario(){
    var boton = $(this);
    var row  = boton.parent().parent().parent();
    var estado = $(this).data("estado");
    var idUsuario = $(this).data("idusuario");
    console.log("Estado actual: " +estado);
    console.log(idUsuario);
    console.log(row);
    $.ajax({
        type: "POST",
        url: Routing.generate('habilitar_usuario'),
        data: {idusuario: idUsuario, estado:estado},
        success: function(data){
            console.log("Estado nuevo:"+data.nuevoestado);
            boton.data("estado") = data.nuevoestado;
            if(data.nuevoestado=="Activo")
                row.removeClass("danger").addClass("success")
            else
                row.addClass("danger").removeClass("success");

        }
    });
}