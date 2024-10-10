<?php
include_once "encabezado.php";
?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="row shadow-lg" style="max-width: 500px; width: 100%;">
        <div class="col-md-12 bg-white p-4 text-center">

            <img src="logo_princi.png" class="img-fluid mb-2" alt="Logo" style="max-width: 250px;">
            
            <h3 class="pb-1">Iniciar sesión</h3>
            <div>
                <form action="iniciar_sesion.php" method="post">
                    <div class="form-group pb-3">
                        <input type="text" placeholder="Usuario" class="form-control" name="usuario" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group pb-3">
                        <input type="password" placeholder="Contraseña" class="form-control" name="password" id="exampleInputPassword1">
                    </div>

                    <div class="pb-2">
                        <button type="submit" name="ingresar" class="btn btn-primary w-100 font-weight-bold mt-2">Ingresar</button>
                    </div>
                </form>
             </div>
        </div>
    </div>
</div>
