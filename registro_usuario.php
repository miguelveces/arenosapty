<?php ob_start(); ?>
<?php session_start(); ?>
<!DOCTYPE html>
<html>
    <head>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
      <title>PTY Lotto</title>
        <meta name="description"	content="Loteria de  Panamá"/>	
        <link rel="stylesheet" href="lib_css/jquery-ui-1.9.2.custom.css">
         <link rel="stylesheet" href="css/ptylotto.css">
        <script src="lib_js/jquery-1.8.3.js"></script>
        <script src="lib_js/jquery-ui-1.9.2.custom.js"></script>
        <script src="js/login.js"></script>
    </head>
    <body>
        <!--encabezado de la pagina-->
        <div id="header" >
            <div class="logo">  <img src="img/logo.jpg"/></div> 
            <div class="estrellas">  <img src="img/estrellas.jpg"/></div>
        </div>
        <!--Contenido de la pagina-->
        <div id="contenido" >
             <div   id="registro">
                <div class="div_reg"></div>
                <form name="frmregistrar" action="clases/formularios/registrar_user.php" method="POST">
                <div class="label_box_inicial2" ><label  class="label_frm">Nombre de usuario</label></div>                
                <div  class="label_box_inicial2" ><label  class="label_frm">Apellido</label>  </div>        
                <div  class="txt_box_2" ><input type="text" name="nombre"   class="txt_frm" ></div>
                <div class="txt_box_2"><input type="text" name="apellido"   class="txt_frm" ></div>
                <div  class="label_box_2" ><label  class="label_frm">Cedula</label></div>
                <div  class="label_box_2" ><label  class="label_frm">Telefono</label>  </div>
                <div class="txt_box_2" ><input type="text" name="cedula"   class="txt_frm" ></div>               
                <div class="txt_box_2" ><input type="text" name="telefono"  class="txt_frm" ></div>                               
                <div  class="label_box_2" ><label  class="label_frm">Correo Electrónico</label></div>
                <div  class="label_box_2"><label  class="label_frm">Correo Electrónico alterno</label></div> 
                <div class="txt_box_2" ><input type="email" name="correo_electronico"  value="<?php echo $_POST["correo_electronico"]; ?>"  class="txt_frm" ></input></div>                                        
                <div class="txt_box_2" ><input type="email" name="correo_electronico2"   class="txt_frm" ></div>          
                <div  class="label_box_2" > <label  class="label_frm" > Contraseña</label> </div>                
                <div  class="label_box_2" > <label  class="label_frm" > Repetir Contraseña</label> </div>
                <div class="txt_box_2" > <input type="password" name="contrasenia"   class="txt_frm" ></div>
                <div class="txt_box_2" > <input type="password" name="contrasenia2"   class="txt_frm" ></div>
                
                <div> <h2 id="error"> </h2></div>
                
                <div class="btn_registrar" ><input type="image" src="img/btn-registrar.gif"  /></div>
                </form>
                <form name="frmlogin" action="clases/seguridad/logout.php" method="POST">
                 <div class="btn_atras" ><input type="image" src="img/btn-atras.gif" /></div>
                </form>
                
                <div id="mensaje" class="mensajeOk" ></div>
            </div>
        </div> 

      
        <!--pie de la pagina-->
        <div id="footer">
        <div class="div_footer_logo" ></div>
        <div class="div_footer" ></div>
        </div>
    </body>
</html>