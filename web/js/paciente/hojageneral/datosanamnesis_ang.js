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
    //$scope.datosAnamnesis = null;
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



app.directive('mypaint', function($compile) {

    var getTemplate = function(content) {
        return Handlebars.templates.imagenpaint(content);
    }
    return {
        restrict: 'E',
        scope: { ident : '@', ancho:'@', alto:'@', imagen:'@' },
        transclude:true,
        link : function(scope,element,attributes){
            var colores = [{color:'#f00', title:"color1"},{color:'#f00', title:"color10"},{color:'#0f0', title:"color2"},{color:'#0ff', title:"color3"},{color:'#fff', title:"color4"}]
            scope["colores"]= colores;
            element.html(getTemplate(scope));

            var canvas = element.find("canvas");
            canvas.sketchpad({
                aspectRatio: 2 / 1,             // (Required) To preserve the drawing, an aspect ratio must be specified
                backgroundColor: '#FFFFFF',      // (Optional) Set the background of the canvas
                strokes: 'JSON',                // (Optional) Initialize the sketchpad with stroke data
                lineColor: '#000000'
            });

            element.find("button").click(function(){ canvas.setLineColor($(this).data("color"))}).tooltip();
            element.find(".tamanoPuntero").click(function(){ canvas.setLineSize($(this).val())});
            element.find(".toolimage").tooltip();
            element.find(".botonRedo").click(function(){ canvas.redo(); });
            element.find(".botonUndo").click(function(){ canvas.undo(); });
            element.find(".botonClear").click(function(){ canvas.clear(); });

        }
    }

});

app.directive('mycolor', function() {
    return {
        restrict: 'E',
        scope: { canvas:'@' },
        transclude:true,
        template: '',
        link : function(scope,element,attributes){
            var canvas = $("#canvas_"+scope.canvas)[0];
            console.log(canvas[0]);
            element.click(function(){
                console.log(canvas);
                canvas.setLineColor(element.data('color'));
            });

        },
        controller: function($scope,$element,$attrs, $transclude) {


        }
    }

});