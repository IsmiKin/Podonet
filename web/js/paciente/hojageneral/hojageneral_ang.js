/**
 * Created by ismikin on 3/02/15.
 */
/**
 * Created by ismikin on 25/01/15.
 */

'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('myHojaGeneral',['datosPersonalesMod']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});


app.controller('MainController',  function($scope,$rootScope) {
//    $scope.diagnosticos = diagnosticos;
//    $scope.diagnosticoSeleccionado = $scope.diagnosticos[1];


});

