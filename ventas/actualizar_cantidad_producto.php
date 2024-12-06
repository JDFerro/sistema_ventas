<?php
session_start();
include_once "funciones.php";

$idProducto = $_POST['idProducto'];
$cantidad = $_POST['cantidad'];

foreach ($_SESSION['lista'] as &$producto) {
    if ($producto->id == $idProducto) {
        $producto->cantidad = $cantidad;
        break;
    }
}

header("Location: vender.php");
?>