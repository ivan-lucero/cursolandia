<?php

include_once "models/classes/curso.php";
include_once "models/classes/usuario.php";
include_once "models/cursosModel.php";
include_once "models/usuariosCursosModel.php";
include_once "models/usuariosModel.php";
include_once "models/materialesModel.php";

class CursosController extends Controller{
    function __construct()
    {
        parent::__construct();
    }

    function render(){
        $cursos_model = new CursosModel;
        $cursos = $cursos_model->getAll();
        $this->view->cursos = $cursos;
        $this->view->render('cursos/index');
    }
    function ver($param){
        session_start();
        $curso_id = intval($param[0]);
        $cursos_model = new CursosModel;
        $usuarios_model = new UsuariosModel;
        $usuarios_cursos_model = new UsuariosCursosModel;
        $materiales_model = new MaterialesModel;
        $materiales = $materiales_model->getAllByCourse($curso_id);
        $curso = $cursos_model->getById($curso_id);
        $this->view->alumnos_pendientes = NULL;
        if($curso->dueno_id != $_SESSION["id"])
        {
            if($alumno = $usuarios_cursos_model->isStudent($curso_id, $_SESSION["id"]))
            {
                $this->view->es_inscripto = true;
                if($alumno->pago_pendiente)
                    $this->view->es_pago_pendiente = true;
                else 
                    $this->view->es_pago_pendiente = false;
            }
            else $this->view->es_inscripto = false;
        }
        else 
        {
            $alumnosPendientes = $usuarios_cursos_model->getStudentsPendingsToPayByCourse($curso_id);
            var_dump($alumnosPendientes);
            $alumnosPendientesArray = [];
            foreach($alumnosPendientes as $alumnoPendiente)
            {
                $alumno = new Usuario;
                $alumno = $usuarios_model->getUser($alumnoPendiente->usuario_id);
                $alumnosPendientesArray[] = $alumno;
            }
            $this->view->alumnos_pendientes = $alumnosPendientesArray;
        }
        $this->view->materiales = $materiales;
        $this->view->curso = $curso;
        $this->view->render("cursos/ver-curso");
    }

    function inscribirseACurso($param){
        $cursos_model = new CursosModel;
        $usuarios_cursos_model = new UsuariosCursosModel;
        $curso = $cursos_model->getById($param[0]);
        var_dump($curso);
        session_start();
        if($curso->costo == 0)
            $usuarios_cursos_model->addStudentFree($curso->id, $_SESSION["id"]);
        else
            $usuarios_cursos_model->addStudentPendingToPay($curso->id, $_SESSION["id"]);
        header("Location:". constant('URL')."cursos/ver/". $curso->id);
    }
    
    function salirDelCurso($param)
    {
        session_start();
        $curso_id = $param[0];
        $usuarios_cursos_model = new UsuariosCursosModel;
        if($usuarios_cursos_model->deleteStudent($curso_id, $_SESSION["id"]))
            header("Location:". constant('URL')."cursos/ver/". $curso_id);
    }
    
    function abrirMaterial ($curso_id, $archivo)
    {
        header("Location:". constant('URL')."uploads/files/". $curso_id . $archivo);
    }

    
}

?>