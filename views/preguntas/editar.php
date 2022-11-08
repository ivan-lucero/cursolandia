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
    <h1>Editar pregunta</h1>
    <?php var_dump($this->pregunta); ?>

    <form action="<?php echo constant("URL") . "preguntas/editarPregunta/". $this->pregunta->id ?>" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?php echo $this->pregunta->titulo; ?>">
        <label for="titulo">Contenido:</label>
        <textarea name="contenido"><?php echo $this->pregunta->contenido ?></textarea>
        <input type="submit" value="Editar pregunta">
    </form>
    <?php require_once("views/footer.php");?>
</body>
</html>