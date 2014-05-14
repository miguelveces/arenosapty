<?php
ob_start();
//$varBuscarr = new busca_tarjeta();
//$varBuscarr->extraer_cod_tarjeta();

class busca_fecha_soteo {
    private $usuario;
 
     function extraer_fecha() {
           require_once('clases/procesos/auditoria.php');
         $auditar = new auditoria();
        //Creamos sesión
                    //session_start();
        require_once('clases/conexion_bd/conexion.php');
        $this->usuario = $_SESSION['usuarios'];//'rtonunez@gmail.com';
        $conectado = new conexion();
        $con_res =$conectado->conectar();
       
      $valorRetornado="";
        if (strcmp($con_res, "ok") == 0) {
            //id_targeta_usuario
            echo 'Conexion exitosa todo bien ';
            $varTarjetas = "select DATE_FORMAT(fecha, '%Y-%m-%d') as 'fechas' from restricciones_venta order by fecha desc";
            $auditar->insertar_auditoria($_SESSION['usuarios'], 
                  "Consulta", "restricciones_sorteos", "Consultando de las fechas de sorteo");
            $result = mysql_query($varTarjetas);
            if ($result) { 
                 $variableCapitan=0;
                while ($row = mysql_fetch_row($result)) {
                    $variableCapitan = $variableCapitan +1;
                    if($variableCapitan == 1){
                       $valorRetornado= $row[0];
                    }
                   
                }
               
            }
        } else {
            $auditar->insertar_auditoria($_SESSION['usuarios'], 
                  "Conexion", "Base de datos", "Problemas de conexion");
        }

    mysql_free_result($result);
        $conectado->desconectar();
        return $valorRetornado;
        
        }

}
