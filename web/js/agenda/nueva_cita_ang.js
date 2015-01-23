'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('myAgenda',['ui.calendar']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

app.controller('MainController',  function($scope,$rootScope) {
    this.eventos = {
        events: [
            {
                title: 'Event1',
                start: '2011-04-04'
            },
            {
                title: 'Event2',
                start: '2011-05-05'
            }

        ],
        color: 'yellow',
        textColor: 'black'
    };

    this.calendars = [{  idgabinete:1,nombregabinete:"gabinete1", id:Math.random(), events:this.eventos },
                      {  idgabinete:2,nombregabinete:"gabinete2", id:Math.random() ,events: this.eventos   } ];

});

app.controller('CalendarController',function($scope,$rootScope){

    $scope.init = function(idgabinete,nombregabinete,id,events){
        this.nombregabinete=nombregabinete;
        this.id=id;
        this.idgabinete=idgabinete;
        this.fullito = $('#calendar_'+this.idgabinete);
        this.editing = false;
        this.editando = false;
        this.consultando = false;
        this.events = events;
        //$scope.initFullCalendar();
    };

    $scope.initFullCalendar = function(){
        console.log(this.fullito);
        $('#calendar_'+$scope.idgabinete).fullCalendar({

            lang: 'es'

        });
    }


});