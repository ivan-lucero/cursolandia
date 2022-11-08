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
    <h1>Crear respuesta</h1>
    <h4>Respuesta citada:</h4>
    <?php if(isset($this->respuesta_citada)) var_dump($this->respuesta_citada); ?>

    <form action="<?php echo constant("URL") . "respuestas/crearRespuesta/" .$this->pregunta->id; if(isset($this->respuesta_citada)) echo "/". $this->respuesta_citada->id ?>" method="POST">
        <textarea name="contenido" placeholder="escribir respuesta..."></textarea>
        <input type="submit" value="Enviar">
    </form>

    <?php require_once("views/footer.php");?>
</body>
</html>