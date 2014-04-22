<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of validar_usuario
 * Se utiliza para validar el usuario
 * @author miguel
 */
require_once '../conexion_bd/conexion.php';
$conexion = new conexion();
$con_res = $conexion->conectar();
if (strcmp($con_res, "ok") == 0) {
    if (isset($_GET['id'])) {

        $idval = $_GET['id'];
        $activate2 = $_GET['activateKey'];        
        //y aqui es donde cambiamos el valor 1=desactivado  por valor 0=activado
        $query = "UPDATE usuarios
           SET estado = '1' WHERE   id_usuario = '$idval' AND activacion ='$activate2' ";
        echo "UPDATE usuarios
           SET estado = '1' WHERE   id_usuario = '$idval' AND activacion ='$activate2' ";
        mysql_query($query) or die(mysql_error());
}else{
echo "activacion incompleta.";         
}
}
