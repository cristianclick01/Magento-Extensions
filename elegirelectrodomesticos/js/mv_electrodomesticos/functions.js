function siguientePregunta(id_anterior, id_nuevo){
    var anterior = jQuery('#' + id_anterior);
    var nuevo = jQuery('#' + id_nuevo);

    anterior.fadeOut(100);    
    setTimeout(function (){
        nuevo.fadeIn(100);
    }, 100);
}

function vaciarCampos(){
    jQuery('#cont_productos').empty();
    jQuery('.no-results').empty();
    var max_size = 3;
    for (var i=0; i < max_size; i++)
        jQuery('#res' + i).empty();
}

//inicializamos el cuestionario
jQuery(function(){
    jQuery('#pregunta-1').show();
});