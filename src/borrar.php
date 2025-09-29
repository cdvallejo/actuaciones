
<?php
require("conexion.php");

$idObra = $_POST["idObra"];

// Borra una obra con un determinado id
// DELETE FROM obra WHERE dni="12345"

$borrado = "DELETE FROM obra WHERE id_obra='$idObra'";
mysqli_query($conexion, $borrado);

header('Location: index.php');
