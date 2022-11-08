<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href= "<?php echo constant('URL')?>public/css/default.css">
    <title>Document</title>
</head>
<body>
    <?php require 'views/header.php'; ?>

    <?php include_once $this->error; ?>

    <?php require 'views/footer.php'; ?>
</body>
</html>