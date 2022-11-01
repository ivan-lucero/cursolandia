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
    <h1>Pagina Cursos</h1>
    <?php if(isset($this->cursos))
    {
        foreach($this->cursos as $curso)
        {
            var_dump($curso);
            echo "<a href=".constant("URL")."cursos/ver/$curso->id".">Ver curso</a><br>";
        }
    } ?>
    <?php require_once("views/footer.php");?>
</body>
</html>