<?php

use PHPUnit\Framework\TestCase;

error_reporting(E_ALL);
ini_set('display_errors', 1);

class IntegracionTest extends TestCase
{
    public function testAgregarCliente()
    {
        // Iniciar sesión
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Datos del cliente a agregar
        $nombre = 'Juan';
        $telefono = '3183423251';
        $direccion = 'calle 14B';

        // Simular la solicitud POST para agregar un cliente
        $_POST['nombre'] = $nombre;
        $_POST['telefono'] = $telefono;
        $_POST['direccion'] = $direccion;

        // Llamar directamente a la función que maneja la lógica de agregar cliente
        include_once __DIR__ . '/../ventas/funciones.php';
        $resultado = registrarCliente($nombre, $telefono, $direccion);

        // Verificar que el cliente fue agregado correctamente
        $clientes = obtenerClientes(); // Asumiendo que tienes una función para obtener los clientes
        $clienteAgregado = end($clientes);

        $this->assertEquals($nombre, $clienteAgregado->nombre);
        $this->assertEquals($telefono, $clienteAgregado->telefono);
        $this->assertEquals($direccion, $clienteAgregado->direccion);

        // Limpiar datos de la sesión
        unset($_POST['nombre']);
        unset($_POST['telefono']);
        unset($_POST['direccion']);
    }

    public function testAgregarProducto()
    {
        // Iniciar sesión
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Datos del producto a agregar
        $codigo = '11111';
        $nombre = 'platonos';
        $compra = 13000;
        $venta = 15000;
        $existencia = 18;

        // Simular la solicitud POST para agregar un producto
        $_POST['codigo'] = $codigo;
        $_POST['nombre'] = $nombre;
        $_POST['compra'] = $compra;
        $_POST['venta'] = $venta;
        $_POST['existencia'] = $existencia;

        // Llamar directamente a la función que maneja la lógica de agregar producto
        include_once __DIR__ . '/../ventas/funciones.php';
        $resultado = registrarProducto($codigo, $nombre, $compra, $venta, $existencia);

        // Verificar que el producto fue agregado correctamente
        $productos = obtenerProductos(); // Asumiendo que tienes una función para obtener los productos
        $productoAgregado = end($productos);

        $this->assertEquals($codigo, $productoAgregado->codigo);
        $this->assertEquals($nombre, $productoAgregado->nombre);
        $this->assertEquals($compra, $productoAgregado->compra);
        $this->assertEquals($venta, $productoAgregado->venta);
        $this->assertEquals($existencia, $productoAgregado->existencia);

        // Limpiar datos de la sesión
        unset($_POST['codigo']);
        unset($_POST['nombre']);
        unset($_POST['compra']);
        unset($_POST['venta']);
        unset($_POST['existencia']);
    }

    public function testAgregarUsuario()
    {
        // Iniciar sesión
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Datos del usuario a agregar
        $usuario = 'carlos';
        $nombre = 'jose carlos';
        $telefono = '1234';
        $direccion = 'calle 14B';

        // Simular la solicitud POST para agregar un usuario
        $_POST['usuario'] = $usuario;
        $_POST['nombre'] = $nombre;
        $_POST['telefono'] = $telefono;
        $_POST['direccion'] = $direccion;

        // Llamar directamente a la función que maneja la lógica de agregar usuario
        include_once __DIR__ . '/../ventas/funciones.php';
        $resultado = registrarUsuario($usuario, $nombre, $telefono, $direccion);

        // Verificar que el usuario fue agregado correctamente
        $usuarios = obtenerUsuarios(); // Asumiendo que tienes una función para obtener los usuarios
        $usuarioAgregado = end($usuarios);

        $this->assertEquals($usuario, $usuarioAgregado->usuario);
        $this->assertEquals($nombre, $usuarioAgregado->nombre);
        $this->assertEquals($telefono, $usuarioAgregado->telefono);
        $this->assertEquals($direccion, $usuarioAgregado->direccion);

        // Limpiar datos de la sesión
        unset($_POST['usuario']);
        unset($_POST['nombre']);
        unset($_POST['telefono']);
        unset($_POST['direccion']);
    }

    public function testAgregarProductoVenta()
    {
        // Iniciar sesión
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Inicializar la lista de productos en la sesión
        $_SESSION['lista'] = [];

        // Datos del producto a agregar
        $codigo = '11111';
        $producto = obtenerProductoPorCodigo($codigo);

        // Verificar que el producto existe
        $this->assertNotNull($producto, "El producto no existe en la base de datos");

        // Simular la solicitud POST para agregar un producto a la venta
        $_POST['codigo'] = $codigo;
        $_POST['agregar'] = true; // Asegurarse de que el campo 'agregar' esté presente

        // Llamar directamente a la función que maneja la lógica de agregar producto a la venta
        include_once __DIR__ . '/../ventas/funciones.php';
        $_SESSION['lista'] = agregarProductoALista($producto, $_SESSION['lista']);

        // Verificar que el producto fue agregado correctamente a la lista de la sesión
        $listaProductos = $_SESSION['lista'];
        $this->assertNotEmpty($listaProductos, "La lista de productos está vacía");
        $productoAgregado = end($listaProductos);

        $this->assertEquals($producto->codigo, $productoAgregado->codigo);
        $this->assertEquals($producto->nombre, $productoAgregado->nombre);
        $this->assertEquals($producto->compra, $productoAgregado->compra);
        $this->assertEquals($producto->venta, $productoAgregado->venta);
        $this->assertEquals(1, $productoAgregado->cantidad); // Verificar que la cantidad es 1

        // Limpiar datos de la sesión
        unset($_POST['codigo']);
        unset($_POST['agregar']);
        unset($_SESSION['lista']);
    }
}