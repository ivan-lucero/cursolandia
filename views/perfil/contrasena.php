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
    <h1>Cambiar contraseña</h1>
    
    <?php var_dump($this->usuario); ?>
    <br>
    <form method="POST" action="<?php echo constant('URL') ?>perfil/cambiarContrasena">
        <label for="contrasena_actual">Ingresar contraseña actual:</label>
        <input type="password" name="contrasena_actual">
        <label for="contrasena_actual">Ingresar nueva contraseña:</label>
        <input type="password" name="contrasena">
        <label for="contrasena_actual">Confirmar nueva contraseña:</label>
        <input type="password" name="confirmar_contrasena">
        <input type="submit" value="Confirmar">
    </form>
    <?php require_once("views/footer.php");?>
</body>
</html>