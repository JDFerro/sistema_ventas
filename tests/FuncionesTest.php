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
    
    function verificarPassword($userId, $password) {
        global $select;
    
        // Suponemos que el query devuelve el usuario y la contraseña hasheada
        $resultado = $select("SELECT password FROM usuarios WHERE id = $userId");
    
        if (!empty($resultado)) {
            // Si la contraseña es correcta, devolver true
            return password_verify($password, $resultado[0]->password); // Compara la contraseña ingresada con el hash
        }
    
        return false; // Si no hay resultados, devolvemos false
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
    public function mockSelectFunction($resultadoEsperado) {
        global $select;
        $select = function ($query) use ($resultadoEsperado) {
            return $resultadoEsperado;
        };
    }
    


// Mock para la función verificarPassword
private function mockVerificarPasswordFunction($resultadoEsperado) {
    global $verificarPassword; // Aseguramos que $verificarPassword esté en el alcance global
    $verificarPassword = function ($password, $hash) use ($resultadoEsperado) {
        return $resultadoEsperado; // Simulamos que la contraseña siempre es correcta (true)
    };
}

    
    // Mock para la función editar
    private function mockEditarFunction($resultado) {
        // Sobrescribimos la función editar

    }

    // Mock para la función insertar
    private function mockInsertarFunction($resultado) {
        // Sobrescribimos la función insertar

    }
}