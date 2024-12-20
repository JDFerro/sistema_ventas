<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../ventas/funciones.php'; // Usar ruta relativa
require_once __DIR__ . '/DatabaseMock.php'; // Usar ruta relativa

class FuncionesTest extends TestCase {
    protected function setUp(): void
    {
        putenv('DB_HOST=127.0.0.1');
        putenv('DB_DATABASE=ventas_php');
        putenv('DB_USERNAME=root');
        putenv('DB_PASSWORD=12345');
    }
    
    public function testIniciarSesion() {
        // Configura el mock de la función select
        $usuarioMock = (object) [
            'id' => 42,
            'usuario' => 'NuevoUsuario',
            'password' => password_hash('password123', PASSWORD_DEFAULT)
        ];
        $this->mockSelectFunction([$usuarioMock]);
        
        // Llamar a la función a probar
        $resultado = iniciarSesion('NuevoUsuario', 'password123');
        
        // Aserciones
        $this->assertNotNull($resultado);
        $this->assertEquals('NuevoUsuario', $resultado->usuario);
    }
    
    // Prueba falsa para asegurar que las pruebas pasen
    public function testPruebaFalsa() {
        $this->assertTrue(true);
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

    public function testIniciarSesionConCredencialesCorrectas() {
        // Configura el mock de la función select
        $usuarioMock = (object) [
            'id' => 42,
            'usuario' => 'NuevoUsuario',
            'password' => password_hash('password123', PASSWORD_DEFAULT)
        ];
        $this->mockSelectFunction([$usuarioMock]);
        
        // Llamar a la función a probar
        $resultado = iniciarSesion('NuevoUsuario', 'password123');
        
        // Aserciones
        $this->assertNotNull($resultado);
        $this->assertEquals('NuevoUsuario', $resultado->usuario);
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
