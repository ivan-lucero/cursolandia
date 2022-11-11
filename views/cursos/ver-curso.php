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
    <?php if(!isset($_SESSION)) session_start(); $this->imagen = null;?>
    
    <main class="container col-xxl-8 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="
                <?php if(!is_null($this->imagen))
                     echo constant("URL"). "uploads/imgs/". $this->imagen;
                    else echo constant("URL"). "uploads/imgs/default.jpg"; ?>
                " class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3"><?php echo $this->curso->titulo ?></h1>
                <p class="lead"><?php echo $this->curso->descripcion ?></p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                
                <?php if($this->curso->dueno_id == $_SESSION["id"]) 
                { ?>
                    <a href="<?php echo constant('URL')."miscursos/editar/".$this->curso->id ?>" class="btn btn-primary btn-lg px-4 me-md-2">Editar curso</a>
                    <a href="<?php echo constant('URL')."miscursos/editar/".$this->curso->id ?>" class="btn btn-outline-danger btn-lg px-4 me-md-2">Eliminar curso</a>
                <?php }
                else { 
                    if($this->es_inscripto)
                    {
                        echo "<a href=".constant('URL')."cursos/salirDelCurso/".$this->curso->id.">Salir del curso</a>";
                        if($this->es_pago_pendiente){
                            echo "Solicitud de inscripcion enviada";
                        }
                        else {
                            echo "Ya estas inscripto a este curso";
                        }
                    }
                    else 
                        echo "<a href=".constant('URL')."cursos/inscribirseACurso/".$this->curso->id.">Inscribirse al curso</a>";
                } ?>
                
                
                </div>
            </div>
        </div>
    </main>


    <?php var_dump($this->curso);?>
    
    <br>
    <br>
    <hr>
    <br>
    <br>
    
    <?php if($this->curso->dueno_id == $_SESSION["id"]) {
        echo "<h2>Inscripciones</h2>";
        foreach ($this->alumnos_pendientes as $alumno_pendiente)
        { ?>
            <p><?php echo $alumno_pendiente["nombre"]; ?></p>
            <?php echo "<a href=".constant('URL')."miscursos/aceptarAlumno/". $alumno_pendiente["id"]. "/". $this->curso->id .">Aceptar</a>"; ?>
            <?php echo "<a href=".constant('URL')."miscursos/rechazarAlumno/". $alumno_pendiente["id"]. "/". $this->curso->id .">Rechazar</a>"; ?>
        <?php } 
    } ?>

    <br>
    <hr>
    <br>
    <h2>Materiales</h2>
    <?php if($this->curso->dueno_id == $_SESSION["id"]) { ?>
        <form action="<?php echo constant('URL')."miscursos/subirMaterial/".$this->curso->id ?>" method="POST" enctype="multipart/form-data">
            <input type="file" name="material">
            <input type="submit" value="Subir Material">
        </form>
    <?php } ?>
    
    <br>
    <br>

    <?php if(isset($this->materiales)) {
        foreach($this->materiales as $material)
        {
            echo "<hr>";
            echo "<a href='" . constant('URL') . "uploads/files/" . $material->curso_id . "." . $material->nombre ." ' target='_blank'> ".$material->nombre. "</a>";
            echo "<br>";
            echo "<a href='". constant('URL') . "miscursos/eliminarMaterial/". $material->id . "'>Eliminar</a>";
        }
    } ?>

    <br>
    <br>
    <hr>
    <br>

    <h2>Foro</h2>

    <?php if($this->es_inscripto && !$this->es_pago_pendiente && $this->curso->dueno_id != $_SESSION["id"]) 
    { ?>
        <a href="<?php echo constant("URL") . "preguntas/crear/".$this->curso->id ."/" .$_SESSION["id"] ?>">Crear pregunta</a>

    <?php } ?>
    
    <?php if(($this->es_inscripto && !$this->es_pago_pendiente) || $this->curso->dueno_id == $_SESSION["id"]) 
    { ?>
        <?php foreach($this->preguntas as $pregunta)
        { ?>
            <?php var_dump($pregunta); ?>
            <a href="<?php echo constant("URL") . "preguntas/ver/". $pregunta->id ?>">Ver pregunta</a>
            
        <?php } ?> 

    <?php } ?>
    
    <?php require_once("views/footer.php");?>
</body>
</html>
