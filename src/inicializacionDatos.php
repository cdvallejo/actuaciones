<?php
/* session_start($orderObras);
session_start($orderFunciones); */

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
