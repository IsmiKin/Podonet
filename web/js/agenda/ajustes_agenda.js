/**
 * Created by root on 23/12/14.
 */

$(document).ready(function(){

    $(".form-gabinete").submit(submitFormGabinete);

});

function submitFormGabinete(e){
    e.preventDefault();
    $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(data) {
            alert(data);
        }
    });

    return false;

}