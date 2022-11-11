<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- CONTINUAR ACA -->
    <?php require_once("views/header.php");?>
    
    
    <main class="container my-5">
        <h1>Pagina Cursos</h1>
    <?php if(!empty($this->cursos))
    { ?>
        <div class="d-flex my-5">
        <?php foreach($this->cursos as $curso)
        { ?>
            <div class="card mx-1" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $curso->titulo ?></h5>
                    <p class="card-text"><?php echo $curso->descripcion ?></p>
                    <a href=" <?php echo constant("URL")."cursos/ver/". $curso->id ?>">Ver curso</a>
                </div>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>Aun no hay cursos creados.</p>
    <?php } ?>
        </div>
            
    </main>
    
    <?php require_once("views/footer.php");?>
</body>
</html>