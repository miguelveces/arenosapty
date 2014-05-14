<?php
session_start();
header('Content-Type: application/json');
try {   
    if (!isset($_SESSION['mensaje'])) {
        $mensaje = "Existe un problema con el navegador";
    } else
        $mensaje = $_SESSION['mensaje'];
    if (!isset($_SESSION['capitan'])) {
        $capitan = 0;
    } else
        $capitan = $_SESSION['capitan'];
    
    
    $armaJson = array("capitan" => $capitan, "valor" => $mensaje);
    if (isset($_GET['callback'])) { // Si es una petición cross-domain
        echo $_GET['callback'] . '(' . json_encode($armaJson) . ')';
    } else // Si es una normal, respondemos de forma normal
        echo json_encode($armaJson);
} catch (Exception $e) {
    echo '{"error":{"text":' . $e->getMessage() . '}}';
}