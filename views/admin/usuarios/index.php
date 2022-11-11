<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require_once("views/header-dashboard.php"); ?>

    <header class="container">
        <h1>Pagina Admin Usuarios</h1>
    </header>
    <main class="container">
        <h2>Solicitudes Pro:</h2>
        <?php foreach($this->solicitudes as $solicitud){ ?>

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $solicitud->nombre ?></h5>
                    <a href=" <?php echo constant("URL") . "/adminusuarios/aceptarSolicitud/" . $solicitud->usuario_id ?>" class="btn btn-success">Aceptar solicitud</a>
                    <a href=" <?php echo constant("URL") . "/adminusuarios/rechazarSolicitud/" . $solicitud->usuario_id ?>" class="btn btn-danger">Rechazar solicitud</a>
                </div>
            </div>

        <?php } ?>  

    </main>
    <?php require_once("views/footer.php");?>
</body>
</html>