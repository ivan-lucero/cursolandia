<?php

class Nuevo extends Controller{
    function __construct()
    {
        parent::__construct();
        $this->view->mensaje = "";
    }
    
    function render()
    {
        $this->view->render('nuevo/index');
    }

    function registrarAlumno()
    {
        // Hacer validaciones
        
        $matricula = $_POST['matricula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        $respuesta = $this->model->insert([
            "matricula" => $matricula,
            "nombre" => $nombre,
            "apellido" => $apellido
        ]);
        if($respuesta)
            $mensaje = "matricula insertada exitosamente"; 
        else 
            $mensaje = "Ya existe la matricula";
    
        $this->view->mensaje = $mensaje;
        $this->render();
    }
}

?>