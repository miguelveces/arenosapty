<?php

/**
 * Esta clase valida si el usuario existe en la base de datos
 *
 * @author Miguel Veces
 */
 //Se instancia la clase
 $mains = new valida_usuario();
 $mains->validar();
class valida_usuario_contrasenia {

    private $usuario; //$_POST["admin"];
    private $password; //$_POST["password_usuario"];



//costructor de la clase Se usa para inicializar variables

//    public function __construct() {
//        $this->usuario = $_POST["user"];
//        $this->password = $_POST["pass"];       
//    }

    public function validar() {
        $this->usuario = $_POST["user"];        
        require_once('../conexion_bd/conexion.php');        
        require_once('encriptar.php');
        $encripta = new encriptar();
        $pwd = $encripta->encriptar_dato($this->password, "ptylotodeveloper");
//para encriptar se hace asi : 
//se instancia la clase encriptar
        
        $conectado = new conexion();


        $con_res = $conectado->conectar();

        if (strcmp($con_res, "ok") == 0) {
            //echo 'Conexion exitosa todo bien';

            $result = mysql_query("SELECT * FROM usuarios WHERE correo_electronico = '" . $this->usuario . "'");
//Validamos si el nombre del administrador existe en la base de datos o es correcto
            if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
//                    $_SESSION['cedula'] = $row["cedula"];
//                    $_SESSION['nombre'] = $row["nombre"];
//                    echo $_SESSION['cedula'];
//                    echo  $_SESSION['nombre'];
                if ($row["correo_electronico"] != null) {
                    //Creamos sesión
                    session_start();
                    //Almacenamos el nombre de usuario en una variable de sesión usuario
                    require_once '../mensajeria/envia_correo.php';
                    $correo = new envia_correo();
                    $correo->enviar_Correo_confirmacion($row["correo_electronico"], "tu contraseña es miguel veces");
                } else {
                    //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
                    echo 'El Correo es incorrecto';

                    header("Location: ../../index.php");
                }
            } else {
                //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
                echo 'El usuario es Incorrecto';

                header("Location: ../../index.php");
            }

//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
            mysql_free_result($result);

            /* Mysql_close() se usa para cerrar la conexión a la Base de datos y es 
             * *necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
             * *programar una aplicación que tendrá muchas visitas ;) . */
            // mysql_close();
            $conectado->desconectar();
        } else {
            echo 'Algo anda mal';
        }
    }

}
