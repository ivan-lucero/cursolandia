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
    <h1>Editar curso</h1>
    <?php if(isset($this->errores)) var_dump($this->errores) ?>
    <form action="<?php echo constant('URL')."miscursos/editarCurso/".$this->curso->id ?>" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?php if(isset($this->curso)) echo $this->curso->titulo ?>">
        <label for="descripcion">Descripcion:</label>
        <input type="text" name="descripcion" value="<?php if(isset($this->curso)) echo $this->curso->descripcion ?>">
        <label for="costo">Costo:</label>
        <input type="text" name="costo" value="<?php if(isset($this->curso)) echo $this->curso->costo ?>">
        <label for="cupo">Cupos:</label>
        <input type="text" name="cupo" value="<?php if(isset($this->curso)) echo $this->curso->cupo ?>">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" value="<?php if(isset($this->curso)) echo date('Y-m-d', strtotime($this->curso->fecha_inicio)) ?>">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" value="<?php if(isset($this->curso)) echo date('Y-m-d', strtotime($this->curso->fecha_fin)) ?>">
        <label for="etiqueta">Etiqueta:</label>
        <select name="etiqueta">
            <option value=0>Seleccione etiqueta:</option>
            <option value=1 <?php if($this->curso->etiqueta_id == 1) echo "selected"?>>Programación</option>
            <option value=2 <?php if($this->curso->etiqueta_id == 2) echo "selected"?>>Diseño</option>
            <option value=3 <?php if($this->curso->etiqueta_id == 3) echo "selected"?>>Finanzas</option>
        </select>
        <label for="temario">Temario:</label>
        <textarea name="temario" ><?php echo $this->curso->temario ?></textarea>
        <input type="submit" value="Editar curso">
    </form>
    <?php require_once("views/footer.php");?>

</body>
</html>