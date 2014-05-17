<?php ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pruebas encriptacion desencriptacion</title>
    </head>
    <body>
        <?php
require_once('clases/seguridad/encriptar.php');
       //para encriptar se hace asi : 
       //se instancia la clase encriptar
        $encripta = new encriptar();
        //se llama al metodo encriptar_dato y se le envian dos parametros
        //el primer parametro es lo que se desea encriptar osea la cadena
        //el segundo parametro es el key de encriptacion es una clave para 
        //poder desencriptar posteriormente
        //es importante muy importante no cambiar este key porque eso ocacionaria que no se puedan
        //desencriptar los datos despues.
        //yo are una clase que arme este key asi no lo dejaremos como un valor fijo
        $resultado_cadena = $encripta->encriptar_dato("12345", "ptylotodeveloper");
        //se muestra el resultado
        echo 'encriptada: '.$resultado_cadena;
        //para desencriptar se usa de la siguiente manera
        //se instancia la clase desencriptar
        require_once('clases/seguridad/desencriptar.php');
        $desencripta = new desencriptar();
        //se invoca el metodo desentriptar_dato y se le envian dos parametros
        //el primero es la cadena encriptada 
        // el segundo es el key de encriptacion debe ser exactamente el mismo que se uso para encriptarla
        $resultado_cadena_des = $desencripta->desencriptar_dato("o6Kn", "ptylotodeveloper");
       //el metodo devuelve la cadena desencriptada
        echo '<br>';
        echo 'desencriptada: '.$resultado_cadena_des;
        
        ?>
    </body>
</html>