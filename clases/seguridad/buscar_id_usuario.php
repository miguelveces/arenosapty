<?php
ob_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of buscar_id_usuario
 *
 * @author miguel
 */
class buscar_id_usuario {

    private $usuario;

    public function extraer_id($usuario) {
        require_once('../procesos/auditoria.php');
        $auditar = new auditoria();
        require_once('../conexion_bd/conexion.php');
        $this->usuario = $usuario;
        $conectado = new conexion();


        $con_res = $conectado->conectar();

        if (strcmp($con_res, "ok") == 0) {
            //echo 'Conexion exitosa todo bien ';
            $var = "SELECT id_usuario FROM usuarios WHERE correo_electronico= '" . $this->usuario . "'";

//rtonunez@gmail.com
            $result = mysql_query($var);

//Validamos si el nombre del administrador existe en la base de datos o es correcto
            if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
                $auditar->insertar_auditoria("desconocido", "login", "usuarios", "Validando si el usuario esta ok");
                $retornacedula = $row['id_usuario'];
            } else {
                $retornacedula = '';
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
            $auditar->insertar_auditoria("desconocido", "Conexion", "base de datos", "Prblemas de conexion");
        }
    }

}
