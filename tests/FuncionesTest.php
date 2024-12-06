<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../ventas/funciones.php'; // Usar ruta relativa
require_once __DIR__ . '/DatabaseMock.php'; // Usar ruta relativa

class FuncionesTest extends TestCase {
    
    public function testIniciarSesion() {
        // Configura el mock de la función select
        $usuarioMock = (object) [
            'id' => 1,
            'usuario' => 'testuser'
        ];
        $this->mockSelectFunction([$usuarioMock]);
        
        // Simular la verificación de contraseña
        $this->mockVerificarPasswordFunction(true);
        
        // Llamar a la función a probar
        $resultado = iniciarSesion('testuser', 'password');
        
        // Aserciones
        $this->assertNotNull($resultado);
        $this->assertEquals('testuser', $resultado->usuario);
    }
    
    public function testVerificarPassword() {
        // Configurar el mock de la función select para devolver un hash de contraseña
        $hashedPassword = password_hash("password123", PASSWORD_DEFAULT);
        $this->mockSelectFunction([(object) ['password' => $hashedPassword]]);
        
        // Llamar a la función a probar
        $resultado = verificarPassword(1, "password123");
        
        // Aserciones
        $this->assertTrue($resultado);
    }

    public function testCambiarPassword() {
        // Configurar el mock de la función editar
        $this->mockEditarFunction(true);
        
        // Llamar a la función a probar
        $resultado = cambiarPassword(1, "nueva_password");
        
        // Aserciones
        $this->assertTrue($resultado);
    }
    
    public function testRegistrarUsuario() {
        // Datos del usuario a agregar
        $usuario = "carlos";
        $nombre = "jose carlos";
        $telefono = "1234";
        $direccion = "calle 14B";

        // Configurar el mock de la función insertar
        $this->mockInsertarFunction(true);

        // Configurar el mock de la función obtenerUsuarios
        $usuarioMock = (object) [
            'usuario' => $usuario,
            'nombre' => $nombre,
            'telefono' => $telefono,
            'direccion' => $direccion
        ];
        $this->mockSelectFunction([$usuarioMock]);

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

    // Mock para la función verificarPassword
    private function mockVerificarPasswordFunction($resultado) {
        $mock = $this->getMockBuilder(DatabaseMock::class)
                     ->onlyMethods(['verificarPassword'])
                     ->getMock();
        $mock->method('verificarPassword')
             ->willReturn($resultado);
        $GLOBALS['verificarPassword'] = $mock;
    }
    
    // Mock para la función editar
    private function mockEditarFunction($resultado) {
        $mock = $this->getMockBuilder(DatabaseMock::class)
                     ->onlyMethods(['editar'])
                     ->getMock();
        $mock->method('editar')
             ->willReturn($resultado);
        $GLOBALS['editar'] = $mock;
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
}
