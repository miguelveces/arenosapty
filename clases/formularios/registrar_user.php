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
            //echo 'Conexion exitosa!';
            //Recibir
            $nombre = strip_tags($_POST['nombre']);
            $apellido = strip_tags($_POST['apellido']);
            $cedula = strip_tags($_POST['cedula']);
            $telefono = strip_tags($_POST['telefono']);
            $correo_electronico = strip_tags($_POST['correo_electronico']);
            $correo_electronico2 = strip_tags($_POST['correo_electronico2']);
            $contrasenia = strip_tags(sha1($_POST['contrasenia']));
            $fecha_actual = date("Y-m-d");

            /* $date = new DateTime();
              //echo $date->format('Y-m-d');
              echo $date->format('Y-m-d H:i:s'); */
          //  $date = DateTime('Y-m-d H:i:s');

           


          //  $query = @mysql_query('SELECT * FROM usuarios
                                 //  WHERE correo_electronico="' . mysql_real_escape_string($correo_electronico) .'"');
            
                //$queryC = @mysql_query('SELECT * FROM usuarios
                  //                 WHERE cedula="' . mysql_real_escape_string($cedula) .'"');
                
                $query = @mysql_query("SELECT * FROM usuarios 
                    WHERE correo_electronico = '".mysql_real_escape_string($correo_electronico)."' 
                        OR cedula = '".mysql_real_escape_string($cedula)."'");
            // $query = @mysql_query('SELECT * FROM usuarios WHERE correo_electronico="' . mysql_real_escape_string($correo_electronico) .'" AND cedula="' . mysql_real_escape_string($cedula) .'"');
             //$query = @mysql_query('SELECT * FROM usuarios WHERE correo_electronico="'. mysql_real_escape_string($correo_electronico).'" AND cedula="'. mysql_real_escape_string($cedula) .'"');
             
            /*$query = @mysql_query('SELECT * 
                 FROM usuarios 
                 WHERE correo_electronico=
                 "'.mysql_real_escape_string($correo_electronico).'"
                 " AND cedula=
                 "'.mysql_real_escape_string($cedula).'"');*/
            
            /*$consulta = sprintf("SELECT * FROM usuarios 
                                WHERE correo_electronico='%' AND cedula='%s'",
                                mysql_real_escape_string($correo_electronico),
                               mysql_real_escape_string($cedula));
            
            // Ejecutar la consulta
            $resultado = mysql_query($consulta);*/
            
            
             
            if ($existe = @mysql_fetch_object($query)) {
               // echo $query;
                echo '<div align="center"> El la cedula o el correo ya existe.  </div> <br> <br>';
                /* if ($existe = @mysql_fetch_object($queryC)) {
                echo '<div align="center"> La cedula: ' . $cedula . 'ya existe.</div> ';
            }*/
            } 
           else {
                $meter = @mysql_query('INSERT INTO usuarios (nombre,apellido,telefono,cedula,fecha_registro, correo_electronico, correo_electronico2, contrasenia) values ("' . mysql_real_escape_string($nombre) . '","' . mysql_real_escape_string($apellido) . '","' . mysql_real_escape_string($telefono) . '","' . mysql_real_escape_string($cedula) . '","' . mysql_real_escape_string($fecha_actual) . '", "' . mysql_real_escape_string($correo_electronico) . '", "' . mysql_real_escape_string($correo_electronico2) . '", "' . mysql_real_escape_string($contrasenia) . '")');
                if ($meter) {
                   // echo '<script>alert("BIENVENIDO, se ha registrado!");window.location="/arenosapty-master/index.php"</script>';
                     echo '<script>alert("BIENVENIDO, se ha registrado!");window.location="/arenosapty-master/registrar_numero.php"</script>';
                } else {
                    echo 'Hubo un error en el registro.';
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
