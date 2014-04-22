<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase utilizada para cerrar la sesion de una persona
 *
 * @author Miguel Veces
 */

$salir = new logout2();
$salir->cerrar_sesion();
class logout2 {
       
    public function cerrar_sesion() {
        //Crear sesión
        session_start();
       
        require_once('../procesos/auditoria.php');
         $auditar = new auditoria();
                    $auditar->insertar_auditoria($_SESSION['usuarios'], 
                            "login", "usuarios", "El usuario acaba de cerrar sesion");
                     //Vaciar sesión
        $_SESSION = array();
        //Destruir Sesión
        session_destroy();
        //Redireccionar a login.php
        header("location: ../../login.php");
    }

}
