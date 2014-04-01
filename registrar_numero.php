<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <!--<link rel="stylesheet" href="css/style.css">-->
        <title></title>
    </head>
    <body>
        
        <div align="center"> <img src="imagenes/logo.jpg" /> 

        </div>


        <form  action="clases/formularios/registro_de_numero.php" method="POST">

            <div align="center">  
                <h2>Registro de un Numero</h2>

                <label for="nombre">Nombre Cliente:</label>
                <input type="text" name="nombre" class="form-input" required value=""/> <br> 
                <br>

                <label for="numero">No. por Comprar:</label>
                <input type="int" name="numero" class="form-input" required/>

                <label>Cantidad<input type="text" name="cantidad" class="form-input"/></label>
                <br>
                <br>


                <label for="tarj" >Tarjeta</label>
            <select name="id_tarjeta">
                <?php
                require_once 'clases/seguridad/busca_tarjeta.php';
                $variable = new busca_tarjeta();                
                $variable->extraer_cod_tarjeta();

                ?>
            </select>

                <br>
                <br>

                <input type="submit" value="Comprar">
                <input type="submit" formtarget="_blank"
                       value="Regresar">

            </div>

        </form>

    </body>
</html>
