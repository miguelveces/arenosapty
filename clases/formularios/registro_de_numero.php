<?php

/**
 * Esta clase Insertara Los datos del Usuario en la base de datos
 *
 * @author JJD
 */
//$insertar = new registrarNumero();
//$insertar->insertar();
$_SESSION['validacionTotal'] = 0;

class registro_de_numero {

    //costructor de la clase por si deseas inicailizar variables
    public function __construct() {
        require_once('clases/procesos/auditoria.php');
    }

    private $respuesta="";

    public function insertar($codigoTarjeta, $numero, $cantidadNumero) {
        
  $auditar = new auditoria();
        require_once('clases/conexion_bd/conexion.php');

        $conectar = new conexion();
        $con_res = $conectar->conectar();

        //$fecha_registro_numero;
        //$numero_user = strip_tags($_POST['nombre']); // esta quemado el numero en la pag

        $id_tarjeta_user = strip_tags($codigoTarjeta); //$_POST['cod_tarjeta']); // este hay que cambiarselo a dinamico 
        $fecha_actual = date("Y-m-d");
        $numero = strip_tags($numero); //$_POST['numero']);
        $cantidadDisponibles = strip_tags($cantidadNumero); //$_POST['cantidad']);

        if (strcmp($con_res, "ok") == 0) {
            //echo 'conexion exitosa';
            //valido la disponibilidad de los numeros con el query
            $query = @mysql_query("SELECT * FROM numeros_disponibles 
                    WHERE numero = '" . mysql_real_escape_string($numero) . "' 
                    AND cantidad_disponible >= '" . mysql_real_escape_string($cantidadDisponibles) . "'");
        // valido si existe en el query
            if (!$existe = @mysql_fetch_object($query)) {
                $auditar->insertar_auditoria($_SESSION['usuarios'], 
                            "Consulta", "numeros_disponibles", "El Numero: ' . $numero . ' no esta disponible.");
                $this->respuesta='El Numero: ' . $numero . ' no esta disponible.';
            } else {
                // aqui valido la fecha de cierre de compra

                $cierre = new registro_de_numero();
                $respuesta = $cierre->validar_cierre_compra();
//                 $cierre = validar_cierre_compra();
                echo $respuesta;

                if ($respuesta > 0) {
                    // metodos que obtienen el saldo de la tarjeta y la actualiza
                    $cobrar_numeros_ = new registro_de_numero();
                    $resp = $cobrar_numeros_->cobrar_numeros();

                    if ($resp == "ok") {
                        $restaNumDispo = new registro_de_numero();
                        $restaNumDispo->restar_cantidad_numeros_disponibles();
                        // $meter = @mysql_query('INSERT INTO usuarios (nombre,apellido,telefono,cedula,fecha_registro, correo_electronico, correo_electronico2, contrasenia) values ("' . mysql_real_escape_string($nombre) . '","' . mysql_real_escape_string($apellido) . '","' . mysql_real_escape_string($telefono) . '","' . mysql_real_escape_string($cedula) . '","' . mysql_real_escape_string($fecha_actual) . '", "' . mysql_real_escape_string($correo_electronico) . '", "' . mysql_real_escape_string($correo_electronico2) . '", "' . mysql_real_escape_string($contrasenia) . '")');
                        /* 1er query inserta numeros disponible */ $insertNum = @mysql_query('INSERT INTO numeros_por_usuario(id_fk_targeta,id_fk_numero,cantidad,fecha_registro,fecha_sorteo)
                                                   values ("' . mysql_real_escape_string($id_tarjeta_user) . '","' . mysql_real_escape_string($numero) . '","' . mysql_real_escape_string($cantidadDisponibles) . '","' . mysql_real_escape_string($fecha_actual) . '","' . mysql_real_escape_string($fecha_actual) . '")');
                  
                        echo $insertNum;

                        if ($insertNum) {
                            $auditar->insertar_auditoria($_SESSION['usuarios'], 
                            "Insert", "numeros_por_usuario", "OK, se ha registrado!");
                
                            require_once '../mensajeria/envia_correo.php';
                    $enviando = new envia_correo();
                    $enviando->enviar_Correo_confirmacion($_SESSION['usuarios'], "ha comprado el nuemero ".$numero." en PTYLOTTO");
                            $this->respuesta= 'OK, se ha registrado!';
                        } else {
                            $auditar->insertar_auditoria($_SESSION['usuarios'], 
                            "Insert", "numeros_por_usuario", "Hubo un error en el registro.");
                            $this->respuesta= 'Hubo un error en el registro.';
                        }
                    }
                } else {
                        $auditar->insertar_auditoria($_SESSION['usuarios'], 
                            "Insert", "numeros_por_usuario", "La hora de la venta ha sido cerrada");
                    $this->respuesta='La hora de la venta ha sido cerrada';
                }
            }
            //aqui desconecto la conexion de la BD
            $conectar->desconectar();
        } else {
            $auditar->insertar_auditoria($_SESSION['usuarios'], 
                            "Insert", "numeros_por_usuario", "Ocurrio un problema al intentar conectar a la base de datos");
            $this->respuesta= 'Ocurrio un problema al intentar conectar a la base de datos';
        }
    }

    function restar_cantidad_numeros_disponibles() {
        //require_once('../procesos/auditoria.php');
        $auditar2 = new auditoria();
        require_once('clases/conexion_bd/conexion.php');
        $conectado = new conexion();
        $con_res = $conectado->conectar();

        $this->numer = strip_tags($_POST['numero']);
        $this->cantidadDisponible = strip_tags($_POST['cantidad']);


        if (strcmp($con_res, "ok") == 0) {
            // echo 'Conexion exitosa todo bien ';

            $consultaNum_disponible = @mysql_query("SELECT  cantidad_disponible 
                FROM numeros_disponibles WHERE numero = '" . mysql_real_escape_string($this->numer) . "'");

            if ($row = mysql_fetch_array($consultaNum_disponible)) {
                $total = $row["cantidad_disponible"];
                //$consultaNumDis = @mysql_query($consultaNum_disponible);

                $cant_disp_total = $total - $this->cantidadDisponible;
                echo "consulta a la bd:'.$total.'";
                echo "<br>";
                echo "<br>";
                echo "total de la resta:'.$cant_disp_total.'";

                $restadeNumDisponible = @mysql_query("UPDATE numeros_disponibles 
                                                SET cantidad_disponible ='" . mysql_real_escape_string($cant_disp_total) . "' 
                                                WHERE numero = '" . mysql_real_escape_string($this->numer) . "'");

                $conectado->desconectar();
            }
        } else {
            $auditar2->insertar_auditoria($_SESSION['usuarios'], 
            "Insert", "numeros_por_usuario", "Ocurrio un problema al intentar conectar a la base de datos");
            
            echo 'Ocurrio un problema al intentar conectar a la base de datos';
        }
    }

    function cobrar_numeros() {
       // require_once('../procesos/auditoria.php');
        $auditar3 = new auditoria();
        require_once('clases/conexion_bd/conexion.php');

        $conectado = new conexion();
        $con_res = $conectado->conectar();

        $precio_numero = 0.25;

        $cantidad = strip_tags($_POST['cantidad']);
        // llamar la variable sesion valor investigar.
        $cod_tarjeta = strip_tags($_POST['cod_tarjeta']);
        $validacion_saldo = 0;
        echo $cod_tarjeta;

        $respuestaCobro = "";


        if (strcmp($con_res, "ok") == 0) {

            $montoTotalCompra = $precio_numero * $cantidad;
            echo "total a pagar:'.$montoTotalCompra.'";
            echo $cod_tarjeta;

            $obtiene_saldo = new registro_de_numero();
            $saldo_tarjeta = $obtiene_saldo->encuentra_saldo($cod_tarjeta);

            echo $saldo_tarjeta;

            if ($montoTotalCompra > $saldo_tarjeta) {
                 $auditar3->insertar_auditoria($_SESSION['usuarios'], 
                            "Consulta", "tarjetas_recibidas", "NO tiene suficiente saldo");
                echo "<div> <h2>NO tiene suficiente saldo</h2> </div>";
            } else {
                $respuestaCobro = "ok";
                $restar_saldo = new registro_de_numero();
                $totalSaldoRestado = $restar_saldo->Actualiza_saldo($cod_tarjeta, $montoTotalCompra, $saldo_tarjeta);

                echo $totalSaldoRestado;
            }
            $conectado->desconectar();
        } else {
            $auditar3->insertar_auditoria($_SESSION['usuarios'], 
                            "Conexion", "base de datos", "Ocurrio un problema al intentar conectar a la base de datos");
            echo 'Ocurrio un problema al intentar conectar a la base de datos';
        }

        return $respuestaCobro;
    }

    function validar_cierre_compra() {
        //require_once('../procesos/auditoria.php');
       $auditar4 = new auditoria();
        require_once('clases/conexion_bd/conexion.php');
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
                //           if ($row = mysql_fetch_array($queryCierredeCompra)) {
                // $valorRetornado = $row["id_restriccion"];
                echo "Valor retornado" . $valorRetornado;

                $valorRetornado = 0;
            } else {

                $valorRetornado = 1;
            }
            $conectado->desconectar();
                   $auditar4->insertar_auditoria($_SESSION['usuarios'], 
                            "Consulta", "restricciones_venta", "valor retornado= ".$valorRetornado);
            return $valorRetornado;
        } else {
            $auditar4->insertar_auditoria($_SESSION['usuarios'], 
             "Conexion", "base de datos", "Ocurrio un problema al intentar conectar a la base de datos");
            echo 'Ocurrio un problema al intentar conectar a la base de datos';
        }
    }

//-------------------------------
// Funcion obtiene Saldo
// -----------------------------------
    function encuentra_saldo($cod) {
        //require_once('../procesos/auditoria.php');
        $auditar5 = new auditoria();
        require_once('clases/conexion_bd/conexion.php');
        $this->usuario = $_SESSION['usuarios'];//'rtonunez@gmail.com';
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        $precio_numero = 0.25;
        $cantidad = strip_tags($_POST['cantidad']);


        if (strcmp($con_res, "ok") == 0) {
           // echo 'Conexion exitosa todo bien ';

            $montoTotalCompra = $precio_numero * $cantidad;
            echo "total a pagar:'.$montoTotalCompra.'";

            $var = "select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b
            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= " . $cod . " and a.registrada_sistema=TRUE";

            echo $var;

            $result = mysql_query($var);
            if ($row = mysql_fetch_array($result)) {
                $auditar5->insertar_auditoria($_SESSION['usuarios'], 
             "Consulta", "tarjetas_recibidas", "valor retornado ".$var);
           
                $retornasaldo = $row['saldo'];
            } else {
                 $auditar5->insertar_auditoria($_SESSION['usuarios'], 
             "Consulta", "tarjetas_recibidas", "No se encontro ningul valor");
                $retornasaldo = 0;
            }

            mysql_free_result($result);
            $conectado->desconectar();
            return $retornasaldo;
        } else {
             $auditar5->insertar_auditoria($_SESSION['usuarios'], 
             "Conexion", "base de datos", "Problemas de conexion");
            echo 'Algo anda mal';
        }
    }

//----------------------------------------------------
    //----Funcion agregada para que realice el descuento
    //---------------------------------------------------
    function Actualiza_saldo($cod2, $montoTot2, $saldoTarjeta2) {
       // require_once('../procesos/auditoria.php');
        $auditar6 = new auditoria();
        require_once('clases/conexion_bd/conexion.php');
        $this->usuario = $_SESSION["usuarios"];//'rtonunez@gmail.com';
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa todo bien ';
            //                                   1.25
            $saldo_reemplazar = $saldoTarjeta2 - $montoTot2;

            $varActualiza = " Update tarjetas_recibidas SET saldo=" . $saldo_reemplazar . " where codigo_targeta= " . $cod2 . " and registrada_sistema =TRUE";
            echo $varActualiza;
            $result = mysql_query($varActualiza);

            if ($existe = @mysql_fetch_object($result)) {
                 $auditar6->insertar_auditoria($_SESSION['usuarios'], 
             "Update", "tarjetas_recibidas", "Se actualizo la tabla con exito");
                $retornar = 'Listo';
            } else {
                 $auditar6->insertar_auditoria($_SESSION['usuarios'], 
             "Update", "tarjetas_recibidas", "Error al intentar actualizar el valor");
                $retornar = 'Error';
            }



            $conectado->desconectar();
            return $retornar;
        } else {
             $auditar6->insertar_auditoria($_SESSION['usuarios'], 
             "Conexion", "base de datos", "Problemas de conexion");
            echo 'Algo anda mal';
        }
    }

    function valida_saldo_disponible() {
     //   require_once('../procesos/auditoria.php');
$auditar7 = new auditoria();
        require_once('clases/conexion_bd/conexion.php');
        $valorRetornado;
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        if (strcmp($con_res, "ok") == 0) {
            echo 'Conexion exitosa todo bien ';


            $saldo = "select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b
            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= " . $cod . " and a.registrada_sistema=TRUE and saldo > " . $con_res . "";


            $queryCierredeCompra = @mysql_query("SELECT * FROM restricciones_venta 
                    WHERE hora_limite <= '" . mysql_real_escape_string($mySqlTime) . "'");


            if ($existe = @mysql_fetch_object($queryCierredeCompra)) {
                //           if ($row = mysql_fetch_array($queryCierredeCompra)) {
                // $valorRetornado = $row["id_restriccion"];
                echo "Valor retornado" . $valorRetornado;
            $auditar7->insertar_auditoria($_SESSION['usuarios'], 
             "Consulta", "restricciones_venta", "valor retornado ".$valorRetornado);
                $valorRetornado = 0;
            } else {
                $auditar7->insertar_auditoria($_SESSION['usuarios'], 
             "Consulta", "restricciones_venta", "valor retornado ".$valorRetornado);
                $valorRetornado = 1;
            }
            $conectado->desconectar();

            return $valorRetornado;
        } else {
            $auditar7->insertar_auditoria($_SESSION['usuarios'], 
             "Conexion", "Base de datos", "Ocurrio un problema al intentar conectar a la base de datos");
            echo 'Ocurrio un problema al intentar conectar a la base de datos';
        }
    }

    public function __get($propiedad) {
        if (isset($this->$propiedad)) {
            return $this->$propiedad;
        }
        return null;
    }

}
