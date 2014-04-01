<?php

/**
 * Esta clase Insertara Los datos del Usuario en la base de datos
 *
 * @author JJD
 */
//Se instancia la clase.
$insertar = new registrar_user;
$insertar->insertar();

class registrar_user {

//costructor de la clase por si deseas inicailizar variables
    public function __construct() {
        
    }

    public function insertar() {
        require_once('../conexion_bd/conexion.php');
//conectar('localhost', 'root', '', 'ptyloto');
        $conectar = new conexion();
        $con_res = $conectar->conectar();

        if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa!';
            //Recibir
            $nombre = strip_tags($_POST['nombre']);
            $apellido = strip_tags($_POST['apellido']);
            $cedula = strip_tags($_POST['cedula']);
            $telefono = strip_tags($_POST['telefono']);
            $correo_electronico = strip_tags($_POST['correo_electronico']);
            $correo_electronico2 = strip_tags($_POST['correo_electronico2']);
            $contrasenia = strip_tags(sha1($_POST['contrasenia']));


            /* $date = new DateTime();
              //echo $date->format('Y-m-d');
              echo $date->format('Y-m-d H:i:s'); */
            $date = date('Y-m-d H:i:s');

            $fecha_actual = date("Y-m-d");


            $query = @mysql_query('SELECT * FROM usuarios WHERE correo_electronico="' . mysql_real_escape_string($correo_electronico) . '"');

            if ($existe = @mysql_fetch_object($query)) {
                echo 'El usuario ' . $correo_electronico . ' ya existe.';
            } else {
                $meter = @mysql_query('INSERT INTO usuarios (nombre,apellido,telefono,cedula,fecha_registro, correo_electronico, correo_electronico2, contrasenia) values ("' .
                                mysql_real_escape_string($nombre) . '","' . mysql_real_escape_string($apellido) .
                                '","' . mysql_real_escape_string($telefono) . '","' . mysql_real_escape_string($fecha_actual) .
                                '","' . mysql_real_escape_string($date) . '", "' . mysql_real_escape_string($correo_electronico) .
                                '", "' . mysql_real_escape_string($correo_electronico2) . '", "' . mysql_real_escape_string($contrasenia) . '")');
                if ($meter) {
                    echo '<script>alert("BIENVENIDO, se ha registrado!");window.location="../../index.php"</script>';
                } else {
                    echo '<script>alert("Error al insertar!");window.location="../../registro_usuario.php"</script>';
//echo 'fecha'.$date.'';  
                }
            }
            mysql_free_result($query);
            $conectar->desconectar();
        } else {
            echo 'Ocurrio un problema al intentar conectar a la base de datos';
        }
    }

}
