/**
 * Created by ismikin on 3/02/15.
 */


'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosPersonalesMod',[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

app.controller('DPController',  function($scope,$rootScope) {
//    $scope.diagnosticos = diagnosticos;
//    $scope.diagnosticoSeleccionado = $scope.diagnosticos[1];

    var fxNacimiento = $(".datepickerFxNacimiento");

    $scope.init = function(){
        fxNacimiento.datepicker({ language:"es" });
    };

});