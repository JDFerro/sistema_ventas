<?php
use PHPUnit\Framework\TestCase;


require_once 'c:/xampp/htdocs/sistema_ventas/ventas/funciones.php'; // 

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
        // Configurar el mock de la función insertar
        $this->mockInsertarFunction(true);
        
        // Llamar a la función a probar
        $resultado = registrarUsuario("nuevo_usuario", "Nombre", "123456789", "Direccion");
        
        // Aserciones
        $this->assertTrue($resultado);
    }

    // Mock para la función select
    private function mockSelectFunction($resultado) {
        // Sobrescribimos la función select
        function mockSelect($sentencia, $parametros) {
            global $resultado; // Usamos la variable global de prueba
            return $resultado;
        }
    }

    // Mock para la función verificarPassword
    private function mockVerificarPasswordFunction($resultado) {
        // Sobrescribimos la función verificarPassword
        function verificarPassword($idUsuario, $password) {
            global $resultado;
            return $resultado;
        }
    }
    
    // Mock para la función editar
    private function mockEditarFunction($resultado) {
        // Sobrescribimos la función editar
        function editar($sentencia, $parametros) {
            global $resultado;
            return $resultado;
        }
    }

    // Mock para la función insertar
    private function mockInsertarFunction($resultado) {
        // Sobrescribimos la función insertar
        function insertar($sentencia, $parametros) {
            global $resultado;
            return $resultado;
        }
    }
}
