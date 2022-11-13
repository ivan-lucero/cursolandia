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
    
    <main class="container d-flex flex-column justify-content-center my-5 align-items-center">
        <form class="bg-light w-50 p-5 border rounded" action="<?php echo constant('URL') ?>perfil/editarPerfil" method="POST">
            <h1 class="mb-5 text-center">Editar perfil</h1>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" aria-describedby="telefono" value="<?php echo $this->usuario["telefono"]; ?>">
                <?php if(isset($this->errores["telefono"])) echo "<span class='text-danger'> ". $this->errores["telefono"] ."</span>" ?>
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento</label>
                <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" aria-describedby="fecha_nacimiento" value="<?php echo date('Y-m-d', strtotime($this->usuario['fecha_nacimiento'])) ?>">
                <?php if(isset($this->errores["fecha_nacimiento"])) echo "<span class='text-danger'> ". $this->errores["fecha_nacimiento"] ."</span>" ?>
            </div>
            <label for="intereses" class="form-label">Intereses</label>
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="programacion" id="flexCheckDefault" <?php if(isset($this->intereses) && in_array("programacion" ,$this->intereses)) echo "checked"; ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                        Programacion
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="diseno" id="flexCheckDefault1" <?php if(isset($this->intereses) && in_array("diseño" ,$this->intereses)) echo "checked"; ?>>
                    <label class="form-check-label" for="flexCheckDefault1">
                        Diseño
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="finanzas" id="flexCheckDefault2" <?php if(isset($this->intereses) && in_array("finanzas" ,$this->intereses)) echo "checked"; ?>>
                    <label class="form-check-label" for="flexCheckDefault2">
                        Finanzas
                    </label>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="antecedentes">Antecedentes</label>
                <textarea class="form-control" name="antecedentes" id="antecedentes" cols="30" rows="10"><?php echo $this->usuario["antecedentes"] ?></textarea>
                <?php if(isset($this->errores["antecedentes"])) echo "<span class='text-danger'> ". $this->errores["antecedentes"] ."</span>" ?>
            </div>

            <button type="submit" class="btn mt-3 w-100 btn-primary">Editar</button>
        </form>
    </main>
    <?php require_once("views/footer.php");?>
</body>
</html>