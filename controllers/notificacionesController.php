<?php

include_once "models/classes/curso.php";
include_once "models/classes/usuario.php";
include_once "models/classes/notificacion.php";
include_once "models/cursosModel.php";
include_once "models/usuariosCursosModel.php";
include_once "models/usuariosModel.php";
include_once "models/materialesModel.php";
include_once "models/preguntasModel.php";
include_once "models/notificacionesModel.php";

class NotificacionesController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        session_start();
        $notificaciones_model = new NotificacionesModel;
        $notificaciones = $notificaciones_model->getAllByUser($_SESSION["id"]);
        $this->view->notificaciones = $notificaciones;
        $this->view->render('notificaciones/index');
    }
    
    function notificarPreguntaCreada ($curso_id)
    {
        if(!isset($_SESSION)) session_start();
        var_dump($curso_id);
        $usuarios_cursos_model = new UsuariosCursosModel;
        $cursos_model = new CursosModel;
        $usuarios_model = new UsuariosModel;
        $notificaciones_model = new NotificacionesModel;
        $usuario = $usuarios_model->getUser($_SESSION["id"]);
        $alumnos_id = $usuarios_cursos_model->getStudentsByCourse($curso_id);
        $curso = $cursos_model->getById($curso_id);
        
        $notificacion = new Notificacion;
        $notificacion->contenido = $usuario["nombre"] . " ha iniciado una pregunta en el curso \"" . $curso->titulo . "\"";
        var_dump($notificacion);
        foreach($alumnos_id as $alumno_id)
        {
            if($alumno_id != $_SESSION["id"])
            {
                var_dump($alumno_id);
                $notificacion->usuario_id = $alumno_id;
                $notificaciones_model->create($notificacion);
            }
        }
        return true;
    }

    function notificarRespuestaCreada ($pregunta_id)
    {
        echo "Notificar respuesta";
        var_dump($pregunta_id[0]);
        if(!isset($_SESSION)) session_start();
        $preguntas_model = new PreguntasModel;
        $usuarios_model = new UsuariosModel;
        $cursos_model = new CursosModel;
        $notificaciones_model = new NotificacionesModel;
        $pregunta = $preguntas_model->getById($pregunta_id[0]);
        $participantes_id = $preguntas_model->getAllParticipants($pregunta->id);
        $usuario = $usuarios_model->getUser($_SESSION["id"]);
        $curso = $cursos_model->getById($pregunta->curso_id);
        var_dump($participantes_id);
        $notificacion = new Notificacion;
        $notificacion->contenido = $usuario["nombre"] . " ha realizado una respuesta a la pregunta \"" . $pregunta->titulo . "\" del curso \"" .$curso->titulo;
        var_dump($notificacion);
        
        foreach($participantes_id as $participante_id)
        {
            if($participante_id != $_SESSION["id"])
            {
                var_dump($participante_id);
                $notificacion->usuario_id = $participante_id;
                $notificaciones_model->create($notificacion);
            }
        }
        return true;

    }
}
?>