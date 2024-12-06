<?php  
    ob_start();
    include_once "funciones.php";
    session_start();
    if (!isset($_SESSION['lista'])) {
        $_SESSION['lista'] = [];
    }
    if(isset($_POST['agregar'])){
        if(isset($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            $producto = obtenerProductoPorCodigo($codigo);
            if(!$producto) {
                echo "
                <script type='text/javascript'>
                    window.location.href='vender.php'
                    alert('No se ha encontrado el producto')
                </script>";
                return;
            }
            
            $_SESSION['lista'] = agregarProductoALista($producto,  $_SESSION['lista']);
            unset($_POST['codigo']);
            header("location: vender.php");
            exit();
        }
    }
ob_end_flush();
?>