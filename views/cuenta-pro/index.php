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
    <h1>Solicitar Cuenta Pro</h1>

    <?php if($this->es_solicitado)
    {
        echo "<h3>Tu cuenta Pro ya ha sido solicitada.</h3>";
    }

    else { ?>
        <?php if(is_null($this->vencimiento_pro) || $this->vencimiento_pro < date("Y-m-d")) { ?>
            <form action="<?php echo constant('URL')."cuentapro/solicitarCuentaPro" ?>" method="POST">
                <input type="submit" value="Solicitar cuenta Pro">
            </form>
            <?php } else { ?>
                <h3>Ya eres usuario Pro</h3>
            <?php } ?>
    <?php } ?>

    <?php require_once("views/footer.php");?>
</body>
</html>