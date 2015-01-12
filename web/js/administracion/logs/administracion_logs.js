/**
 * Created by ismikin on 28/12/14.
 */

// Habria que hacerlo automatico
var categorias = { categorias: [ {nombre:"Administracion", logo:"cog"},{nombre:"Agenda", logo:"calendar"},{ nombre:"Paciente",logo:"stethoscope"} ]};
var subcategorias = {
    subcategorias: {
        Administracion: [{nombre: "Usuario", logo: "users"}, {nombre: "Log", logo: "book"}],
        Agenda: [{nombre: "Cita", logo: ""}, {nombre: "Gabinete", logo: ""}],
        Paciente: [{nombre: "DatosPersonales", logo: ""}, {
            nombre: "HistoriaGeneral",
            logo: ""
        }, {nombre: "DatosSemipermanentes", logo: ""}]
    }
};


$(document).ready(function(){

    inicializarPanelFiltroHigh();
    $('.footable').footable();
    $(".pagination").children("ul").addClass("pagination");
    $(".footable-sort-indicator").click(function(){
        setTimeout(borrarSegundo,1000 );
    });

});

function inicializarPanelFiltroHigh(){
    var htmlPanel = Handlebars.templates.filtros_highres(categorias);
    $("#panel-filtros > .row").after(htmlPanel);
    $(".item-categoria").click(filtrarCategoria);
}

function filtrarCategoria(e){
    e.preventDefault();

    var categoria = $(this);
    var panelSubcategorias =$(".filtro-subcategorias").find(".subcategorias");
    panelSubcategorias.empty();
    var subs= subcategorias.subcategorias[categoria.data("categoria")];
    $.each(subs,function(index,value){
        var htmlNuevaFilaSubcategoria = Handlebars.templates.nuevafila_subcategoria(value);
        panelSubcategorias.append(htmlNuevaFilaSubcategoria);
        $(".subcategoria-item").click(filtrarSubcategoria);
    });
    filtrarTabla(categoria.data("categoria"));
}

function filtrarSubcategoria(e){
    e.preventDefault();
    var subcategoria =$(this);
    filtrarTabla(subcategoria.data("subcategoria"));
}

function filtrarTabla(filtro){
    var footableFilter = $(".footable").data('footable-filter');
    footableFilter.filter(filtro);
    borrarSegundo();
}