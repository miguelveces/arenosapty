<?php
ob_start();
/**
 * Esta clase valida si el usuario existe en la base de datos y enviar un correo
 *
 * @author Miguel Veces
 */
 //Se instancia la clase
$mains = new recupera_conrasenia();
$mains->recupera();
class recupera_conrasenia {

    private $usuario; //$_POST["admin"];
   
    public function recupera() {
      
        require_once('../procesos/auditoria.php');
        $this->usuario = $_POST["correo_electronico"];        
        require_once('../conexion_bd/conexion.php');                
        
        $conectado = new conexion();


        $con_res = $conectado->conectar();  
        if (strcmp($con_res, "ok") == 0) {
            //echo 'Conexion exitosa todo bien';
            $consulta = "SELECT * FROM usuarios WHERE correo_electronico = '" . $this->usuario . "'";
            //$consulta = "SELECT * FROM usuarios WHERE correo_electronico = '" . $this->usuario . "' and estado = 0";
            //echo $consulta;
            $result = mysql_query($consulta);
            //Validamos si el nombre del administrador existe en la base de datos o es correcto
            if ($row = mysql_fetch_array($result)) {
            //Si el usuario es correcto ahora validamos su contraseña
                //$pwd = $row["contrasenia"];
                 require_once('desencriptar.php');
                    $desencriptar = new desencriptar();
                    $pwd = $desencriptar->desencriptar_dato($row["contrasenia"], "ptylotodeveloper");
                    $nombre= $row["nombre"];
                    $apellido= $row["apellido"];
                    $correo= $row["correo_electronico"];
                    $url="http://www.".$_SERVER['HTTP_HOST']."/demo/ptylotto/clases/seguridad/validar_usuario.php?id=".$id."&activateKey=".$activate;
                    $logo="http://".$_SERVER['HTTP_HOST']."/demo/ptylotto/img/logo.jpg";
                    $bkgHeader="http://".$_SERVER['HTTP_HOST']."/demo/ptylotto/img/bkg_1.jpg";
                    $bkgConten="http://".$_SERVER['HTTP_HOST']."/demo/ptylotto/img/bkg_2.jpg";
                 require_once '../mensajeria/envia_correo.php';
                    $enviando = new envia_correo();
                     $enviando->enviar_Correo_contrasenia($this->usuario,
                     '<table width="485" border="0" cellspasing="0" cellpadding="0">
                                <tr>
                                <td width="475" height="125"   background='.$bkgHeader.'><img src='.$logo.' style="padding-top: 15px" /></td>
                                </tr>
                                <tr>
                                <td background='.$bkgConten.' style="padding-left:15px;padding-right:15px;padding-top:15px; font-size:14px; font-family: arial;  color:#666666;"><p>Estimado(a)  '.$nombre.' '.$apellido. ',</p>
                                   <p>Recuerda tus credenciales</p>
        			  <div><label>Correo electronico</label></div>
        			 <div><input type="text" name="user" id="user" value="'.$correo.'" readonly="readonly" style="border-right: 1px solid #e6e6e6; border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px;height: 25px;background-color:#e6e6e6;" /></div>
        			<div><label>Contrase&ntilde;a:</label></div>
        			<div><input type="text" name="pass" value="'.$pwd.'" readonly="readonly" style="border-right: 1px solid #e6e6e6; border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px;height: 25px;background-color:#e6e6e6;"/> </div>
        				<p>&nbsp;</p>
                                  <p>Gracias por utilizar PTY Lotto.</p>
                                </td>
                               </tr>
                            </table>');         
                    //Creamos sesión
                    session_start();
                    //Almacenamos el nombre de usuario en una variable de sesión usuario
                    $_SESSION['usuarios'] = $this->usuario;
                    $_SESSION['cedula'] = $row["cedula"];
                    $_SESSION['nombre'] = $row["nombre"];
                    $_SESSION['id'] = $row["id_usuario"];
                   // echo "usuario " . $_SESSION['cedula'] . "<br/>";
                  //  echo  "usuario " . $_SESSION['nombre']. "<br/>";
                    
                    
                    
                    $auditar = new auditoria();
                    $auditar->insertar_auditoria($this->usuario, 
                            "password", "usuarios", "se ha recuperado la contraseña");
                    echo 'La Contraseña es incorrecta ';
                    //Redireccionamos a la pagina: index.php
                    header("Location: ../../login.php");             
            } else {
                //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
                echo 'El usuario no existe ';
                    $auditar = new auditoria();
                    $auditar->insertar_auditoria("desconocido", 
                            "login", "usuarios", "El usuario no existe");
                //header("Location: ../../login.php");
            }

//Mysql_free_result() se usa para liberar la memoria empleada al realizar una consulta
            mysql_free_result($result);
         
            $conectado->desconectar();
        } else {
            echo 'Algo anda mal';
            $auditar = new auditoria();
                    $auditar->insertar_auditoria("desconocido", 
                            "login", "usuarios", "Fallo la comexion a la base de datos");
        }
    }

}