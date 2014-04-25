<?php ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>PTY Lotto</title>
        <link rel="stylesheet" href="css/ptylotto.css">
       
    </head>
    <body>


<form name="frmLogin"  method="POST"> 

        <table id="Tabla_01"  width="100%"  border="0" cellpadding="0" cellspacing="0">
            <tr>

                <td background="img/bkg_1.jpg" height="124" height="116" >
                    <div>
                        <div class="logo">  <img src="img/logo.jpg"></div> 
                        <div style="float:right; padding-top:13px">  <img src="img/estrellas.jpg"></div>
                    </div>
                </td>
            </tr>
            <tr>


                <td background="img/bkg_2.jpg" height="500" style=" vertical-align: top; padding-top: 35px ">

                    <table  align="center" width="100%" height="500" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td style=" vertical-align: top;">
                                
                                    <div data-role="fieldcontain" id="login" style="text-align:left; ">
                                        <div style=" margin-left:auto; margin-right:15px;width:313px;  height: 91px;  background-image: url(img/inicio-sesion.jpg); background-repeat: no-repeat; background-size: 313px 91px"></div>
                                        <div style=" margin-left:auto; width:290px;padding-bottom: 6px; margin-top:-15px"><label for="user" style="font-size:12px; font-family: arial; font-weight: bold; color:#666666">Correo electronico</label></div>
                                        <div style=" margin-left:auto; width:290px;padding-bottom: 6px  "><input type="text" name="user" id="user" value="" style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"/></div>
                                        <div style=" margin-left:auto; width:290px;padding-bottom: 6px   "><label for="pwd" style="font-size:12px; font-family: arial; font-weight: bold; color:#666666">Contrase&ntilde;a:</label></div>
                                        <div style=" margin-left:auto; width:290px;padding-bottom: 8px  "><input type="password" name="pass" id="pwd" value="" placeholder="contrase&ntilde;a" style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6" />    </div>
                                        <div> <h2 id="error"> </h2></div>
                                        <div style=" margin-left:auto;margin-right:53px;text-align: right; width:290px; padding-bottom: 20px"><input type="image" src="img/btn-inicio.gif" onclick = "this.form.action = 'clases/seguridad/valida_usuario.php'"/></div>
                                        <div style=" margin-left:auto;margin-right:50px;text-align: center; width:290px; padding-bottom: 6px"><a href="recupera_pwd.php" style="text-decoration:none; font-family:arial;font-size: 12px; font-weight:bold "> &iquest;Ha olvidado su contrase&ntilde;a?</a></div>
                                    </div>  
                               
                            </td>
                            <td style=" vertical-align: top; ">
                                <table  align="center" width="656" height="447" border="0" cellpadding="0" cellspacing="0" style="background-image: url(img/nuevo-usuario.jpg);background-repeat: no-repeat; background-size: 656px 96px">
                                    <tr>
                                        <td  style=" vertical-align: top; padding-top:60px"  width="656px">
                                            <div>
                                               
                                                    <div >
                                                        <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Nombre de usuario</label></div>
                                                        <div style="border: 0px solid;margin-right:240px; float:right;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Apellido</label>  </div>
                                                    </div>

                                                    <div>
                                                        <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><input type="text" name="nombre"   style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                                        <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px"><input type="text" name="apellido"   style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                                    </div>

                                                    <div>
                                                        <div style="width:70px; border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label  style="height: 25px; font-size:12px; font-family: arial; font-weight: bold; color:#666666">Cedula</label></div>
                                                        <div style="border: 0px solid;margin-right:237px; float:right;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Telefono</label>  </div>

                                                    </div>

                                                    <div>
                                                        <div style="border: 0px solid; margin-left:35px;float:left;padding-bottom: 6px" ><input type="text" name="cedula"   style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                                        <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px" ><input type="text" name="telefono"  style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>                    
                                                    </div>

                                                    <div >
                                                        <div style="border: 0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Correo Electrónico</label></div>
                                                        <div style="border: 0px solid;margin-right:136px; float:right;padding-bottom:6px"><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Correo Electrónico alterno</label></div>
                                                    </div>

                                                    <div >
                                                        <div style="border:0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><input type="email" name="correo_electronico" value=""  style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></input></div>
                                                        <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px" ><input type="email" name="correo_electronico2"   style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                                    </div>

                                                    <div >
                                                        <div style="border:0px solid; margin-left:35px; float:left;padding-bottom: 6px" > <label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666"> Contraseña</label> </div>
                                                        <div style="width:60px; height: 25px;border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                                    </div>
                                                    <div >
                                                        <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" > <input type="password" name="contrasenia"   style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                                        <div style="width:60px; height: 25px; border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                                    </div>
                                                    <div>
                                                        <div style="border: 0px solid; margin-left:35px;padding-bottom: 6px;padding-top:20px;float:left" ><input type="image" src="img/btn-registrar.gif" data-theme="b" onclick = "this.form.action = 'clases/formularios/registrar_user.php'" /></div>
                                                        <div style="width:60px; height: 25px;border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                                    </div>
                                              
                                                <div>
                                                    <!--<form name="frmLogin" action="login.php" method="POST">
                                                    <div style="border: 0px solid; margin-left:35px;padding-bottom: 6px;float:left;margin-top: 10px" ><input type="image" src="img/btn-atras.gif" data-theme="b"/></div>
                                                    </form>-->
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
                            <td colspan="2" style=" vertical-align: bottom;"> 
                                <div>
                                    <div style="float:right; padding-right:13px">  <img src="img/logo-loteria.gif">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>


                </td>

            </tr>
            <tr>
                <td background="img/bkg_3.jpg" height="40" >

                </td>
            </tr>
        </table>

 </form>


    </body>
</html>

