/**
 * Created by kuku on 10/01/15.
 */


$(document).ready(function(){
    $('.form-usuario-perfil').attr('disabled', 'disabled'); //Disable
});

$(".editarFormularioUsuarioPerfil").click(mostrarBotonesPerfil);

function mostrarBotonesPerfil(){
    $("#botoneraPerfil").show("slow");
    $(".editarFormularioUsuarioPerfil").hide("slow");

}
