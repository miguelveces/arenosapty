<!DOCTYPE html>
<html>
    <head>
        <title>Pruebas</title>
    </head>
    <body>
        
        <form name="frmLogin" action="scripts/conexion/login.php" method="POST">            
             <h2 id="error"> </h2>
                    <p id="cinta"> <strong>Ingresar</strong></p>   		          
                      <div data-role="fieldcontain" id="login">

                              <label for="user">Usuario:</label>
                              <input type="text" name="user" id="user" value="" />
                              <label for="pwd" >Contraseña:</label>
                              <input type="password" name="pwd" id="pwd" value="" placeholder="contraseña" />                                                
                              <p id="enviar">
                                <input type="submit" name ="iniciar" value="Enviar" data-theme="b"/>                                
                       </div>  
              </form>  
        <?php
require_once('clases/conexion_bd/conexion.php');
       //para encriptar se hace asi : 
       //se instancia la clase encriptar
        $conectado = new conexion();
        
        
        $con_res = $conectado->conectar();
         
        if (strcmp ($con_res, "ok" ) == 0 )
         {
          echo 'Conexion exitosa todo bien';
         }
         else{
             echo 'Algo anda mal';
         }
      
         
         //para enviar correos
//         require_once ('clases/mensajeria/envia_correo.php');
//         
//         $enviar_correo = new envia_correo();
//         $enviar_correo->enviarCorreo();
        ?>
    </body>
</html>