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
    <h1>Ver pregunta</h1>
    <?php var_dump($this->pregunta); ?>
    <?php if($this->pregunta->creador_id == $_SESSION["id"]) 
    { ?>
        <a href="<?php echo constant("URL") . "preguntas/editar/". $this->pregunta->id ?>">Editar pregunta</a>
    <?php } ?>

    <h3>Responder:</h3>
    <a href="<?php echo constant("URL") . "respuestas/crear/" .$this->pregunta->id ?>">Responder</a>
    <hr>
    <h4>Respuestas:</h4>
    <?php foreach($this->respuestas as $respuesta)
    { ?>
        <?php var_dump($respuesta) ?>
        <a href="<?php echo constant("URL") . "respuestas/crear/" .$this->pregunta->id . "/" . $respuesta->id ?>">Citar</a>
        <a href="<?php echo constant("URL") . "respuestas/marcar/" . $respuesta->id ?>">Marcar como aceptada</a>
    <?php } ?>
    <?php require_once("views/footer.php");?>
</body>
</html>