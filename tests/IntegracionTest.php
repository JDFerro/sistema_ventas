<?php

use PHPUnit\Framework\TestCase;

class IntegracionTest extends TestCase
{
    public function testAgregarCliente()
    {
        // Datos del cliente a agregar
        $nombre = 'Cliente de Prueba';
        $email = 'cliente@prueba.com';
        $telefono = '1234567890';

        // Simular la solicitud POST para agregar un cliente
        $_POST['nombre'] = $nombre;
        $_POST['email'] = $email;
        $_POST['telefono'] = $telefono;

        // Incluir el archivo que maneja la lógica de agregar cliente
        include_once __DIR__ . '/../ventas/agregar_cliente.php';

        // Verificar que el cliente fue agregado correctamente
        $clientes = obtenerClientes(); // Asumiendo que tienes una función para obtener los clientes
        $clienteAgregado = end($clientes);

        $this->assertEquals($nombre, $clienteAgregado['nombre']);
        $this->assertEquals($email, $clienteAgregado['email']);
        $this->assertEquals($telefono, $clienteAgregado['telefono']);
    }
}