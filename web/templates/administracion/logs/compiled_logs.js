(function() {
  var template = Handlebars.template, templates = Handlebars.templates = Handlebars.templates || {};
templates['filtros_highres'] = template({"1":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "            <a href=\"#\" class=\"list-group-item item-categoria\" data-categoria=\""
    + escapeExpression(((helper = (helper = helpers.nombre || (depth0 != null ? depth0.nombre : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"nombre","hash":{},"data":data}) : helper)))
    + "\" >\n                <i class=\"fa fa-"
    + escapeExpression(((helper = (helper = helpers.logo || (depth0 != null ? depth0.logo : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"logo","hash":{},"data":data}) : helper)))
    + "\"></i>  "
    + escapeExpression(((helper = (helper = helpers.nombre || (depth0 != null ? depth0.nombre : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"nombre","hash":{},"data":data}) : helper)))
    + "\n            </a>\n";
},"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, buffer = "<div class=\"row\">\n    <div class=\"list-group filtro-categorias\">\n        <a href=\"#\" class=\"list-group-item active\">\n            <i class=\"fa fa-list-alt fa-2x\" ></i>  <span class=\"tituloPanel\">Categorias</span>\n        </a>\n";
  stack1 = helpers.each.call(depth0, (depth0 != null ? depth0.categorias : depth0), {"name":"each","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data});
  if (stack1 != null) { buffer += stack1; }
  return buffer + "    </div>\n    <div class=\"list-group filtro-subcategorias\">\n        <a href=\"#\" class=\"list-group-item list-group-item-info item-subcategoria\">\n            <i class=\"fa fa-th-list fa-2x\" ></i>    <span class=\"tituloPanel\">Subcategorias</span>\n        </a>\n        <div class=\"subcategorias\">\n\n        </div>\n    </div>\n</div>";
},"useData":true});
templates['nuevafila_subcategoria'] = template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var helper, functionType="function", helperMissing=helpers.helperMissing, escapeExpression=this.escapeExpression;
  return "<a href=\"#\" class=\"list-group-item subcategoria-item\" data-subcategoria=\""
    + escapeExpression(((helper = (helper = helpers.nombre || (depth0 != null ? depth0.nombre : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"nombre","hash":{},"data":data}) : helper)))
    + "\">\n    <i class=\"fa fa-"
    + escapeExpression(((helper = (helper = helpers.logo || (depth0 != null ? depth0.logo : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"logo","hash":{},"data":data}) : helper)))
    + "\"></i>  "
    + escapeExpression(((helper = (helper = helpers.nombre || (depth0 != null ? depth0.nombre : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"nombre","hash":{},"data":data}) : helper)))
    + "\n</a>";
},"useData":true});
})();