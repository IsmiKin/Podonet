/**
 * Created by kuku on 30/12/14.
 */


$(document).ready(function(){

    $(".habilitarUsuarioButton").click(activarUsuario);
    $('.footable').footable();
    $(".pagination").children("ul").addClass("pagination");
    $(".footable-sort-indicator").click(function(){
        setTimeout(borrarSegundo,1000 );
    });

});

function activarUsuario(){
    var boton = $(this);
    var row  = boton.parent().parent().parent();
    var estado = $(this).data("estado");
    var idUsuario = $(this).data("idusuario");
    $.ajax({
        type: "POST",
        url: Routing.generate('habilitar_usuario'),
        data: {idusuario: idUsuario, estado:estado},
        success: function(data){
            console.log("Estado nuevo:"+data.nuevoestado);
            boton.data("estado",data.nuevoestado);
            row.find(".tdEstado").text(data.nuevoestado);
            if(data.nuevoestado=="Activo"){
                boton.removeClass("btn-success").addClass("btn-danger");
                boton.find("i").removeClass("fa-check").addClass("fa-minus-circle");
                row.removeClass("danger").addClass("success");
            }
            else{
                boton.addClass("btn-success").removeClass("btn-danger");
                boton.find("i").addClass("fa-check").removeClass("fa-minus-circle");
                row.addClass("danger").removeClass("success");
            }
        }
    });
}