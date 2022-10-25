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
    <h1>Pagina Iniciar sesion</h1>
    <?php if(isset($this->errores)) var_dump($this->errores); ?>
    <form action="<?php echo constant('URL') ?>login/iniciarSesion" method="POST">
        <label for="email">Correo electronico:</label>
        <input type="text" name="email">
        <br>
        <label for="contrasena">Contraseña:</label>
        <input type="password" name="contrasena">
        <br>
        <input type="submit" value="Ingresar">
    </form>
    <?php require_once("views/footer.php");?>
</body>
</html>