<?php
ob_start();
//Autor: JJD


$cerrar = new cierre_de_compra();
$cerrar->cerrar_compra();

class cierre_de_compra {

    function cerrar_compra() {
        require_once('../conexion_bd/conexion.php');

  require_once('../procesos/auditoria.php');
         $auditar = new auditoria();
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa todo bien ';

            $mySqlTime = date('H:i:s');
           // $fecha_actual = date("Y-m-d");//'Y-m-d H:i:s'
//            $fecha_actual = date('Y-m-d H:i:s');
//           echo $fecha_actual;
//           echo"<br>";

            echo $mySqlTime;
           
            $queryCierredeCompra = @mysql_query("SELECT * FROM restricciones_venta 
                    WHERE hora_limite <= '" . mysql_real_escape_string($mySqlTime). "'");
            
            
                  if ($existe = @mysql_fetch_object($queryCierredeCompra)) {
               // echo $query;
                echo '<div align="center"> <h2>La hora de la venta ha sido cerrada</h2></div> <br> <br>';
                 $auditar->insertar_auditoria($_SESSION['usuarios'], 
                            "Consulta", "restricciones_venta", "La hora de la venta ha sido cerrada");     
                
                  }else{
                         '<div align="center"> <h2>Puede comprar</h2></div> <br> <br>';
                     }
        }
    }

}

?>
