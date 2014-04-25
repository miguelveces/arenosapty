<?php ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Pruebas</title>

        <link rel="stylesheet" href="lib_css/jquery-ui-1.9.2.custom.css">
        <script src="lib_js/jquery-1.8.3.js"></script>
        <script src="lib_js/jquery-ui-1.9.2.custom.js"></script>
        <script src="js/index.js"></script>

    </head>
    <body>
        <?php
//creamos la sesion
       // session_start();

//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
//esta instruccion debe ir al iniscio de cada pagina
        if (!isset($_SESSION['usuarios'])) {
            header('Location: login.php');
            exit();
        }
        ?><form name="frmLogin" action="clases/seguridad/logout.php" method="POST">            
            <h2 id="saludo"> Hola Loteria</h2>

            <input type="submit" name ="iniciar" value="Cerrar Sesion" data-theme="b" />
            <br/>
            <a href="Registro_Tarjeta.php">Registrar tarjeta</a>
            <br/>
            <a href="Registrar_numero.php">Comprar Numero</a>
            <br/>
        </form> 



        <div id="dialog" title="Mensaje">
            <p>Bienbenido al sistema  <?php echo $_SESSION['nombre']?></p>
        </div>

    </body>
</html>