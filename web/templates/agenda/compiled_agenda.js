(function() {
  var template = Handlebars.template, templates = Handlebars.templates = Handlebars.templates || {};
templates['nuevafila_gabinete'] = template({"1":function(depth0,helpers,partials,data) {
  return "            class=\"success\"\n";
  },"3":function(depth0,helpers,partials,data) {
  return "            class=\"danger\"\n";
  },"5":function(depth0,helpers,partials,data) {
  return " hidden=\"hidden\" ";
  },"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, helperMissing=helpers.helperMissing, functionType="function", escapeExpression=this.escapeExpression, buffer = "<tr\n";
  stack1 = ((helpers.ifCond || (depth0 && depth0.ifCond) || helperMissing).call(depth0, (depth0 != null ? depth0.estado : depth0), "==", "Activo", {"name":"ifCond","hash":{},"fn":this.program(1, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n";
  stack1 = ((helpers.ifCond || (depth0 && depth0.ifCond) || helperMissing).call(depth0, (depth0 != null ? depth0.estado : depth0), "==", "Inactivo", {"name":"ifCond","hash":{},"fn":this.program(3, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n";
  stack1 = ((helpers.ifCond || (depth0 && depth0.ifCond) || helperMissing).call(depth0, (depth0 != null ? depth0.estado : depth0), "==", "Inactivo", {"name":"ifCond","hash":{},"fn":this.program(3, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += "\n        data-idgabinete=\""
    + escapeExpression(((helper = (helper = helpers.id_gabinete || (depth0 != null ? depth0.id_gabinete : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"id_gabinete","hash":{},"data":data}) : helper)))
    + "\"\n        data-estado=\""
    + escapeExpression(((helper = (helper = helpers.estado || (depth0 != null ? depth0.estado : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"estado","hash":{},"data":data}) : helper)))
    + "\"\n>\n<td class=\"tdcodigo\" data-codigo=\""
    + escapeExpression(((helper = (helper = helpers.codigo || (depth0 != null ? depth0.codigo : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"codigo","hash":{},"data":data}) : helper)))
    + "\">"
    + escapeExpression(((helper = (helper = helpers.codigo || (depth0 != null ? depth0.codigo : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"codigo","hash":{},"data":data}) : helper)))
    + "</td>\n<td class=\"tdlocalizacion\" data-localizacion=\""
    + escapeExpression(((helper = (helper = helpers.localizacion || (depth0 != null ? depth0.localizacion : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"localizacion","hash":{},"data":data}) : helper)))
    + "\">"
    + escapeExpression(((helper = (helper = helpers.localizacion || (depth0 != null ? depth0.localizacion : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"localizacion","hash":{},"data":data}) : helper)))
    + "</td>\n<td class=\"tdtipo\" data-tipo=\""
    + escapeExpression(((helper = (helper = helpers.tipo || (depth0 != null ? depth0.tipo : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"tipo","hash":{},"data":data}) : helper)))
    + "\">"
    + escapeExpression(((helper = (helper = helpers.tipo || (depth0 != null ? depth0.tipo : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"tipo","hash":{},"data":data}) : helper)))
    + "</td>\n<td class=\"tdacciones\">\n    <button class=\"btn btn-warning editarGabineteTabla\" data-toggle=\"modal\" data-target=\"#modalEditarForm\"><i class=\"fa fa-edit\"></i></button>\n\n    <span ";
  stack1 = ((helpers.ifCond || (depth0 && depth0.ifCond) || helperMissing).call(depth0, (depth0 != null ? depth0.estado : depth0), "==", "Activo", {"name":"ifCond","hash":{},"fn":this.program(5, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  buffer += ">\n        <button class=\"btn btn-success habilitarGabineteButton\" data-habilitar=\"true\" ><i class=\"fa fa-check\"></i></button>\n    </span>\n    <span ";
  stack1 = ((helpers.ifCond || (depth0 && depth0.ifCond) || helperMissing).call(depth0, (depth0 != null ? depth0.estado : depth0), "==", "Inactivo", {"name":"ifCond","hash":{},"fn":this.program(5, data),"inverse":this.noop,"data":data}));
  if (stack1 != null) { buffer += stack1; }
  return buffer + ">\n        <button class=\"btn btn-danger habilitarGabineteButton\" data-habilitar=\"false\"><i class=\"fa fa-minus-circle\"></i></button>\n    </span>\n\n</td>\n\n</tr>";
},"useData":true});
templates['nuevo_popover_cita'] = template({"compiler":[6,">= 2.0.0-beta.1"],"main":function(depth0,helpers,partials,data) {
  var stack1, helper, lambda=this.lambda, escapeExpression=this.escapeExpression, functionType="function", helperMissing=helpers.helperMissing;
  return "<strong>Gabinete</strong>:"
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.Gabinete : depth0)) != null ? stack1.localizacion : stack1), depth0))
    + "<br/><br/>\n<strong>Paciente</strong>:<em> "
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.Paciente : depth0)) != null ? stack1.apellidos : stack1), depth0))
    + ","
    + escapeExpression(lambda(((stack1 = (depth0 != null ? depth0.Paciente : depth0)) != null ? stack1.nombre : stack1), depth0))
    + "</em>\n<hr>\n<p>"
    + escapeExpression(((helper = (helper = helpers.motivoconsulta || (depth0 != null ? depth0.motivoconsulta : depth0)) != null ? helper : helperMissing),(typeof helper === functionType ? helper.call(depth0, {"name":"motivoconsulta","hash":{},"data":data}) : helper)))
    + "</p>\n";
},"useData":true});
})();