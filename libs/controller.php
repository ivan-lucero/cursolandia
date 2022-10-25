<?php

class Controller {
    
    function __construct()
    {
        $this->view = new View();
    }
    
    function cargarModelo($model)
    {
        $url = "models/".$model."Model.php";
        if(file_exists($url))
        {
            require_once $url;
            $modelName = $model."Model";
            $this->model = new $modelName();
        }
    }
}

?>