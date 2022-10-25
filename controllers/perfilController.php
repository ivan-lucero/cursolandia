<?php

include_once "models/classes/usuario.php";
include_once("helpers/validaciones.php");

class PerfilController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
    function render()
    {
        session_start();
        $usuario = new Usuario();
        $usuario = $this->model->getUser($_SESSION["id"]);
        $intereses = $this->model->getUserTags($_SESSION["id"]);
        $this->view->usuario = $usuario;
        $this->view->intereses = $intereses;
        $this->view->render('perfil/index');
    }
    function editar($errors = [])
    {
        session_start();
        $usuario = new Usuario();
        $usuario = $this->model->getUser($_SESSION["id"]);
        $intereses = $this->model->getUserTags($_SESSION["id"]);
        if(!empty($errors))
        {
            $this->view->usuario = $_POST;
            $this->view->errores = $errors;
        }
        $this->view->usuario = $usuario;
        $this->view->intereses = $intereses;
        $this->view->render('perfil/editar');
    }
    function contrasena ()
    {
        session_start();
        $usuario = new Usuario();
        $usuario = $this->model->getUser($_SESSION["id"]);
        $this->view->usuario = $usuario;
        $this->view->render('perfil/contrasena');
    }
    
    function editarPerfil ()
    {
        $errors = [];
        $intereses = [];
        if(!Validaciones::validarTelefono($_POST["telefono"]))
            $errors["telefono"] = "El valor ingresado no es un telefono";
        if(!Validaciones::validarAntecedentes($_POST["antecedentes"]))
            $errors["antecedentes"] = "Los antecedentes deben ser menor a 255 caracteres";
        if(!Validaciones::validarFechaNacimiento($_POST["fecha_nacimiento"]))
            $errors["fecha_nacimiento"] = "La fecha ingresada no es válida";
        
        if(isset($_POST["programacion"]))
            $intereses[] = 1;
        if(isset($_POST["diseno"]))
            $intereses[] = 2;
        if(isset($_POST["finanzas"]))
            $intereses[] = 3;
        if(!empty($errors))
        {
            $this->view->errores = $errors;
            $this->editar($errors);
            return false;
        }
        session_start();
        $usuario = new Usuario();
        $usuario->email = $_SESSION["email"];
        $usuario->imagen = $_POST["imagen"];
        $usuario->telefono = $_POST["telefono"];
        $usuario->fecha_nacimiento = $_POST["fecha_nacimiento"];
        $usuario->antecedentes = $_POST["antecedentes"];
        if($this->model->updateUser($usuario) 
        && $this->model->updateUserTags($_SESSION["id"], $intereses))
        {
            header("Location:". constant('URL')."/perfil");
        }
        else echo "Error inesperado.";
    }
}

?>