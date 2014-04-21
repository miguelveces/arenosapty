<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of verifica_e_InsertaTarjeta
 *
 * @author JJD
 */
$consultaTar2 = new lista_tarjetas_de_usuarios();
$consultaTar2->valida_tarjetas_usuario();

class lista_tarjetas_de_usuarios {

    //put your code here
    private $cod_tarjeta="veces";

    public function valida_tarjetas_usuario() {
        require_once('../conexion_bd/conexion.php');
        //instaciamos la conexion
        $conectado = new conexion();
        $conrespuesta = $conectado->conectar();

        
        if (strcmp($conrespuesta, "ok") == 0) {
            require_once '../seguridad/Busca_cedula.php';
            $cod = new busca_tarjeta();            
            $this->cod_tarjeta= $cod->extraer_cod_tarjeta();
           /*$var2= "SELECT codigo_targeta FROM tarjetas_por_usuarios Where cedula ='" . $this->cedula ."'";
            $total = mysql_num_rows(mysql_query($var2));
           */
               
     //Verificamos que el codigo exista en la tabla de tarjetas recibidas
            if ($total != 0) {
                               // voy a permitir introducir sin verificar ...falta hacer la logica para hacer que 
                //Si existe verificamos si pertenece a la cedula que esta asociada para permitir introducirla.

                //ejecucion para insertar la Tarjeta
               // $a = 'INSERT INTO tarjetas_por_usuarios( codigo_targeta,codigo_verificador,id_fk_usuario,fecha_registro,Estado_tarjeta,Sellar_tarjeta) values ("' . mysql_real_escape_string($this->codigoTar) . '","' . mysql_real_escape_string($codverifi) . '","' . mysql_real_escape_string($nombre) . '","' . mysql_real_escape_string($fecha) . '", "' . mysql_real_escape_string($estado) . '", "' . mysql_real_escape_string($sellar) . '")';
               // echo $a;
                $intro = @mysql_query('INSERT INTO tarjetas_por_usuarios( codigo_targeta,codigo_verificador,id_fk_usuario,fecha_registro,Estado_tarjeta,Sellar_tarjeta) values ("' . mysql_real_escape_string($this->codigoTar) . '","' . mysql_real_escape_string($this->codverifi) . '","' . mysql_real_escape_string($this->nombre) . '","' . mysql_real_escape_string($this->fecha) . '", "' . mysql_real_escape_string($this->estado) . '", "' . mysql_real_escape_string($this->sellar) . '")');
                $intro2 = @mysql_query('UPDATE tarjetas_recibidas set registrada_sistema =TRUE where codigo_targeta= ' . mysql_real_escape_string($this->codigoTar) . '');
                 
                echo '<script>alert("Tarjeta Registrada Correctamente")</script>';

            } else {
                
               //Si el codigo No existe manda mensaje Alert diciendo que este numero no esta en la base de datos.
                 echo '<script>alert("No Existe esta Tarjeta en nuestros Registros...")</script>';
         
//                header("Location: ../../Registro_Tarjeta.php");
            }
        } else {
            //
            echo '<script>alert("No hay Conexion a la Base de Datos")</script>';
        }
        //mysql_free_result($total);
        $conectado->desconectar();
    }

   
    
    
}

?>
