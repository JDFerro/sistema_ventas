<?php
include_once "funciones.php";

$usuario = "NuevoUsuario";
$nuevaPassword = "nueva_contraseña_segura";

if (actualizarPasswordUsuario($usuario, $nuevaPassword)) {
    echo "Contraseña actualizada exitosamente.";
} else {
    echo "Error al actualizar la contraseña.";
}
?>