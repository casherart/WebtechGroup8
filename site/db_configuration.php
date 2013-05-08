<?php
// die Konstanten auslagern in eigene Datei
// die dann per require_once ('konfiguration.php'); 
// geladen wird.
 
// Damit alle Fehler angezeigt werden
error_reporting(E_ALL);

if ($_SERVER['HTTP_HOST'] == "localhost:8888") 
{
    // local
    define ('MYSQL_HOST','localhost');
    define ('MYSQL_USER','root');
    define ('MYSQL_PW','root');
    define ('MYSQL_DB','seapal');
} 
else
{
    define ('MYSQL_HOST','rdbms.strato.de');
    define ('MYSQL_USER','U1323276');
    define ('MYSQL_PW','seapal2711');
    define ('MYSQL_DB','DB1323276');
}
?>


