<?php ob_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <META http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>PTY Lotto</title>
        <link rel="stylesheet" href="css/style.css">
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
        session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
//esta instruccion debe ir al iniscio de cada pagina
        if (!isset($_SESSION['usuarios'])) {
            header('Location: login.php');
            exit();
        }
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


                <td background="img/bkg_2.jpg"  style=" vertical-align: top; padding-top: 35px ">

                    <table  align="center" width="656"  border="0" cellpadding="0" cellspacing="0" style="background-image: url(img/registro-tarjeta.jpg);background-repeat: no-repeat; background-size: 656px 96px">


                        <tr>
                            <td  style=" vertical-align: top; padding-top:60px"  width="656px">
                                <div>
                                    <form name="registrotarjeta" action="" method="POST"> 
                                        <div>
                                            <div >
                                                <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Nombre de usuario</label></div>
                                                <div style="width:60px; height: 25px;border: 0px solid;margin-right:225px; float:right;padding-bottom:6px"></div>
                                            </div>

                                            <div>
                                                <div style="border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><input type="text" name="nombre"readonly=”readonly” value="<?php echo $_SESSION['usuarios'] ?>" style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 578px; height: 25px;background-color:#e6e6e6"></div>
                                            </div> 

                                            <div>
                                                <div style="width:70px; border: 0px solid;margin-left:35px; float:left;padding-bottom:6px" ><label for="numero" style="height: 25px; font-size:12px; font-family: arial; font-weight: bold; color:#666666">Cedula</label></div>
                                                <div style="border: 0px solid;margin-right:237px; float:right;padding-bottom:6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Telefono</label>  </div>
                                            </div>

                                            <div>
                                                <div style="border: 0px solid; margin-left:35px;float:left;padding-bottom: 6px" ><input type="text" name="cedula"  readonly=”readonly” style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                                <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:6px" ><input type="text" name="telefono" readonly=”readonly” style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>                    
                                            </div>

                                            <div >
                                                <div style="border: 0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Numero de tarjeta</label></div>
                                                <div style="border: 0px solid;margin-right:180px; float:right;padding-bottom:6px"><label  style="height: 25px;font-size:12px; font-family: arial; font-weight: bold; color:#666666">Codigo verificador</label></div>
                                            </div>

                                            <div >
                                                <div style="border:0px solid; margin-left:35px; float:left;padding-bottom: 6px" ><input type="int" name="tarjeta" id="notarje" class="form-input-corto" required  style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6" ></input></div>
                                                <div style="border: 0px solid;margin-right:45px; float:right;padding-bottom:20px" ><input  type="int" name="codverifi" class="form-input-corto" required style="border-right: 1px solid #e6e6e6;border-bottom: 1px solid #e6e6e6;border-left: 1px solid #bfbfbf;border-top: 1px solid #bfbfbf;width: 240px; height: 25px;background-color:#e6e6e6"></div>
                                            </div>


                                            <div style="border: 0px solid;">
                                                <div style="margin-left:35px;border: 0px solid;padding-bottom: 6px;padding-top:20px;float: left" ><input type="image" src="img/btn-aceptar.gif" data-theme="b"  /></div>
                                                <div style="margin-left:35px;border: 0px solid; padding-bottom: 6px; margin-top: 20px;float: left " ><input type="image" src="img/btn-borrar.gif" data-theme="b" onclick = "this.form.action = 'login.php'" /></div>
                                                <div style="margin-left:35px;border: 0px solid; padding-bottom: 6px; margin-top: 20px;float: left " ><input type="image" src="img/btn-regresar.gif" data-theme="b" onclick = "this.form.action = 'registrar_numero'" /></div>
                                            </div>
                                        </div>
                                    </form> 

                                </div>
                            </td> 

                        </tr>
                        <tr>
                            <td>

                                <div>
                                    <?php
                                    include('clases/formularios/consultandoTarjetas.php');
                                    $consultaTar = new consultandoTarjetas();
                                    $consultaTar->muestra_tarjetas_usuario();
                                    ?>  
                                </div>
                            </td>
                        </tr>
                        <tr>
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

        <?php
        if (isset($_POST['crear'])) {
            require_once './clases/formularios/verifica_e_InsertaTarjeta.php';
            $consultaTar2 = new verifica_e_InsertaTarjeta();
            $consultaTar2->valida_tarjetas_usuario($_POST['tarjeta'], $_POST['codverifi']);
            echo '<div>' . $consultaTar2->mensaje . '</div>';
        }
        ?>


    </body>
</html>


