<?php

/**
 * Esta clase Insertara Los datos del Usuario en la base de datos
 *
 * @author JJD
 */
$insertar = new registrarNumero();
$insertar->insertar();
//$cerrar = new registrarNumero();
//$cerrar->validar_cierre_compra();

class registrarNumero {

    //costructor de la clase por si deseas inicailizar variables
    public function __construct() {
        
    }

    public function insertar() {
        require_once('../conexion_bd/conexion.php');

        $conectar = new conexion();
        $con_res = $conectar->conectar();

        //$fecha_registro_numero;
        //$numero_user = strip_tags($_POST['nombre']); // esta quemado el numero en la pag

        $id_tarjeta_user = strip_tags($_POST['id_tarjeta']); // este hay que cambiarselo a dinamico 
        $fecha_actual = date("Y-m-d");
        $numero = strip_tags($_POST['numero']);
        $cantidadDisponibles = strip_tags($_POST['cantidad']);
//        
//        echo $id_tarjeta_user;
//        echo "<br>";
//        echo $numero;
//           echo "<br>";
//        echo$cantidadDisponibles;



        if (strcmp($con_res, "ok") == 0) {
            echo 'conexion exitosa';

            /* $queryNum_disponible = @mysql_query('SELECT * FROM numeros_disponibles
              WHERE numero="' . mysql_real_escape_string($numero) .'"');
              $queryCantidad_disponible = @mysql_query('SELECT * FROM numeros_disponibles
              WHERE numero="' . mysql_real_escape_string($cantidadDisponibles) .'"'); */

            //valido la disponibilidad de los numeros con el query
            $query = @mysql_query("SELECT * FROM numeros_disponibles 
                    WHERE numero = '" . mysql_real_escape_string($numero) . "' 
                    AND cantidad_disponible >= '" . mysql_real_escape_string($cantidadDisponibles) . "'");
//            echo "SELECT * FROM numeros_disponibles 
//                    WHERE numero = '" . mysql_real_escape_string($numero) . "' 
//                    AND cantidad_disponible >= '" . mysql_real_escape_string($cantidadDisponibles) . "'";
            // valido si existe en el query
            if (!$existe = @mysql_fetch_object($query)) {
                echo $query;
                echo '<div align="center"> El Numero: ' . $numero . ' no esta disponible.  </div> <br> <br>';
            } else {
                // aqui valido la fecha de cierre de compra
           
                $cierre = validar_cierre_compra();
                
                if ($cierre >0 ){
                    
                // $meter = @mysql_query('INSERT INTO usuarios (nombre,apellido,telefono,cedula,fecha_registro, correo_electronico, correo_electronico2, contrasenia) values ("' . mysql_real_escape_string($nombre) . '","' . mysql_real_escape_string($apellido) . '","' . mysql_real_escape_string($telefono) . '","' . mysql_real_escape_string($cedula) . '","' . mysql_real_escape_string($fecha_actual) . '", "' . mysql_real_escape_string($correo_electronico) . '", "' . mysql_real_escape_string($correo_electronico2) . '", "' . mysql_real_escape_string($contrasenia) . '")');
                $insertNum = @mysql_query('INSERT INTO numeros_por_usuario(id_fk_targeta,id_fk_numero,cantidad,fecha_registro,fecha_sorteo) values ("' . mysql_real_escape_string($id_tarjeta_user) . '","' . mysql_real_escape_string($numero) . '","' . mysql_real_escape_string($cantidadDisponibles) . '","' . mysql_real_escape_string($fecha_actual) . '","' . mysql_real_escape_string($fecha_actual) . '")');
                //echo  'INSERT INTO numeros_por_usuario(id_fk_targeta,id_fk_numero,cantidad,fecha_registro,fecha_sorteo) values ("' . mysql_real_escape_string($id_tarjeta_user) . '","' . mysql_real_escape_string($numero) . '","' . mysql_real_escape_string($cantidadDisponibles) . '","' . mysql_real_escape_string($fecha_actual) . '","' . mysql_real_escape_string($fecha_actual) . '")';
                echo $insertNum;
                if ($insertNum) {
                    echo '<script>alert("BIENVENIDO, se ha registrado!");window.location="/ptyloto/index.php"</script>';
                } else {
                    echo 'Hubo un error en el registro.';
//echo 'fecha'.$date.'';  
                }
                }
                else{
                    
                     echo '<div align="center"> <h2>La hora de la venta ha sido cerrada</h2></div> <br> <br>';
                }
                
                

            }
            //aqui desconecto la conexion de la BD
            $conectar->desconectar();
        }
    }

}

function validar_cierre_compra() {
    require_once('../conexion_bd/conexion.php');
    $valorRetornado;

    $conectado = new conexion();
    $con_res = $conectado->conectar();
    if (strcmp($con_res, "ok") == 0) {
        echo 'Conexion exitosa todo bien ';

        $mySqlTime = date('H:i:s');
        // $fecha_actual = date("Y-m-d");//'Y-m-d H:i:s'


        echo $mySqlTime;

        $queryCierredeCompra = @mysql_query("SELECT * FROM restricciones_venta 
                    WHERE hora_limite <= '" . mysql_real_escape_string($mySqlTime) . "'");


        if ($existe = @mysql_fetch_object($queryCierredeCompra)) {
            // echo $query;
           
            $valorRetornado = 0;
        } else {
            
            $valorRetornado = 1;
        }
        $conectado->desconectar();
        
        return $valorRetornado;
    }
}
?>
