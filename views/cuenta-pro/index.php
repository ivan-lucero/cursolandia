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

    
    <main class="container my-5">
        
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
        <h1 class="display-4 fw-normal">Solicita tu Cuenta Pro</h1>
        <p class="fs-5 text-muted">Solicita tu cuenta Pro para obtener beneficios exclusivos.</p>
        </div>

        <div class="row text-center d-flex justify-content-center align-items-center">
        
        <div class="w-50">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">Cuenta Pro</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">$20<small class="text-muted fw-light"> anuales</small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                    <li>Crea cursos ilimitados</li>
                    <li>Inscribite a cursos ilimitados</li>
                    <li>Tus cursos tienen prioridad al ser recomendados</li>
                    </ul>

                    <?php if($this->es_solicitado)
                    { ?>
                        <p class="w-100 btn btn-lg btn-primary disabled">Tu cuenta Pro ya ha sido solicitada.</p>
                    <?php }
                     else { ?>
                        <?php if(is_null($this->vencimiento_pro) || $this->vencimiento_pro < date("Y-m-d")) { ?>
            
                            <form action="<?php echo constant('URL')."cuentapro/solicitarCuentaPro" ?>" method="POST">
                                <input class="w-100 btn btn-lg btn-primary" type="submit" value="Solicitar cuenta Pro">
                            </form>
                            
                            <?php } else { ?>
                                <p class="w-100 btn btn-lg btn-primary disabled">Ya eres un usuario pro</p>
                            <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <?php require_once("views/footer.php");?>
</body>
</html>