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

    <h1>Pagina Admin Usuarios</h1>
    <h2>Solicitudes Pro:</h2>

    <?php foreach($this->solicitudes as $solicitud){ ?>

        <?php var_dump($solicitud); ?>
        <?php echo "<a href=" . constant("URL") . "/adminusuarios/aceptarSolicitud/" . $solicitud->usuario_id . ">Aceptar solicitud</a>"; ?>
        <?php echo "<a href=" . constant("URL") . "/adminusuarios/rechazarSolicitud/" . $solicitud->usuario_id . ">Rechazar solicitud</a>"; ?>
    <?php } ?>
    <?php require_once("views/footer.php");?>
</body>
</html>