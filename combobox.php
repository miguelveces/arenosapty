<!DOCTYPE html>
<html>
    <head>
        <title>Pruebas</title>
    </head>
    <body>   
        <form name="frmLogin" action="clases/seguridad/logout.php" method="POST">            
            <h2 id="saludo"> Hola Loteria</h2>


            <select>
                <?php
                require_once 'clases/seguridad/busca_tarjeta.php';
                $variable = new busca_tarjeta();
                $resultado = $variable->extraer_cod_tarjeta();
//para graar en archivo
               
                ?>
            </select>
            
        </form> 
        <?php  
            $fecha_actual = date('Y-m-d_H_i_s');
                echo $fecha_actual;
                $fp = fopen("archivos/consulidado_" . $fecha_actual . ".txt", "a");
                fwrite($fp, "Juan Perez 225122 22/07/07" . PHP_EOL);
                fclose($fp);
                ?>
    </body>
</html>
