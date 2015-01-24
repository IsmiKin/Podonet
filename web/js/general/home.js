/**
 * Created by ismikin on 24/01/15.
 */

var calendario = $("#calendario");
console.log(new Date().getHours());
$(document).ready(function(){
    calendario.fullCalendar({
        header: {
            left: '',
            center: 'title',
            right: ''
        },
        height: 450,
        lang: 'es',
        defaultView: 'agendaDay',
        selectable: true,
        selectHelper: true,
        slotDuration: { days:0, hours:0, minutes:5 },
        minTime:"10:00:00",
        maxTime:"21:00:00",
        weekends:false,
        scrollTime:moment(),
        events: {
            url:   Routing.generate('obtener_citas_hoy'),
            color: '#9FB8ED',
            textColor:'black'
        },
        businessHours:{
            start: '10:00', // a start time (10am in this example)
            end: '18:00', // an end time (6pm in this example)

            dow: [ 1, 2, 3, 4 ]
            // days of week. an array of zero-based day of week integers (0=Sunday)
            // (Monday-Thursday in this example)
        },
        eventClick: function(calEvent, jsEvent, view) {
           /* modalConsultaCita.modal('show');
            modalConsultaCita.find('.horaInicioConsulta').empty().append(calEvent.start.format('HH mm'));
            modalConsultaCita.find('.horaFinConsulta').empty().append(calEvent.end.format('HH mm'));
            modalConsultaCita.find('.consultaNombrePaciente').empty().append(calEvent.Paciente.nombre+" "+calEvent.Paciente.apellidos);
            modalConsultaCita.find('.consultaMotivoConsultaPaciente').empty().append(calEvent.motivoconsulta);
            modalConsultaCita.find('.botonEliminarCita').data('idcita',calEvent.idCita);
            modalConsultaCita.find('.botonEliminarCita').data('idevent',calEvent._id);*/
            window.location.href = Routing.generate('dashboard_paciente',{ id:calEvent.Paciente["id_paciente"] });
        },
        eventRender: function(event, element){
            element.popover({
                animation:true,
                html:true,
                delay: 300,
                placement:"bottom",
                title: '<strong>'+event.start.format('HH mm')+' - '+event.end.format('HH mm'),
                content: Handlebars.templates.nuevo_popover_cita(event),
                trigger: 'hover'
            });
        }
    });
});