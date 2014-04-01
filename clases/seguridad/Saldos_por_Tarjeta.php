<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Saldos_por_Tarjeta
 *
 * @author RNN80501
 */
class Saldos_por_Tarjeta {
    //put your code here
    
    // Encuentra el Saldo de la Tarjeta Introducida y lo retorna
    public function encuentra_saldo($codigo_tar){
        require_once('../conexion_bd/conexion.php');
        $this->usuario='rtonunez@gmail.com';
        $conectado = new conexion();
        $con_res = $conectado->conectar();
                if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa todo bien ';
           
            $var =  "select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b
            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta=".$codigo_tar . "and a.registrada_sistema=TRUE";
               
            $result = mysql_query( $var );
           if ($row = mysql_fetch_array($result)) {
                 $retornasaldo= $row['saldo'];
            } else {
                 $retornasaldo='';  
            }

            mysql_free_result($result);
            $conectado->desconectar();
            return $retornasaldo;
            
        } else {
            echo 'Algo anda mal';
        }             
    }

    //Actualiza el Saldo de esta TArjeta pasada por parametro
        public function Actualiza_saldo($codigo_tar,$montoTotalCompra,$saldoTarjeta){
        require_once('../conexion_bd/conexion.php');
        $this->usuario='rtonunez@gmail.com';
        $conectado = new conexion();
        $con_res = $conectado->conectar();
                if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa todo bien ';
             $saldo_reemplazar= $montoTotalCompra-$saldoTarjeta;
             
            $varActualiza =  " Update tarjetas_recibidas SET saldo=".$saldo_reemplazar." where codigo_targeta ".$codigo_tar ." registrada_sistema =TRUE";
               
            $result = mysql_query( $varActualiza );
           if ($row = mysql_fetch_array($result)) {
                 $retornar= 'Listo';
            } else {
                 $retornar='';  
            }

            mysql_free_result($result);
            $conectado->desconectar();
            return $retornar;
            
        } else {
            echo 'Algo anda mal';
        }             
    }
    
    

    
    
    
}
    


?>
