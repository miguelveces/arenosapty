$(function() {
    $("#mensaje").fadeOut();
    console.log("entrando");
 $.ajax({
            type: "GET",
            contentType: "application/json; charset=utf-8",
            dataType: "jsonp",
            url: "clases/procesos/getMensaje.php",
            cache: true,
            crossDomain: true,
            data: {flag: 1}, //se le envia al servidor la variable codigo la cual contiene el codigo del libro a buscar
            success: function(DATA) {
                console.log(DATA.capitan);
               var capitanrecibido;
               var mensaje;
                
                    capitanrecibido = DATA.capitan;
                    mensaje = DATA.valor;
                    console.log(capitanrecibido);
                    
                    console.log(mensaje);
                 if (capitanrecibido == 1)
                {
                    //mensaje 
                    $("#mensaje").fadeIn();

                    $("#mensaje").text(mensaje);
                    $("#mensaje").css("border", "solid blue 1px");
                }
                else if (capitanrecibido == 2) {
                    //error
                    $("#mensaje").fadeIn();
                    console.log(mensaje);
                    $("#mensaje").text(mensaje);
                    $("#mensaje").css("border", "solid red 1px");
                }
                else {
                    //cualquier otra cosa no deberia mostrarse al usuario
                    $("#mensaje").text("");
                    $("mensaje").fadeout();
                }

                             
            },
            complete: function( ) {
                console.timeEnd("Peticion AJAX");
            },
            error: function(DATA) {                
                console.log("Error de conexion con los servicios PTYLOTTO " + DATA);
            }
            // }); 
        });
});

