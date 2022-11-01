<?php

include_once "models/classes/curso.php";
include_once "models/cursosModel.php";

class CursosController extends Controller{
    function __construct()
    {
        parent::__construct();
    }

    function render(){
        $this->view->render('cursos/index');
    }
    function ver($param){
        $curso_id = intval($param[0]);
        $cursos_model = new CursosModel;
        $curso = $cursos_model->getById($curso_id);
        $this->view->curso = $curso;
        $this->view->render("cursos/ver-curso");
    }
}

?>