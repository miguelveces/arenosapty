<?php
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
        require_once('clases/conexion_bd/conexion.php');
        //instaciamos la conexion
        $conectado = new conexion();
        $conrespuesta = $conectado->conectar();
	
	
           if (strcmp($conrespuesta, "ok") == 0) {
             echo "<table style='border: 2px dotted gray;margin-right:auto;margin-left:auto; width:60%;height:30px'> ";
		     echo "	<tr> ";
	         echo " <td>#</td>";
	         echo " <td>Fecha</td>";
		     echo " <td>No Tarjeta</td>";
		     echo " <td>Estado</td>	";
		     echo " <td>Sellar</td> ";
	        echo "</tr> ";
  		    $query = @mysql_query('SELECT id_targeta_usuario,fecha_registro,codigo_targeta,Estado_tarjeta,Sellar_tarjeta  FROM tarjetas_por_usuarios WHERE id_fk_usuario=1');
		    while ($registro = mysql_fetch_array($query)){
         	   echo "<tr>";
	    	   echo "<td>".$registro['id_targeta_usuario']."</td>";
		       echo "<td>".$registro['fecha_registro']." </td>";
		       echo "<td>".$registro['codigo_targeta']."</td>";
			   echo "<td>";
		      if ($registro['Estado_tarjeta']==0){  	   
			         echo "<img alt='Imagen' src='imagenes/estadorojo.png'>"; 
			    }
			   else { 
				     echo "<img alt='Imagen' src='imagenes/estadoverde.png'>"; 
				}
			   echo "</td>";
		       echo "<td>";
			   echo "<img alt='Imagen' src='imagenes/sello.png' />";
			   echo "</td>";
		       echo "</tr> ";
		        }  	// fin del while
               echo "</table>"; 

           } else {
                //
				echo '<script>alert("No hay Conexion a la Base de Datos")</script>';              
            }
            mysql_free_result($query);
            $conectado->desconectar();
	
        } 
		
		//---Validacion de Tarjeta

}


