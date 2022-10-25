<?php

class App {

    function __construct()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = explode("/", $url);

        if(empty($url[0]))
        {
            require_once "controllers/homeController.php";
            $controlador = new HomeController();
            $controlador->cargarModelo("main");
            $controlador->render();
            return false;
        }
        
        $archivo_controlador = 'controllers/'.$url[0]."Controller.php";
        
        if(!file_exists($archivo_controlador)) 
        {
            require_once 'controllers/errors.php';
            $controlador = new Errors();
            $controlador->error404();
            return false;
        }
        require_once $archivo_controlador;
        $nombre_clase = $url[0]."Controller";
        $controlador = new $nombre_clase;
        $controlador->cargarModelo($url[0]);
        $cant_parametros = sizeof($url);
        if($cant_parametros > 1)
        {
            if($cant_parametros > 2)
            {
                $parametros = [];
                for($i = 2; $i < $cant_parametros; $i++)
                {
                    $parametros [] = $url[$i];
                }
                $controlador->{$url[1]}($parametros);
            }
            else
            {
                $controlador->{$url[1]}();
            }
        }
        else $controlador->render();
    }
}


?>