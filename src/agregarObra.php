<?php
session_start();
require("conexion.php");

$titulo = $_POST["titulo"];
$anio = $_POST["anio"];
$compositor = $_POST["compositor"];
$libretista = $_POST["libretista"];

// Añade un nuevo cliente ///////////////////////////////////////////
// INSERT INTO cliente VALUES ("1234", "Pepe", "Calle Patatín", 1234567)
//  $consulta = mysqli_query($conexion, "SELECT COUNT(*) AS id_obra FROM cliente WHERE id_obra='$idObra'");
// $registro = mysqli_fetch_array($consulta);

/*if ($registro["dni"] == "1") {
  $_SESSION["error"] = "<b>Error: Ya existe un cliente con ese DNI</b>";
} else {
  $insercion = "INSERT INTO obra VALUES ('$titulo', '$anio', '$compositor', '$libretista')";
  mysqli_query($conexion, $insercion);
}*/

$insercion = "INSERT INTO obra (`titulo`, `anio`, `compositor`, `libretista`) 
              VALUES ('$titulo', '$anio', '$compositor', '$libretista')";
mysqli_query($conexion, $insercion);

header('Location: index.php');
