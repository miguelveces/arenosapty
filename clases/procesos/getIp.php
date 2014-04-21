<?php
/**
 * Clase que optiene el ip de la persona que realiza la transaccion.
 *
 * @author miguel veces
 */
//$ip = new getIp();
//$mensaje = $ip->getRealIP();
//echo $mensaje;
class getIp {
   function getRealIP() {
    //si el usuario tiene una direccion con ip compartido
       if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
    //si el usuario tiene una direccion con proxy   
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
   //de lo contrario el ip esta directo
    return $_SERVER['REMOTE_ADDR'];
}
}
