<?php

ob_start();
/**
 * Esta clase Insertara Los datos del Usuario en la base de datos
 *
 * @author JJD
 */
$mains = new registro_de_numero();
$mains->insertar();
$_SESSION['validacionTotal'] = 0;

class registro_de_numero {

    //costructor de la clase por si deseas inicailizar variables
    public function __construct() {
        require_once('../procesos/auditoria.php');
    }

    private $respuesta = "";

    //public function insertar($codigoTarjeta, $numero, $cantidadNumero) {
    public function insertar() {
        session_start();
        $auditar = new auditoria();
        require_once('../conexion_bd/conexion.php');

        $conectar = new conexion();
        $con_res = $conectar->conectar();

        $id_tarjeta_user = strip_tags($_POST['cod_tarjeta']);
        $numero = strip_tags($_POST['numero']);
       $cantidad_validado = $this->valida_saldo($_POST['cantidad']);
       if ($cantidad_validado == 1){
//           $_SESSION['mensaje'] = "TIENE SALDO DISPONIBLE";
//                $_SESSION['capitan'] = 1;
//                header("Location: ../../registrar_numero.php");
           
               if ($numero < 10) {
            $numero = "0" . $numero;
        }
        $cantidadDisponibles = strip_tags($_POST['cantidad']);
        if (strcmp($con_res, "ok") == 0) {
            //echo 'conexion exitosa';
            //valido la disponibilidad de los numeros con el query
            $query = @mysql_query("SELECT * FROM numeros_disponibles 
                    WHERE numero = '" . mysql_real_escape_string($numero) . "' 
                    AND cantidad_disponible >= '" . mysql_real_escape_string($cantidadDisponibles) . "'");
            // valido si existe en el query
            if (!$existe = @mysql_fetch_object($query)) {
                $auditar->insertar_auditoria($_SESSION['usuarios'], "Consulta", "numeros_disponibles", "El Numero:  $numero  no esta disponible.");
                $this->respuesta = 'El Numero: ' . $numero . ' no esta disponible.';
                $_SESSION['mensaje'] = $this->respuesta;
                $_SESSION['capitan'] = 2;
                header("Location: ../../registrar_numero.php");
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
                        $monto = 0.25 * $cantidadDisponibles;
                        /* 1er query inserta numeros disponible */
                        $insertNum = @mysql_query('INSERT INTO numeros_por_usuario(id_fk_targeta,id_fk_numero,cantidad,fecha_registro,fecha_sorteo)values ("' . mysql_real_escape_string($id_tarjeta_user) . '","' . mysql_real_escape_string($numero) . '","' . mysql_real_escape_string($cantidadDisponibles) . '",UTC_TIMESTAMP(),(SELECT fecha FROM restricciones_venta  WHERE estado=0))');

                        //echo $insertNum;

                        if ($insertNum) {
                            $auditar->insertar_auditoria($_SESSION['usuarios'], "Insert", "numeros_por_usuario", "OK, se ha registrado!");
                            $_SESSION['mensaje'] = "OK, se ha registrado!";
                            $_SESSION['capitan'] = 2;
                            $logo = "http://" . $_SERVER['HTTP_HOST'] . "/demo/ptylotto/img/logo.jpg";
                            $bkgHeader = "http://" . $_SERVER['HTTP_HOST'] . "/demo/ptylotto/img/bkg_1.jpg";
                            $bkgConten = "http://" . $_SERVER['HTTP_HOST'] . "/demo/ptylotto/img/bkg_2.jpg";
                            require_once '../mensajeria/envia_correo.php';
                            $enviando = new envia_correo();
                            //$enviando->enviar_Correo_confirmacion($_SESSION['usuarios'], "ha comprado el nuemero ".$numero." en PTYLOTTO");
                            $enviando->enviar_Correo_confirmacion($_SESSION['usuarios'], '<table width="400" border="0" cellspacing="0" cellpadding="0">
				<tr>
				<td width="400" height="125"   background=' . $bkgHeader . '><img src=' . $logo . ' style="padding-top: 15px" /></td>
				</tr>
				<tr>
				<td background=' . $bkgConten . ' style="padding-left:15px;padding-right:15px;padding-top:15px; font-size:14px; font-family: arial;  color:#666666;">
				<table width="400" border="0" cellspacing="0" align="center">
					  <tr>
					    <td height="20" width="260" rowspan="2" align="center" style="border: 1px solid #bfbfbf;">2014-05-09 12:23:23</td>
					    <td>&nbsp;</td>
					    <td height="20" width="101" align="center"  style="border-right: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;"  >TARJETA</td>
					  </tr>
					  <tr>
					    <td width="28" align="center">&nbsp;</td>
					    <td height="20" align="center" style="border-right: 1px solid #bfbfbf;border-bottom: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;">' . $id_tarjeta_user . '</td>
					  </tr>
					  <tr>
					    <td width="222">&nbsp;</td>
					    <td width="66" align="center">&nbsp;</td>
					    <td align="center">&nbsp;</td>
					  </tr>
					  <tr>
					    <td colspan="2" rowspan="8" align="center" style="font-size:150px; font-family:   Arial, Helvetica, sans-serif; font-weight:bold">' . $numero . '</td>
					    <td align="center" style="border-right: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;">CANTIDAD</td>
					  </tr>
					  <tr>
					    <td align="center" style="border-right: 1px solid #bfbfbf;border-bottom: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;">' . $cantidadDisponibles . '</td>
					  </tr>
					  <tr>
					    <td align="center">&nbsp;</td>
					  </tr>
					  <tr>
					    <td align="center" style="border-right: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;">PRECIO</td>
					  </tr>
					  <tr>
					    <td align="center" style="border-right: 1px solid #bfbfbf;border-bottom: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;">B/.0.25</td>
					  </tr>
					  <tr>
					    <td align="center">&nbsp;</td>
					  </tr>
					  <tr>
					    <td align="center" style="border-right: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;">MONTO</td>
					  </tr>
					  <tr>
					    <td align="center" style="border-right: 1px solid #bfbfbf;border-bottom: 1px solid #bfbfbf;border-left: 1px solid #bfbfbf;">B/.' . $monto . '</td>
					  </tr>
					  <tr>
					    <td colspan="3">&nbsp;</td>
					  </tr>
					  <tr>
					    <td colspan="3" align="center">SORTEO DE ORO TRES GOLPES EXTRAORDINARIA</td>
					  </tr>
					  <tr>
					    <td colspan="3" align="center">11 DE SEPTIEMBRE DE 2014</td>
					  </tr>
					  <tr>
					    <td colspan="3">&nbsp;</td>
					  </tr>
					</table>
					</td>
				</tr>
				</table>');
                            $this->respuesta = 'OK, se ha registrado!';
                            header("Location: ../../registrar_numero.php");
                        } else {
                            $auditar->insertar_auditoria($_SESSION['usuarios'], "Insert", "numeros_por_usuario", "Hubo un error en el registro.");
                            $this->respuesta = 'Hubo un error en el registro.';
                            $_SESSION['mensaje'] = $this->respuesta;
                            $_SESSION['capitan'] = 2;
                            header("Location: ../../registrar_numero.php");
                        }
                    }
                } else {
                    $auditar->insertar_auditoria($_SESSION['usuarios'], "Insert", "numeros_por_usuario", "La hora de la venta ha sido cerrada");
                    $this->respuesta = 'La hora de la venta ha sido cerrada';
                    $_SESSION['mensaje'] = $this->respuesta;
                    $_SESSION['capitan'] = 2;
                    header("Location: ../../registrar_numero.php");
                }
            }
            //aqui desconecto la conexion de la BD
            $conectar->desconectar();
        } else {
            $auditar->insertar_auditoria($_SESSION['usuarios'], "Insert", "numeros_por_usuario", "Ocurrio un problema al intentar conectar a la base de datos");
            $this->respuesta = 'Ocurrio un problema al intentar conectar a la base de datos';
            $_SESSION['mensaje'] = $this->respuesta;
            $_SESSION['capitan'] = 2;
            header("Location: ../../registrar_numero.php");
        }
           
           
       }
       else{
           $_SESSION['mensaje'] = "NO TIENE SALDO DISPONIBLE";
                $_SESSION['capitan'] = 2;
                header("Location: ../../registrar_numero.php");
       }
        
        

        
        
        
        
        
    }

