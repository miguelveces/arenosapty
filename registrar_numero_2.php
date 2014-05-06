<?php ob_start(); ?>
<?php session_start(); ?>
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
          <div   id="numero">
                <div class="div_num"></div>
                <form name="frmnumero" action="clases/formularios/registro_de_numero.php" method="POST">
                <div class="label_box_inicial2" ><label  class="label_frm">Nombre de usuario</label></div>                
                <div  class="txt_box_3" ><input type="text" name="nombre" readonly="readonly" value=""  class="txt_frm_3" ></div>
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
                <div class="btn_registrar" ><input type="image" src="img/btn-aceptar.gif"  /></div>
                </form>
                <form name="frmnumeroclear" action="" method="POST">
                 <div class="btn_atras" ><input type="image" src="img/btn-borrar.gif" onclick="document.frmnumeroclear.reset();"/></div>
                </form>
                <form name="frmtarjeta" action="registro_tarjeta.php" method="POST">
                 <div class="btn_regitro_tarjeta" ><input type="image" src="img/btn-registrar-tarjeta.gif" /></div>
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
