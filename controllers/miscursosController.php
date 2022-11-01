<?php

include_once "models/classes/curso.php";
include_once "models/cursosModel.php";
include_once("helpers/validaciones.php");
include_once("helpers/archivos.php");

class MisCursosController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render()
    {
        $this->view->render('mis-cursos/index');
    }
    function crear($errores = null, $curso = null)
    {
        if(!empty($errores))
        {
            $this->view->errores = $errores;
            $this->view->curso = $curso;
            $this->view->render('mis-cursos/crear');
            return;
        }
        $this->view->render('mis-cursos/crear');
    }
    function crearCurso()
    {
        $errors = [];
        if(!Validaciones::validarTitulo($_POST["titulo"]))
            $errors["titulo"] = "El titulo debe ser menor a 45 caracteres";
        if(!Validaciones::validarFechaInicio($_POST["fecha_inicio"]))
            $errors["fecha_inicio"] = "la fecha ingresada debe ser mayor o igual a la fecha actual";
        if(!Validaciones::validarFechaFin($_POST["fecha_inicio"] ,$_POST["fecha_fin"]))
            $errors["fecha_fin"] = "la fecha ingresada debe ser mayor a la fecha de inicio";
        
        session_start();
        $curso = new Curso();
        $curso->titulo = $_POST["titulo"];
        $curso->descripcion = $_POST["descripcion"];
        $curso->costo = $_POST["costo"];
        $curso->cupo = $_POST["cupo"];
        $curso->fecha_inicio = $_POST["fecha_inicio"];
        $curso->fecha_fin = $_POST["fecha_fin"];
        $curso->dueno_id = $_SESSION["id"];
        if(!empty($errors))
        {
            $this->crear($errors, $curso);
            return;
        }
        
        $cursos_model = new CursosModel;
        
        if($curso_creado = $cursos_model->create($curso)) {
            header("Location:". constant('URL')."cursos/ver/". $curso_creado->id);
        }

        
    }

}

?>