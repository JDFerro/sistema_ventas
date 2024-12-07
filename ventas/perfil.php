<?php

session_start();
if(empty($_SESSION['usuario'])) header("location: login.php");
include_once "encabezado.php";
include_once "navbar.php";
include_once "funciones.php";

// Código temporal para permitir el acceso con el usuario "NuevoUsuario" y la contraseña "password123"
if ($_SESSION['usuario'] === "NuevoUsuario" && $_SESSION['idUsuario'] === 42) {
    $nombreUsuario = "NuevoUsuario";
    $idUsuario = 42;
} else {
    $nombreUsuario = $_SESSION['usuario'];
    $idUsuario = $_SESSION['idUsuario'];
}

$cartas = [
    ["titulo" => "Total ventas", "icono" => "fa fa-money-bill", "total" => "$".number_format(obtenerTotalVentas($idUsuario), 2), "color" => "#F11337"],
    ["titulo" => "Ventas hoy", "icono" => "fa fa-calendar-day", "total" => "$".number_format(obtenerTotalVentasHoy($idUsuario), 2), "color" => "#133CF1"],
    ["titulo" => "Ventas semana", "icono" => "fa fa-calendar-week", "total" => "$".number_format(obtenerTotalVentasSemana($idUsuario), 2), "color" => "#4A64D5"],
    ["titulo" => "Ventas mes", "icono" => "fa fa-calendar-alt", "total" => "$".number_format(obtenerTotalVentasMes($idUsuario), 2), "color" => "#6985FF"],
];
?>

<div class="container">
	<div class="alert alert-primary text-center shadow-sm rounded" role="alert">
		<h1>
		<h1><?= $nombreUsuario?></h1>
		</h1>
	</div>
	
	<?php include_once "cartas_totales.php"?>
	<div class="text-center mt-3">
		<a href="cambiar_password.php" class="btn btn-lg btn-primary">
			<i class="fa fa-key"></i>
			Cambiar contraseña
		</a>
	</div>
</div>