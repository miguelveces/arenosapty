<?php
 
echo "Requested URL is: ".$_SERVER['REQUEST_URI']."<BR>";
 
echo "Which URL: ".$_SERVER['PHP_SELF']."<BR>";
 
echo " Get IP Address: ".$_SERVER['SERVER_ADDR']."<BR>";
 
echo "Server Name: ".$_SERVER['SERVER_NAME']."<BR>";
 
echo "Request Timeout: ".$_SERVER['REQUEST_TIME']."<BR>";
 
echo "Document root (Physical path): ".$_SERVER['DOCUMENT_ROOT']."<BR>";
 
echo "Script (Physical path): ".$_SERVER['SCRIPT_FILENAME']."<BR>";
 
echo "Server Admin: ".$_SERVER['SERVER_ADMIN']."<BR>";
 
echo "Server Port: ".$_SERVER['SERVER_PORT']."<BR>";

echo "server host: ".$_SERVER['HTTP_HOST']."<BR>";
 
?>