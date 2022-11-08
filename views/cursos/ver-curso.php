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
    
    <h1> Ver curso</h1>
    <?php var_dump($this->curso);?>
    <?php if($this->curso->dueno_id == $_SESSION["id"]) {
            echo "<a href=".constant('URL')."miscursos/editar/".$this->curso->id.">Editar curso</a>";
            echo "<a href=".constant('URL')."miscursos/eliminarCurso/".$this->curso->id.">Eliminar curso</a>";
        }
        else {
            if($this->es_inscripto){
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
