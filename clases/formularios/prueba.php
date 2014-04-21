<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of prueba
 *
 * @author NCN00973
 */

class prueba {
    private $persona, $codigoTar, $codverifi;
    public function prueba1($valor1, $valor2){
        $this->codigoTar = $valor1;//strip_tags($_POST["tarjeta"]);
        $this->codverifi = $valor2;//strip_tags($_POST['codverifi']);
        $this->persona =   $this->codigoTar . $this->codverifi;
       // header("Location: ../../Registro_Tarjeta.php");
    }
      public function __get($propiedad) {
            if(isset($this->$propiedad)) {
                return $this->$propiedad;
            }

            return null;
        }
}
