<?php

include_once "models/classes/curso.php";
include_once "models/cursosModel.php";
include_once "models/usuariosCursosModel.php";
include_once "models/materialesModel.php";
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
        $usuarios_cursos_model = new UsuariosCursosModel;
        $cursos_creados = $cursos_model->getAllByUser($_SESSION["id"]);
        $cursos_inscriptos_id = $usuarios_cursos_model->getCoursesRegisteredByUser($_SESSION["id"]);
        $cursos_inscriptos = [];
        foreach($cursos_inscriptos_id as $id)
        {
            $cursos_inscriptos[] = $cursos_model->getById($id);
        }
        $this->view->cursos_creados = $cursos_creados;
        $this->view->cursos_inscriptos = $cursos_inscriptos;
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
        $cursos_model = new CursosModel;
        if($cursos_model->delete($curso_id))
        {
            header("Location:". constant('URL')."miscursos");
        }
    }

    function subirMaterial($param)
    {
        $curso_id = $param[0];
        if($_FILES["material"]["name"] === "")
        {
            echo "Error. Archivo vacio";
            return;
        }
        $archivosHelper = new Archivos;
        $materiales_model = new MaterialesModel;
        $material = new Material;
        $material->nombre = $_FILES["material"]["name"];
        $material->peso = $_FILES["material"]["size"];
        $material->curso_id = $curso_id;
        if($material_creado = $materiales_model->create($material))
        {
            if($archivosHelper->subirMaterial($_FILES, $curso_id))
                header("Location:". constant('URL')."cursos/ver/". $curso_id);
            else echo "Error al subir archivo";
        }
        else echo "Error BD desde controlador";
    }

    function eliminarMaterial ($param)
    {
        session_start();
        $material_id = $param[0];
        $materiales_model = new MaterialesModel;
        $cursos_model = new CursosModel;
        $material = $materiales_model->getById($material_id);
        $curso = $cursos_model->getById($material->curso_id);
        if($curso->dueno_id !== $_SESSION["id"])
        {
            echo "Error 403. Operacion no autorizada";
            return;
        }
        if($materiales_model->delete($material_id))
        {
            if(unlink("uploads/files/" . $curso->id .".". $material->nombre))
            {
                header("Location:". constant('URL')."cursos/ver/". $curso->id);
            } else echo "error";
        } 
        echo "Error Inesperado";
    }

    function aceptarAlumno ($params)
    {
        $usuario_id = $params[0];
        $curso_id = $params[1];
        $usuarios_cursos_model = new UsuariosCursosModel;
        if($usuarios_cursos_model->updateStudentPendingToPay($curso_id, $usuario_id))
        {
            header("Location:". constant('URL')."cursos/ver/". $curso_id);
        } else echo "Error inesperado";
    }
    function rechazarAlumno ($params)
    {
        $usuario_id = $params[0];
        $curso_id = $params[1];
        $usuarios_cursos_model = new UsuariosCursosModel;
        if($usuarios_cursos_model->deleteStudent($curso_id, $usuario_id))
        {
            header("Location:". constant('URL')."cursos/ver/". $curso_id);
        } else echo "Error inesperado";
    }

}

?>