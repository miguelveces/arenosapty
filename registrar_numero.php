<?php ob_start(); ?>
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
    <?php
	session_start();
    		if (!isset($_SESSION['usuarios'])) { header('Location: login.php'); exit(); }
      ?>
        <!--encabezado de la pagina-->
        <div id="header" >
            <div class="logo">  <img src="img/logo.jpg"/></div> 
            <div class="estrellas">  <img src="img/estrellas.jpg"/></div>
             <div class="div_menu"><div class="menu"><a class="menu "href=""> Contactenos</a> </div><div class="menu">|</div><div class="menu"><a class="menu" href=""> Legal</a> </div><div class="menu">|</div> <div class="menu"><a class="menu" href="clases/seguridad/logout.php"> Salir</a></div></div>
        </div>
        <!--Contenido de la pagina-->
        <div id="contenido" >
          <div   id="numero">
                <div class="div_num"></div>
                <form name="frmnumero" action="clases/formularios/registro_de_numero.php" method="POST">
                <div class="label_box_inicial2" ><label  class="label_frm">Nombre de usuario</label></div>                
                <div  class="txt_box_3" ><input type="text" name="nombre" readonly="readonly" value="<?php echo  $_SESSION['nombre']." ". $_SESSION['apellido'] ?>"  class="txt_frm_3" ></div>
                <div  class="label_box_2" ><label  class="label_frm">Cedula</label></div>
                <div  class="label_box_2"><label  class="label_frm">Correo Electrónico</label></div>
                <div  class="txt_box_2" ><input type="text" name="cedula" readonly="readonly"  value="<?php echo $_SESSION['cedula']  ?>"  class="txt_frm" > </div> 
                <div  class="txt_box_2" ><input type="email" name="correo_electronico" readonly="readonly"  value="<?php echo $_SESSION['usuarios'] ?>"  class="txt_frm" > </div>
                <div  class="label_box_2" ><label  class="label_frm">Numero por comprar</label></div>
                <div  class="label_box_2" ><label  class="label_frm">Cantidad</label>  </div>
                <div class="txt_box_2" ><input type="int" name="numero" maxlength="2" size="1" required  class="txt_frm" ></div>      
                <div class="txt_box_2" ><input type="text" name="cantidad"  class="txt_frm" ></div>                               
                <div  class="label_box_2" ><label  class="label_frm">Numero de tarjeta</label></div>
                <div class="label_empty2">&nbsp;</div>
                <div class="txt_box_2" ><select class="txt_frm" name="cod_tarjeta"><?php require_once 'clases/seguridad/busca_tarjeta.php';  
                $variable = new busca_tarjeta(); 
                $variable->extraer_cod_tarjeta(); ?>
                    </select></div>                                        

                 <div> <h2 id="error"> </h2></div>
                <div class="grd_box"> <?php include('clases/formularios/lista_de_numeros_comprados.php');$consultaTar = new lista_de_numeros_comprados();$consultaTar->muestra_numeros_usuario(); ?></div>
                <div class="btn_registrar" ><input type="image" src="img/btn-aceptar.gif" value="Crear" name="crear" /></div>
                </form>
                <form name="frmnumeroclear" action="" method="POST">
                 <div class="btn_atras" ><input type="image" src="img/btn-borrar.gif" onclick="document.frmnumeroclear.reset();"/></div>
                </form>
                <form name="frmtarjeta" action="registro_tarjeta.php" method="POST">
                 <div class="btn_regitro_tarjeta" ><input type="image" src="img/btn-registrar-tarjeta.gif" /></div>
                 
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