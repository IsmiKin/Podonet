/**
 * Created by ismikin on 22/01/15.
 */

$(document).ready(function(){
    var calendario = $('#calendar');
    var modalNuevaCita = $("#modalNuevaCita");
    var inputAutocomplete =$('#autocomplete');
    var reelegirButton = $("#reelegirPaciente");

    calendario.fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        lang: 'es',
        selectable: true,
        selectHelper: true,
        dayClick: function(date, jsEvent, view) {
            calendario.fullCalendar( 'gotoDate', date );
            var modovista=view.name;
            if(modovista=='month')
            {
                $('#calendar').fullCalendar( 'changeView', 'agendaDay'  );
            }
        },
        select: function(start, end,jsEvent,view) {
           /* var title = prompt('Event Title:');
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }*/
            console.log(view);
            var modovista=view.name;
            if(modovista=='agendaDay')
            {
                modalNuevaCita.modal('show');
                modalNuevaCita.find('.horaInicio').empty().append(start.format('HH mm'));
                modalNuevaCita.find('.horaFin').empty().append(end.format('HH mm'));
            }

            $('#calendar').fullCalendar('unselect');
        }
    });


    inputAutocomplete.autocomplete({
        serviceUrl: Routing.generate('consultar_pacientes_filtro'),
        onSelect: function (suggestion) {
            inputAutocomplete.prop('disabled', true);
            reelegirButton.parent().show();
        }
    });

    reelegirButton.click(function(){
        inputAutocomplete.val("");
        inputAutocomplete.prop('disabled',false);
        reelegirButton.parent().hide();
    });

});