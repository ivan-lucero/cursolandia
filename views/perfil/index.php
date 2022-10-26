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
    <h1>Mi perfil</h1>
    
    <?php var_dump($this->usuario); var_dump($this->intereses); ?>
    <img src="uploads/imgs/<?php echo $this->usuario["imagen"] ?>" alt="">
    <br>
    <a href="<?php echo constant("URL")."perfil/editar" ?>">Editar perfil</a>
    <a href="<?php echo constant("URL")."perfil/contrasena" ?>">Cambiar contraseña</a>

    <div>
        <h2>Mis cursos</h2>
    </div>
    <?php require_once("views/footer.php");?>
</body>
</html>