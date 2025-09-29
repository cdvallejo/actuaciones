<?php

// por defecto ordena por dni
$order = 'titulo';

if (isset($_GET['orderby'])) {
    $order = $_GET['orderby'];
}

return $order;