<?php
ob_start();
/**
 * Clase que envia los correos a los usuarios
 *
 * @author NCN00973
 */
class envia_correo {

    public function enviarCorreo() {
        $destinatario = "mveces8@gmail.com";
        $asunto = "Nuevo Cliente, Cotizacion";
        $youremail = "mveces8@gmail.com"; // trim(htmlspecialchars($_POST['your_email']));
        $yourname = "mveces8@gmail.com"; // stripslashes(strip_tags($_POST['your_name']));
        //$yourmessage = "mveces8@gmail.com"; //stripslashes(strip_tags($_POST['your_message']));

//$cuerpo = ' <html>  <head> <title>Bienvenido a PTYLOTTO</title> </head> <body> <h1>Cotizacion!</h1> <p> <b>'
                //. $mensaje .' </b>. ' . $yourmessage . '</p> </body> </html> ';
        $cuerpo = ' <html>  <head> <title></title> </head> <body> '. $mensaje .' </body> </html> ';
        
//para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente 
        $headers .= "From:  " . $yourname . " <" . $youremail . ">\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente 
        $headers .= "Reply-To: mveces8@gmail.com\r\n";

//ruta del mensaje desde origen a destino 
        $headers .= "Return-path: mveces8@gmail.com\r\n";

//direcciones que recibián copia 
        $headers .= "Cc: mveces8@gmail.com\r\n";

//direcciones que recibirán copia oculta 
        $headers .= "Bcc:mveces8@gmail.com,mveces8@gmail.com\r\n";

        mail($destinatario, $asunto, $cuerpo, $headers);
    }

    
        public function enviar_Correo_confirmacion($correo, $mensaje) {
        $destinatario = $correo;
        $asunto = "Completa tu registro en PTY Lotto";
        $youremail = $correo; // trim(htmlspecialchars($_POST['your_email']));
        $yourname = $correo; // stripslashes(strip_tags($_POST['your_name']));
        //$yourmessage = $correo; //stripslashes(strip_tags($_POST['your_message']));

        //$cuerpo = ' <html>  <head> <title>Bienvenido a PTY LOTTO</title> </head> <body> <h1>Cotizacion!</h1> <p> <b>'
                //. $mensaje .' </b>. ' . $yourmessage . '</p> </body> </html> ';
        $cuerpo = ' <html>  <head> <title></title> </head> <body> '. $mensaje .' </body> </html> ';

//para el envío en formato HTML 
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente 
        $headers .= "From: Atención al Cliente de PTY Lotto <" . $youremail . ">\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente 
        $headers .= "Reply-To: mveces8@gmail.com\r\n";

//ruta del mensaje desde origen a destino 
        $headers .= "Return-path: mveces8@gmail.com\r\n";

//direcciones que recibián copia 
        $headers .= "Cc: mveces8@gmail.com\r\n";

//direcciones que recibirán copia oculta 
        $headers .= "Bcc:mveces8@gmail.com,mveces8@gmail.com\r\n";

        mail($destinatario, $asunto, $cuerpo, $headers);
    }
     public function enviar_Correo_contrasenia($correo, $mensaje) {
        $destinatario = $correo;
        $asunto = "Tu contraseña PTY Lotto";
        $youremail = $correo; // trim(htmlspecialchars($_POST['your_email']));
        $yourname = $correo; // stripslashes(strip_tags($_POST['your_name']));
        //$yourmessage = $correo; //stripslashes(strip_tags($_POST['your_message']));

        //$cuerpo = ' <html>  <head> <title>Bienvenido a PTY LOTTO</title> </head> <body> <h1>Cotizacion!</h1> <p> <b>'
                //. $mensaje .' </b>. ' . $yourmessage . '</p> </body> </html> ';
        $cuerpo = ' <html>  <head> <title></title> </head> <body> '. $mensaje .' </body> </html> ';

//para el envío en formato HTML 

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers

$headers .= 'From:Atención al Cliente de PTY Lotto <' . $youremail . '>' . "\r\n";
$headers .= 'Reply-To: mveces8@gmail.com' . "\r\n";
$headers .= 'Return-path: mveces8@gmail.com'."\r\n";
$headers .= 'Cc:  mveces8@gmail.com' . "\r\n";
$headers .= 'Bcc:mveces8@gmail.com,mveces8@gmail.com' . "\r\n";
       // $headers = "MIME-Version: 1.0\r\n";
        //$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
//dirección del remitente 
        //$headers .= "From: Atención al Cliente de PTY Lotto <" . $youremail . ">\r\n";
//dirección de respuesta, si queremos que sea distinta que la del remitente 
       //$headers .= "Reply-To: mveces8@gmail.com\r\n";
//ruta del mensaje desde origen a destino 
        //$headers .= "Return-path: mveces8@gmail.com\r\n";
//direcciones que recibián copia 
        //$headers .= "Cc: mveces8@gmail.com\r\n";
//direcciones que recibirán copia oculta 
        //$headers .= "Bcc:mveces8@gmail.com,mveces8@gmail.com\r\n";

        mail($destinatario, utf8_decode($asunto),  utf8_decode($cuerpo),  utf8_decode($headers));
    }
}