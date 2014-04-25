<?php ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
    <html>
        <head>
            <META http-equiv="Content-Type" content="text/html; charset=utf-8">
                 <title>PTY Lotto</title>
        <style>
          
            
           body
           {
            background-image: url(img/fondo1.jpg)
            
           }
        </style>
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
       
           
           
            <table id="Tabla_01"  width="100%"  border="0" cellpadding="0" cellspacing="0">
                <tr>

                    <td background="img/bkg_1.jpg" height="124" height="116" >
                        <div>
                            <div style="float:left;padding-top:12px">  <img src="img/logo.jpg"></div> 
                            <div style="float:right; padding-top:13px">  <img src="img/estrellas.jpg"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td background="img/bkg_2.jpg" height="447" style=" vertical-align: top; padding-top: 35px ">
                    <table  align="center" width="321" height="447" border="0" cellpadding="0" cellspacing="0" style="background-image: url(img/olvido-contrasena.jpg);background-repeat: no-repeat; background-size: 321px 96px">
                    <tr>
                        <td  style=" vertical-align: top; padding-top:60px"  width="321px">
                          <div>
                          <form name="contrasena" action="clases/seguridad/valida_usuario.php" method="POST">   
                                <div>
                                    <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label   for="user" style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Correo Electrónico</label></div>
                                </div>
                                <div>
                                <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><input type="text" name="email" id="user"  style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                </div>

                                
                                <div>
                                    <div style="border: 0px solid; margin-left:35px;padding-bottom: 6px;padding-top:20px;float:left" ><input type="image" src="img/btn-enviar.gif" data-theme="b" /></div>
                                </div>
                                </form> 
                          <div>
                          <form name="frmLogin" action="login.php" method="POST">
                                <div style="border: 0px solid; margin-left:35px;padding-bottom: 6px;float:left;margin-top: 20px" ><input type="image" src="img/btn-atras.gif" data-theme="b"/></div>
                                </form>
                          </div>
                        </div>
                        </td> 
                        <td> 
                        </td>
                    </tr>
                  </table>
                 </td>
                </tr>
                <tr>
                    <td style="background-color:#fff">
                         <div style="float:right;padding-right:13px">  
                            <img src="img/logo-loteria.gif">
                       </div>
                    </td>
                </tr>
                <tr>
                    
                    <td background="img/bkg_3.jpg" height="40" >
                        
                    </td>
                </tr>
             </table>
           
        


    </body>
</html>