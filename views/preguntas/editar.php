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
    <main class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <form class="bg-light w-50 p-5 border rounded" action="<?php echo constant("URL") . "preguntas/editarPregunta/". $this->pregunta->id ?>" method="POST">
            <h1 class="mb-5 text-center">Editar pregunta</h1>    
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo" value="<?php echo $this->pregunta->titulo; ?>" >
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" name="contenido" cols="30" rows="10"><?php echo $this->pregunta->contenido ?></textarea>
            </div>
            <button type="submit" class="btn mt-3 w-100 btn-primary">Crear</button>
        </form>
    </main>

    <?php require_once("views/footer.php");?>
</body>
</html>