<?php

include_once "models/classes/pregunta.php";
include_once "models/preguntasModel.php";

class PreguntasController extends Controller{
    
    function __construct()
    {
        parent::__construct();
    }

    function crearPregunta ($params)
    {
        echo "Crear pregunta";
        var_dump($_POST);
        $curso_id = $params[0];
        $creador_id = $params[1];
        var_dump($params);
        $preguntas_model = new PreguntasModel;
        $pregunta = new Pregunta;
        $pregunta->titulo = $_POST["titulo"];
        $pregunta->contenido = $_POST["contenido"];
        $pregunta->cursos_id = $curso_id;
        $pregunta->creador_id = $creador_id;
        if($pregunta_creada = $preguntas_model->create($pregunta))
        {
            var_dump($pregunta_creada);
        } 

    }

}
?>