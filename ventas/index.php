<?php
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";
session_start();
if(empty($_SESSION['usuario'])) header("location: login.php");

$cartas = [
    ["titulo" => "Total ventas", "icono" => "fa fa-money-bill", "total" => "$".number_format(obtenerTotalVentas(), 0, ',', '.'), "color" => "#A71D45"],
    ["titulo" => "Ventas hoy", "icono" => "fa fa-calendar-day", "total" => "$".number_format(obtenerTotalVentasHoy(), 0, ',', '.'), "color" => "#2A8D22"],
    ["titulo" => "Ventas semana", "icono" => "fa fa-calendar-week", "total" => "$".number_format(obtenerTotalVentasSemana(), 0, ',', '.'), "color" => "#223D8D"],
    ["titulo" => "Ventas mes", "icono" => "fa fa-calendar-alt", "total" => "$".number_format(obtenerTotalVentasMes(), 0, ',', '.'), "color" => "#D55929"],
];
 
$totales = [
    ["nombre" => "Total productos", "total" => number_format(obtenerNumeroProductos(), 0, ',', '.'), "imagen" => "img/productos.png"],
    ["nombre" => "Ventas registradas", "total" => number_format(obtenerNumeroVentas(), 0, ',', '.'), "imagen" => "img/ventas.png"],
    ["nombre" => "Usuarios registrados", "total" => number_format(obtenerNumeroUsuarios(), 0, ',', '.'), "imagen" => "img/usuarios.png"],
    ["nombre" => "Clientes registrados", "total" => number_format(obtenerNumeroClientes(), 0, ',', '.'), "imagen" => "img/clientes.png"],
];

$ventasUsuarios = obtenerVentasPorUsuario();
$ventasClientes = obtenerVentasPorCliente();
$productosMasVendidos = obtenerProductosMasVendidos();
?>

<div class="container">
    <div class="alert alert-info" role="alert">
        <h1>
            Hola, <?= $_SESSION['usuario']?>
        </h1>
    </div>
    <div class="card-deck row mb-2">
        <?php foreach($totales as $total){?>
        <div class="col-xs-12 col-sm-6 col-md-3" >
            <div class="card text-center">
                <div class="card-body">
                    <img class="img-thumbnail" src="<?= $total['imagen']?>" alt="">
                    <h4 class="card-title" >
                        <?= $total['nombre']?>
                    </h4>
                    <h2><?= $total['total']?></h2>
                </div>
            </div>
        </div>
        <?php }?>
    </div>

    <?php include_once "cartas_totales.php"?>

    <div class="row mt-2">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Ventas por usuarios</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre usuario</th>
                                <th>Número ventas</th>
                                <th>Total ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ventasUsuarios as $usuario) {?>
                                <tr>
                                    <td><?= $usuario->usuario?></td>
                                    <td><?= number_format($usuario->numeroVentas, 0, ',', '.');?></td>
                                    <td>$<?= number_format($usuario->total, 0, ',', '.');?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4>Ventas por clientes</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre cliente</th>
                                <th>Número compras</th>
                                <th>Total ventas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($ventasClientes as $cliente) {?>
                                <tr>
                                    <td><?= $cliente->cliente?></td>
                                    <td><?= number_format($cliente->numeroCompras, 0, ',', '.');?></td>
                                    <td>$<?= number_format($cliente->total, 0, ',', '.');?></td>
                                </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <h4>10 Productos más vendidos</h4>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Unidades vendidas</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productosMasVendidos as $producto) {?>
            <tr>
                <td><?= $producto->nombre?></td>
                <td><?= number_format($producto->unidades, 0, ',', '.');?></td>
                <td>$<?= number_format($producto->total, 0, ',', '.');?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
</div>    