    function restar_cantidad_numeros_disponibles() {
        //require_once('../procesos/auditoria.php');
        $auditar2 = new auditoria();
        require_once('../conexion_bd/conexion.php');
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
                //echo "consulta a la bd:'.$total.'";
                //echo "<br>";
                //echo "<br>";
                //echo "total de la resta:'.$cant_disp_total.'";

                $restadeNumDisponible = @mysql_query("UPDATE numeros_disponibles 
                                                SET cantidad_disponible ='" . mysql_real_escape_string($cant_disp_total) . "' 
                                                WHERE numero = '" . mysql_real_escape_string($this->numer) . "'");

                $conectado->desconectar();
            }
        } else {
            $auditar2->insertar_auditoria($_SESSION['usuarios'], "Insert", "numeros_por_usuario", "Ocurrio un problema al intentar conectar a la base de datos");
            $_SESSION['mensaje'] = 'Ocurrio un problema al intentar conectar a la base de datos';
            $_SESSION['capitan'] = 2;
//            echo 'Ocurrio un problema al intentar conectar a la base de datos';
        }
    }

    function cobrar_numeros() {
        // require_once('../procesos/auditoria.php');
        $auditar3 = new auditoria();
        require_once('../conexion_bd/conexion.php');

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
                $auditar3->insertar_auditoria($_SESSION['usuarios'], "Consulta", "tarjetas_recibidas", "NO tiene suficiente saldo");
                echo "<div> <h2>NO tiene suficiente saldo</h2> </div>";
            } else {
                $respuestaCobro = "ok";
                $restar_saldo = new registro_de_numero();
                $totalSaldoRestado = $restar_saldo->Actualiza_saldo($cod_tarjeta, $montoTotalCompra, $saldo_tarjeta);

                echo $totalSaldoRestado;
            }
            $conectado->desconectar();
        } else {
            $auditar3->insertar_auditoria($_SESSION['usuarios'], "Conexion", "base de datos", "Ocurrio un problema al intentar conectar a la base de datos");
            $_SESSION['mensaje'] = 'Ocurrio un problema al intentar conectar a la base de datos';
            $_SESSION['capitan'] = 2;
        }

        return $respuestaCobro;
    }

    function validar_cierre_compra() {
        //require_once('../procesos/auditoria.php');
        $auditar4 = new auditoria();
        require_once('../conexion_bd/conexion.php');
        $valorRetornado;
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        if (strcmp($con_res, "ok") == 0) {
            //echo 'Conexion exitosa todo bien ';
            //$queryCierredeCompra = @mysql_query("SELECT * FROM restricciones_venta  WHERE hora_limite <= ADDTIME(UTC_TIME(),'-5:00:00.00')");
            $queryCierredeCompra = @mysql_query("SELECT * FROM restricciones_venta  WHERE UTC_TIMESTAMP()<= fecha_sorteo and estado=0");

            if ($existe = @mysql_fetch_object($queryCierredeCompra)) {

                //echo "Valor retornado" . $valorRetornado;

                $valorRetornado = 1;
            } else {

                $valorRetornado = 0;
            }

            $conectado->desconectar();
            $auditar4->insertar_auditoria($_SESSION['usuarios'], "Consulta", "restricciones_venta", "valor retornado= " . $valorRetornado);
            return $valorRetornado;
        } else {
            $auditar4->insertar_auditoria($_SESSION['usuarios'], "Conexion", "base de datos", "Ocurrio un problema al intentar conectar a la base de datos");
            $_SESSION['mensaje'] = 'Ocurrio un problema al intentar conectar a la base de datos';
            $_SESSION['capitan'] = 2;
        }
    }

