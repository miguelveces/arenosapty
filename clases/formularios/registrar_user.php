<?php
ob_start();
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

    //añadimos la funcion que se encargara de generar un numero aleatorio
    public function genera_random() {
        
        $valor = rand();
        
        require_once('../seguridad/encriptar.php');
        $encripta = new encriptar();
        $retorno = $encripta->encriptar_dato($valor, "ptylotodeveloper2014");
        
        return $retorno;
    }

    public function insertar() {
        session_start();
        //para grabar la auditori 
        require_once('../procesos/auditoria.php');
        $auditar = new auditoria();

        require_once('../conexion_bd/conexion.php');
        require_once('../seguridad/encriptar.php');
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
            //$contrasenia = strip_tags(sha1($_POST['contrasenia']));            
            $encripta = new encriptar();
            $contrasenia = $encripta->encriptar_dato($_POST['contrasenia'], "ptylotodeveloper");
            $fecha_actual = date("Y-m-d");
            $sinGuionCedula = str_replace("-", "", $cedula);

            $query = @mysql_query("SELECT * FROM usuarios 
                    WHERE correo_electronico = '" . mysql_real_escape_string($correo_electronico) . "' 
                        OR cedula = '" . mysql_real_escape_string($cedula) . "'");
            if ($existe = @mysql_fetch_object($query)) {

                $auditar->insertar_auditoria("desconocido", "Consulta", "usuarios", " La cedula o el correo ya existe.");
//                echo '<div align="center"> La cedula o el correo ya existe.  </div> <br> <br>';
//                 if ($existe = @mysql_fetch_object($queryC)) {
//                  echo '<div align="center"> La cedula: ' . $cedula . 'ya existe.</div> ';
//                  } 
                $_SESSION['mensaje'] = "La cedula o el correo ya existe";
                 $_SESSION['capitan'] = 2;
            } else {
                //agregamos la variable $activate que es un numero aleatorio de  
                  //20 digitos crado con la funcion genera_random de mas arriba
                   $random = new registrar_user();                   
                  $activate = $random->genera_random();
                  
                  $insert = 'INSERT INTO usuarios (nombre,apellido,telefono,cedula,fecha_registro, correo_electronico, correo_electronico2, contrasenia,activacion, estado)'
                        . ' values ("' . mysql_real_escape_string($nombre) . 
                        '","' . mysql_real_escape_string($apellido) . '","' .
                        mysql_real_escape_string($telefono) . '","' . mysql_real_escape_string($sinGuionCedula) . 
                        '",UTC_DATE(), "' . mysql_real_escape_string($correo_electronico) .
                        '", "' . mysql_real_escape_string($correo_electronico2) . '", "' . mysql_real_escape_string($contrasenia) . '", "'.$activate.'", 0)';
                
                  $meter = @mysql_query($insert);
                if ($meter) {
                    // echo '<script>alert("BIENVENIDO, se ha registrado!");window.location="/arenosapty-master/index.php"</script>';
                    $auditar->insertar_auditoria("desconocido", "Insert", "usuarios", " Se ha registrado correctamente.");
                    require_once '../seguridad/buscar_id_usuario.php';
                    $traerId = new buscar_id_usuario();
                    $id = $traerId->extraer_id($correo_electronico);
                    //$url="http://localhost:3515/ptydeveloper/seguridad/validar_usuario.php?id=".$id."&activateKey=".$activate;
                    $url="http://www.".$_SERVER['HTTP_HOST']."/demo/ptylotto/clases/seguridad/validar_usuario.php?id=".$id."&activateKey=".$activate;
                     $logo="http://".$_SERVER['HTTP_HOST']."/demo/ptylotto/img/logo.jpg";
                    $bkgHeader="http://".$_SERVER['HTTP_HOST']."/demo/ptylotto/img/bkg_1.jpg";
                    $bkgConten="http://".$_SERVER['HTTP_HOST']."/demo/ptylotto/img/bkg_2.jpg";
                    require_once '../mensajeria/envia_correo.php';
                    $enviando = new envia_correo();
                      $enviando->enviar_Correo_confirmacion($correo_electronico, 
                            '<table width="485" border="0" cellspasing="0" cellpadding="0">
                                <tr>
                                <td width="475" height="125"   background='.$bkgHeader.'><img src='.$logo.' style="padding-top: 15px" /></td>
                                </tr>
                                <tr>
                                <td background='.$bkgConten.' style="padding-left:15px;padding-right:15px;padding-top:15px; font-size:14px; font-family: arial;  color:#666666;"><p>Bienvenido/a '.$nombre.' '.$apellido. ',</p>
                                    <p>Gracias por registrate con PTY Lotto.</p>
                                    <p>En PTY Lotto nos preocupamos por tu seguridad y nos esmeramos por cuidar tu informacion. Para completar el registro, por favor confirmar tu direccion de correo electronico al hacer clic en este vinculo:</p>
                                    <p><a href="'.$url.'" target="_blank">'.$url.'</a>
                                    </p>
                                    <p>Cuando confirmas tu direccion de correo electronico, te asegura de ser solo tu quien recibe los correos electronicos que envia PTY Lotto, lo cual es importante para proteger la seguridad y confidencialidad de tu informacion.</p>
                                    <p>Si no se registro en PTY Lotto, por favor ignora este mensaje y te presentamos disculpas por cualquier molestia.</p>
                                  <p>Gracias por utilizar PTY Lotto</p>
                                </td>
                               </tr>
                            </table>');
                            $_SESSION['mensaje'] = "Se ha enviado un correo de validacion a la direccion de correo brindada";
                            $_SESSION['capitan'] = 1;
                    
                    header("Location: ../../login.php");
                    // echo '<script>alert("BIENVENIDO, se ha registrado!");window.location="/arenosapty-master/registrar_numero.php"</script>';
                } else {
                    $auditar->insertar_auditoria("desconocido", "Insert", "usuarios", "Hubo un error en el registro.");
                   
                     $_SESSION['mensaje'] = 'Hubo un error en el registro. '.$insert;
                     $_SESSION['capitan'] = 2;
//echo 'fecha'.$date.'';  
                }
            }
            mysql_free_result($query);
            $conectar->desconectar();
        } else {
            $auditar->insertar_auditoria("desconocido", "conexion", "Base de datos", " Ocurrio un problema al intentar conectar a la base de datos");
            echo 'Ocurrio un problema al intentar conectar a la base de datos';
            $_SESSION['mensaje'] = 'Hubo un error en el registro. '.$insert;
            $_SESSION['capitan'] = 2;
        }
    }

}