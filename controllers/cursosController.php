<?php

include_once "models/classes/curso.php";
include_once "models/cursosModel.php";

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
        $curso = $cursos_model->getById($curso_id);
        $alumnos = $cursos_model->getStudents($curso_id);
        var_dump($alumnos);
        if(in_array($_SESSION["id"], $alumnos))
            $this->view->es_inscripto = true;
        $this->view->curso = $curso;
        $this->view->render("cursos/ver-curso");
    }

    function inscribirseACurso($param){
        var_dump($param);
        $cursos_model = new CursosModel;
        $curso = $cursos_model->getById($param[0]);
        var_dump($curso);
        session_start();
        if($curso->costo == 0)
            $cursos_model->addStudentFree($curso->id, $_SESSION["id"]);
        else
            $cursos_model->addStudentPendingPay($curso->id, $_SESSION["id"]);
        
    }
}

?>