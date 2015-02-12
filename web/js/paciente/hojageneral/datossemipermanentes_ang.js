/**
 * Created by ismikin on 8/02/15.
 */

'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosSPMod',[]);

app.controller('DSPController',  function($scope,$rootScope,$http) {

    $scope.editando = false;
    $scope.creando = false;
    $scope.expandido = true;
    $scope.dpaciente = paciente.Paciente;
    $scope.dspall = paciente.DatosSemipermanentes;
    $scope.dsp = paciente.DatosSemipermanentes[0];
    $scope.ultimoMostrado = 0;


    var form = $("#formularioDatosSemipermanentes");
    var dialog = $("#dialogoNotificacion");

    $scope.init = function(){

    };

    $scope.setEditando = function(valor){
        $scope.editando = valor;
        $scope.ultimoMostrado=$scope.dsp;
    };

    $scope.setExpandido = function(valor){
        $scope.expandido = valor;
    };

    $scope.setCreando = function(valor,plantilla){
        plantilla = plantilla || false;
        $scope.creando = valor;
        if(valor){
            console.log("creando");
            $scope.ultimoMostrado=$scope.dsp;
            if(!plantilla)  $scope.dsp = {}
            else            $scope.dsp = angular.copy($scope.dsp);
        }else{
            console.log("cancelando");
            $scope.dsp = $scope.ultimoMostrado;
        }
    };

    $scope.cancelarAction = function(){
        $scope.setCreando(false);
        $scope.setEditando(false);
    };

    $scope.submitFormulario = function(){
        dialog.find('.cargando').show();
        dialog.modal('show');
        var ruta = null;
        if ($scope.editando)    ruta = Routing.generate('editar_datos_semipermanentes')
        else                    ruta = Routing.generate('crear_datos_semipermanentes');

        var dataPreEnviar = form.serializeObject();
        console.log(dataPreEnviar);

        form.find('input[type=checkbox]').each(
            function(index,element) {
                dataPreEnviar[element.name] = element.checked;
            });

        var dataEnviar = JSON.stringify(dataPreEnviar);

        $http.post(ruta,dataEnviar )
            .success(function(data, status, headers, config) {
                if(data.codigo_error==0){
                    dialog.find('.cargando').hide();
                    dialog.find('.completadoerror').hide();
                    dialog.find('.completadook').show();
                    $scope.setEditando(false);
                    $scope.setCreando(false);
                    $scope.dspall.push(JSON.parse(data.nuevodsp));
                    $scope.dsp = $scope.dspall[$scope.dspall.length-1];
                }else {
                    dialog.find('.cargando').hide();
                    dialog.find('.completadook').hide();
                    dialog.find('.completadoerror').show();
                };
            })
            .error(function(data, status, headers, config) {
                dialog.find('.cargando').hide();
                dialog.find('.completadook').hide();
                dialog.find('.completadoerror').show();
            });

    };

});
