<?php
session_start();
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";


//if(empty($_SESSION['usuario'])) header("location: login.php");
$nombreProducto = (isset($_POST['nombreProducto'])) ? $_POST['nombreProducto'] : null;

$productos = obtenerProductos($nombreProducto);

$cartas = [
    ["titulo" => "No. Productos", "icono" => "fa fa-box", "total" => number_format(count($productos)), "color" => "#3578FE"],
    ["titulo" => "Total productos", "icono" => "fa fa-shopping-cart", "total" => number_format(obtenerNumeroProductos()), "color" => "#4F7DAF"],
    ["titulo" => "Total inventario", "icono" => "fa fa-money-bill", "total" => "$". number_format(obtenerTotalInventario(), 2), "color" => "#1FB824"],
    ["titulo" => "Ganancia", "icono" => "fa fa-wallet", "total" => "$". number_format(calcularGananciaProductos(), 2), "color" => "#D55929"],
];
?>
<div class="container mt-3">
    <h1>
        <a class="btn btn-success btn-lg" href="agregar_producto.php">
            <i class="fa fa-plus"></i>
            Agregar
        </a>
        Productos
    </h1>
    <?php include_once "cartas_totales.php"; ?>

    <form action="" method="post" class="input-group mb-3 mt-3">
        <input autofocus name="nombreProducto" type="text" class="form-control" placeholder="Escribe el nombre o código del producto que deseas buscar" aria-label="Nombre producto" aria-describedby="button-addon2">
        <button type="submit" name="buscarProducto" class="btn btn-primary" id="button-addon2">
            <i class="fa fa-search"></i>
            Buscar
        </button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio compra</th>
                <th>Precio venta</th>
                <th>Ganancia</th>
                <th>Existencia</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($productos as $producto){
            ?>
                <tr>
                    <td><?= $producto->codigo; ?></td>
                    <td><?= $producto->nombre; ?></td>
                    <td><?= '$'. number_format($producto->compra, 2); ?></td>
                    <td><?= '$'. number_format($producto->venta, 2); ?></td>
                    <td><?= '$'. number_format(floatval($producto->venta - $producto->compra), 2); ?></td>
                    <td><?= $producto->existencia; ?></td>
                    <td>
                        <a class="btn btn-info" href="editar_producto.php?id=<?= $producto->id; ?>">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-danger" href="eliminar_producto.php?id=<?= $producto->id; ?>">
                            <i class="fa fa-trash"></i>
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
