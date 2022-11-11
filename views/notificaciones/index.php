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

    <main class="container">
    <div class="list-group list-group-radio d-grid gap-2 border-0 w-auto mt-3 w-50">
        <h1>Pagina Notificaciones</h1>
        <?php foreach($this->notificaciones as $notificacion) 
        { ?>
            <div class="position-relative">
                <input class="form-check-input position-absolute top-50 end-0 me-3 fs-5" type="radio" name="listGroupRadioGrid" id="listGroupRadioGrid1" value="" checked>
                <label class="list-group-item py-3 pe-5 <?php if($notificacion->es_leido == 0) echo "bg-warning" ?>  " >
                    <p class="fs-6"><?php echo $notificacion->fecha_creacion; ?></p>
                    <p class="fs-5 "><?php echo $notificacion->contenido; ?></p>
                    <?php if(!$notificacion->es_leido) 
                    { ?>
                        <a href="<?php echo constant("URL") . "notificaciones/marcarComoLeido/". $notificacion->id?>" class="btn btn-primary">Marcar como leido</a>
                    <?php } ?>
                </label>
            </div>
        <?php } ?>
    </main>
    <?php var_dump($this->notificaciones); ?>
    <?php require_once("views/footer.php");?>
</body>
</html>