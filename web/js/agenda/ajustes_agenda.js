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
    $(".habilitarGabineteButton").click(habilitarGabinete);
    $(".crearModalButton").click(showCreateModal);
    $(".editarGabineteTabla").click(showEditModal);

});

function submitFormGabinete(e){
    e.preventDefault();
    var form = $(".form-gabinete");
    var botonCrear = $(".submitCrearGabinete");

    var values = {};
    $.each( form.serializeArray(), function(i, field) {
        values[field.name] = field.value;
    });

    $.ajax({
        type: botonCrear.data("method"), url: botonCrear.data("action"),
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
    var botonEditar = $(".submitEditarGabinete");
    var idGabinete = null;

    if(rowEditando!=undefined)
        idGabinete = rowEditando.data("idgabinete");

    var values = {};
    $.each( form.serializeArray(), function(i, field) {
        values[field.name.split("[")[1].split("]")[0]] = field.value;
    });
    values["idgabinete"] = idGabinete;

    $.ajax({
        type: botonEditar.data("method"), url: botonEditar.data("action"),
        data: $.param(values),
        success: function(data) {
            if(data.codigo_error==0){
                var gabinete = $.parseJSON(data.gabinete);
                actualizarRow(gabinete);
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
    $.each(camposEnColumnas,function(index,value){
        columna = rowEditando.find(".td"+value);
        columna.data(value,gabinete[value]);
        columna.text(gabinete[value]);
    });
    $.each(camposEnFilas,function(index,value){
        rowEditando.data(value,gabinete[value]);
    });

    var nuevoColor = (gabinete.estado=="Activo") ? "success" : "danger";
    var antiguoColor = (gabinete.estado=="Activo") ? "danger" : "success";
    rowEditando.removeClass(antiguoColor).addClass(nuevoColor);

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