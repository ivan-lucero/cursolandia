<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear curso</title>
</head>
<body>

    <?php require_once("views/header.php"); if(isset($this->curso)) var_dump($this->curso); if(isset($this->errores)) var_dump($this->errores);?>
    <h1>Crear curso</h1>

    <main class="container d-flex flex-column justify-content-center align-items-center">
        <form class="bg-light w-50 p-5 border rounded" action="<?php echo constant('URL')."miscursos/crearCurso" ?>" method="POST">
            <h1 class="mb-5 text-center">Crear curso</h1>    
            <div class="mb-3">
                <label class="form-label" for="titulo">Titulo:</label>
                <input class="form-control" type="text" name="titulo" value="<?php if(isset($this->curso)) echo $this->curso->titulo ?>">
                <?php if(isset($this->errores["titulo"])) echo "<span>". $this->errores["titulo"] ."</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="costo">Costo:</label>
                <input class="form-control" type="text" name="costo" value="<?php if(isset($this->curso)) echo $this->curso->costo ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="cupo">Cupos:</label>
                <input class="form-control" type="text" name="cupo" value="<?php if(isset($this->curso)) echo $this->curso->cupo ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="fecha_inicio">Fecha de inicio:</label>
                <input class="form-control" type="date" name="fecha_inicio" value="<?php if(isset($this->curso)) echo $this->curso->fecha_inicio ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="fecha_fin">Fecha de fin:</label>
                <input class="form-control" type="date" name="fecha_fin" value="<?php if(isset($this->curso)) echo $this->curso->fecha_fin ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="descripcion">Descripcion:</label>
                <input class="form-control" type="text" name="descripcion" value="<?php if(isset($this->curso)) echo $this->curso->descripcion ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="etiqueta">Etiqueta:</label>
                <select class="form-select" name="etiqueta">
                    <option value=0 selected>Seleccione etiqueta:</option>
                    <option value=1>Programación</option>
                    <option value=2>Diseño</option>
                    <option value=3>Finanzas</option>
                </select>
            </div>
            <button type="submit" class="btn mt-3 w-100 btn-primary">Ingresar</button>
        </form>
    </main>

    <form action="<?php echo constant('URL')."miscursos/crearCurso" ?>" method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" value="<?php if(isset($this->curso)) echo $this->curso->titulo ?>">
        <label for="descripcion">Descripcion:</label>
        <input type="text" name="descripcion" value="<?php if(isset($this->curso)) echo $this->curso->descripcion ?>">
        <label for="costo">Costo:</label>
        <input type="text" name="costo" value="<?php if(isset($this->curso)) echo $this->curso->costo ?>">
        <label for="cupo">Cupos:</label>
        <input type="text" name="cupo" value="<?php if(isset($this->curso)) echo $this->curso->cupo ?>">
        <label for="fecha_inicio">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio" value="<?php if(isset($this->curso)) echo $this->curso->fecha_inicio ?>">
        <label for="fecha_fin">Fecha de fin:</label>
        <input type="date" name="fecha_fin" value="<?php if(isset($this->curso)) echo $this->curso->fecha_fin ?>">
        <label for="etiqueta">Etiqueta:</label>
        <select name="etiqueta">
            <option value=0 selected>Seleccione etiqueta:</option>
            <option value=1>Programación</option>
            <option value=2>Diseño</option>
            <option value=3>Finanzas</option>
        </select>
        <input type="submit" value="Crear curso">
    </form>
    <?php require_once("views/footer.php");?>
</body>
</html>