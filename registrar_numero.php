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


        <form   method= "post" action="" >

            <div align="center">  
                <h2>Registro de un Numero</h2>

                <label for="nombre">Nombre Cliente:</label>
                <input type="text" name="nombre" class="form-input" required value=""/> <br> 
                <br>

                <label for="numero">No. por Comprar:</label>
                <input type="int" name="numero" class="form-input" maxlength="2" size="1" required/>

                <label>Cantidad<input type="text" name="cantidad" class="form-input"/></label>
                <br>
                <br>


                <label for="tarj" >Tarjeta</label>
                <select name="cod_tarjeta">
                    <?php
                    require_once 'clases/seguridad/busca_tarjeta.php';
                    $variable = new busca_tarjeta();
                    $variable->extraer_cod_tarjeta();
                    
                    ?>
                </select>

                <br>
                <br>

                <input type="submit" value="Comprar" id="comprar" name="comprar">
                <input type="submit" formtarget="_blank"
                       value="Regresar">

            </div>


            <table style="border: 2px dotted gray;margin-right:auto;margin-left:auto; width:100%;height:100px"  > 

                <tr style="text-align:center;background-color:#4a6890;color:#fff;"> 
                    <td>Fecha</td>
                    <td>No.Comprado</td>
                    <td>Cantidad</td>
                    <td>No Tarjeta</td>
                    <td>Monto</td>

                </tr> 

                <tr> 
                    <td>  </td> 
                    <td> </td>
                    <td>   </td>
                    <td>  </td>
                    <td>  </td>
                </tr> 

            </table> 

        </form>
        <?php
        
        if (isset($_POST['comprar'])) {
            require_once './clases/formularios/registro_de_numero.php';
            $comprar = new registro_de_numero();
            $comprar->insertar($_POST['cod_tarjeta'], $_POST['numero'], $_POST['cantidad']);
            echo '<div>' . $comprar->respuesta . '</div>';
        }
        ?>
    </body>
</html>
