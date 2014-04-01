<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>

       <form name="frmLogin" action="clases/seguridad/valida_usuario.php" method="POST">            
            <h2 id="error"> </h2>
            <p id="cinta"> <strong>Recupera Contraseña</strong></p>   		          
            <div data-role="fieldcontain" id="login">

                <label for="user">Correo Electronico:</label>
                <input type="text" name="email" id="user" value="" />                                                             
                <p id="enviar">
                    <input type="submit" name ="iniciar" value="Enviar" data-theme="b"/>                  
            </div>  
        </form>  


    </body>
</html>