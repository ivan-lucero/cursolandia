<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
    if(!(isset($_SESSION["email"]) && isset($_SESSION["rol"])))
        session_start();
    var_dump($_SESSION);
    if(!isset($_SESSION["rol"]))
    {
        require_once("views/header-invitado.php");
        require_once("invitado.php");
    }
    else if (intval($_SESSION["rol"]) === 1)
    {
        require_once("views/header.php");
        require_once("usuario.php");
    }
    else if (intval($_SESSION["rol"]) === 2)
    {
        require_once("views/header-dashboard.php");
        require_once("views/admin/index.php");
    }
    require_once("views/footer.php");
    ?>
</body>
</html>