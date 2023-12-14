<?php
$serverName = "servidor";
$connectionOptions = array(
    "Database" => "baseDeDatos",
    "Uid" => "Usuario",
    "PWD" => "Contraseña"
);
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>
