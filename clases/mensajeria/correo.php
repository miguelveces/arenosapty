<?php

require_once('../../lib_php/class.phpmailer.php');
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "localhost";
$mail->From = "mveces8@gmail.com";
$mail->FromName = "Nombre del remitente del correo";
 
$numTotal=2; //número de correos diferentes a enviar
$flag=0; //bandera
$direcciones ="mveces8@gmail.com, mveces@yahoo.com";
$tabla=explode(" ", $direcciones); 
while($numTotal>0){
  $mail->AddAddress($tabla[$flag]);
  $mail->Subject = "Asunto";
  $mail->Body = 'Texto';
  $mail->WordWrap = 1200;
  if(!$mail->Send())
    echo 'Se ha producido el siguiente error: ' . $mail->ErrorInfo;
  else
    echo 'El correo electrónico se ha enviado correctamente.';
  $numTotal--;
  $flag++;
  $mail->ClearAddresses();
}