//-------------------------------
// Funcion obtiene Saldo
// -----------------------------------
    function encuentra_saldo($cod) {
        //require_once('../procesos/auditoria.php');
        $auditar5 = new auditoria();
        require_once('../conexion_bd/conexion.php');
        $this->usuario = $_SESSION['usuarios'];
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        $precio_numero = 0.25;
        $cantidad = strip_tags($_POST['cantidad']);


        if (strcmp($con_res, "ok") == 0) {
            // echo 'Conexion exitosa todo bien ';

            $montoTotalCompra = $precio_numero * $cantidad;
            // echo "total a pagar:'.$montoTotalCompra.'";

            $var = "select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b
            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= " . $cod . " and a.registrada_sistema=TRUE";

            //echo $var;

            $result = mysql_query($var);
            if ($row = mysql_fetch_array($result)) {
                $auditar5->insertar_auditoria($_SESSION['usuarios'], "Consulta", "tarjetas_recibidas", "valor retornado " . $var);

                $retornasaldo = $row['saldo'];
            } else {
                $auditar5->insertar_auditoria($_SESSION['usuarios'], "Consulta", "tarjetas_recibidas", "No se encontro ningun valor");
                $_SESSION['mensaje'] = 'No se encontro ningun valor';
                $_SESSION['capitan'] = 2;
                $retornasaldo = 0;
            }

            mysql_free_result($result);
            $conectado->desconectar();
            return $retornasaldo;
        } else {
            $auditar5->insertar_auditoria($_SESSION['usuarios'], "Conexion", "base de datos", "Problemas de conexion");
            $_SESSION['mensaje'] = 'Problemas de conexión';
            $_SESSION['capitan'] = 2;
        }
    }

