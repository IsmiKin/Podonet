/**
 * Created by ismikin on 11/01/15.
 */

$(document).ready(function(){

    $(".generarContrasena").click(pegarContrasena);

});

function pegarContrasena(){
    var inputcontrasena = $("#appbundle_usuario_plainPassword");
    inputcontrasena.val(generarContrasena());
}