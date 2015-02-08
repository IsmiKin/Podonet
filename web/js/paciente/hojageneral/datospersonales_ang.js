/**
 * Created by ismikin on 3/02/15.
 */


'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosPersonalesMod',[]).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
});

app.controller('DPController',  function($scope,$rootScope,$http) {

    $scope.editando = false;
    $scope.dp = paciente.DatosPersonales[0];

    var fxNacimiento = $(".datepickerFxNacimiento");
    var form = $("#formularioDatosPersonales");

    $scope.init = function(){
        fxNacimiento.datepicker({ language:"es",clearBtn:true,format:"dd/mm/yyyy"  });
    };

    $scope.setEditando = function(valor){
        $scope.editando = valor;
    };

    $scope.submitFormulario = function(){
        var dataEnviar = JSON.stringify(form.serializeObject());
        $http.post(Routing.generate('editar_datos_personales'),dataEnviar )
            .success(function(data, status, headers, config) {
                if(data.codigo_error==0){
                    console.log("way")
                }    else {console.log("caca")};
            //$scope.ajaxResponseData = data;
        })
            .error(function(data, status, headers, config) {
            console.log("AJAX failed!");
        });
    };

});
