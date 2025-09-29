<?php

// por defecto ordena por dni
$orderActuaciones = 'titulo';

if (isset($_GET['orderby'])) {
    $orderActuaciones = $_GET['orderby'];
}

return $orderActuaciones;