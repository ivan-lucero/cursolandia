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
    
    <header class="container text-center my-5">
        <h1>Inicio</h1>
    </header>
    <main class="container my-5">
        <h2>Cursos recomendados:</h2>
        <div class="d-flex p-2">
    <?php 
        if(empty($this->cursos_recomendados))
        { ?>
            <p class="fs-4">Agregue sus intereses en la página de perfil para recibir recomendaciones</p>
        <?php } ?>

        <?php 
        foreach($this->cursos_recomendados as $curso_recomendado)
        {
            foreach($curso_recomendado as $curso)
            {
            if($curso->dueno_id != $_SESSION["id"]) { ?>
                <div class="card mx-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $curso->titulo ?></h5>
                        <p class="card-text"><?php echo $curso->descripcion ?></p>
                        <a href=" <?php echo constant("URL")."cursos/ver/". $curso->id ?>">Ver curso</a>
                    </div>
                </div>
            <?php }
            }
        }?>
        </div>
    </main>
    <?php require_once("views/footer.php");?>
</body>
</html>