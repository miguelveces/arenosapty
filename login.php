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
                <div class="label_box_inicial"><label for="user" class="label_frm">Correo electronico</label></div>
                <div class="txt_box"><input type="text" name="user" id="user" value="" class="txt_frm" /></div>
                <div class="label_box"><label for="pwd" class="label_frm">Contrase&ntilde;a:</label></div>
                <div class="txt_box"><input type="password" name="pass" id="pwd" value="" placeholder="contrase&ntilde;a"  class="txt_frm"  />    </div>
                <div> <h2 id="error"> </h2></div>
                <div class="btn_iniciar"><input type="image" src="img/btn-inicio.gif" onclick = "this.form.action = 'clases/seguridad/valida_usuario.php'"/></div>
                <div class="olvida_pwd"><a href="recupera_pwd.php"> &iquest;Ha olvidado su contrase&ntilde;a?</a></div>
            </div> 

            <div   id="registro">
                <div class="div_reg"></div>
                <div class="label_box_2" ><label  class="label_frm">Nombre de usuario</label></div>                
                <div  class="label_box_2" ><label  class="label_frm">Apellido</label>  </div>        
                <div  class="txt_box_2" ><input type="text" name="nombre"   class="txt_frm" ></div>
                <div class="txt_box_2"><input type="text" name="apellido"   class="txt_frm" ></div>
                
                <div  class="label_box_2" ><label  class="label_frm">Cedula</label></div>
                <div  class="label_box_2" ><label  class="label_frm">Telefono</label>  </div>
                <div class="txt_box_2" ><input type="text" name="cedula"   class="txt_frm" ></div>               
                <div class="txt_box_2" ><input type="text" name="telefono"  class="txt_frm" ></div>                               
                <div  class="label_box_2" ><label  class="label_frm">Correo Electrónico</label></div>
                <div  class="label_box_2"><label  class="label_frm">Correo Electrónico alterno</label></div> 
                <div class="txt_box_2" ><input type="email" name="correo_electronico" value=""  class="txt_frm" ></input></div>                                        
                <div class="txt_box_2" ><input type="email" name="correo_electronico2"   class="txt_frm" ></div>          
                <div  class="label_box_2" > <label  class="label_frm" > Contraseña</label> </div>                
                <div  class="label_box_2" > <label  class="label_frm" > Repetir Contraseña</label> </div>
                <div class="txt_box_2" > <input type="password" name="contrasenia"   class="txt_frm" ></div>
                <div class="txt_box_2" > <input type="password" name="contrasenia2"   class="txt_frm" ></div>
                
                <div class="btn_registrar" ><input type="image" src="img/btn-registrar.gif" data-theme="b" onclick = "this.form.action = 'clases/formularios/registrar_user.php'" /></div>
            </div>

        </div>

        <!--pie de la pagina-->
        <div id="footer" >

        </div>
    </body>
</html>
