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
    <h1>Pagina Registrarse</h1>
    <?php if(isset($this->errores)) var_dump($this->errores); ?>
    <form action="<?php echo constant('URL') ?>registro/registrarse" method="POST">
        <label for="text">Nombre de usuario:</label>
        <input type="text" name="nombre">
        <br>
        <label for="email">Correo electronico:</label>
        <input type="email" name="email">
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena">
        <br>
        <label for="confirmar_contrasena">Confirmar contraseña:</label>
        <input type="password" name="confirmar_contrasena">
        <br>
        <input type="submit" value="Registrarse">
    </form>
    <?php require_once("views/footer.php");?>
</body>
</html>