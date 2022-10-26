<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
</head>
<body>
    <?php require_once("views/header.php");?>
    <h1>Editar perfil</h1>
    <?php var_dump($this->usuario);?>
    <?php var_dump($this->intereses);?>
    
    <?php var_dump(isset($this->errores) ? var_dump($this->errores) : null); ?>
    <br>
    <form method="POST" action="<?php echo constant('URL') ?>perfil/editarPerfil" enctype="multipart/form-data">
    <label for="">Imagen:</label>
    <input type="file" name="imagen" value="<?php echo $this->usuario["imagen"] ?>">
    <label for="">Teléfono:</label> 
    <input type="text" name="telefono" value="<?php echo $this->usuario["telefono"]?>">
    <label for="">Fecha de Nacimiento:</label> 
    <input type="date" name="fecha_nacimiento" value="<?php echo date('Y-m-d', strtotime($this->usuario['fecha_nacimiento'])) ?>">
    <label for="">Antecedentes:</label>
    <textarea name="antecedentes"><?php echo $this->usuario["antecedentes"]?></textarea>
    <label for="intereses">Intereses:</label><br>
    <label><input type="checkbox" name="programacion"<?php if(isset($this->intereses) && in_array("programacion" ,$this->intereses)) echo "checked"; ?>>Programación</label><br>
    <label><input type="checkbox" name="diseno" <?php if(isset($this->intereses) && in_array("diseño" ,$this->intereses)) echo "checked"; ?>>Diseño</label><br>
    <label><input type="checkbox" name="finanzas" <?php if(isset($this->intereses) && in_array("finanzas" ,$this->intereses)) echo "checked"; ?>>Finanzas</label><br>
    <input type="submit" value="Editar">
    </form>
    
    <?php require_once("views/footer.php");?>
</body>
</html>