/* 
 * En este archivo se guardara la parte dinamica de JS que sea referente al index.
 */
$(function() {
    $( "#dialog" ).dialog();
    
    var myvar = decodeURIComponent("<?php   require_once '../clases/formularios/verifica_e_InsertaTarjeta.php';\n\
$var = new verifica_e_InsertaTarjeta();\n\
$var2= $var->mensaje; \n\
echo rawurlencode($var2); \n\
?>");
    alert (myvar);
  });