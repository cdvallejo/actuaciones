// Confirma el borrado antes de mandar la info a borrar.php

function confirmarBorrado(titulo) {
  return confirm("¿Seguro que quieres borrar la obra " + titulo + "?");
}