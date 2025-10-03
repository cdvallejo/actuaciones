<?php
// por defecto ordena por titulo
$orderActuaciones = 'titulo';

if (isset($_GET['orderbyActuaciones'])) {
    $orderActuaciones = $_GET['orderbyActuaciones'];
}

return $orderActuaciones;