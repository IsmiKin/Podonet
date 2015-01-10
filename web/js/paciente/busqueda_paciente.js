
$(document).ready(function(){

    var formulario = $("#formBusqueda");
    $('#autocomplete').autocomplete({
        serviceUrl: Routing.generate('consultar_pacientes_todos'),
        onSelect: function (suggestion) {
            formulario.submit();
            alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
        }
    });

});
