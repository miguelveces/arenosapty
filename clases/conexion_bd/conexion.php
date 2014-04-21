<?php

/**
 * Esta clase sera utilizada para centralizar las conexiones a base de datos
 *
 * @author Miguel Veces
 */
class conexion {

//    private $db_host = "localhost";
//    private $db_usuario = "root";
//    private $db_password = "";
//    private $db_nombre = "ptyloto";
//    private $conexion;

    public function conectar() {
     $db_host = "localhost";
     $db_usuario = "root";
     $db_password = "";
     $db_nombre = "ptyloto";

        $link = mysql_connect($db_host, $db_usuario, $db_password);
        if (!$link) {
            //die('Error al conectarse a mysql: ' . mysql_error());
            $resultado = 'Error al conectarse a mysql: ' . mysql_error();
        }

// Seleccionar nuestra base de datos
        $db_selected = mysql_select_db($db_nombre, $link);
        if (!$db_selected) {
            //die('Error al abrir la base de datos: ' . mysql_error());
            $resultado = 'Error al abrir la base de datos: ' . mysql_error();
        } else {
            $resultado = 'ok';
        }
        return $resultado;
    }
    public function desconectar() {
        @mysql_close($conexion);
    }

}
