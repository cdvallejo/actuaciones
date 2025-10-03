<?php
session_start();
require("conexion.php");

$idObra = $_POST["id_obra"];
$idActuacion = $_POST["id_actuacion"];
$lugar = $_POST["lugar"];
$fecha = $_POST["fecha"];
$idActuacionAntigua = $_POST["id_actuacion_antiguo"];

// Actualiza un cliente con un determinado DNI
// UPDATE cliente SET dni="12345", nombre="Antonio", direccion="Campanillas" WHERE dni="567"

$consulta = mysqli_query($conexion, "SELECT COUNT(*) AS id_actuacion FROM actuacion WHERE id_actuacion = '$idActuacion'");
$registro = mysqli_fetch_array($consulta);

// Esta comprobación controla que no se pueda añadir un id existente. En realidad no haría falta, pues el usuario no asigna id: la propia base de datos lo controla incremental
if (($idActuacion == $idActuacionAntigua) || ($registro["id_actuacion"] == "0")) {
  $actualizacion = "UPDATE actuacion SET id_actuacion='$idActuacion', id_obra='$idObra', lugar='$lugar', fecha='$fecha' WHERE id_actuacion='$idActuacionAntigua'";
  mysqli_query($conexion, $actualizacion);

} else if ($registro["id_obra"] == "1") { // Si existe ese dni (y no es el mismo), error: ya existe otro cliente con ese dni
  $_SESSION["error"] = "Error: Ya existe esa obra";
}

header('Location: index.php');

