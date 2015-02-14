/**
 * Created by ismikin on 14/02/15.
 */
/**
 * Created by ismikin on 8/02/15.
 */

'use strict';

// Declare app level module which depends on views, and components
var app = angular.module('datosOnicopatisMod',[]);

app.controller('DOController',  function($scope,$rootScope,$http,$filter) {

    $scope.editando = false;
    $scope.creando = false;
    $scope.dpaciente = paciente.Paciente;
    $scope.anamnesisAll = paciente.Anamnesis;
    $scope.anamnesisActual = paciente.Anamnesis[0];
    $scope.datosOnicopatis = null;
    $scope.datosOAll = paciente.DatosO;
    $scope.expandido = true;
    $scope.ultimoMostrado = null;

    var filter = $filter('filter');
    var form = $("#formularioDatosOnicopatis");
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
            $scope.ultimoMostrado=$scope.datosOnicopatis;
            if(!plantilla){
                $scope.datosOnicopatis = {};
                form.find(".botonClear").click();
            }
            else{
                $scope.ultimoMostrado = angular.copy($scope.datosOnicopatis);
            }
        }else{

            $scope.datosOnicopatis = $scope.ultimoMostrado;
            $(".selectFechaDO").trigger("change");
        }
    };

    $scope.setExpandido = function(valor){
        $scope.expandido = valor;
    };

    $scope.perteneceAnamnesis = function(datosOnicopatis){
        return (datosOnicopatis.Anamnesis_idAnamnesis == $scope.anamnesisActual.id_anamnesis);
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

        if ($scope.editando)    ruta = Routing.generate('editar_datos_onicopatis')
        else{
            ruta = Routing.generate('crear_datos_onicopatis');
        }
        console.log(dataPreEnviar);

        var dataEnviar = JSON.stringify(dataPreEnviar);

        $http.post(ruta,dataEnviar )
            .success(function(data, status, headers, config) {
                if(data.codigo_error==0){
                    dialog.find('.cargando').hide();
                    dialog.find('.completadoerror').hide();
                    dialog.find('.completadook').show();
                    var nuevoDO = JSON.parse(data.nuevoDO);

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
                        $scope.datosOAll.push(nuevoDA);
                        $scope.datosOnicopatis = $scope.datosOAll[$scope.datosOAll.length-1];
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


app.directive('mypainto', function($compile) {

    var getTemplate = function(content) {
        return Handlebars.templates.imagenpaintonico(content);
    };

    return {
        restrict: 'E',
        scope: { ident : '@', ancho:'@', alto:'@', tipo:'@', namedata:'@'},
        transclude:true,
        link : function(scope,element,attributes){
            var opciones = {
                onicopatis: [{color:'#DB0700', title:"Astroficas"},{color:'#50B01C', title:"Distrofica"},
                    {color:'#FFBF00', title:"Hipertrofica"},{color:'#276ACB', title:"Onicogrifosis"}, {color:'#000000', title:"Onicocriptosis"},
                    {color:'#FAD9E5', title:"U.Psoriasica"},{color:'#E0D4E6', title:"U.Discromica"}
                ]
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
                scope.$parent.datosOnicopatis[scope.namedata] = canvas.json();
            });
            $(".selectFechaDO").change(function(){
                element.find(".botonClear").click();
                if(scope.$parent.datosOnicopatis[scope.namedata]!=undefined)
                    canvas.jsonLoad(scope.$parent.datosOnicopatis[scope.namedata]);
            });

        }
    }

});
