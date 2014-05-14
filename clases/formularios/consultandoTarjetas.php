<?php
ob_start();
/**
 * 
 *
 * 
 */
class consultandoTarjetas {

//Hacer funcion para validar que la tarjeta existe en el listado enviado
// si existe Verificar si el campo fueregistrada es igual a false entonces permitir registrarla
// de lo contrario manda mensaje esta tarjeta ya fue registrada.


//funcion para buscar Tarjetas en Tabla de recibidas
    public function muestra_tarjetas_usuario() {
          session_start();
        require_once('clases/conexion_bd/conexion.php');
        //instaciamos la conexion
        $conectado = new conexion();
        $conrespuesta = $conectado->conectar();
	
	
           if (strcmp($conrespuesta, "ok") == 0) {
echo "<table border='0' style='margin-right:auto;margin-left:auto; width:100%; text-align: center' cellpadding='0' cellspacing='0' > ";
    echo "<tr style='height: 25px;font-size:13px; font-family: arial; font-weight: bold; color:#666666'> ";
        echo "<td style='width:40px'><div style='border-bottom: 1px solid #bfbfbf;'>#</div></td>";
        echo "<td style='width:100px'><div style='border-bottom: 1px solid #bfbfbf;'>Fecha</div></td>";
        echo "<td><div style='border-bottom: 1px solid #bfbfbf;'>No Tarjeta</div></td>";
        echo "<td style='width:90px;'><div style='border-bottom: 1px solid #bfbfbf; '>Estado</div></td>	";
        //echo "<td style='width:40px'><div style='border-bottom: 1px solid #bfbfbf;'>Sellar</div></td> ";
    echo "</tr> ";
echo "</table>";
echo "<div class='div_grid' >";
echo "<table  class='grid_tbl' style='height:90px; width:100%; text-align: center' > ";
$query = @mysql_query('SELECT id_targeta_usuario,fecha_registro,codigo_targeta,Estado_tarjeta,Sellar_tarjeta  FROM tarjetas_por_usuarios WHERE id_fk_usuario='.$_SESSION['id'] );//6);
while ($registro = mysql_fetch_array($query)){
    echo "<tr>";
        echo "<td style='width:40px'><div>".$registro['id_targeta_usuario']."</div></td>";
        echo "<td style='width:100px'><div>".$registro['fecha_registro']."</div></td>";
        echo "<td><div>".$registro['codigo_targeta']."</div></td>";
        echo "<td style='width:60px'><div'>";
                if ($registro['Estado_tarjeta']==0){ echo "<img alt='Imagen' src='img/grid_abajo.gif'>"; }
                else { echo "<img alt='Imagen' src='img/grid_arriba.gif'>"; }
        echo "</div></td>";
        //echo "<td style='width:40px'><div style='border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6;padding-top: 7px'>";
        //echo "<img alt='Imagen' src='imagenes/sello.png' width='20' height='20'/>";
        //echo "</div></td>";
    echo "</tr> ";
     }  	// fin del while
echo "</table>"; 
echo "</div>";

           } else {
                //
				
            $_SESSION['mensaje'] = 'No hay Conexion a la Base de Datos';
            $_SESSION['capitan'] = 2;
            }
            mysql_free_result($query);
            $conectado->desconectar();
	
        } 
		
		//---Validacion de Tarjeta

}


