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
        <div class="d-flex">
            <h1 class="fs-2 me-3">Cursos creados</h1>
            <a href="<?php echo constant("URL")."miscursos/crear" ?>" class="btn btn-success btn-lg">Crear curso</a>
        </div>
        <?php if(isset($this->cursos_creados)) { ?>
        <div class="d-flex my-5">
            <?php if(empty($this->cursos_creados)) { ?>
                <p class="fs-4">No tienes ningun curso creado</p>
            <?php } ?>
            <?php foreach($this->cursos_creados as $curso_creado)
            { ?>
                <div class="card mx-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $curso_creado->titulo ?></h5>
                        <p class="card-text"><?php echo $curso_creado->descripcion ?></p>
                        <a href=" <?php echo constant("URL")."cursos/ver/". $curso_creado->id ?>"
                        class="btn btn-primary">Ver curso</a>
                        <a href=" <?php echo constant("URL")."miscursos/editar/ " . $curso_creado->id ?>"
                        class="btn btn-primary">Editar curso</a>
                    </div>
                </div>
            <?php } ?>
        </div>
        <?php } ?>
    </section>

    <section class="container my-5">
        <h1 class="fs-2">Cursos inscriptos</h1>
        <?php if(isset($this->cursos_inscriptos)) { ?>
        <div class="d-flex my-5">
            <?php if(empty($this->cursos_inscriptos)) { ?>
                <p class="fs-4">No te has inscripto a ningun curso</p>
            <?php } ?>
            <?php foreach($this->cursos_inscriptos as $curso_inscripto)
            { ?>
                <div class="card mx-1" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $curso_inscripto->titulo ?></h5>
                        <p class="card-text"><?php echo $curso_inscripto->descripcion ?></p>
                        <a href=" <?php echo constant("URL")."cursos/ver/". $curso_inscripto->id ?>"
                        class="btn btn-primary">Ver curso</a>
                        <a href=" <?php echo constant("URL")."miscursos/editar/ " . $curso_inscripto->id ?>"
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