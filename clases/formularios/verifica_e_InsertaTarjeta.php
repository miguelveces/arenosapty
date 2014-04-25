<?php
ob_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of verifica_e_InsertaTarjeta
 *
 * @author RNN80501
 
$consultaTar2 = new verifica_e_InsertaTarjeta();
$consultaTar2->valida_tarjetas_usuario();*/

class verifica_e_InsertaTarjeta {

    //put your code here
    private $codigoTar, $codverifi, $estado, $sellar, $registrada, $cedula, $id;
    private $mensaje="ESTO ES UNA PRUEBA";
    private $contador;
    public function valida_tarjetas_usuario($codigo,$verifica) {
        //session_start();
        

        //validamos si se ha hecho o no el inicio de sesion correctamente
        //si no se ha hecho la sesion nos regresará a login.php
        //esta instruccion debe ir al iniscio de cada pagina
        if (!isset($_SESSION['usuarios'])) {

            header('Location: login.php');
            exit();
        }

        require_once('clases/conexion_bd/conexion.php');
        //instaciamos la conexion
        $conectado = new conexion();
        $conrespuesta = $conectado->conectar();
        $this->codigoTar = $codigo;//strip_tags($_POST["tarjeta"]);
        $this->codverifi = $verifica;//strip_tags($_POST['codverifi']);
        
            //controlar los intentos con una tarjeta

        $this->fecha = date("Y-m-d");
        $this->id = $_SESSION['id'];;    //strip_tags($_POST['nombre']);  // Aqui debe ir el Id_ForeingKey del Nombre de usuario en este caso de ejmplo el 1 que toy usando pero ya debe venir de inicio de la sesion en el sistema               
        //$this->tarjeta   = strip_tags($_POST['tarjeta']); 
        $this->estado = 1;
        $this->sellar = 0;
        $this->registrada = TRUE;

        if (strcmp($conrespuesta, "ok") == 0) {
          //  require_once '../seguridad/Busca_cedula.php';
         //   $ced = new Busca_cedula();
            require_once('clases/procesos/auditoria.php');
            $auditar = new auditoria();
            $this->cedula = $_SESSION['cedula']; //Cambien la forma de obtener la cedula $ced->extraer();

            $var2 = "SELECT codigo_targeta,codigo_verificador,cedula, registrada_sistema  FROM tarjetas_recibidas Where codigo_targeta ='" . $this->codigoTar . "' and codigo_verificador ='" . $this->codverifi . "' and cedula ='" . $this->cedula . "'";
           // echo '<br>' . $var2;
            $total = mysql_num_rows(mysql_query($var2));
            
//            $result = mysql_query( $var2 );
//           if ($row = mysql_fetch_array($result)) {
//                 $retornasaldo= $row['saldo'];
//                 $retornasaldo= $row['saldo'];
//                 $retornasaldo= $row['saldo'];
//            } else {
//                 $retornasaldo='';  
//            }
            
            //Verificamos que el codigo exista en la tabla de tarjetas recibidas
            if ($total != 0) {
                // voy a permitir introducir sin verificar ...falta hacer la logica para hacer que 
                //Si existe verificamos si pertenece a la cedula que esta asociada para permitir introducirla.
                //ejecucion para insertar la Tarjeta
                // $a = 'INSERT INTO tarjetas_por_usuarios( codigo_targeta,codigo_verificador,id_fk_usuario,fecha_registro,Estado_tarjeta,Sellar_tarjeta) values ("' . mysql_real_escape_string($this->codigoTar) . '","' . mysql_real_escape_string($codverifi) . '","' . mysql_real_escape_string($nombre) . '","' . mysql_real_escape_string($fecha) . '", "' . mysql_real_escape_string($estado) . '", "' . mysql_real_escape_string($sellar) . '")';
                // echo $a;
                //Si esta Registrada en nuestro sistema verificar el campo registra_sistema si tiene valor de TRUE
                // mandar mensaje que diga Ya esta tarjeta fue Registrada.
                //--------------------------------------------------------------
                $result = mysql_query($var2);
                if ($row = mysql_fetch_array($result)) {
                    $estaRegistra = $row['registrada_sistema'];
                } else {
                    $estaRegistra = '';  //esta variable vendra vacia si no tiene ningun registro en Nuestro Sistema
                }
                if ($estaRegistra == TRUE) {
                     $auditar->insertar_auditoria($_SESSION['usuarios'], 
             "Insert", "tarjetas_por_usuario", "Esta Tarjeta ya ha sido Registrada en Nuestro Sistema");
                  $this->mensaje= "Esta Tarjeta ya ha sido Registrada en Nuestro Sistema" ;
 //echo '<script>alert("Esta Tarjeta ya ha sido Registrada en Nuestro Sistema")</script>';
                } else { // aqui entrara siempre y cuando esta Registrada y no se haya registrado aun osea FALSE
                    $intro = @mysql_query('INSERT INTO tarjetas_por_usuarios( codigo_targeta,codigo_verificador,id_fk_usuario,fecha_registro,Estado_tarjeta,Sellar_tarjeta) values ("' . mysql_real_escape_string($this->codigoTar) . '","' . mysql_real_escape_string($this->codverifi) . '","' . mysql_real_escape_string($this->id) . '","' . mysql_real_escape_string($this->fecha) . '", "' . mysql_real_escape_string($this->estado) . '", "' . mysql_real_escape_string($this->sellar) . '")');
                    
                   
                    //MAV valido si la se ralizo el inset correctamente para luego actualizar
                    if(($intro >=1)){
                       
                       $intro2 = @mysql_query('UPDATE tarjetas_recibidas set registrada_sistema =TRUE '
                               . 'where codigo_targeta= ' . mysql_real_escape_string($this->codigoTar) . '');
                       $auditar->insertar_auditoria($_SESSION['usuarios'], 
                       "Insert", "registrada_sistema", "Se actualiza el estado de la tarjeta en tarjetas recibidas");
                       $auditar->insertar_auditoria($_SESSION['usuarios'], 
                       "Insert", "tarjetas_por_usuario", "Tarjeta Registrada Correctamente");
                       require_once '../mensajeria/envia_correo.php';
                    $enviando = new envia_correo();
                    $enviando->enviar_Correo_confirmacion($_SESSION['usuarios'], "Se ha registrado una nueva tarjeta  en PTYLOTO ".$this->codigoTar);
                       $this->mensaje="Tarjeta Registrada Correctamente ";  
                    }
                   else {
                       $auditar->insertar_auditoria($_SESSION['usuarios'], 
                        "Insert", "tarjetas_por_usuario", "Ocurrio un problema con  el insert en la base de datos");
                       
                        $this->mensaje="Ocurrio un problema con  el insert en la base de datos  ";  
                   }
                   // echo '<script>alert("Tarjeta Registrada Correctamente")</script>';
                }
            } else {
                //Si el codigo No existe manda mensaje Alert diciendo que este numero no esta en la base de datos.
                  $auditar->insertar_auditoria($_SESSION['usuarios'], 
                        "Insert", "tarjetas_por_usuario", "No Existe esta Tarjeta en nuestros Registros ...");
                       
                $this->mensaje="No Existe esta Tarjeta en nuestros Registros ...";
             //  $__SESSION['capitan']=$__SESSION['capitan']+$this->contador;
             

              // echo '<script>alert("No Existe esta Tarjeta en nuestros Registros ...")</script>';
//                header("Location: ../../Registro_Tarjeta.php");
            }
        } else {
            //
            $auditar->insertar_auditoria($_SESSION['usuarios'], 
            "Conexion", "Base de datos", "No hay Conexion a la Base de Datos");
                       
           $this->mensaje="No hay Conexion a la Base de Datos";
           // echo '<script>alert("No hay Conexion a la Base de Datos")</script>';
        }
        //mysql_free_result($total);
        $conectado->desconectar();
        
    }

    public function __get($propiedad){
        if (isset($this->$propiedad)){
            return $this->$propiedad;
        }
        return null;
    }
}


