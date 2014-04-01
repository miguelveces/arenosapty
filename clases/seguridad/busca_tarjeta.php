<?php
//$varBuscarr = new busca_tarjeta();
//$varBuscarr->extraer_cod_tarjeta();

class busca_tarjeta {
    private $usuario;
 
     function extraer_cod_tarjeta() {
        
        require_once('clases/conexion_bd/conexion.php');
        $this->usuario = 'rtonunez@gmail.com';
        $conectado = new conexion();
        $con_res =$conectado->conectar();
       
      
        if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa todo bien ';
            $varTarjetas = "SELECT id_targeta_usuario,codigo_targeta FROM tarjetas_por_usuarios a, usuarios b
                            WHERE b.correo_electronico = '" . $this->usuario . "'
                             AND a.id_fk_usuario = b.id_usuario";
            echo $varTarjetas;
            $result = mysql_query($varTarjetas);
            if ($result) { 
                 $combobit = "";
                while ($row = mysql_fetch_row($result)) {
                    $combobit = " <option value='" . $row[0] . "'>" . $row[1] . "</option>";                    
                    echo $combobit; 
                }
               
            }
        } else {
            echo 'Algo anda mal';
        }

    mysql_free_result($result);
        $conectado->desconectar();
        
        
        }

}
