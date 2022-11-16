<?php

include_once "models/classes/pregunta.php";
include_once "models/classes/respuesta.php";
include_once "models/preguntasModel.php";
include_once "models/respuestasModel.php";
include_once "notificacionesController.php";

class RespuestasController extends Controller {

    function crear($params)
    {
        session_start();
        $pregunta_id = $params[0];
        if(isset($params[1]))
        {
            $respuesta_id = $params[1];
            $respuestas_model = new RespuestasModel;
            if($respuesta_citada = $respuestas_model->getById($respuesta_id))
                $this->view->respuesta_citada = $respuesta_citada;
        }
        $preguntas_model = new PreguntasModel;
        if($pregunta = $preguntas_model->getById($pregunta_id))
            $this->view->pregunta = $pregunta; 
        
        $this->view->render("respuestas/crear");
    }
    
    function crearRespuesta ($params)
    {
        session_start();
        $notificaciones_controller = new NotificacionesController;
        $pregunta_id = $params[0];
        $respuestas_model = new RespuestasModel;
        $respuesta = new Respuesta;
        $respuesta->contenido = $_POST["contenido"];
        $respuesta->preguntas_id = $pregunta_id;
        $respuesta->creador_id = $_SESSION["id"];
        if(isset($params[1]))
        {
            $respuesta_citada_id = $params[1];
            $respuesta_citada = $respuestas_model->getById($respuesta_citada_id);
            $respuesta->respuesta_citada_id = $respuesta_citada->id;
        }
        else $respuesta->respuesta_citada_id = NULL;

        if($respuesta_creada = $respuestas_model->create($respuesta))
        {
            if($notificaciones_controller->notificarRespuestaCreada($pregunta_id))
            {
                header("Location:". constant('URL')."preguntas/ver/". $pregunta_id);
            }
        }
    }

    function marcar ($param)
    {
        echo "marcar como aceptada";
        $respuesta_id = $param[0];
        $respuestas_model = new RespuestasModel;
        $preguntas_model = new PreguntasModel;
        $respuesta = $respuestas_model->getById($respuesta_id);
        $pregunta = $preguntas_model->getById($respuesta->preguntas_id);
        if($respuestas_model->updateAccepted($respuesta))
        {
            if($preguntas_model->updateConclude($pregunta))
            {
                header("Location:". constant('URL')."preguntas/ver/". $pregunta->id);
            }
            else echo "Error inesperado"; 
        }
        echo "Error inesperado";
    }

}

?>