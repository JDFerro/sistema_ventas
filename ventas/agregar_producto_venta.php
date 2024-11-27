<?php   
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
            
            print_r($producto);
            $_SESSION['lista'] = agregarProductoALista($producto,  $_SESSION['lista']);
            echo "Producto agregado a la lista: ";
            print_r($_SESSION['lista']); // Agregar depuración
            unset($_POST['codigo']);
            header("location: vender.php");
        }
    }

?>