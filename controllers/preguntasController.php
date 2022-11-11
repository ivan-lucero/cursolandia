<?php

include_once "models/classes/pregunta.php";
include_once "models/classes/respuesta.php";
include_once "models/preguntasModel.php";
include_once "models/respuestasModel.php";
include_once "notificacionesController.php";

class PreguntasController extends Controller{
    
    function __construct()
    {
        parent::__construct();
    }

    function crear($params)
    {
        session_start();
        var_dump($params);
        $this->view->curso_id = $params[0];
        $this->view->usuario_id = $params[1];
        var_dump($this->view->curso_id);
        var_dump($this->view->usuario_id);
        $this->view->render("preguntas/crear");
    }
    
    function editar($params)
    {
        session_start();
        var_dump($params);
        $this->view->curso_id = $params[0];
        $this->view->usuario_id = $_SESSION["id"];
        $preguntas_model = new PreguntasModel;
        $pregunta = $preguntas_model->getById($params[0]);
        $this->view->pregunta = $pregunta;
        $this->view->render("preguntas/editar");
    }

    function ver ($params)
    {
        session_start();
        $preguntas_model = new PreguntasModel;
        $respuestas_model = new RespuestasModel;
        $usuarios_model = new UsuariosModel;
        $pregunta = $preguntas_model->getById($params[0]);
        $respuestas = $respuestas_model->getAllByQuestion($params[0]);
        $creador = $usuarios_model->getUser($pregunta->creador_id);
        var_dump($creador);
        $this->view->pregunta = $pregunta;
        $this->view->respuestas = $respuestas;
        $this->view->creador = $creador;
        $this->view->render("preguntas/ver");
    }

    function crearPregunta ($params)
    {
        session_start();
        $notificaciones_controller = new NotificacionesController;
        echo "Crear pregunta";
        var_dump($_POST);
        $curso_id = $params[0];
        $creador_id = $_SESSION["id"];
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
            if($notificaciones_controller->notificarPreguntaCreada($curso_id)) 
                header("Location:". constant('URL')."preguntas/ver/". $pregunta_creada->id);
        }
    }

    function editarPregunta($param)
    {
        echo "editar pregunta";
        $pregunta_id = $param[0];
        $preguntas_model = new PreguntasModel;
        $usuarios_model = new UsuariosModel;
        $pregunta = $preguntas_model->getById($pregunta_id);
        
        $pregunta->titulo = $_POST["titulo"];
        $pregunta->contenido = $_POST["contenido"];
        var_dump($pregunta);
        if($preguntas_model->update($pregunta))
        {
            header("Location:". constant('URL')."preguntas/ver/". $pregunta_id);
        }
    }
}
?>