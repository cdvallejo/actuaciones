<?php
$host = "db";
$user = "root";
$password = "test";
$bbdd = "teatro_lirico";

$conexion = mysqli_connect($host, $user, $password, $bbdd);
if (!$conexion) {
    die("Error al conectar con la base de datos");
}
