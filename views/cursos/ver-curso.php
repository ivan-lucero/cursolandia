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
    <h2>Materiales</h2>
    <?php if($this->curso->dueno_id == $_SESSION["id"]) { ?>
        <form method="POST" action="<?php constant("URL")."cursos/subirMaterial/".$this->curso->id ?>" enctype="multipart/form-data">
            <input type="file" name="material">
            <input type="submit" value="Subir Material">
        </form>
    <?php } ?>
    
    <?php require_once("views/footer.php");?>
</body>
</html>
