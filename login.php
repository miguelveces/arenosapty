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
            </div>  
        </form>  


    </body>
</html>