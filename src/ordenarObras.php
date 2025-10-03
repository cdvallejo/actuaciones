<?php
// por defecto ordena por título
$orderObras = 'titulo';

if (isset($_GET['orderbyObras'])) {
    $orderObras = $_GET['orderbyObras'];
}

return $orderObras;