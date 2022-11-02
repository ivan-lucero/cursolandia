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
        session_start();
        $cursos_model = new CursosModel;
        $cursos = $cursos_model->getAllByUser($_SESSION["id"]);
        $this->view->cursos = $cursos;
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
    function editar($param, $errores = null)
    {
        $cursos_model = new CursosModel;
        $curso = $cursos_model->getById($param[0]);
        $this->view->curso = $curso;
        if(!empty($errores))
        {
            $this->view->errores = $errores;
            $this->view->render('mis-cursos/editar');
            return;
        }
        $this->view->render('mis-cursos/editar');
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
        if($_POST["etiqueta"] < 1 || $_POST["etiqueta"] > 3)
            $errors["etiqueta"] = "Seleccione una etiqueta";
        if(Validaciones::validarDecimal($_POST["decimal"]))
            $errores["costo"] = "El costo ingresado debe ser un numero";
        else if($_POST["costo"] < 0) 
            $errors["costo"] = "El costo debe ser un valor positivo";
        
        if($_POST["costo"] === "") 
            $_POST["costo"] = 0;
        session_start();
        $curso = new Curso();
        $curso->titulo = $_POST["titulo"];
        $curso->descripcion = $_POST["descripcion"];
        $curso->costo = $_POST["costo"];
        $curso->cupo = $_POST["cupo"];
        $curso->fecha_inicio = $_POST["fecha_inicio"];
        $curso->fecha_fin = $_POST["fecha_fin"];
        $curso->dueno_id = $_SESSION["id"];
        $curso->etiqueta_id = $_POST["etiqueta"];
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
    
    function editarCurso ($param)
    {
        $curso_id = $param[0];
        var_dump($curso_id);
        var_dump($_POST);
        $errors = [];
        if(!Validaciones::validarTitulo($_POST["titulo"]))
            $errors["titulo"] = "El titulo debe ser menor a 45 caracteres";
        if(!Validaciones::validarFechaInicio($_POST["fecha_inicio"]))
            $errors["fecha_inicio"] = "la fecha ingresada debe ser mayor o igual a la fecha actual";
        if(!Validaciones::validarFechaFin($_POST["fecha_inicio"] ,$_POST["fecha_fin"]))
            $errors["fecha_fin"] = "la fecha ingresada debe ser mayor a la fecha de inicio";
        if($_POST["etiqueta"] < 1 || $_POST["etiqueta"] > 3)
            $errors["etiqueta"] = "Seleccione una etiqueta";
        if($_POST["costo"] < 0) 
            $errors["costo"] = "El costo debe ser un valor positivo";
        if($_POST["costo"] === "") 
            $_POST["costo"] = 0;
        if(!empty($errors))
        {
            $this->editar($param ,$errors);
            return;
        }
        session_start();
        $curso = new Curso();
        $curso->id = $curso_id;
        $curso->titulo = $_POST["titulo"];
        $curso->descripcion = $_POST["descripcion"];
        $curso->costo = $_POST["costo"];
        $curso->cupo = $_POST["cupo"];
        $curso->fecha_inicio = $_POST["fecha_inicio"];
        $curso->fecha_fin = $_POST["fecha_fin"];
        $curso->temario = $_POST["temario"];
        $curso->dueno_id = $_SESSION["id"];
        $curso->etiqueta_id = $_POST["etiqueta"];

        $cursos_model = new CursosModel;
        if($curso_editado = $cursos_model->update($curso)) {
            header("Location:". constant('URL')."cursos/ver/". $curso_editado->id);
        }
    }

    function eliminarCurso ($param)
    {
        $curso_id = $param[0];
        var_dump($curso_id);
        $cursos_model = new CursosModel;
        if($cursos_model->delete($curso_id))
        {
            header("Location:". constant('URL')."miscursos");
        }
    }
}

?>