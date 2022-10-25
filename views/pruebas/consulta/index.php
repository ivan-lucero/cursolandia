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
    
    <div id="consulta" class="center">
        <h1 class="center">Consulta</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach($this->datos as $dato)
                    {
                        $alumno = new Alumno();
                        $alumno = $dato;
                ?>
                    <tr>
                        <td><?php echo $alumno->matricula?></td>
                        <td><?php echo $alumno->nombre?></td>
                        <td><?php echo $alumno->apellido?></td>
                        <td><a href="<?php echo constant('URL')."consulta/verAlumno/".$alumno->matricula; ?>">Editar</a></td>
                        <td><a href="<?php echo constant('URL')."consulta/eliminarAlumno/".$alumno->matricula; ?>">Eliminar</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <span>
            <?php echo $this->mensaje ?>
        </span>
    </div>

    <?php require 'views/footer.php' ?>
</body>
</html>