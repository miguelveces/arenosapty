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
       // session_start();
        require_once('clases/conexion_bd/conexion.php');
        //instaciamos la conexion
        $conectado = new conexion();
        $conrespuesta = $conectado->conectar();
	
	 if (strcmp($conrespuesta, "ok") == 0) {
echo "<table border='0' style='margin-right:auto;margin-left:auto; width:100%; text-align: center' cellpadding='0' cellspacing='0' > ";
    echo "<tr style='height: 25px;font-size:13px; font-family: arial; font-weight: bold; color:#666666'> ";
        echo "<td style='width:115px'><div style='border-bottom: 1px solid #bfbfbf;'>Fecha de Sorteo</div></td>";
        echo "<td style='width:90px'><div style='border-bottom: 1px solid #bfbfbf;'># Comprado</div></td>";
        echo "<td style='width:70px'><div style='border-bottom: 1px solid #bfbfbf;'>Cantidad</div></td>";
        echo "<td style='width:70px'><div style='border-bottom: 1px solid #bfbfbf;'>Monto</div></td> ";
        echo "<td><div style='border-bottom: 1px solid #bfbfbf;'># de Tarjeta</div></td>	";
        echo "<td style='width:115px'><div style='border-bottom: 1px solid #bfbfbf;'>Fecha</div></td> ";
    echo "</tr> ";
echo "</table>";
echo "<div class='div_grid' >";
echo "<table  class='grid_tbl' style='height:90px; width:100%; text-align: center' > ";
$query = @mysql_query("SELECT a.fecha_sorteo ,IF(a.id_fk_numero  <10, CONCAT('0',CAST(a.id_fk_numero AS CHAR)),  a.id_fk_numero)as id_fk_numero, a.cantidad,a.id_fk_targeta,ADDTIME( a.fecha_registro,  '-5:00:00.00' )  
FROM numeros_por_usuario a, tarjetas_por_usuarios c
WHERE a.id_fk_targeta = c.codigo_targeta
AND c.id_fk_usuario =".$_SESSION['id']."
ORDER BY a.fecha_registro DESC "); 

while ($registro = mysql_fetch_array($query)){
    echo "<tr>";
        echo "<td style='width:110px'><div>".$registro['0']."</div></td>";
        echo "<td style='width:85px'><div>".$registro['1']."</div></td>";
        echo "<td style='width:65px'><div>".$registro['2']."</div></td>";
         $totalAPagar =  $registro['2'] * 0.25;
        echo "<td style='width:65px'><div>".$totalAPagar."</div></td>";
        echo "<td><div>".$registro['3']."</div></td>";
        echo "<td style='width:90px'><div>".$registro['4']."</div></td>";
    echo "</tr> ";
     }  	// fin del while
echo "</table>"; 
echo "</div>";

           }else {
                //
               $_SESSION['mensaje'] = 'No hay Conexion a la Base de Datos';
            $_SESSION['capitan'] = 2;
				
            }
            mysql_free_result($query);
            $conectado->desconectar();
	
        } 
		
		//---Validacion de Tarjeta

}