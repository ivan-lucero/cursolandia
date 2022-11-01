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
    <?php session_start();?>
    <h1> Ver curso</h1>
    <?php var_dump($this->curso);?>
    <?php if($this->curso->dueno_id == $_SESSION["id"]) {
        echo "<a href=".constant('URL')."miscursos/editar/".$this->curso->id.">Editar curso</a>";
        echo "<a href=".constant('URL')."miscursos/eliminarCurso/".$this->curso->id.">Eliminar curso</a>";
    } ?>
    <?php require_once("views/footer.php");?>
</body>
</html>
