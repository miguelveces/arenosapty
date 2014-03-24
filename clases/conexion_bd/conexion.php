<?php

/**
 * Esta clase sera utilizada para centralizar las conexiones a base de datos
 *
 * @author Miguel Veces
 */
class conexion {
    private $nombre;

            public function inicializar($nom) {
                $this->nombre = $nom;
            }

            public function imprimir() {
                echo $this->nombre;
                echo '<br>';
            }
}
