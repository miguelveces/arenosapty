<?php
//$varBuscarr = new busca_tarjeta();
//$varBuscarr->extraer_cod_tarjeta();

class busca_tarjeta {
    private $usuario;
 
     function extraer_cod_tarjeta() {
           require_once('../procesos/auditoria.php');
         $auditar = new auditoria();
        //Creamos sesión
                    session_start();
        require_once('clases/conexion_bd/conexion.php');
        $this->usuario = $_SESSION['usuarios'];//'rtonunez@gmail.com';
        $conectado = new conexion();
        $con_res =$conectado->conectar();
       
      
        if (strcmp($con_res, "ok") == 0) {
            //id_targeta_usuario
            echo 'Conexion exitosa todo bien ';
            $varTarjetas = "SELECT codigo_targeta,codigo_targeta  FROM tarjetas_por_usuarios a, usuarios b
                            WHERE b.correo_electronico = '" . $this->usuario . "'
                             AND a.id_fk_usuario = b.id_usuario";
            $auditar->insertar_auditoria($_SESSION['usuarios'], 
                  "Consulta", "tarjetas_por_usuarios", "Consultando las tarjetas por usuario");
            $result = mysql_query($varTarjetas);
            if ($result) { 
                 $combobit = "";
                while ($row = mysql_fetch_row($result)) {
                    $combobit = " <option value='" . $row[0] . "'>" . $row[1] . "</option>";                    
                    echo $combobit; 
                }
               
            }
        } else {
            $auditar->insertar_auditoria($_SESSION['usuarios'], 
                  "Conexion", "Base de datos", "Problemas de conexion");
        }

    mysql_free_result($result);
        $conectado->desconectar();
        
        
        }

}
