<?php  ob_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
       <title>PTY Lotto</title>
       
        <meta name="description"	content="Loteria de  Panam®¢"/>	
        <link rel="stylesheet" href="lib_css/jquery-ui-1.9.2.custom.css">
         <link rel="stylesheet" href="css/ptylotto.css">
        <script src="lib_js/jquery-1.8.3.js"></script>
        <script src="lib_js/jquery-ui-1.9.2.custom.js"></script>
    </head>
    <body>
        <!--encabezado de la pagina-->
        <div id="header" >
            <div class="logo">  <img src="img/logo.jpg"/></div> 
            <div class="estrellas">  <img src="img/estrellas.jpg"/></div>
        </div>
        <!--Contenido de la pagina-->
        <div id="contenido" >
             <div   id="pass">
                <div class="div_pass"></div>
                <form name="frmpass" action="clases/seguridad/recupera_contrasenia.php" method="POST">                              
                <div  class="label_box" ><label  class="label_frm">Correo Electr√≥nico</label></div>
                <div class="txt_box" ><input type="email" name="correo_electronico"    class="txt_frm" ></div>                                        
                <div> <h2 id="error"> </h2></div>
                <div class="btn_registrar" ><input type="image" src="img/btn-enviar.gif"  /></div>
                </form>
                <form name="frmlogin" action="clases/seguridad/logout.php" method="POST">
                 <div class="btn_atras" ><input type="image" src="img/btn-atras.gif" /></div>
                </form>
            </div>
            </div> 

        </div>
        <!--pie de la pagina-->
        <div id="footer">
        <div class="div_footer_logo" ></div>
        <div class="div_footer" ></div>
        </div>
    </body>
</html>