<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require 'views/header.php'; ?>
    
    <div id="nuevo">
        <h1 class="center">Nuevo</h1>

        <form method="POST" action="<?php echo constant('URL') ?>nuevo/registrarAlumno">
        <div>
            <label for="matricula">Matricula</label>
            <input type="text" name="matricula" id="matricula">
        </div>
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div>
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido">
        </div>
        <input type="submit" value="Registrar">
        </form>
        <span>
            <?php echo $this->mensaje?>
        </span>
    </div>

    <?php require 'views/footer.php' ?>
</body>
</html>