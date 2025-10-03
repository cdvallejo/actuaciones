<?php
require("conexion.php");
require("ordenarObras.php");

if (!empty($_SESSION["error"])) {
  $error = $_SESSION["error"]; // Guardamos el valor
  unset($_SESSION["error"]);
  echo '<script>alert("' . addslashes($error) . '");</script>';
}

// Listado de obras //////////////////////////////////////////////////
$consultaObra = mysqli_query($conexion, "SELECT id_obra, titulo, anio, compositor, libretista FROM obra ORDER BY $orderObras");

?>

<table class="table table-striped">
  <tr>
    <th><a href="?orderbyObras=titulo">Título ⬆</a></th>
    <th><a href="?orderbyObras=anio">Año ⬆</a></th>
    <th><a href="?orderbyObras=compositor">Compositor ⬆</a></th>
    <th><a href="?orderbyObras=libretista">Libretista ⬆</a></th>
    <th></th>
    <th></th>
  </tr>
  <?php

  while ($registro = mysqli_fetch_array($consultaObra)) {

    if (($accion == "modificar") && ($idObra == $registro["id_obra"])) {
      // Fila que queremos modificar
  ?>

      <tr class="fila-modificable">
        <form action="modificar.php" method="post">
          <td><input type="text" name="titulo" value="<?= $registro["titulo"] ?>"></td>
          <td><input type="text" name="anio" value="<?= $registro["anio"] ?>"></td>
          <td><input type="text" name="compositor" value="<?= $registro["compositor"] ?>"></td>
          <td><input type="text" name="libretista" value="<?= $registro["libretista"] ?>"></td>
          <input type="hidden" name="id_obra" value="<?= $registro["id_obra"] ?>">
          <td>
            <input type="hidden" name="id_obra_antiguo" value="<?= $registro["id_obra"] ?>">
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
        <td><?= $registro["anio"] ?></td>
        <td><?= $registro["compositor"] ?></td>
        <td><?= $registro["libretista"] ?></td>
        <td>
          <!-- Formulario para borrar: redirige la acción a borrar.php -->
          <form action="borrar.php" method="post">
            <input type="hidden" name="idObra" value="<?= $registro["id_obra"] ?>">
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
            <input type="hidden" name="id_obra" value="<?= $registro["id_obra"] ?>">
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
      <form action="agregar.php" method="post">
        <td><input type="text" name="titulo" required></td>
        <td><input type="number" name="anio" min="1400" required></td>
        <td><input type="text" name="compositor" required></td>
        <td><input type="text" name="libretista" required></td>
        <td>
          <button type="submit" class="btn btn-success">
            <i class="bi bi-plus"></i>
            Añadir
          </button>
        </td>
      </form>
    <?php
  }
    ?>
    </tr>
</table>