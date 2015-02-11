/**
 * Created by ismikin on 8/02/15.
 */

'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosAnamnesisMod',[]);

app.controller('DAController',  function($scope,$rootScope,$http) {

    $scope.editando = false;
    $scope.dpaciente = paciente.Paciente;
    $scope.anamnesisAll = paciente.Anamnesis;
    $scope.anamnesisActual = paciente.Anamnesis[0];
    $scope.datosAnamnesis = null;
    $scope.datosAAll = paciente.DatosA;
    //$scope.dp = paciente.DatosAnamnesis[0];
    $scope.expandido = true;

    var fxNacimiento = $(".datepickerFxNacimiento");
    var form = $("#formularioDatosPersonales");
    var dialog = $("#dialogoNotificacion");

    $scope.init = function(){
        fxNacimiento.datepicker({ language:"es",clearBtn:true,dateFormat:"dd/mm/yyyy"  });
    };

    $scope.setEditando = function(valor){
        $scope.editando = valor;
    };

    $scope.setExpandido = function(valor){
        $scope.expandido = valor;
    };

    $scope.perteneceAnamnesis = function(datosAnamnesis){
        return (datosAnamnesis.Anamnesis_idAnamnesis == $scope.anamnesisActual.id_anamnesis);
    };

    $scope.submitFormulario = function(){
        dialog.find('.cargando').show();
        dialog.modal('show');
        var dataEnviar = JSON.stringify(form.serializeObject());
        $http.post(Routing.generate('editar_datos_personales'),dataEnviar )
            .success(function(data, status, headers, config) {
                if(data.codigo_error==0){
                    dialog.find('.cargando').hide();
                    dialog.find('.completadook').show();
                }else {
                    dialog.find('.cargando').hide();
                    dialog.find('.completadoerror').show();
                };
            })
            .error(function(data, status, headers, config) {
                dialog.find('.cargando').hide();
                dialog.find('.completadoerror').show();
            });

        //setTimeout("dialog.modal('hide')",1000);
        $scope.setEditando(false);
    };

});
