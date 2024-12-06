
<?php
$hashedPassword = '$2y$10$eImiTXuWVxfM37uY4JANjQ==';
$password = 'password123';

if (password_verify($password, $hashedPassword)) {
    echo "La contraseña es correcta.";
} else {
    echo "La contraseña es incorrecta.";
}
?>