/**
 * Created by ismikin
 */

'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('myHojaGeneral',['datosPersonalesMod','datosAnamnesisMod','datosSPMod']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

app.controller('MainController',  function($scope,$rootScope) {
//    $scope.diagnosticos = diagnosticos;
//    $scope.diagnosticoSeleccionado = $scope.diagnosticos[1];


});