//----------------------------------------------------
    //----Funcion agregada para que realice el descuento
    //---------------------------------------------------
    function Actualiza_saldo($cod2, $montoTot2, $saldoTarjeta2) {
        // require_once('../procesos/auditoria.php');
        $auditar6 = new auditoria();
        require_once('../conexion_bd/conexion.php');
        $this->usuario = $_SESSION["usuarios"];
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        if (strcmp($con_res, "ok") == 0) {
            // echo 'Conexion exitosa todo bien ';

            $saldo_reemplazar = $saldoTarjeta2 - $montoTot2;

            $varActualiza = " Update tarjetas_recibidas SET saldo=" . $saldo_reemplazar . " where codigo_targeta= " . $cod2 . " and registrada_sistema =TRUE";
            //echo $varActualiza;
            $result = mysql_query($varActualiza);

            if ($existe = @mysql_fetch_object($result)) {
                $auditar6->insertar_auditoria($_SESSION['usuarios'], "Update", "tarjetas_recibidas", "Se actualizo la tabla con exito");
                $retornar = 'Listo';
            } else {
                $auditar6->insertar_auditoria($_SESSION['usuarios'], "Update", "tarjetas_recibidas", "Error al intentar actualizar el valor");
                $retornar = 'Error';
            }



            $conectado->desconectar();
            return $retornar;
        } else {
            $auditar6->insertar_auditoria($_SESSION['usuarios'], "Conexion", "base de datos", "Problemas de conexion");
            echo 'Algo anda mal';
        }
    }

    function valida_saldo_disponible() {
        //   require_once('../procesos/auditoria.php');
        $auditar7 = new auditoria();
        require_once('../conexion_bd/conexion.php');
        $valorRetornado;
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        if (strcmp($con_res, "ok") == 0) {
            // echo 'Conexion exitosa todo bien ';


            $saldo = "select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b
            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= " . $cod . " and a.registrada_sistema=TRUE and saldo > " . $con_res . "";


            $queryCierredeCompra = @mysql_query("SELECT * FROM restricciones_venta 
                    WHERE hora_limite <= '" . mysql_real_escape_string($mySqlTime) . "'");


            if ($existe = @mysql_fetch_object($queryCierredeCompra)) {

                //echo "Valor retornado" . $valorRetornado;
                $auditar7->insertar_auditoria($_SESSION['usuarios'], "Consulta", "restricciones_venta", "valor retornado " . $valorRetornado);
                $valorRetornado = 0;
            } else {
                $auditar7->insertar_auditoria($_SESSION['usuarios'], "Consulta", "restricciones_venta", "valor retornado " . $valorRetornado);
                $valorRetornado = 1;
            }
            $conectado->desconectar();

            return $valorRetornado;
        } else {
            $auditar7->insertar_auditoria($_SESSION['usuarios'], "Conexion", "Base de datos", "Ocurrio un problema al intentar conectar a la base de datos");
            $_SESSION['mensaje'] = 'Problemas de conexión';
            $_SESSION['capitan'] = 2;
        }
    }

    public function __get($propiedad) {
        if (isset($this->$propiedad)) {
            return $this->$propiedad;
        }
        return null;
    }

    function valida_saldo($cantidad) {
        //   require_once('../procesos/auditoria.php');
        $auditar7 = new auditoria();
        require_once('../conexion_bd/conexion.php');
        $valorRetornado;
        $conectado = new conexion();
        $con_res = $conectado->conectar();
        $cantidad_total = $cantidad * 0.25;
        if (strcmp($con_res, "ok") == 0) {
            // echo 'Conexion exitosa todo bien ';
//            $saldo = "select a.saldo from   tarjetas_recibidas a, tarjetas_por_usuarios b
//            where b.codigo_targeta=a.codigo_targeta and a.codigo_targeta= " . $cod . " and a.registrada_sistema=TRUE and saldo > " . $con_res . "";
            $saldo = "select  count(*) from tarjetas_recibidas where codigo_targeta = ".$_POST['cod_tarjeta']." and saldo >= " .$cantidad_total;


            //echo $consulta;
            $result = mysql_query($saldo);
//Validamos si el nombre del administrador existe en la base de datos o es correcto
            if ($row = mysql_fetch_array($result)) {
//Si el usuario es correcto ahora validamos su contraseña
                //Falta validar es estado del usuario
                $numeroTarjetas = $row[0];
                if ($numeroTarjetas > 0) {
                    return 1;
                } else {
                    return 0;
                }

                $conectado->desconectar();
            } else {
                return 0;
            }
        } else {
            $auditar7->insertar_auditoria($_SESSION['usuarios'], "Conexion", "Base de datos", "Ocurrio un problema al intentar conectar a la base de datos");
            $_SESSION['mensaje'] = 'Problemas de conexión';
            $_SESSION['capitan'] = 2;
            return 0;
        }
    }

}
