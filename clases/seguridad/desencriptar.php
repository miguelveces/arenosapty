<?php
ob_start();
/**
 * Esta Clase se utilizara para desencriptar 
 * los datos que se hayan encriptado.
 *  
 * @author Miguel Veces
 */
class desencriptar {

    public function desencriptar_dato($valor_encriptado, $key) {
        $result = '';
        $valor_encriptado = base64_decode($valor_encriptado);
        for ($i = 0; $i < strlen($valor_encriptado); $i++) {
            $char = substr($valor_encriptado, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char = chr(ord($char) - ord($keychar));
            $result.=$char;
        }
        return $result;
    }

}
