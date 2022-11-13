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
    <main class="container d-flex flex-column justify-content-center align-items-center vh-100">
        <form class="bg-light w-50 p-5 border rounded" action="<?php echo constant('URL') ?>perfil/cambiarImagen" method="POST" enctype="multipart/form-data">
            <h1 class="mb-5 text-center">Cambiar imagen</h1>
            <div class="mb-3">
                <input class="form-control" name="imagen" type="file" id="formFile">
                <?php if(isset($this->errores["imagen"])) echo "<span class='text-danger'>".$this->errores["imagen"] ."</span>" ?>
            </div>
            <button type="submit" class="btn mt-3 w-100 btn-primary">Cambiar</button>
        </form>
    </main>

    <?php require_once("views/footer.php");?>
</body>
</html>