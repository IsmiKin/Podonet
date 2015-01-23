/**
 * Created by kuku on 18/01/15.
 */

var listaPatologiasEliminadas = [];
var contadorPatologiasEliminadas = 0;

$(document).ready(function(){

    var buscador = $("#patologiaBusqueda");
    $('#patologiaBusqueda').autocomplete({
        serviceUrl: Routing.generate('consultar_patologias_todos'),
        onSelect: function (suggestion) {
            //window.location.replace(Routing.generate('dashboard_paciente',{id:suggestion.data}));7

            agregarBadge(suggestion.value, suggestion.id);
        }
    });

    $(".form-editar-diagnostico input").prop( "disabled", true );
    $("#botonSubmitForm").hide();

    $(".form-editar-diagnostico").submit(submitEditarDiagnostico);

    $("#botonClearForm").click(limpiarFormulario);
    $(".habilitarFormularioDiagnostico").click(habilitarFormulario);
    $(".crearFormularioDiagnostico").click(crearDiagnostico);


});

function crearDiagnostico(){
    $(".form-editar-diagnostico input").prop( "disabled", false );
    $(".habilitarFormularioDiagnostico").hide("slow");
    $("#botonSubmitForm").show("slow");
    limpiarFormulario;
}

function habilitarFormulario(){
    $(".form-editar-diagnostico input").prop( "disabled", false );
    $(".habilitarFormularioDiagnostico").hide("slow");
    $("#botonSubmitForm").show("slow");
}

function agregarBadge(valor, id)
{
    // TO-DO: CONTROLAR QUE NO SE META LA MISMA BADGE DOS VECES
    var badgeNuevo = $("<span/>", {class:"badge", attr: { id: id }}).append(valor);

    var badgesActuales = getBadgesDiagnostico();

    if($.inArray(valor,badgesActuales)==-1)
        $(".containerBadgesPatologia").append(badgeNuevo);

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
            if(data.codigo_error==0){
            }else
                console.log("error!");
        }
    });

}
