/**
 * Created by IsmiKin on 23/12/14.
 */

// Version "semi-automatica"
var camposEnColumnas = ["codigo","localizacion","tipo"];
var camposEnFilas = ["estado"];
var rowEditando ;

$(document).ready(function(){

    $(".form-gabinete").submit(submitFormGabinete); // Para la creacion
    $(".form-editar-gabinete").submit(submitEditarFormGabinete)
    //$(".submitEditarGabinete").click(submitEditarFormGabinete);
    $(".habilitarGabineteButton").click(habilitarGabinete);
    $(".crearModalButton").click(showCreateModal);
    $(".editarGabineteTabla").click(showEditModal);

    // Version alternativa

});

function submitFormGabinete(e){
    e.preventDefault();
    var form = $(".form-gabinete");
    var botonCrear = $(".submitCrearGabinete");
    var botonEditar = $(".submitEditarGabinete");
    var idGabinete = null;
    var opcion = null;

    if(rowEditando!=undefined)
        idGabinete = rowEditando.data("idgabinete");

    var values = {};
    $.each( form.serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });
    console.log(form.serializeArray());

    if(botonCrear.is(":visible")){
        opcion = botonCrear;
    }else{
        opcion = botonEditar;
    }

    $.ajax({
        type: opcion.data("method"), url: opcion.data("action"),
        data: values,
        success: function(data) {
            if(data.codigo_error==0){
                var gabinete = $.parseJSON(data.gabinete);
                insertarNuevaRow(gabinete);

                resetearForm();
                $(".cancelarGabineteForm").click();
            }else
                console.log("error!");

        }
    });

}

function submitEditarFormGabinete(e){
    e.preventDefault();
    console.log("yija");
    var form = $(".form-editar-gabinete");
    var botonCrear = $(".submitCrearGabinete");
    var botonEditar = $(".submitEditarGabinete");
    var idGabinete = null;
    var opcion = null;

    if(rowEditando!=undefined)
        idGabinete = rowEditando.data("idgabinete");

    var values = {};
    $.each( form.serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });
    console.log(form.serializeArray());

    if(botonCrear.is(":visible")){
        opcion = botonCrear;
    }else{
        opcion = botonEditar;
        values["idGabinete"] = idGabinete;
    }

    $.ajax({
        type: opcion.data("method"), url: opcion.data("action"),
        data: values,
        success: function(data) {
            if(data.codigo_error==0){
                var gabinete = $.parseJSON(data.gabinete);
                insertarNuevaRow(gabinete);

                resetearForm();
                $(".cancelarGabineteForm").click();
            }else
                console.log("error!");

        }
    });

    console.log("webe");
}


function resetearForm(){
    $(".form-gabinete")[0].reset();
}

function insertarNuevaRow(gabinete){
    var htmlNuevaFila = Handlebars.templates.nuevafila_gabinete(gabinete);
    $(".table-gabinetes tr:last").after(htmlNuevaFila);
    $(".habilitarGabineteButton").click(habilitarGabinete);
    $(".editarGabineteTabla").click(showEditModal);
}

function actualizarRow(gabinete){
    console.log(gabinete);
    $.each(camposEnColumnas,function(index,value){
       row.find(".td"+value).data();

    });
    $.each(camposEnFilas,function(index,value){
        formulario.find('[name*='+value+']').val(row.data(value));
    });
}

function habilitarGabinete(){
    var boton = $(this);
    var accion = $(this).data("habilitar");
    var row = $(this).parent().parent().parent();
    var nuevoColor = (accion) ? "success" : "danger";
    var antiguoColor = (accion) ? "danger" : "success";

    $.ajax({
        type: "PUT",
        url: Routing.generate('habilitar_gabinete'),
        data: {idGabinete:row.data("idgabinete"), habilitar:accion},
        success: function(data) {
            if(data.codigo_error==0){
                row.find(".habilitarGabineteButton:hidden").parent().show();
                boton.parent().hide();
                row.removeClass(antiguoColor).addClass(nuevoColor);
            }else
                console.log("error!");

        }
    });

}


function showCreateModal(e){
    resetearForm();
}

function showEditModal(){
    resetearForm();
    rowEditando = $(this).parent().parent();
    bindDatosForm(rowEditando);
}

// Este metodo habria que hacerlo "automatico"
function bindDatosForm(row){
    var formularioEditar = $(".form-editar-gabinete");
    $.each(camposEnColumnas,function(index,value){
        formularioEditar.find('[name*='+value+']').val(row.find(".td"+value).data(value));
    });
    $.each(camposEnFilas,function(index,value){
        formularioEditar.find('[name*='+value+']').val(row.data(value));
    });
}