<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require 'views/header.php';?>
    
    <div id="nuevo">
        <h1 class="center">Editar Alumno</h1>

        <form method="POST" action="<?php echo constant('URL') ?>consulta/editarAlumno">
        <div>
            <label for="matricula">Matricula</label>
            <input type="text" name="matricula" id="matricula" disabled value="<?php echo $this->alumno->matricula ?>">
        </div>
        <div>
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" value="<?php echo $this->alumno->nombre ?>">
        </div>
        <div>
            <label for="apellido">Apellido</label>
            <input type="text" name="apellido" id="apellido" value="<?php echo $this->alumno->apellido ?>">
        </div>
        <input type="submit" value="Editar">
        </form>
        <span>
            <?php echo $this->mensaje?>
        </span>
    </div>

    <?php require 'views/footer.php' ?>
</body>
</html>