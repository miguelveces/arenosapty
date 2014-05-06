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

                        <table  align="center" width="656" height="447" border="0" cellpadding="0" cellspacing="0" style="background-image: url(img/nuevo-usuario.jpg);background-repeat: no-repeat; background-size: 656px 96px">
                            <tr>
                                <td  style=" vertical-align: top; padding-top:60px"  width="656px">
                                    <div>
                                    <form name="frmRegistro" action="clases/formularios/registrar_user.php" method="POST"> 
                                    <div >
                                    <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Nombre de usuario</label></div>
                                    <div style="border: 0px solid;margin-right:240px; float:right;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Apellido</label>  </div>
                                    </div>
                                    
                                    <div>
                                    <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><input type="text" name="nombre" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                    <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px"><input type="text" name="apellido" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                    </div>
                                    
                                    <div>
                                    <div style="width:70px; border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label  style="height: 25px; font-size:12px; font-family: arial; font-weight: bold; color:#666666">Cedula</label></div>
                                    <div style="border: 0px solid;margin-right:237px; float:right;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Telefono</label>  </div>

                                     </div>
                                    
                                    <div>
                                    <div style="border: 0px solid; margin-left:35px;float:left;padding-bottom: 6px" ><input type="text" name="cedula" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                    <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px" ><input type="text" name="telefono"required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>                    
                                     </div>
                                    
                                    <div >
                                    <div style="border: 0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Correo Electrónico</label></div>
                                    <div style="border: 0px solid;margin-right:136px; float:right;padding-bottom:6px"><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Correo Electrónico alterno</label></div>
                                     </div>
                                    
                                    <div >
                                    <div style="border:0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><input type="email" name="correo_electronico" value="" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></input></div>
                                    <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px" ><input type="email" name="correo_electronico2" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                     </div>
                                    
                                    <div >
                                    <div style="border:0px solid; margin-left:35px; float:left;padding-bottom: 6px" > <label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666"> Contraseña</label> </div>
                                    <div style="width:60px; height: 25px;border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                    </div>
                                    <div >
                                        <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" > <input type="password" name="contrasenia" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                        <div style="width:60px; height: 25px; border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                    </div>
                                    <div>
                                        <div style="border: 0px solid; margin-left:35px;padding-bottom: 6px;padding-top:20px;float:left" ><input name="reg" type="image" src="img/btn-registrar.gif" data-theme="b" /></div>
                                        <div style="width:60px; height: 25px;border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                    </div>
                                     </form> 
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