/**
 * Created by kuku on 18/01/15.
 */

var listaPatologiasEliminadas = [];
var contadorPatologiasEliminadas = 0;
var comboFechasDiag = $("#comboFechasDiag");
var botonCancelarFormulario = $(".cancelarFormularioDiagnostico");

$(document).ready(function(){

    var buscador = $("#patologiaBusqueda");
    $('#patologiaBusqueda').autocomplete({
        serviceUrl: Routing.generate('consultar_patologias_todos'),
        onSelect: function (suggestion) {
            //window.location.replace(Routing.generate('dashboard_paciente',{id:suggestion.data}));

            agregarBadge(suggestion.value, suggestion.id);
        }
    });

    var badgesInicio = $(".containerBadgesPatologia  > span");
    badgesInicio.click(autoDestroyBadge);

    $(".form-editar-diagnostico input").prop( "disabled", true );
    $(".create input").prop( "disabled", false );

    $("#botonSubmitForm").hide();
    $(".btnCrear").show();
    //En el twig de crear hay que mostrarlo

    $(".form-editar-diagnostico").submit(submitEditarDiagnostico);

    $("#botonClearForm").click(limpiarFormulario);
    $(".habilitarFormularioDiagnostico").click(habilitarFormulario);
    $(".crearFormularioDiagnostico").click(crearDiagnostico);
    comboFechasDiag.change(actualizarListenersBadges);
    botonCancelarFormulario.click(cancelarFormulario);
    $(".badge").click(autoDestroyBadge);

});

function crearDiagnostico(){
    $(".form-editar-diagnostico input").prop( "disabled", false );
    comboFechasDiag.prop("disabled",true);
    $(".habilitarFormularioDiagnostico").hide("slow");
    $("#botonSubmitForm").show("slow");
    limpiarFormulario();
}

function actualizarListenersBadges(){
    $(".badge").click(autoDestroyBadge);
}

function cancelarFormulario(){
    $(".form-editar-diagnostico input").prop( "disabled", true );
    $(".habilitarFormularioDiagnostico").show("slow");
    $("#botonSubmitForm").hide("slow");
    $(this).parent().hide("show");
}

function habilitarFormulario(){
    $(".form-editar-diagnostico input").prop( "disabled", false );
    $(".habilitarFormularioDiagnostico").hide("slow");
    $("#botonSubmitForm").show("slow");
    botonCancelarFormulario.parent().show("slow");
}

function agregarBadge(valor, id)
{
    // TO-DO: CONTROLAR QUE NO SE META LA MISMA BADGE DOS VECES
    var badgeNuevo = $("<span/>", {class:"badge", attr: { id: id }}).append(valor);

    var badgesActuales = getBadgesDiagnostico();

    if($.inArray(valor,badgesActuales)==-1)
        $(".containerBadgesPatologiaAng").append(badgeNuevo);

    badgeNuevo.click(autoDestroyBadge);
}

function autoDestroyBadge(){
    listaPatologiasEliminadas[contadorPatologiasEliminadas] = { nombre : $(this).text(),  id : $(this).attr("id") };
    contadorPatologiasEliminadas++;
    $(this).remove();
}

function limpiarFormulario()
{
    $(".form-editar-diagnostico")[0].reset();

    $(':input','.form-editar-diagnostico')
        .not(':button, :submit, :reset, :hidden')
        .val('');
}

function getBadgesArrayDatos(){
    var lista = [];
    var i = 0;
    var spans = $.map($(".containerBadgesPatologia  > span"), function(  elem ) {

        lista[i] = { nombre : $(elem).text(),  id : $(elem).attr("id") };

        i++;

        return  $(elem).text();
    });

    if(lista.length==0) return false;
    return lista;
}

function getBadgesDiagnostico(){
    var spans = $.map($(".containerBadgesPatologia  > span"), function(  elem ) {
        return  $(elem).text();
    });

    return spans;
}

//Submit valido tanto para create como para update
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
    var badgesActuales = getBadgesArrayDatos();
    if(listaPatologiasEliminadas.length==0)
        listaPatologiasEliminadas = false;

    values["patologiasEliminadas"] = listaPatologiasEliminadas;
    values["patologias"] = badgesActuales;
    values["idpaciente"] = idPaciente;
    values["iddiagnostico"] = idDiagnostico;
    $.ajax({
        type: 'POST', url: form.data("action"),
        data: $.param(values),
        success: function(data) {
            window.location = Routing.generate('consultar_diagnostico',{'idPaciente':idPaciente, 'idDiagnostico':idDiagnostico});
        }
    });

}
