/**
 * Created by kuku on 18/01/15.
 */

$(document).ready(function(){

    var buscador = $("#patologiaBusqueda");
    $('#patologiaBusqueda').autocomplete({
        serviceUrl: Routing.generate('consultar_patologias_todos'),
        onSelect: function (suggestion) {
            //window.location.replace(Routing.generate('dashboard_paciente',{id:suggestion.data}));
            document.write("<span class='badge'>suggestion.value</span>");
            //agregarBadge();
        }
    });

    $(".form-editar-diagnostico").submit(submitEditarDiagnostico)

});

function agregarBadge()
{
    document.write("<span class='badge'>{suggestion.dataNombre}</span>");
}


function submitEditarDiagnostico(e){
    e.preventDefault();

    console.log("Llego?!");

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
