<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Crear pregunta</h1>
    <?php require_once("views/header.php");?>
    <form action="<?php echo constant("URL") . "preguntas/crearPregunta/". $this->curso_id . "/" . $_SESSION["id"] ?>" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo">
        <label for="titulo">Contenido:</label>
        <textarea name="contenido"></textarea>
        <input type="submit" value="Crear pregunta">
    </form>
    <?php require_once("views/footer.php");?>
</body>
</html>