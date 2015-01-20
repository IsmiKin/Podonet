/**
 * Created by kuku on 18/01/15.
 */

$(document).ready(function(){

    var buscador = $("#patologiaBusqueda");
    $('#patologiaBusqueda').autocomplete({
        serviceUrl: Routing.generate('consultar_patologias_todos'),
        onSelect: function (suggestion) {
            //window.location.replace(Routing.generate('dashboard_paciente',{id:suggestion.data}));7

            agregarBadge(suggestion.value);
        }
    });

    $(".form-editar-diagnostico input").prop( "disabled", true );
    $("#botonSubmitForm").hide();

    $(".form-editar-diagnostico").submit(submitEditarDiagnostico);

    $("#botonClearForm").click(limpiarFormulario);
    $(".habilitarFormularioDiagnostico").click(habilitarFormulario);


});

function habilitarFormulario(){
    $(".form-editar-diagnostico input").prop( "disabled", false );
    $(".habilitarFormularioDiagnostico").hide("slow");
    $("#botonSubmitForm").show("slow");
}

function agregarBadge(valor)
{
    // TO-DO: CONTROLAR QUE NO SE META LA MISMA BADGE DOS VECES
    var badgeNuevo = $("<span/>", {class:"badge"}).append(valor);

    //var badgesActuales= $.map($(".containerBadgesPatologia  > span"), function(  elem ) {
    //    return  $(elem).text();
    //});
    var badgesActuales = getBadgesDiagnostico;

    if($.inArray(valor,badgesActuales)==-1)
        $(".containerBadgesPatologia").append(badgeNuevo);

    badgeNuevo.click(autoDestroyBadge);
}

function autoDestroyBadge(){
    $(this).remove();
}

function limpiarFormulario()
{
    $(".form-editar-diagnostico")[0].reset();
}

function getBadgesDiagnostico(){
    var spans = $.map($(".containerBadgesPatologia  > span"), function(  elem ) {
        return  $(elem).text();
    });

    return spans;
}

function submitEditarDiagnostico(e){
    e.preventDefault();

    var form = $(".form-editar-diagnostico");
    var botonEditar = $(".submitEditarDiagnostico");
    var idPaciente = form.data("paciente");
    var idDiagnostico = form.data("diagnostico");

    var values = {};
    $.each( form.serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });
    var badgesActuales = getBadgesDiagnostico;

    values["patologia"] = badgesActuales;
    values["idpaciente"] = idPaciente;
    values["iddiagnostico"] = idDiagnostico;

    $.ajax({
        type: 'POST', url: form.data("action"),
        data: $.param(values),
        success: function(data) {
            if(data.codigo_error==0){
            }else
                console.log("error!");
        }
    });

}
