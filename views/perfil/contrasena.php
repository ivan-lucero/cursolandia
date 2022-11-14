<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once("views/header.php");?>

    <main class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <form class="bg-light w-50 p-5 border rounded" action="<?php echo constant('URL') ?>perfil/cambiarContrasena" method="POST">
            <h1 class="mb-5 text-center">Cambiar contraseña</h1>    
            <div class="mb-3">
                <label for="contrasena_actual" class="form-label">Ingresar contraseña actual</label>
                <input type="password" class="form-control" id="contrasena_actual" name="contrasena_actual" aria-describedby="contrasena_actual">
                <?php if(isset($this->errores["contrasena_actual"])) echo "<span class='text-danger'> ". $this->errores["contrasena_actual"] ."</span>" ?>
            </div>
            <div class="mb-3">
                <label for="contrasena" class="form-label">Ingresar nueva contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" aria-describedby="contrasena">
                <?php if(isset($this->errores["contrasena"])) echo "<span class='text-danger'> ". $this->errores["contrasena"] ."</span>" ?>
            </div>
            <div class="mb-3">
                <label for="confirmar_contrasena" class="form-label">Confirmar nueva contraseña</label>
                <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" aria-describedby="confirmar_contrasena">
                <?php if(isset($this->errores["email"])) echo "<span class='text-danger'> ". $this->errores["email"] ."</span>" ?>
            </div>
            
            <button type="submit" class="btn mt-3 w-100 btn-primary">Ingresar</button>
        </form>
    </main>

    <?php require_once("views/footer.php");?>
</body>
</html>