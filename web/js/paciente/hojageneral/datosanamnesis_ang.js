/**
 * Created by ismikin on 8/02/15.
 */

'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosAnamnesisMod',[]);

app.controller('DAController',  function($scope,$rootScope,$http) {

    $scope.editando = false;
    $scope.creando = false;
    $scope.dpaciente = paciente.Paciente;
    $scope.anamnesisAll = paciente.Anamnesis;
    $scope.anamnesisActual = paciente.Anamnesis[0];
    $scope.datosAnamnesis = null;
    $scope.datosAAll = paciente.DatosA;
    //$scope.dp = paciente.DatosAnamnesis[0];
    $scope.expandido = true;
    $scope.ultimoMostrado = null;

    var fxNacimiento = $(".datepickerFxNacimiento");
    var form = $("#formularioDatosAnamnesis");
    var dialog = $("#dialogoNotificacion");

    $scope.init = function(){
        fxNacimiento.datepicker({ language:"es",clearBtn:true,dateFormat:"dd/mm/yyyy"  });
    };

    $scope.setEditando = function(valor){
        $scope.editando = valor;
    };

    $scope.setCreando = function(valor,plantilla){
        plantilla = plantilla || false;
        $scope.creando = valor;
        if(valor){
            console.log("creando");
            $scope.ultimoMostrado=$scope.datosAnamnesis;
            if(!plantilla){
                $scope.datosAnamnesis = {};
                form.find(".botonClear").click();
            }
            else{
                $scope.ultimoMostrado = angular.copy($scope.datosAnamnesis);
            }
        }else{

            $scope.datosAnamnesis = $scope.ultimoMostrado;
            $(".selectFechaDA").trigger("change");
        }
    };

    $scope.setExpandido = function(valor){
        $scope.expandido = valor;
    };

    $scope.perteneceAnamnesis = function(datosAnamnesis){
        return (datosAnamnesis.Anamnesis_idAnamnesis == $scope.anamnesisActual.id_anamnesis);
    };

    $scope.cancelarAction = function(){
        $scope.setEditando(false);
        $scope.setCreando(false);
    };

    $scope.submitFormulario = function(){
        dialog.find('.cargando').show();
        dialog.modal('show');
        var ruta = null;
        if ($scope.editando)    ruta = Routing.generate('editar_datos_semipermanentes')
        else                    ruta = Routing.generate('crear_datos_semipermanentes');

        var dataPreEnviar = form.serializeObject();
        console.log(dataPreEnviar);

        form.find('input[type=checkbox],input[type=radio]').each(
            function(index,element) {
                dataPreEnviar[element.name] = element.checked;
            });

        form.find('canvas').each(
            function(index,element) {
               // dataPreEnviar[element.data("namedata")] = element.json();
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



app.directive('mypaint', function($compile) {

    var getTemplate = function(content) {
        return Handlebars.templates.imagenpaint(content);
    }
    return {
        restrict: 'E',
        scope: { ident : '@', ancho:'@', alto:'@', tipo:'@', namedata:'@'},
        transclude:true,
        link : function(scope,element,attributes){
            var opciones = {
                dolor: [{color:'#f00', title:"Fuerte"},{color:'yellow', title:"Normal"},{color:'#0f0', title:"Leve"}]
            };
            var colores = opciones[scope.tipo];
            scope["colores"]= colores;
            element.html(getTemplate(scope));

            var canvas = element.find("#canvas_"+scope.ident);
            canvas.sketchpad({
                aspectRatio: 2 / 1,             // (Required) To preserve the drawing, an aspect ratio must be specified
                backgroundColor: '#FFFFFF',      // (Optional) Set the background of the canvas
                strokes: 'JSON',                // (Optional) Initialize the sketchpad with stroke data
                lineColor: '#000000'
            }).setLineSize(5);

            element.find("button").click(function(){ canvas.setLineColor($(this).data("color"))}).tooltip();
            element.find(".tamanoPuntero").click(function(){ canvas.setLineSize($(this).val())});
            element.find(".toolimage").tooltip();
            element.find(".botonRedo").click(function(){ canvas.redo();  });
            element.find(".botonUndo").click(function(){ canvas.undo(); });
            element.find(".botonClear").click(function(){ canvas.clear(); });
            $(".selectFechaDA").change(function(){ canvas.jsonLoad(scope.$parent.datosAnamnesis[scope.namedata]); });
            
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