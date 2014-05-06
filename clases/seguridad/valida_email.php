<?php 
ob_start();
/**
 * Esta clase valida si el usuario existe en la base de datos
 *
 * @author Miguel Veces
 */
 //Se instancia la clase
$mains = new valida_email();
$mains->validar();
class valida_email {

    public function validar() {
         session_start();
        //$_SESSION['usuarios'] = $_POST["correo_electronico"];
        $_SESSION['usuario']=$_REQUEST['correo_electronico'];
          header("Location: ../../registro_usuario.php");

    }


}
