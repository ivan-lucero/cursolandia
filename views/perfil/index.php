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
    
    <main class="vh-100"> 
        <div class="container py-5">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="<?php echo "uploads/imgs/" . $this->usuario["imagen"] ?>" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                            <h5 class="my-3"><?php echo $this->usuario["nombre"] ?></h5>
                            <div class="d-flex flex-column justify-content-center mb-2">
                                <a href="<?php echo constant("URL")."perfil/imagen" ?>" type="button" class="btn btn-outline-primary my-1">Cambiar imagen</a> 
                                <a href="<?php echo constant("URL")."perfil/editar" ?>" type="button" class="btn btn-outline-primary my-1">Editar perfil</a>
                                <a href="<?php echo constant("URL")."perfil/contrasena" ?>" type="button" class="btn btn-outline-primary my-1">Cambiar contraseña</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $this->usuario["email"] ?></p>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Telefono</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"> <?php echo $this->usuario["telefono"] ?></p>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Fecha de nacimiento</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo date('d-m-Y', strtotime($this->usuario["fecha_nacimiento"])) ?></p>
                        </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Fecha de registro</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo date('d-m-Y', strtotime($this->usuario["fecha_registro"])) ?></p>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Intereses</p>
                            </div>
                            <ul class="list-group list-group-flush px-5">
                                <?php foreach($this->intereses as $interes) { ?>
                                    <li class="list-group-item text-muted"> <?php echo $interes ?> </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Antecedentes</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0"><?php echo $this->usuario["antecedentes"] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <?php require_once("views/footer.php");?>
</body>
</html>