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
    <h1>Crear pregunta</h1>

    <main class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <form class="bg-light w-50 p-5 border rounded" action="<?php echo constant("URL") . "preguntas/crearPregunta/". $this->curso_id . "/" . $_SESSION["id"] ?>" method="POST">
            <h1 class="mb-5 text-center">Iniciar sesion</h1>    
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo</label>
                <input type="text" class="form-control" name="titulo">
            </div>
            <div class="mb-3">
                <label for="contenido" class="form-label">Contenido</label>
                <textarea class="form-control" name="contenido" cols="30" rows="10"></textarea>
            </div>
            <button type="submit" class="btn mt-3 w-100 btn-primary">Crear</button>
        </form>
    </main>

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