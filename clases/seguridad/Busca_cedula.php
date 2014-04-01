<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Busca_cedula
 *
 * @author RNN80501

 if (!isset($_SESSION['usuarios'])) {
            header('Location: login.php');
            exit();
        }
         */
class Busca_cedula {
    //put your code here
    
    private $usuario;
    
    public function extraer() {
        require_once('../conexion_bd/conexion.php');
        $this->usuario='rtonunez@gmail.com';
        $conectado = new conexion();


        $con_res = $conectado->conectar();

        if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa todo bien ';
             $var =  "SELECT cedula FROM usuarios WHERE correo_electronico= '" . $this->usuario . "'";

//rtonunez@gmail.com
            $result = mysql_query( $var );
     
//Validamos si el nombre del administrador existe en la base de datos o es correcto
           if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
                 $retornacedula= $row['cedula'];
            } else {
                 $retornacedula='';  
            }

//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
            mysql_free_result($result);
            /* Mysql_close() se usa para cerrar la conexión a la Base de datos y es 
             * *necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
             * *programar una aplicación que tendrá muchas visitas ;) . */
            // mysql_close();
            $conectado->desconectar();
            return $retornacedula;
            
        } else {
            echo 'Algo anda mal';
        }
    }
}

?>
