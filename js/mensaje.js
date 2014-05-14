$(function(){
    
     $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "jsonp",
            url: "../clases/formulario/verifica_e_InsertaTarjeta.php",
            cache: true,
            crossDomain: true,     
            //data: parametros_frases,//se le envia al servidor la variable codigo la cual contiene el codigo del libro a buscar
            //data: parametros_frases,
            success: function(DATA3) { 
            fras.data("cachefras", DATA3);
            console.log("solo una ves frasess");
            
            },
              complete: function( ){
                    console.timeEnd("Peticion AJAX");
                  },
            error: function(DATA3) {
                console.log("Error" + DATA3);
                alert("Error de conexion con los servicios MET" + DATA3);
            }
           // });

         });
});

