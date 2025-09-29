<?php
session_start();
require("conexion.php");
require("ordenar.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" integrity="sha384-tViUnnbYAV00FLIhhi3v/dWt3Jxw4gZQcNoSCxCIFNJVCx7/D55/wXsrNIRANwdD" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/confirmar-borrado.js"></script>
</head>

<body>

  <div id="principal">

    <div class="card">

      <div id="titulo">
        <h1 class="text-center">Actuaciones y obras</h1>
      </div>

      <?php
      $accion = $_POST["accion"] ?? "";
      $idObra = $_POST["id_obra"] ?? "";
      $titulo = $_POST["titulo"] ?? "";
      $anio = $_POST["anio"] ?? "";
      $compositor = $_POST["compositor"] ?? "";
      $libretista = $_POST["libretista"] ?? "";
      $idObraAntiguo = $_POST["id_obraAntiguo"] ?? "";

      if (!empty($_SESSION["error"])) {
        $error = $_SESSION["error"]; // Guardamos el valor
        unset($_SESSION["error"]);
        echo '<script>alert("' . addslashes($error) . '");</script>';
      }


      // Listado de clientes //////////////////////////////////////////////////
      $consultaObra = mysqli_query($conexion, "SELECT id_obra, titulo, anio, compositor, libretista FROM obra ORDER BY $order");
      
      ?>

      <table class="table table-striped">
        <tr>
          <th><a href="?orderby=dni">Título ⬆</a></th>
          <th><a href="?orderby=nombre">Año ⬆</a></th>
          <th><a href="?orderby=direccion">Compositor ⬆</a></th>
          <th><a href="?orderby=dni">Letrista ⬆</a></th>
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
                <td><input type="hidden" name="idObra" value="<?= $registro["id_obra"] ?>"></td>
                <td>
                  <input type="hidden" name="idObraAntiguo" value="<?= $registro["id_obraAntiguo"] ?>">
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
                  <button  onclick="return confirmarBorrado('<?= $registro['id_obra'] ?>')"
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
                  <input type="hidden" name="idObra" value="<?= $registro["id_obra"] ?>">
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
              <td><input type="text" name="anio" required></td>
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
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</script>

</html>