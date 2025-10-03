<?php
session_start();
require("conexion.php");

$idObra = $_POST["id_obra"];
$titulo = $_POST["titulo"];
$compositor = $_POST["compositor"];
$libretista = $_POST["libretista"];
$anio = $_POST["anio"];
$idObraAntiguo = $_POST["id_obra_antiguo"];

// Actualiza un cliente con un determinado DNI
// UPDATE cliente SET dni="12345", nombre="Antonio", direccion="Campanillas" WHERE dni="567"

$consulta = mysqli_query($conexion, "SELECT COUNT(*) AS id_obra FROM obra WHERE id_obra = '$idObra'");
$registro = mysqli_fetch_array($consulta);

// Esta comprobación controla que no se pueda añadir un id existente. En realidad no haría falta, pues el usuario no asigna id: la propia base de datos lo controla incremental
if (($idObra == $idObraAntiguo) || ($registro["id_obra"] == "0")) {
  $actualizacion = "UPDATE obra SET titulo='$titulo', anio='$anio', compositor='$compositor', libretista='$libretista' WHERE id_obra='$idObraAntiguo'";
  mysqli_query($conexion, $actualizacion);

} else if ($registro["id_obra"] == "1") { // Si existe ese dni (y no es el mismo), error: ya existe otro cliente con ese dni
  $_SESSION["error"] = "Error: Ya existe esa obra";
}

header('Location: index.php');

