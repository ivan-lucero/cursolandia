<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear curso</title>
</head>
<body>

    <?php require_once("views/header.php"); if(isset($this->curso)) var_dump($this->curso); if(isset($this->curso)) var_dump($this->errores);?>
    <h1>Crear curso</h1>

    <form action="<?php echo constant('URL')."miscursos/crearCurso" ?>" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?php if(isset($this->curso)) echo $this->curso->titulo ?>">
        <label for="titulo">Descripcion:</label>
        <input type="text" name="descripcion" value="<?php if(isset($this->curso)) echo $this->curso->descripcion ?>">
        <label for="titulo">Costo:</label>
        <input type="text" name="costo" value="<?php if(isset($this->curso)) echo $this->curso->costo ?>">
        <label for="titulo">Cupos:</label>
        <input type="text" name="cupo" value="<?php if(isset($this->curso)) echo $this->curso->cupo ?>">
        <label for="titulo">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" value="<?php if(isset($this->curso)) echo $this->curso->fecha_inicio ?>">
        <label for="titulo">Fecha de fin:</label>
        <input type="date" name="fecha_fin" value="<?php if(isset($this->curso)) echo $this->curso->fecha_fin ?>">
        <input type="submit" value="Crear curso">
    </form>
    <?php require_once("views/footer.php");?>
</body>
</html>