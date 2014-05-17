<?php

ob_start();
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
    private $mensaje;
    //este valor es el que indicara al js que el mensaje es un mensaje de error o informacion (1= informacion; 2 = error)
    private $bandera;

//costructor de la clase Se usa para inicializar variables
//    public function __construct() {
//        $this->usuario = $_POST["user"];
//        $this->password = $_POST["pass"];       
//    }

    public function validar() {
          session_start();               
        
        require_once('../procesos/auditoria.php');
        $this->usuario = $_POST["user"];
        $this->password = $_POST["pass"];


        $validausuario = new valida_usuario();
        $respuesta = $validausuario->requerido($this->usuario);
        echo $respuesta;
        if ($respuesta == 1) {
            $_SESSION['mensaje'] = "Completa el campo correo electronico";
            $_SESSION['capitan'] = 1;
            header("Location: ../../login.php");
            exit();
        }
        require_once('../conexion_bd/conexion.php');
        require_once('encriptar.php');
        $encripta = new encriptar();
        $pwd = $encripta->encriptar_dato($this->password, "ptylotodeveloper");
//para encriptar se hace asi : 
//se instancia la clase encriptar

        $conectado = new conexion();


        $con_res = $conectado->conectar();
//echo $con_res;
        if (strcmp($con_res, "ok") == 0) {
            //echo 'Conexion exitosa todo bien';
            $consulta = "SELECT * FROM usuarios WHERE correo_electronico = '" . $this->usuario . "'";

//echo $consulta;
            $result = mysql_query($consulta);
//Validamos si el nombre del administrador existe en la base de datos o es correcto
            if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
                //Falta validar es estado del usuario
                if ($row["contrasenia"] == $pwd) {
                    //Creamos sesión
                   
                    //Almacenamos el nombre de usuario en una variable de sesión usuario
                    $_SESSION['usuarios'] = $this->usuario;
                    $_SESSION['cedula'] = $row["cedula"];
                    $_SESSION['nombre'] = $row["nombre"];
                    $_SESSION['apellido'] = $row["apellido"];
                    $_SESSION['id'] = $row["id_usuario"];
                    // echo "usuario " . $_SESSION['cedula'] . "<br/>";
                    //  echo  "usuario " . $_SESSION['nombre']. "<br/>";



                    $auditar = new auditoria();
                    $auditar->insertar_auditoria($this->usuario, "login", "usuarios", "Acaba de inciar sesion");
                    //echo 'lllllLa Contraseña es incorrecta ';
                    //Redireccionamos a la pagina: index.php
                    header("Location: ../../registrar_numero.php");
                } else {
                    //En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php
                    echo 'En caso que la contraseña sea incorrecta enviamos un msj y redireccionamos a login.php ';
                    //echo 'La Contraseña es incorrecta ';
                    $_SESSION['mensaje'] = "La Contraseña es incorrecta";
                    $_SESSION['capitan'] = 1;
                    $auditar = new auditoria();
                    $auditar->insertar_auditoria("desconocido", "login", "usuarios", "La Contraseña es incorrecta");
                    header("Location: ../../login.php");
                }
            } else {
                //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
                echo 'En caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php';
                //echo 'El usuario es Incorrecto ';
                $_SESSION['mensaje'] = "El usuario es Incorrecto";
                $_SESSION['capitan'] = 1;
                $auditar = new auditoria();
                $auditar->insertar_auditoria("desconocido", "login", "usuarios", "El usuario es Incorrecto");
                header("Location: ../../login.php");
            }

//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
            mysql_free_result($result);

            /* Mysql_close() se usa para cerrar la conexión a la Base de datos y es 
             * *necesario hacerlo para no sobrecargar al servidor, bueno en el caso de
             * *programar una aplicación que tendrá muchas visitas ;) . */
            // mysql_close();
            $conectado->desconectar();
        } else {
            //echo 'Algo anda mal';
            $_SESSION['mensaje'] = "Fallo la comexion a la base de datos";
            $_SESSION['capitan'] = 1;
            $auditar = new auditoria();
            $auditar->insertar_auditoria("desconocido", "login", "usuarios", "Fallo la comexion a la base de datos");
        }
    }

    function requerido($valor) {
        $valor = trim($valor);
        if (empty($valor)) {
            return true;
        } elseif (preg_match("/^(([A-Za-z0-9]+_+)|([A-Za-z0-9]+\-+)|([A-Za-z0-9]+\.+)|([A-Za-z0-9]+\++))*[A-Za-z0-9]+@((\w+\-+)|(\w+\.))*\w{1,63}\.[a-zA-Z]{2,6}$/", $valor)) {
            return false;
        } else {
            return true;
        }
    }

    public function __get($propiedad) {
        if (isset($this->$propiedad)) {
            return $this->$propiedad;
        }
        return null;
    }

}
