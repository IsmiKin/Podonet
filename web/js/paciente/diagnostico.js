/**
 * Created by kuku on 18/01/15.
 */

$(document).ready(function(){

    var buscador = $("#patologiaBusqueda");
    $('#patologiaBusqueda').autocomplete({
        serviceUrl: Routing.generate('consultar_patologias_todos'),
        onSelect: function (suggestion) {
            //window.location.replace(Routing.generate('dashboard_paciente',{id:suggestion.data}));

            agregarBadge(suggestion.value);
        }
    });

    $(".form-editar-diagnostico").submit(submitEditarDiagnostico);
    $("#botonClearForm").click(limpiarFormulario);

});

function agregarBadge(valor)
{
    // TO-DO: CONTROLAR QUE NO SE META LA MISMA BADGE DOS VECES
    var badgeNuevo = $("<span/>", {class:"badge"}).append(valor);
    $(".containerBadgesPatologia").append(badgeNuevo);
    badgeNuevo.click(autoDestroyBadge);

}

function autoDestroyBadge(){
    $(this).remove();
}

function limpiarFormulario()
{
    var frm_elements = this.form.elements;

    for(var i=0; i<frm_elements.length; i++)
    {
        frm_elements[i].value = "";
    }
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

    values["idpaciente"] = idPaciente;
    values["iddiagnostico"] = idDiagnostico;

    $.ajax({
        type: 'POST', url: form.data("action"),
        data: $.param(values),
        success: function(data) {
            if(data.codigo_error==0){
                alert("Success");
            }else
                console.log("error!");
        }
    });

}
