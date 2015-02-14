(function() {
  var template = Handlebars.template, templates = Handlebars.templates = Handlebars.templates || {};
templates['imagenpaint'] = template({"1":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "            <button  type=\"button\" canvas=\""
    + escapeExpression(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ident","hash":{},"data":data}) : helper)))
    + "\" class=\"btn botoncolor\"  href=\".colors_sketch\" height=\"20\" width=\"20\" style=\"background:"
    + escapeExpression(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"color","hash":{},"data":data}) : helper)))
    + " ;\" data-color=\""
    + escapeExpression(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"color","hash":{},"data":data}) : helper)))
    + "\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\""
    + escapeExpression(((helper = (helper = helpers.title || (depth0 != null ? depth0.title : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"title","hash":{},"data":data}) : helper)))
    + "\"><i class=\"fa fa-eyedropper\"></i></button>\n";
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "<div class=\"row\">\n    <div class=\"col-md-4\">\n        <button type=\"button\" class=\"btn btn-default toolimage botonUndo\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Deshacer\"><i class=\"fa fa-undo\"></i></button>\n        <button type=\"button\" class=\"btn btn-default toolimage botonRedo\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Rehacer\"><i class=\"fa fa-repeat\"></i></button>\n        <button type=\"button\" class=\"btn btn-default toolimage botonClear\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Limpiar\"><i class=\"fa fa-eraser\"></i></button>\n    </div>\n</div>\n\n<div class=\"row\">\n    <div class=\"col-md-4\">\n        <canvas id=\"canvas_"
    + escapeExpression(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ident","hash":{},"data":data}) : helper)))
    + "\" border=\"5\" width=\""
    + escapeExpression(((helper = (helper = helpers.ancho || (depth0 != null ? depth0.ancho : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ancho","hash":{},"data":data}) : helper)))
    + "\" height=\""
    + escapeExpression(((helper = (helper = helpers.alto || (depth0 != null ? depth0.alto : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"alto","hash":{},"data":data}) : helper)))
    + "\" data-namedata=\""
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + "\" style=\"width:"
    + escapeExpression(((helper = (helper = helpers.ancho || (depth0 != null ? depth0.ancho : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ancho","hash":{},"data":data}) : helper)))
    + "px; height:"
    + escapeExpression(((helper = (helper = helpers.alto || (depth0 != null ? depth0.alto : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"alto","hash":{},"data":data}) : helper)))
    + "px; cursor: crosshair; background:url('/img/hojageneral/"
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + ".png') ;  background-repeat: no-repeat;\">Your browser does not support HTML5 Canvas.</canvas>\n        <input type=\"hidden\" class=\"hidden_"
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + "\" name=\""
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + "\"/>\n    </div>\n</div>\n<div class=\"row\">\n    <div class=\"col-md-4\">\n";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.colores : depth0), {"name":"each","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "    </div>\n</div>\n<div class=\"row\">\n    <div class=\"col-md-4\">\n        <input type=\"range\" class=\"tamanoPuntero\" canvas=\""
    + escapeExpression(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ident","hash":{},"data":data}) : helper)))
    + "\" max=\"10\" min=\"1\"/>\n    </div>\n</div>";
},"useData":true});
templates['imagenpaintonico'] = template({"1":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "            <div class=\"row\">\n                    <div class=\"col-sm-2\">\n                        <button  type=\"button\" canvas=\""
    + escapeExpression(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ident","hash":{},"data":data}) : helper)))
    + "\" class=\"btn botoncolor\"  href=\".colors_sketch\" height=\"20\" width=\"20\" style=\"background:"
    + escapeExpression(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"color","hash":{},"data":data}) : helper)))
    + " ;\" data-color=\""
    + escapeExpression(((helper = (helper = helpers.color || (depth0 != null ? depth0.color : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"color","hash":{},"data":data}) : helper)))
    + "\" data-toggle=\"tooltip\" data-placement=\"bottom\" title=\""
    + escapeExpression(((helper = (helper = helpers.title || (depth0 != null ? depth0.title : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"title","hash":{},"data":data}) : helper)))
    + "\"><i class=\"fa fa-eyedropper\"></i></button>\n                    </div>\n                    <div class=\"col-sm-2\">\n                        <b>"
    + escapeExpression(((helper = (helper = helpers.title || (depth0 != null ? depth0.title : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"title","hash":{},"data":data}) : helper)))
    + "</b>\n                    </div>\n\n            </div>\n";
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression, buffer = "<div class=\"row\">\n    <div class=\"col-md-4 pull-left\">\n        <button type=\"button\" class=\"btn btn-default toolimage botonUndo\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Deshacer\"><i class=\"fa fa-undo\"></i></button>\n        <button type=\"button\" class=\"btn btn-default toolimage botonRedo\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Rehacer\"><i class=\"fa fa-repeat\"></i></button>\n        <button type=\"button\" class=\"btn btn-default toolimage botonClear\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Limpiar\"><i class=\"fa fa-eraser\"></i></button>\n    </div>\n</div>\n<br/>\n\n<div class=\"row\">\n    <div class=\"col-md-4\">\n        <canvas id=\"canvas_"
    + escapeExpression(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ident","hash":{},"data":data}) : helper)))
    + "\" border=\"5\" width=\""
    + escapeExpression(((helper = (helper = helpers.ancho || (depth0 != null ? depth0.ancho : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ancho","hash":{},"data":data}) : helper)))
    + "\" height=\""
    + escapeExpression(((helper = (helper = helpers.alto || (depth0 != null ? depth0.alto : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"alto","hash":{},"data":data}) : helper)))
    + "\" data-namedata=\""
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + "\" style=\"width:"
    + escapeExpression(((helper = (helper = helpers.ancho || (depth0 != null ? depth0.ancho : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ancho","hash":{},"data":data}) : helper)))
    + "px; height:"
    + escapeExpression(((helper = (helper = helpers.alto || (depth0 != null ? depth0.alto : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"alto","hash":{},"data":data}) : helper)))
    + "px;cursor: crosshair; background:url('/img/hojageneral/"
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + ".png') ;  background-repeat: no-repeat;\">Your browser does not support HTML5 Canvas.</canvas>\n        <input type=\"hidden\" class=\"hidden_"
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + "\" name=\""
    + escapeExpression(((helper = (helper = helpers.namedata || (depth0 != null ? depth0.namedata : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"namedata","hash":{},"data":data}) : helper)))
    + "\"/>\n        <input type=\"range\" class=\"tamanoPuntero\" canvas=\""
    + escapeExpression(((helper = (helper = helpers.ident || (depth0 != null ? depth0.ident : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"ident","hash":{},"data":data}) : helper)))
    + "\" max=\"10\" min=\"1\"/>\n    </div>\n    <div class=\"col-md-6\">\n";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.colores : depth0), {"name":"each","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "    </div>\n\n\n</div>";
},"useData":true});
})();