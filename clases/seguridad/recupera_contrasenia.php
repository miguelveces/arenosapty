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
      
        require_once('../procesos/auditar.php');
        $this->usuario = $_POST["email"];        
        require_once('../conexion_bd/conexion.php');                
        
        $conectado = new conexion();


        $con_res = $conectado->conectar();  
        if (strcmp($con_res, "ok") == 0) {
            //echo 'Conexion exitosa todo bien';
            $consulta = "SELECT * FROM usuarios WHERE correo_electronico = '" . $this->usuario . "' and estado = 1";
            echo $consulta;
            $result = mysql_query($consulta);
            //Validamos si el nombre del administrador existe en la base de datos o es correcto
            if ($row = mysql_fetch_array($result)) {
            //Si el usuario es correcto ahora validamos su contraseña
                //$pwd = $row["contrasenia"];
                 require_once('desencriptar.php');
                    $desencriptar = new desencriptar();
                    $pwd = $desencriptar->desencriptar_dato($row["contrasenia"], "ptylotodeveloper");
                 require_once '../mensajeria/envia_correo.php';
                    $enviando = new envia_correo();
                    $enviando->enviar_Correo_confirmacion($this->usuario, "Ha solicitado recuperar la contraseña de su cuenta PTYLOTO "
                            . " <br/> \n" . $pwd);       
                    //Creamos sesión
                    session_start();
                    //Almacenamos el nombre de usuario en una variable de sesión usuario
                    $_SESSION['usuarios'] = $this->usuario;
                    $_SESSION['cedula'] = $row["cedula"];
                    $_SESSION['nombre'] = $row["nombre"];
                    $_SESSION['id'] = $row["id_usuario"];
                   // echo "usuario " . $_SESSION['cedula'] . "<br/>";
                  //  echo  "usuario " . $_SESSION['nombre']. "<br/>";
                    
                    
                    
                    $auditar = new auditar();
                    $auditar->insertar_auditoria($this->usuario, 
                            "password", "usuarios", "se ha recuperado la contraseña");
                    echo 'La Contraseña es incorrecta ';
                    //Redireccionamos a la pagina: index.php
                    header("Location: ../../login.php");             
            } else {
                //en caso que el nombre de administrador es incorrecto enviamos un msj y redireccionamos a login.php
                echo 'El usuario no existe ';
                    $auditar = new auditar();
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
