<?php

/**
 * Esta clase valida si el usuario existe en la base de datos
 *
 * @author Miguel Veces
 */
 //Se instancia la clase
 $mains = new valida_usuario();
 $mains->validar();
class valida_usuario {

    private $usuario; //$_POST["admin"];
    private $password; //$_POST["password_usuario"];



//costructor de la clase Se usa para inicializar variables

//    public function __construct() {
//        $this->usuario = $_POST["user"];
//        $this->password = $_POST["pass"];       
//    }

    public function validar() {
      
        
        $this->usuario = $_POST["user"];
        $this->password = $_POST["pass"];
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
            $consulta = "SELECT * FROM usuarios WHERE correo_electronico = '" . $this->usuario . "'";
            $result = mysql_query($consulta);
//Validamos si el nombre del administrador existe en la base de datos o es correcto
            if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
//                    $_SESSION['cedula'] = $row["cedula"];
//                    $_SESSION['nombre'] = $row["nombre"];
//                    echo $_SESSION['cedula'];
//                    echo  $_SESSION['nombre'];
                if ($row["contrasenia"] == $pwd) {
                    //Creamos sesión
                    session_start();
                    //Almacenamos el nombre de usuario en una variable de sesión usuario
                    $_SESSION['usuarios'] = $this->usuario;
                    $_SESSION['cedula'] = $row["cedula"];
                    $_SESSION['nombre'] = $row["nombre"];
                    $_SESSION['id'] = $row["id_usuario"];
                   // echo "usuario " . $_SESSION['cedula'] . "<br/>";
                  //  echo  "usuario " . $_SESSION['nombre']. "<br/>";
                    
                    //Redireccionamos a la pagina: index.php
                    header("Location: ../../index.php");
                } else {
                    //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
                    echo 'La Contraseña es incorrecta '.$pwd;

                   // header("Location: ../../login.php");
                }
            } else {
                //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
                echo 'El usuario es Incorrecto '.$consulta;

                //header("Location: ../../login.php");
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
