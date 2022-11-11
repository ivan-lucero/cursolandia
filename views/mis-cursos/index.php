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
    
    <section class="container my-5">
        <h1 class="fs-2">Cursos creados</h1>
        <a href="<?php echo constant("URL")."miscursos/crear" ?>" class="btn btn-primary btn-lg">Crear curso</a>
        <?php if(isset($this->cursos)) { ?>
        <div class="d-flex my-5">
            <?php foreach($this->cursos as $curso)
            { ?>
                <div class="card mx-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $curso->titulo ?></h5>
                        <p class="card-text"><?php echo $curso->descripcion ?></p>
                        <a href=" <?php echo constant("URL")."cursos/ver/". $curso->id ?>"
                        class="btn btn-primary">Ver curso</a>
                        <a href=" <?php echo constant("URL")."miscursos/editar/ " . $curso->id ?>"
                        class="btn btn-primary">Editar curso</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>
    
    <?php require_once("views/footer.php");?>
</body>
</html>