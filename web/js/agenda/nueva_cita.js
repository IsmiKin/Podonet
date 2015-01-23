/**
 * Created by ismikin on 22/01/15.
 */

var calendario = $('#calendar');
var modalNuevaCita = $("#modalNuevaCita");
var modalConsultaCita = $("#modalConsultaCita");
var inputAutocomplete =$('#autocomplete');
var reelegirButton = $("#reelegirPaciente");
var botonNuevoPaciente = $("#botonCrearPaciente");
var formularioNuevoPaciente = $("#nuevoPacienteForm");
var formularioNuevaCita = $("#crearCitaForm");
var modalCrearPaciente = $("#nuevoPacienteModal");
var radioGabinetes = $(".gabinete-group button");
var gabineteSeleccionado =$("#gabineteSeleccionado");

$(document).ready(function(){

    calendario.fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        lang: 'es',
        selectable: true,
        selectHelper: true,
        slotDuration: { days:0, hours:0, minutes:5 },
        events: {
            url:   Routing.generate('obtener_citas_rango'),
            data:function(){
                return{
                    gabinete: gabineteSeleccionado.val()
                };
            },
            color: '#9FB8ED',
            textColor:'black'
        },
        dayClick: function(date, jsEvent, view) {
            calendario.fullCalendar( 'gotoDate', date );
            var modovista=view.name;
            if(modovista=='month')
            {
                $('#calendar').fullCalendar( 'changeView', 'agendaDay'  );
            }
        },
        eventClick: function(calEvent, jsEvent, view) {
            modalConsultaCita.modal('show');
            modalConsultaCita.find('.horaInicioConsulta').empty().append(calEvent.start.format('HH mm'));
            modalConsultaCita.find('.horaFinConsulta').empty().append(calEvent.end.format('HH mm'));
            modalConsultaCita.find('.consultaNombrePaciente').empty().append(calEvent.Paciente.nombre+" "+calEvent.Paciente.apellidos);
            modalConsultaCita.find('.consultaMotivoConsultaPaciente').empty().append(calEvent.motivoconsulta);
        },
        eventRender: function(event, element){
            element.popover({
                animation:true,
                html:true,
                delay: 300,
                title: '<strong>'+event.start.format('HH mm')+' - '+event.end.format('HH mm'),
                content: Handlebars.templates.nuevo_popover_cita(event),
                trigger: 'hover'
            });
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

            var modovista=view.name;
            if(modovista=='agendaDay')
            {
                modalNuevaCita.modal('show');
                modalNuevaCita.find('.horaInicio').empty().append(start.format('HH:mm'));
                modalNuevaCita.find('.horaFin').empty().append(end.format('HH:mm'));

                modalNuevaCita.find('.inicioForm').empty().val(start.format('HH:mm'));
                modalNuevaCita.find('.finForm').empty().val(end.format('HH:mm'));
                console.log($(this).parent());
                console.log($(this).parent().data("idgabinete"));
                modalNuevaCita.find(".idgabineteForm").empty().val($(this).parent().data("idgabinete"));
            }

            $('#calendar').fullCalendar('unselect');
        }/*,eventDataTransform: function (rawEventData) {
            console.log(rawEventData.idCita);
            console.log(rawEventData.horaInicio);
            console.log(rawEventData.horaFin);
            return {
                idCita: rawEventData.idCita,
                idGabinete:rawEventData.idGabinete,
                //title: rawEventData.title,
                start: rawEventData.horaInicio,
                end: rawEventData.horaFin,
                motivoconsulta : rawEventData.motivoConsulta
                //url: rawEventData.url
            };
        }*/
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

    formularioNuevoPaciente.submit(crearPaciente);
    formularioNuevaCita.submit(crearCita);

    radioGabinetes.click(cambiarGabinete);
});

function crearPaciente(e){
    e.preventDefault();

    var formulario = $(this);
    var inputAutocomplete =$('#autocomplete');
    var modalCrear =  $("#nuevoPacienteModal");
    $.ajax({
        type: formulario.attr("method"), url: formulario.attr("action"),
        data: formulario.serialize(),
        success: function(respuesta) {
            if(respuesta.codigo_error==0){
                console.log({value:respuesta.nombre,data:respuesta.nuevoid});
                modalCrear.modal('hide');
                var newOptions = {query:Unit,suggestions:[{value:respuesta.nombre,data:respuesta.nuevoid}]};
                inputAutocomplete.setOptions(newOptions);
                inputAutocomplete.val(respuesta.nombre);

            }else
                console.log("error!");

        }
    });

}

function crearCita(e){
    e.preventDefault();

    var formulario = $(this);

    $.ajax({
        type: formulario.attr("method"), url: formulario.attr("action"),
        data: formulario.serialize(),
        success: function(respuesta) {
            if(respuesta.codigo_error==0){
                /*console.log({value:respuesta.nombre,data:respuesta.nuevoid});
                modalCrear.modal('hide');
                var newOptions = {query:Unit,suggestions:[{value:respuesta.nombre,data:respuesta.nuevoid}]};
                inputAutocomplete.setOptions(newOptions);
                inputAutocomplete.val(respuesta.nombre);*/

            }else
                console.log("error!");

        }
    });
}

function cambiarGabinete(){
    var radio = $(this);
    gabineteSeleccionado.val(radio.data("idgabinete"));
    calendario.fullCalendar( 'refetchEvents' );
}