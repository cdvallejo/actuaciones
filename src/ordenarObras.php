<?php

// por defecto ordena por dni
$orderObras = 'titulo';

if (isset($_GET['orderby'])) {
    $orderObras = $_GET['orderby'];
}

return $orderObras;