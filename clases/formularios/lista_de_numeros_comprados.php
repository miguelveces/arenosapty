<?php
ob_start();
/**
 * 
 *
 * 
 */
//$prueba = new consultandoNumeros();
//$prueba->muestra_tarjetas_usuario();
class lista_de_numeros_comprados {

//Hacer funcion para validar que la tarjeta existe en el listado enviado
// si existe Verificar si el campo fueregistrada es igual a false entonces permitir registrarla
// de lo contrario manda mensaje esta tarjeta ya fue registrada.


//funcion para buscar Tarjetas en Tabla de recibidas
    
    public function muestra_numeros_usuario() {
        
        require_once('clases/conexion_bd/conexion.php');
        //instaciamos la conexion
        $conectado = new conexion();
        $conrespuesta = $conectado->conectar();
	
	
           if (strcmp($conrespuesta, "ok") == 0) {
            echo '<table border="0" style=" margin-right:auto;margin-left:auto; width:90%; text-align: center"cellpadding="0" cellspacing="0">';
            echo '<thead>';
                echo '<tr style=" font-size:12px; font-family: arial; font-weight: bold; color:#666666;height: 25px;background-color:#e6e6e6">';
                    echo '<th style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">Usuario</th>';
                    echo '<th style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">Tarjeta</th>';
                    echo '<th style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">Numero</th>';
                    echo '<th style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">Cantidad</th>';
                    echo '<th style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">Total Pagado</th>';
                    echo '<th style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">Fecha de registro</th>';
                echo '</tr>';
            echo '</thead>';
            echo '<tbody>'; 
            $consultas = "select b.correo_electronico, a.id_fk_targeta, a.id_fk_numero, a.cantidad, a.fecha_registro from numeros_por_usuario a, usuarios b, tarjetas_por_usuarios c"
                            . " where a.id_fk_targeta = c.codigo_targeta and b.id_usuario = c.id_fk_usuario and a.fecha_sorteo = (select DATE_FORMAT(fecha, '%Y-%m-%d') from restricciones_venta order by fecha desc LIMIT 1)";
  		    $query = @mysql_query($consultas);
                    //echo $consultas;
		   
                   while ($registro = mysql_fetch_array($query)){
         	   echo '<tr style=" font-size:12px; font-family: arial; font-weight: bold; color:#666666;height: 25px;background-color:#e6e6e6">';
                       echo '<td style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">'.$registro['0'].'</td>';
		       echo '<td style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">'.$registro['1'].'</td>';
		       echo '<td style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">'.$registro['2'].'</td>';
                       echo '<td style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">'.$registro['3'].'</td>';
                       $totalAPagar = $registro['2'] * $registro['3'] * 0.25;
                       echo '<td style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">'.$totalAPagar.'</td>';
		       echo '<td style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6">'.$registro['4'].'</td>';
		       echo '</tr > ';
		        }  	// fin del while
                 echo ' </tbody>';
                 echo ' </table>'; 
               echo "</div>";

           } else {
                //
				echo '<script>alert("No hay Conexion a la Base de Datos")</script>';              
            }
            mysql_free_result($query);
            $conectado->desconectar();
	
        } 
		
		//---Validacion de Tarjeta

}