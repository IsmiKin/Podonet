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

});

function agregarBadge()
{
    document.write("<span class='badge'>{suggestion.dataNombre}</span>");
}


