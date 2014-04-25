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
        <link rel="stylesheet" href="lib_css/jquery-ui-1.9.2.custom.css">
        <script src="lib_js/jquery-1.8.3.js"></script>
        <script src="lib_js/jquery-ui-1.9.2.custom.js"></script>
        <script src="js/index.js"></script>
    </head>
    <body>
        <?php
//creamos la sesion
        session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
//esta instruccion debe ir al iniscio de cada pagina
        if (!isset($_SESSION['usuarios'])) {
            header('Location: login.php');
            exit();
        }
        ?>


 <form name="frmRegistroNumero" action="clases/formularios/registro_de_numero.php" method="POST"> 
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


                <td background="img/bkg_2.jpg"  style=" vertical-align: top; padding-top: 35px ">

                    <table  align="center" width="656"  border="0" cellpadding="0" cellspacing="0" style="background-image: url(img/registro-numero.jpg);background-repeat: no-repeat; background-size: 656px 96px">
                    

                        <tr>
                            <td  style=" vertical-align: top; padding-top:60px"  width="656px">
                                <div>
                                   
                                        <div >
                                            <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Nombre de usuario</label></div>
                                            <div style="width:60px; height: 25px;border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                        </div>

                                        <div>
                                            <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><input type="text" name="nombre" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 578px; height: 25px;background-color:#e6e6e6"></div>

                                        </div>

                                        <div>
                                            <div style=" border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label for="numero" style="height: 25px; font-size:12px; font-family: arial; font-weight: bold; color:#666666">Numero por Comprar</label></div>
                                            <div style="border: 0px solid;margin-right:237px; float:right;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Cantidad</label>  </div>

                                        </div>

                                        <div>
                                            <div style="border: 0px solid; margin-left:35px;float:left;padding-bottom: 6px " ><input type="int" name="numero" class="form-input" maxlength="2" size="1" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                            <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px" ><input type="text" name="cantidad" class="form-input" style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>                    
                                        </div>

                                        <div >
                                            <div style="border: 0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><label for="tarj" style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Numero de tarjeta</label></div>
                                            <div style="border: 0px solid;margin-right:180px; float:right;padding-bottom:6px"><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Correo Electrónico</label></div>
                                        </div>

                                        <div >
                                            <div style="border:0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><select style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6" name="cod_tarjeta"><?php
                                                    require_once 'clases/seguridad/busca_tarjeta.php';
                                                    $variable = new busca_tarjeta();
                                                    $variable->extraer_cod_tarjeta();
                                                    ?>
                                                </select></div>
                                            <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:20px" ><input type="email" name="correo_electronico" style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                        </div>

                                </div>
                            </td> 

                        </tr>
                        <tr>
                            <td>
                                <table border="0" style=" margin-right:auto;margin-left:auto; width:90%; text-align: center"cellpadding="0" cellspacing="0"  > 
                                    <tr style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666"> 
                                        <td>Fecha</td>
                                        <td>Numero Comprado</td>
                                        <td>Cantidad</td>
                                        <td>Numero de Tarjeta</td>
                                        <td >Monto</td>
                                    </tr> 
                                    <tr style=" font-size:12px; font-family: arial; font-weight: bold; color:#666666;height: 25px;background-color:#e6e6e6"> 
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td> 
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                    </tr> 
                                    <tr style=" font-size:12px; font-family: arial; font-weight: bold; color:#666666;height: 25px;background-color:#e6e6e6"> 
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td> 
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                    </tr> 
                                    <tr style=" font-size:12px; font-family: arial; font-weight: bold; color:#666666;height: 25px;background-color:#e6e6e6"> 
                                        <td><div style="border: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td> 
                                        <td><div style="border: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                        <td><div style="border: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;height: 25px;background-color:#e6e6e6"></div></td>
                                    </tr> 
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div style="border: 0px solid;">
                                    <div style="margin-left:35px;border: 0px solid;padding-bottom: 6px;padding-top:20px;float: left" ><input type="image" src="img/btn-aceptar.gif" data-theme="b"  /></div>                                    
                                    <div style="margin-left:35px;border: 0px solid; padding-bottom: 6px; margin-top: 20px;float: left " ><input type="image" src="img/btn-borrar.gif" data-theme="b" onclick = "this.form.action = 'login.php'"/></div>                                                                        
                                    <div style="margin-left:35px;border: 0px solid; padding-bottom: 6px; margin-top: 20px;float: left " ><input type="image" src="img/btn-registrar-tarjeta.gif" data-theme="b" onclick = "this.form.action = 'Registro_Tarjeta.php'"/></div>
                                    <div style="margin-left:35px;border: 0px solid; padding-bottom: 6px; margin-top: 20px;float: left " ><input type="image" src="img/btn-borrar.gif" data-theme="b" onclick = "this.form.action = 'clases/seguridad/logout.php'"/></div>                                                                        
                                </div>
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
 </form>

        <div id="dialog" title="Mensaje">
            <p>Bienbenido al sistema  <?php echo $_SESSION['nombre'] ?></p>
        </div>

    </body>
</html>