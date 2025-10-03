<?php
require("conexion.php");
require("ordenarActuaciones.php");

if (!empty($_SESSION["error"])) {
  $error = $_SESSION["error"]; // Guardamos el valor
  unset($_SESSION["error"]);
  echo '<script>alert("' . addslashes($error) . '");</script>';
}

// Listado de obras //////////////////////////////////////////////////
$consultaActuacion = mysqli_query($conexion, "SELECT a.id_actuacion, a.id_obra, o.titulo, a.lugar, a.fecha FROM actuacion a, obra o WHERE a.id_obra = o.id_obra ORDER BY $orderActuaciones");
$consultaTitulos = mysqli_query($conexion, "SELECT id_obra, titulo FROM obra ORDER BY titulo");

?>

<table class="table table-striped">
  <tr>
    <th><a href="?orderbyActuaciones=titulo">Título ⬆</a></th>
    <th><a href="?orderbyActuaciones=lugar">Lugar ⬆</a></th>
    <th><a href="?orderbyActuaciones=fecha">Fecha ⬆</a></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php

  while ($registro = mysqli_fetch_array($consultaActuacion)) {

    if (($accion == "modificar") && ($idActuacion == $registro["id_actuacion"])) {
      // Fila que queremos modificar
  ?>

      <tr class="fila-modificable">
        <form action="modificarActuacion.php" method="post">
          <td>
          <select name="id_obra" id="id_obra">
            <?php
            while ($registroTitulos = mysqli_fetch_array($consultaTitulos)) {
            ?>
              <option value="<?= $registroTitulos["id_obra"] ?>"><?= $registroTitulos["titulo"] ?></option>
            <?php
            }
            ?>
          </select>
        </td>
          <td><input type="text" name="lugar" value="<?= $registro["lugar"] ?>"></td>
          <td><input type="date" name="fecha" value="<?= $registro["fecha"] ?>"></td>
          <input type="hidden" name="id_actuacion" value="<?= $registro["id_actuacion"] ?>">
          <td></td>
          <td></td>
          <td>
            <input type="hidden" name="id_actuacion_antiguo" value="<?= $registro["id_actuacion"] ?>">
            <button type="submit" class="btn btn-success">
              <i class="bi bi-check-lg"></i>
              Aceptar
            </button>
          </td>
        </form>
        <td>
          <form action="#" method="post"> <!-- Cancelar no envía nada por post, de modo que php recarga la página -->
            <button type="submit" class="btn btn-danger">
              <i class="bi bi-x-lg"></i>
              Cancelar
            </button>
          </form>
        </td>
      </tr>
    <?php
    } else {
      // Fila normal
    ?>
      <tr>
        <td><?= $registro["titulo"] ?></td>
        <td><?= $registro["lugar"] ?></td>
        <td><?= date("d-m-Y", strtotime($registro["fecha"])) ?></td><td></td> <!-- Para que salga en formato español: d-m-Y -->
        <td>
          <!-- Formulario para borrar: redirige la acción a borrar.php -->
          <form action="borrarActuacion.php" method="post">
            <input type="hidden" name="id_actuacion" value="<?= $registro["id_actuacion"] ?>">
            <button onclick="return confirmarBorrado('<?= $registro['titulo'] ?>')"
              type="submit"
              class="btn btn-danger"
              <?= $accion == "modificar" ? "disabled" : "" ?>>
              <i class="bi bi-trash"></i>
              Borrar
            </button>
          </form>
        </td>
        <td>
          <form action="#" method="post">
            <input type="hidden" name="accion" value="modificar">
            <input type="hidden" name="id_actuacion" value="<?= $registro["id_actuacion"] ?>">
            <button
              type="submit"
              class="btn btn-primary"
              <?= $accion == "modificar" ? "disabled" : "" ?>>
              <i class="bi bi-pencil"></i>
              Modificar
            </button>
          </form>
        </td>
      </tr>
    <?php
    } // Termina if
  } // Termina while

  if ($accion != "modificar") { // Si no estamos modificando un campo se muestra la fila para añadir un cliente (lo normal)

    ?>
    <!-- tr>td*4>input -->
    <tr>
      <form action="agregarActuacion.php" method="post">
        <td>
          <select name="id_obra" id="id_obra">
            <?php
            while ($registroTitulos = mysqli_fetch_array($consultaTitulos)) {
            ?>
              <option value="<?= $registroTitulos["id_obra"] ?>"><?= $registroTitulos["titulo"] ?></option>
            <?php
            }
            ?>
          </select>
        </td>
        <td><input type="text" name="lugar" required></td>
        <td><input type="date" name="anio" required></td>
        <td></td>
        <td>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-plus"></i>
            Añadir
          </button>
        </td>
        <td></td>
      </form>
    <?php
  }
    ?>
    </tr>
</table>