<?php
include_once "funciones.php";

$idVenta = isset($_GET['id']) ? $_GET['id'] : null;

if (!$idVenta) {
    die("ID de venta no proporcionado.");
}

$venta = obtenerVentaPorId($idVenta);
$productos = obtenerProductosVendidos($idVenta);

if (!$venta || !$productos) {
    die("No se encontraron datos para la venta proporcionada.");
}

header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=factura_venta_$idVenta.doc");

echo "<html><body>";
echo "<h1>Factura de Venta</h1>";
echo "<p><strong>Fecha:</strong> {$venta->fecha}</p>";
echo "<p><strong>Cliente:</strong> {$venta->cliente}</p>";
echo "<p><strong>Usuario:</strong> {$venta->usuario}</p>";
echo "<table border='1'>";
echo "<tr><th>Producto</th><th>Cantidad</th><th>Precio</th><th>Total</th></tr>";

foreach ($productos as $producto) {
    echo "<tr>";
    echo "<td>{$producto->nombre}</td>";
    echo "<td>{$producto->cantidad}</td>";
    echo "<td>{$producto->precio}</td>";
    echo "<td>" . ($producto->cantidad * $producto->precio) . "</td>";
    echo "</tr>";
}

echo "</table>";
echo "<p><strong>Total Venta:</strong> {$venta->total}</p>";
echo "</body></html>";
?>