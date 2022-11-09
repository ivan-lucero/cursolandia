<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href= "<?php echo constant('URL')?>public/css/default.css">
    <title></title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo constant('URL')?>">Cursolandia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo constant('URL')?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo constant('URL')?>cursos">Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo constant('URL')?>miscursos">Mis cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo constant('URL')?>cuentapro">Cuenta Pro</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo constant('URL')?>notificaciones">Notificaciones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo constant('URL')?>perfil">Perfil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo constant('URL')?>login/cerrarSesion">Salir</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

</body>
</html>