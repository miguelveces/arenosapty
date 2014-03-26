<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!--<link rel="stylesheet" href="css/style.css">-->

        <title></title>
    </head>
    <body>
         <?php
//creamos la sesion
        //session_start();

//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
//esta instruccion debe ir al iniscio de cada pagina
        //if (!isset($_SESSION['usuarios'])) {
          //  header('Location: login.php');
           // exit();
        //}
        ?>
        <div align="center"> <img src="imagenes/logo.jpg" /> 

        </div>
        <div align="center">
            <h2>Formulario de Registro</h2>

            <form  action="clases/formularios/registrar_user.php" method="POST">
                <!--<label for="male">Male</label>-->

<!--<input type="text" name="fname" placeholder="First name">-->
                Nombre: <input type="text" name="nombre" required><br><br>
                Apellido: <input type="text" name="apellido" required><br><br>
                Cédula: <input type="text" name="cedula" required><br><br>
                <!--Fecha nacimiento: <input type="date" name="cumpleanios"
                                         step="1" min="2013-01-01" max="2014-12-31" value="2013-01-01"><br><br>-->
                Teléfono: <input type="text" name="telefono" required><br><br>
                Correo Electrónico: <input type="email" name="correo_electronico" required><br><br>
                Correo Electrónico alterno: <input type="email" name="correo_electronico2" required><br><br>
                Contraseña:<input type="password" name="contrasenia" required><br><br>

                <input type="submit" value="Registrarse">
                <input type="submit" formtarget="_blank"
                       value="Regresar">
            </form>

        </div>
    </body>
</html>
