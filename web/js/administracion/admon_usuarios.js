/**
 * Created by kuku on 30/12/14.
 */


$(document).ready(function(){

    $(".habilitarUsuarioButton").click(activarUsuario);

});

function activarUsuario(){
    var estado = $(this).data("habilitar");
    var idUsuario = $(this).data("idusuario");
    $.ajax({
        type: "POST",
        url: Routing.generate('habilitar_usuario'),
        data: {idUsuario: idUsuario, estado:estado}
    });
}