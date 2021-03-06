/**
 * Created by ismikin on 8/02/15.
 */

'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosAnamnesisMod',[]);

app.controller('DAController',  function($scope,$rootScope,$http,$filter) {

    $scope.editando = false;
    $scope.creando = false;
    $scope.dpaciente = paciente.Paciente;
    $scope.anamnesisAll = paciente.Anamnesis;
    $scope.anamnesisActual = paciente.Anamnesis[0];
    $scope.datosAnamnesis = null;
    $scope.datosAAll = paciente.DatosA;
    $scope.expandido = true;
    $scope.ultimoMostrado = null;

    var filter = $filter('filter');
    var form = $("#formularioDatosAnamnesis");
    var dialog = $("#dialogoNotificacion");

    $scope.init = function(){

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

        var dataPreEnviar = form.serializeObject();

        if ($scope.editando)    ruta = Routing.generate('editar_datos_anamnesis')
        else{
            ruta = Routing.generate('crear_datos_anamnesis');
            //dataPreEnviar
        }
        console.log(dataPreEnviar);

        form.find('input[type=radio]').each(
            function(index,element) {
                dataPreEnviar[element.name] = $(element).val();
            });


        var dataEnviar = JSON.stringify(dataPreEnviar);

        $http.post(ruta,dataEnviar )
            .success(function(data, status, headers, config) {
                if(data.codigo_error==0){
                    dialog.find('.cargando').hide();
                    dialog.find('.completadoerror').hide();
                    dialog.find('.completadook').show();
                    var nuevoDA = JSON.parse(data.nuevoda);

                    if($scope.creando){
                        if(data.nuevoanamnesis!=undefined){
                            var nuevoAnamnesis = JSON.parse(data.nuevoanamnesis);
                            $scope.anamnesisAll.push(nuevoAnamnesis);
                            $scope.anamnesisActual = $scope.anamnesisAll[$scope.anamnesisAll.length-1];
                        }else{
                            //$scope.anamnesisActual = filter($scope.anamnesisAll, {id_anamesis: nuevoDA.Anamnesis_idAnamnesis});
                            $scope.anamnesisActual = $scope.anamnesisAll[0];
                        }
                        //alert($scope.datosAAll);
                        //alert($scope.datosAAll.length);
                        $scope.datosAAll.push(nuevoDA);
                        $scope.datosAnamnesis = $scope.datosAAll[$scope.datosAAll.length-1];
                    }
                    $scope.setEditando(false);
                    $scope.setCreando(false);

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
            canvas.mouseup(function(){
                element.find(".hidden_"+scope.namedata).val(canvas.json());
                scope.$parent.datosAnamnesis[scope.namedata] = canvas.json();
            });
            $(".selectFechaDA").change(function(){
                element.find(".botonClear").click();
                if(scope.$parent.datosAnamnesis[scope.namedata]!=undefined)
                    canvas.jsonLoad(scope.$parent.datosAnamnesis[scope.namedata]);
            });
            
        }
    }

});
