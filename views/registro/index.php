<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php require_once("views/header-invitado.php");?>

    <main class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <form class="bg-light w-50 p-5 border rounded" action="<?php echo constant('URL') ?>registro/registrarse" method="POST">
            <h1 class="mb-5 text-center">Registrarse</h1>    
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
                <?php if(isset($this->errores["nombre"])) echo "<span class='text-danger'> ". $this->errores["nombre"] ."</span>" ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
                <?php if(isset($this->errores["email"])) echo "<span class='text-danger'> ". $this->errores["email"] ."</span>" ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" class="form-control" id="exampleInputPassword1">
                <?php if(isset($this->errores["contrasena"])) echo "<span class='text-danger'> ". $this->errores["contrasena"] ."</span>" ?>
            </div>
            <div class="mb-3">
                <label for="confirmar_contrasena" class="form-label">Confirmar Contraseña</label>
                <input type="password" name="confirmar_contrasena" class="form-control" id="confirmar_contrasena">
            </div>
            <button type="submit" class="btn mt-3 w-100 btn-primary">Registrarse</button>
        </form>
    </main>

    <?php require_once("views/footer.php");?>
</body>
</html>