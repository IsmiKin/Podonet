
$(document).ready(function(){

    var formulario = $("#formBusqueda");
    $('#autocomplete').autocomplete({
        serviceUrl: Routing.generate('consultar_pacientes_filtro'),
        onSelect: function (suggestion) {
            window.location.replace(Routing.generate('dashboard_paciente',{id:suggestion.data}));
        }
    });

});
