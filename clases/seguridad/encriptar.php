<?php

/**
 * Esta Clase se utilizara para desencriptar 
 * los datos que se hayan encriptado.
 *  
 * @author Miguel Veces
 */
class encriptar {

    function encriptar_dato($valor_a_encriptar, $key) {
        $resultado = '';
        for ($i = 0; $i < strlen($valor_a_encriptar); $i++) {
            $char = substr($valor_a_encriptar, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) + ord($keychar));
            $resultado.=$char;
        }
        return base64_encode($resultado);
    }

}
