<?php ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>PTY Lotto</title>
        <link rel="stylesheet" href="css/ptylotto.css">
        <meta name="description"	content="Loteria de  Panamá"/>		
    </head>
    <body>
        <!--encabezado de la pagina-->
        <div id="header" >
            <div class="logo">  <img src="img/logo.jpg"/></div> 
            <div class="estrellas">  <img src="img/estrellas.jpg"/></div>
        </div>
        <!--Contenido de la pagina-->
        <div id="contenido" >
            <div data-role="fieldcontain" id="login">
                <div class="div_login"></div>
                 <form name="frmlogin" action="clases/seguridad/valida_usuario.php" method="POST">  
                <div class="label_box_inicial"><label for="user" class="label_frm">Correo electronico</label></div>
                <div class="txt_box"><input type="text" name="user" id="user" value="" class="txt_frm" /></div>
                <div class="label_box"><label for="pwd" class="label_frm">Contrase&ntilde;a:</label></div>
                <div class="txt_box"><input type="password" name="pass" id="pwd" value="" placeholder="contrase&ntilde;a"  class="txt_frm"  />    </div>
                <div> <h2 id="error"> </h2></div>
                <div class="btn_iniciar"><input type="image" src="img/btn-inicio.gif"/></div>
                <div class="olvida_pwd"><a href="recupera_pwd.php"> &iquest;Ha olvidado su contrase&ntilde;a?</a></div>
                </form> 
            </div> 

            <div id="login_registro">
                <div class="div_login_registro"></div>
                 <form name="frmloginregistro" action="clases/seguridad/valida_email.php" method="POST">  
                <div  class="label_box_inicial"><label  class="label_frm">Ingrese su correo electronico</label></div> 
                <div class="txt_box" ><input type="email" name="correo_electronico" value=""  class="txt_frm" /></div> 
                <div class="label_empty">&nbsp;</div>
                <div class="label_empty">&nbsp;</div>
                <div> <h2 id="error"> </h2></div>
                <div class="btn_iniciar"><input type="image" src="img/btn-aceptar.gif" /></div>
                <div class="label_empty">&nbsp;</div>
                </form> 
            </div> 

        </div>
        <!--pie de la pagina-->
        <div id="footer">
        <div class="div_footer_logo" ></div>
        <div class="div_footer" ></div>
        </div>
    </body>
</html>
