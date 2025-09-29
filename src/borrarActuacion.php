<?php
require("conexion.php");

$idActuacion = $_POST["id_actuacion"];

// Borra una obra con un determinado id
// DELETE FROM obra WHERE id_obra="1"

$borrado = "DELETE FROM actuacion WHERE id_actuacion='$idActuacion'";
mysqli_query($conexion, $borrado);

header('Location: index.php');
