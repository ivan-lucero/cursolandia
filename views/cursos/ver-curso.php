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
    <?php if(!isset($_SESSION)) session_start();?>
    
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
                <p class="fs-5"><?php echo $this->curso->descripcion ?></p>
                <p class="fs-6 mb-1">fecha de inicio: <?php echo date("d-m-Y", strtotime($this->curso->fecha_inicio)) ?></p>
                <p class="fs-6 mt-1">fecha de fin: <?php echo date("d-m-Y", strtotime($this->curso->fecha_fin)) ?></p>
                <p class="fs-3 mt-1 fw-bold">$ <?php echo $this->curso->costo; ?></p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                
                <?php if($this->curso->dueno_id == $_SESSION["id"]) 
                { ?>
                    <a href="<?php echo constant('URL')."miscursos/editar/".$this->curso->id ?>" class="btn btn-primary btn-lg px-4 me-md-2">Editar curso</a>
                    <a href="<?php echo constant('URL')."miscursos/eliminarCurso/".$this->curso->id ?>" class="btn btn-outline-danger btn-lg px-4 me-md-2">Eliminar curso</a>
                <?php }
                else {
                    if($this->es_inscripto)
                    { ?>
                    <a href="<?php echo constant('URL')."cursos/salirDelCurso/".$this->curso->id ?>" class="btn btn-outline-danger btn-lg px-4 me-md-2">Salir del curso</a>
                        <?php if($this->es_pago_pendiente)
                        { ?>
                        <p class="fs-5 text-success">Solicitud de inscripcion enviada</p>
                        <?php } 
                        else { ?>
                        <p class="fs-5 text-success">Ya estas inscripto a este curso</p>
                        <?php } ?>
                    <?php }
                    else 
                    { ?> 
                        <a href="<?php echo constant('URL')."cursos/inscribirseACurso/".$this->curso->id ?>" class="btn btn-success btn-lg px-4 me-md-2">Inscribirse al curso</a>
                    <?php } 
                } ?>
                </div>
            </div>
        </div>
    </main>

    <?php if($this->curso->dueno_id == $_SESSION["id"]) 
    { ?>
        <section class="container border-top border-primary my-5 ">
            <h2 class="fs-2 my-4">Solicitudes de Inscripcion</h2>
        
            <?php if(empty($this->alumnos_pendientes)) 
            {  ?>
                <p class="fs-4">No hay alumnos pendientes.</p>
            <?php } 
            else { ?>
                <div class="list-group list-group-radio d-grid gap-2 border-0 w-auto">
                
                <?php foreach ($this->alumnos_pendientes as $alumno_pendiente)
                { ?>
                    <div class="position-relative w-50">
                        <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked>
                        <label class="list-group-item py-3 pe-5" for="listGroupRadioGrid1">
                        <p class="fs-4 fw-semibold"><?php echo $alumno_pendiente["nombre"] ?></p>
                        <a href="<?php echo constant('URL')."miscursos/aceptarAlumno/". $alumno_pendiente["id"]. "/". $this->curso->id ?>" 
                        class="btn btn-success">Aceptar</a>
                        <a href="<?php echo constant('URL')."miscursos/rechazarAlumno/". $alumno_pendiente["id"]. "/". $this->curso->id ?>" 
                        class="btn btn-danger">Rechazar</a>
                        </label>
                    </div>
                <?php } ?>
                </div>
            <?php } ?>
        </section>
    <?php } ?>

    <section class="container my-5 border-top border-primary">
        <h2 class="fs-2 mt-5">Temario</h2>
        <p><?php echo $this->curso->temario ?></p>
    </section>
    
    <?php if(($this->es_inscripto && !$this->es_pago_pendiente ) || $this->curso->dueno_id == $_SESSION["id"])
    { ?>

    <section class="container border-top border-primary my-5">
        <h2 class="fs-2 mt-5">Materiales</h2>
        <?php if($this->curso->dueno_id == $_SESSION["id"]) { ?>
            <form action="<?php echo constant('URL')."miscursos/subirMaterial/".$this->curso->id ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <input class="form-control w-25 " type="file" name="material">
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary my-3">Subir material</button>
                    </div>
                </div>
            </form>
        <?php } ?>
        <?php if(isset($this->materiales)) { ?>
            <div class="list-group list-group-radio d-grid gap-2 border-0 w-50">
            <?php foreach($this->materiales as $material)
            { ?>
                <div class="position-relative">
                    <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked>
                    <label class="list-group-item py-3 pe-5" >
                    <p class="fs-4 fw-semibold"><?php echo $material->nombre; ?></p>
                    <a href="<?php echo constant('URL') . "uploads/files/" . $material->curso_id . "." . $material->nombre ?> " class="btn btn-primary" target="_blank">Ver material</a>
                    <?php if($this->curso->dueno_id == $_SESSION["id"]) { ?>
                        <a href="<?php echo constant('URL') . "miscursos/eliminarMaterial/". $material->id ?>" class="btn btn-danger">Eliminar</a>
                    <?php } ?>
                    </label>
                </div>
                
            <?php } ?>
            </div>
        <?php } ?>
    <?php } ?>
    </section>
    
    <section class="container border-top border-primary my-5">
        <h2 class="fs-2 mt-5">Foro</h2>
        
        <?php if($this->es_inscripto && !$this->es_pago_pendiente && $this->curso->dueno_id != $_SESSION["id"]) 
        { ?>
            <a href="<?php echo constant("URL") . "preguntas/crear/".$this->curso->id ."/" .$_SESSION["id"] ?>"
            class="btn btn-primary"
            >Crear pregunta</a>
        <?php } ?>
        <?php if(($this->es_inscripto && !$this->es_pago_pendiente) || $this->curso->dueno_id == $_SESSION["id"]) 
        { ?>
            <div class="list-group list-group-radio d-grid gap-2 border-0 w-auto mt-3 w-50">
                
                <?php foreach($this->preguntas as $pregunta)
                { ?>
                <div class="position-relative w-50">
                    <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked>
                    <label class="list-group-item py-3 pe-5" >
                    <p class="fs-6"><?php echo $pregunta->fecha_creacion; ?></p>
                    <p class="fs-4 fw-semibold"><?php echo $pregunta->titulo; ?></p>
                    <a href="<?php echo constant("URL") . "preguntas/ver/". $pregunta->id?>" class="btn btn-primary">Ver pregunta</a>
                    </label>
                </div>

            <?php } ?> 
            </div>
        <?php } ?>
    </section>

    
    
    
    
    <?php require_once("views/footer.php");?>
</body>
</html>
