(function() {
  var template = Handlebars.template, templates = Handlebars.templates = Handlebars.templates || {};
templates['imagenpaint'] = template({"1":function(depth0,helpers,partials,data) {
    var helper, alias1=helpers.helperMissing, alias2="function", alias3=this.escapeExpression;

  return "            <button  type=\"button\" canvas=\""
    + alias3(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"ident","hash":{},"data":data}) : helper)))
    + "\" class=\"btn botoncolor\"  href=\".colors_sketch\" height=\"20\" width=\"20\" style=\"background:"
    + alias3(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"color","hash":{},"data":data}) : helper)))
    + " ;\" data-color=\""
    + alias3(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"color","hash":{},"data":data}) : helper)))
    + "\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\""
    + alias3(((helper = (helper = helpers.title || (depth0 != null ? depth0.title : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"title","hash":{},"data":data}) : helper)))
    + "\"><i class=\"fa fa-eyedropper\"></i></button>\n";
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
    var stack1, helper, alias1=helpers.helperMissing, alias2="function", alias3=this.escapeExpression;

  return "<div class=\"row\">\n    <div class=\"col-md-4\">\n        <button type=\"button\" class=\"btn btn-default toolimage botonUndo\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Deshacer\"><i class=\"fa fa-undo\"></i></button>\n        <button type=\"button\" class=\"btn btn-default toolimage botonRedo\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Rehacer\"><i class=\"fa fa-repeat\"></i></button>\n        <button type=\"button\" class=\"btn btn-default toolimage botonClear\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Limpiar\"><i class=\"fa fa-eraser\"></i></button>\n    </div>\n</div>\n\n<div class=\"row\">\n    <div class=\"col-md-4\">\n        <canvas id=\"canvas_"
    + alias3(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"ident","hash":{},"data":data}) : helper)))
    + "\" border=\"5\" width=\""
    + alias3(((helper = (helper = helpers.ancho || (depth0 != null ? depth0.ancho : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"ancho","hash":{},"data":data}) : helper)))
    + "\" height=\""
    + alias3(((helper = (helper = helpers.alto || (depth0 != null ? depth0.alto : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"alto","hash":{},"data":data}) : helper)))
    + "\" style=\"cursor: crosshair; background:url('/img/hojageneral/"
    + alias3(((helper = (helper = helpers.imagen || (depth0 != null ? depth0.imagen : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"imagen","hash":{},"data":data}) : helper)))
    + ".png')\">Your browser does not support HTML5 Canvas.</canvas>\n    </div>\n</div>\n<div class=\"row\">\n    <div class=\"col-md-4\">\n"
    + ((stack1 = helpers.each.call(depth0,(depth0 != null ? depth0.colores : depth0),{"name":"each","hash":{},"fn":this.program(1, data, 0),"inverse":this.noop,"data":data})) != null ? stack1 : "")
    + "    </div>\n</div>\n<div class=\"row\">\n    <div class=\"col-md-4\">\n        <input type=\"range\" class=\"tamanoPuntero\" canvas=\""
    + alias3(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : alias1),(typeof helper === alias2 ? helper.call(depth0,{"name":"ident","hash":{},"data":data}) : helper)))
    + "\" max=\"10\" min=\"1\"/>\n    </div>\n</div>";
},"useData":true});
})();