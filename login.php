<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>

       <form name="frmLogin" action="clases/seguridad/valida_usuario.php" method="POST">            
            <h2 id="error"> </h2>
            <p id="cinta"> <strong>Ingresar</strong></p>   		          
            <div data-role="fieldcontain" id="login">

                <label for="user">Usuario:</label>
                <input type="text" name="user" id="user" value="" />
                <label for="pwd" >Contraseña:</label>
                <input type="password" name="pass" id="pwd" value="" placeholder="contraseña" />                                                
                <p id="enviar">
                    <input type="submit" name ="iniciar" value="Enviar" data-theme="b"/>
                    <br/>
                    <a href="registro_usuario.php">registrarse</a>
                    <br/>
                    <a href="recupera_pwd.php">Olvido Contraseña</a>
                    <br/>
            </div>  
        </form>  


    </body>
</html>