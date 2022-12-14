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
        $this->view->curso_id = $params[0];
        $this->view->usuario_id = $params[1];
        $this->view->render("preguntas/crear");
    }
    
    function editar($params)
    {
        session_start();
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
        $cursos_model = new CursosModel;
        $pregunta = $preguntas_model->getById($params[0]);
        $curso = $cursos_model->getById($pregunta->curso_id);
        $respuestas = $respuestas_model->getAllByQuestion($params[0]);
        $ultima_respuesta = $respuestas_model->getLastAnswerByQuestion($params[0]);
        $respuestas_parse = [];
        foreach($respuestas as $respuesta)
        {
            $usuario = $usuarios_model->getUser($respuesta->creador_id);
            $respuesta->nombre_creador = $usuario["nombre"];
            $respuestas_parse[] = $respuesta;
        }

        $creador = $usuarios_model->getUser($pregunta->creador_id);
        
        $this->view->pregunta = $pregunta;
        $this->view->curso = $curso;
        $this->view->respuestas = $respuestas_parse;
        $this->view->creador = $creador;
        $this->view->ultima_respuesta = $ultima_respuesta;
        $this->view->render("preguntas/ver");
    }

    function crearPregunta ($params)
    {
        session_start();
        $notificaciones_controller = new NotificacionesController;
        $curso_id = $params[0];
        $creador_id = $_SESSION["id"];
        $preguntas_model = new PreguntasModel;
        $pregunta = new Pregunta;
        $pregunta->titulo = $_POST["titulo"];
        $pregunta->contenido = $_POST["contenido"];
        $pregunta->cursos_id = $curso_id;
        $pregunta->creador_id = $creador_id;
        if($pregunta_creada = $preguntas_model->create($pregunta))
        {
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
        if($preguntas_model->update($pregunta))
        {
            header("Location:". constant('URL')."preguntas/ver/". $pregunta_id);
        }
    }
}
?>