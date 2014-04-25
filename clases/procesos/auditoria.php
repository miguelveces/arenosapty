<?php
ob_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auditoria
 *
 * @author miguel Veces
 */
//Se instancia la clase.

class auditoria {

    private $idUsuario, $ip;

    public function insertar_auditoria($usuario, $accion, $tabla, $comentario) {
        require_once('http://localhost:3515/ptydeveloper/clases/conexion_bd/conexion.php');
//conectar('localhost', 'root', '', 'ptyloto');
        $conectar = new conexion();
        $con_res = $conectar->conectar();

        if (strcmp($con_res, "ok") == 0) {
            try {
                //echo 'Conexion exitosa!';                     
                $query = "SELECT * FROM usuarios 
                    WHERE correo_electronico = '" . mysql_real_escape_string($usuario) . "'";
                //recorro el resultado optenido. 

                $result = mysql_query($query);
                if ($result) {
                    while ($row = mysql_fetch_row($result)) {
                        $this->idUsuario = $row["0"];
                    }
                    mysql_free_result($result);
                }
                else{
                    $this->idUsuario = 0;
                }
                 if (strcmp($usuario, "desconocido") == 0) {
                     $this->idUsuario = 11;
                 }
                require_once 'getIp.php';
                $traerIp = new getIp();
                $this->ip = $traerIp->getRealIP();  
                
                $insert = "INSERT INTO auditoria(id_fk_usuario, tipo_transaccion, tabla, ip, comentario, fecha_registro) "
                        . "VALUES ($this->idUsuario, '" . $accion . "', '" . $tabla . "', '" . $this->ip . "', '" . $comentario . "', sysdate())";
                $insertarAuditoria = @mysql_query($insert);
                if ($insertarAuditoria) {
                    // echo '<script>alert("BIENVENIDO, se ha registrado!");window.location="/arenosapty-master/index.php"</script>';
                    //echo 'Se inserto correctamente';
                    
                } else {
                    echo 'Hubo un error al intentar registrar en la tabla Auditorias '.$insert;
                }


                // mysql_free_result($query);
                $conectar->desconectar();
            } catch (Exception $e) {
                echo 'Ocurrio un problema al intentar conectar a la base de datos ' . $e;
            }
        } else {
            echo 'Ocurrio un problema al intentar conectar a la base de datos';
        }
    }

}?>