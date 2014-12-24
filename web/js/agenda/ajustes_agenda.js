/**
 * Created by root on 23/12/14.
 */

$(document).ready(function(){

    $(".form-gabinete").submit(submitFormGabinete);
    $(".nuevoGabineteButton").click(showFormGabinete);
    $(".cancelarGabineteForm").click(hideFormGabinete);
});

function submitFormGabinete(e){
    e.preventDefault();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            if(data.codigo_error==0){
                var gabinete = $.parseJSON(data.gabinete);
                var htmlNuevaFila = Handlebars.templates.nuevafila_gabinete(gabinete);
                $(".table-gabinetes tr:last").after(htmlNuevaFila);
            }else
                console.log("error!");

        }
    });

    return false;

}

function showFormGabinete(){
    $(".form-gabinete").fadeIn("slow");
    var context = {
        title: "My First Blog Post!",
        author: {
            id: 47,
            name: "Yehuda Katz"
        },
        body: "My first post. Wheeeee!"
    };
    //alert(Handlebars.templates.nuevafila_gabinete(context));
    var nuevafila = Handlebars.templates.nuevafila_gabinete(context);

}

function hideFormGabinete(){
    $(".form-gabinete").fadeOut("slow");
    $(".form-gabinete")[0].reset();
}