<?php
session_start();
require("conexion.php");

$id_obra = $_POST["id_obra"];
$lugar = $_POST["lugar"];
$fecha = $_POST["anio"];

$insercion = "INSERT INTO actuacion (`id_obra`, `lugar`, `fecha`) 
              VALUES ('$id_obra', '$lugar', '$fecha')";
mysqli_query($conexion, $insercion);

header('Location: index.php');
