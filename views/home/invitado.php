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
    
    <main class="row vh-100 vw-100 justify-content-center align-items-center">
        <div class="col-auto text-center">
            <h1>Bienvenido a Cursolandia</h1>
            <a class="btn btn-primary" href="<?php echo constant('URL')?>login">Iniciar sesion</a>
            <a class="btn btn-primary" href="<?php echo constant('URL')?>registro">Registrarse</a>
        </div>
    </main>

    <?php require_once("views/footer.php");?>
</body>
</html>