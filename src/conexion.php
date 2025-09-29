<?php
$host = "db";
$user = "root";
$password = "test";
$bbdd = "teatro_lirico";

$conexion = mysqli_connect($host, $user, $password, $bbdd);
if (!$conexion) {
    die("Error al conectar con la base de datos");
}

$accion = $_POST["accion"] ?? "";

// Datos tabla actuacion
$idActuacion = $_POST["id_actuacion"] ?? "";
$idObra = $_POST["id_obra"] ?? "";
$lugar = $_POST["lugar"] ?? "";
$fecha = $_POST["fecha"] ?? "";

// Datos tabla obra
$idObra = $_POST["id_obra"] ?? "";
$titulo = $_POST["titulo"] ?? "";
$anio = $_POST["anio"] ?? "";
$compositor = $_POST["compositor"] ?? "";
$libretista = $_POST["libretista"] ?? "";
$idObraAntiguo = $_POST["id_obra_antiguo"] ?? "";
