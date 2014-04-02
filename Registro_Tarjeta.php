<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link rel="stylesheet" href="css/style.css">
        <title></title>
    </head>
    <body>
        <?php
//creamos la sesion
        session_start();

//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
//esta instruccion debe ir al iniscio de cada pagina
        if (!isset($_SESSION['usuarios'])) {
            header('Location: login.php');
            exit();
        }
       
        ?>
        <div align="center"> <img src="imagenes/logo.jpg" /> 
        </div>
        <h2>Registro de Tarjetas</h2>
        <div class="group">         
            <div class="group2">
                <form method= "post" action="clases/formularios/verifica_e_InsertaTarjeta.php" >
                    <label for="nombre">Nombre Cliente<span>(requerido)</span></label>
                    <!-- Aqui debe venir ya de un post de la base de datos el nombre -->
                    <input type="text" name="nombre" class="form-input" readonly=”readonly” value="<?php echo $_SESSION['usuarios'] ?>">	

                    <label> No. Tarjeta </label> <input type="int" name="tarjeta" id="notarje" class="form-input-corto" required/>
                    <label> Cod. Verificado </label><input type="int" name="codverifi" class="form-input-corto" required/> 			  

                    <br>

                    <table border="0">
                        <tr>
                            <td>
<!--                                <form >            -->
                                    <input  class="form-btn" name="crear" type="submit" value="Crear" onclick="ver();" />
                                    <?php

                                    function ver() {
                                        require_once 'clases/formularios/verifica_e_InsertaTarjeta.php';
                                        $consultaTar2 = new verifica_e_InsertaTarjeta();
                                        $consultaTar2->valida_tarjetas_usuario();
                                    }
                                    ?>
<!--                                </form>-->
                            </td>
                            <td>
                                <input class="form-btn" name="limpiar" type="reset" value="Limpiar" />
                            </td>
                            <td>
                                <form action="registrar_numero.php" method="POST"> 
                                    <input href="registrar_numero.php" class="form-btn" name="regresar" type="submit" value="Regresar" />
                                </form>		
                            </td>


                        </tr>
                    </table>	
                </form>			
            </div>                     
        </div>
        <br><?php
                                    include('clases/formularios/consultandoTarjetas.php');
                                    $consultaTar = new consultandoTarjetas();
                                    $consultaTar->muestra_tarjetas_usuario();
                                    ?>
    </body>


</html>


