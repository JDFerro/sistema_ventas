<?php

use PHPUnit\Framework\TestCase;

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../ventas/funciones.php'; // Usar ruta relativa
require_once __DIR__ . '/DatabaseMock.php'; // Usar ruta relativa

class IntegracionTest extends TestCase
{
    protected function setUp(): void
    {
        putenv('DB_HOST=127.0.0.1');
        putenv('DB_DATABASE=ventas_php');
        putenv('DB_USERNAME=root');
        putenv('DB_PASSWORD=12345');
    }

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
        // Configurar el mock de la función insertar
        $this->mockInsertarFunction(true);

        // Configurar el mock de la función obtenerUsuarios
        $usuarioMock = (object) [
            'usuario' => 'carlos',
            'nombre' => 'jose carlos',
            'telefono' => '1234',
            'direccion' => 'calle 14B'
        ];
        $this->mockSelectFunction([$usuarioMock]);

        // Datos del usuario a agregar
        $usuario = "carlos";
        $nombre = "jose carlos";
        $telefono = "1234";
        $direccion = "calle 14B";

        // Llamar a la función a probar
        $resultado = registrarUsuario($usuario, $nombre, $telefono, $direccion);

        // Aserciones
        $this->assertTrue($resultado);

        // Verificar que el usuario fue agregado correctamente
        $usuarios = obtenerUsuarios();
        $this->assertIsArray($usuarios);
        $ultimoUsuario = end($usuarios);
        $this->assertEquals($usuario, $ultimoUsuario->usuario);
    }

    // Mock para la función select
    private function mockSelectFunction($resultado) {
        $mock = $this->getMockBuilder(DatabaseMock::class)
                     ->onlyMethods(['select'])
                     ->getMock();
        $mock->method('select')
             ->willReturn($resultado);
        $GLOBALS['select'] = $mock;
    }

    // Mock para la función insertar
    private function mockInsertarFunction($resultado) {
        $mock = $this->getMockBuilder(DatabaseMock::class)
                     ->onlyMethods(['insertar'])
                     ->getMock();
        $mock->method('insertar')
             ->willReturn($resultado);
        $GLOBALS['insertar'] = $mock;
    }

    // Mock para la función obtenerUsuarios
    private function mockObtenerUsuariosFunction($resultado) {
        $mock = $this->getMockBuilder(DatabaseMock::class)
                     ->onlyMethods(['obtenerUsuarios'])
                     ->getMock();
        $mock->method('obtenerUsuarios')
             ->willReturn($resultado);
        $GLOBALS['obtenerUsuarios'] = $mock;
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