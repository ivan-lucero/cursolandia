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

    <main class="container mt-5">
        <div>
            <a href=" <?php echo constant("URL")."cursos/ver/". $this->curso->id ?>"><p class="fw-bold"><?php echo $this->curso->titulo ?> </p></a> 
            <h1><?php echo $this->pregunta->titulo ?></h1>
            <p class="fw-semibold">creada por: <?php echo $this->creador["nombre"] ?> </p>
        </div>
        <p class="fs-4 mt-3"><?php echo $this->pregunta->contenido ?></p>
    
        <?php if($this->pregunta->creador_id == $_SESSION["id"] && $this->pregunta->es_concluida == 0) 
            { ?>
                <a class="btn btn-primary" href="<?php echo constant("URL") . "preguntas/editar/". $this->pregunta->id ?>">Editar pregunta</a>
        <?php } ?>
    </main>

    <section class="container my-5">
        <hr>
        <h3>Respuestas:</h3>

        <?php if($this->pregunta->es_concluida == 1) { ?>
            <p class="fs-4 fw-bold text-warning">La respuesta ha sido concluida</p>
        <?php } 
            else { ?>
            <?php if($this->pregunta->creador_id == $_SESSION["id"] && empty($this->respuestas)) 
            { ?> <span></span>
            <?php } else { ?>
            <?php if($this->pregunta->es_concluida == 0 && $this->ultima_respuesta->creador_id != $_SESSION["id"]) { ?>
                <a class="btn btn-success my-2" href="<?php echo constant("URL") . "respuestas/crear/" .$this->pregunta->id ?>">Responder</a>
            <?php } ?>
        <?php } ?>
        <?php } ?>
        
        <div class="container">

            <?php foreach($this->respuestas as $respuesta)
            { ?>
                <div class="container border p-2 m-2 <?php if($respuesta->es_destacado == 1) echo "bg-warning" ?>">
                    <div>
                        <p class="fw-semibold"><?php echo $respuesta->nombre_creador ?></p>
                    </div>
                    <p><?php echo $respuesta->contenido ?></p>
                    <?php if($_SESSION["id"] == $this->pregunta->creador_id && $this->pregunta->es_concluida == 0) { ?>
                        <a href="<?php echo constant("URL") . "respuestas/marcar/" . $respuesta->id ?>">Marcar como aceptada</a>
                    <?php } ?>

                </div>
            <?php } ?>
        </div>
    </section>
    <?php require_once("views/footer.php");?>
</body>
</html>