/**
 * Created by ismikin on 3/02/15.
 */


'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosPersonalesMod',[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

app.controller('DPController',  function($scope,$rootScope,$http) {
//    $scope.diagnosticos = diagnosticos;
//    $scope.diagnosticoSeleccionado = $scope.diagnosticos[1];
    $scope.editando = false;
    var fxNacimiento = $(".datepickerFxNacimiento");
    var form = $("#formularioDatosPersonales");

    $scope.init = function(){
        fxNacimiento.datepicker({ language:"es" });
    };

    $scope.setEditando = function(valor){
        $scope.editando = valor;
    }

    $scope.submitFormulario = function(){
        console.log(form.serialize());
        $http.post(Routing.generate('editar_datos_personales'),form.serialize()+'&idpaciente='+paciente.Paciente.id_paciente )
            .success(function(data, status, headers, config) {
                if(data.codigo_error==0){
                    console.log("way")
                }    else {console.log("caca")};
            //$scope.ajaxResponseData = data;
        })
            .error(function(data, status, headers, config) {
            console.log("AJAX failed!");
        });
    }

});