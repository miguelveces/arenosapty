<?php
ob_start();
/**
 * 
 *
 * 
 */
class consultandoNumeros {

//funcion para buscar Tarjetas en Tabla de recibidas
    public function muestra_tarjetas_usuario() {
        
        require_once('clases/conexion_bd/conexion.php');
        //instaciamos la conexion
        $conectado = new conexion();
        $conrespuesta = $conectado->conectar();
	
	
           if (strcmp($conrespuesta, "ok") == 0) {
             echo "<table id = 'tabla'> ";
		     echo "	<tr> ";
                     echo " <td>#</td>";
                     echo " <td>Fecha</td>";
		     echo " <td>No Tarjeta</td>";
		     echo " <td>Estado</td>	";
		     echo " <td>Sellar</td> ";
	        echo "</tr> ";
                echo "</table>";
               
               echo "  <div id='tar' >";
             echo "<table id = 'tabla1'> ";
//		     echo "	<tr> ";
//	         echo " <td>#</td>";
//	         echo " <td>Fecha</td>";
//		     echo " <td>No Tarjeta</td>";
//		     echo " <td>Estado</td>	";
//		     echo " <td>Sellar</td> ";
//	        echo "</tr> ";
  		    $query = @mysql_query('SELECT id_targeta_usuario,fecha_registro,codigo_targeta,Estado_tarjeta,Sellar_tarjeta  FROM tarjetas_por_usuarios WHERE id_fk_usuario= 6');//.$_SESSION['id']);
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


