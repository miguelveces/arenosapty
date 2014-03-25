<!DOCTYPE html>
<html>
    <head>
        <title>Pruebas</title>
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
        <form name="frmLogin" action="clases/seguridad/logout.php" method="POST">            
            <h2 id="saludo"> Hola Loteria</h2>
          
            <input type="submit" name ="iniciar" value="Cerrar Sesion" data-theme="b" />                                
            
        </form> 
    </body>
</html>