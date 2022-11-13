<?php

include_once "models/classes/usuario.php";
include_once("helpers/validaciones.php");
include_once("helpers/archivos.php");

class PerfilController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
    function render()
    {
        if(!isset($_SESSION)) session_start();
        $usuario = new Usuario();
        $usuario = $this->model->getUser($_SESSION["id"]);
        $intereses = $this->model->getUserTags($_SESSION["id"]);
        $this->view->usuario = $usuario;
        $this->view->intereses = $intereses;
        $this->view->render('perfil/index');
    }
    function editar($errors = [])
    {
        if(!isset($_SESSION)) session_start();
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
    function contrasena ($errors = [])
    {
        if(!isset($_SESSION)) session_start();
        $usuario = new Usuario();
        $usuario = $this->model->getUser($_SESSION["id"]);
        if(!empty($errors))
        {
            $this->view->usuario = $_POST;
            $this->view->errores = $errors;
        }
        $this->view->usuario = $usuario;
        $this->view->render('perfil/contrasena');
    }

    function imagen ($errors = []) 
    {
        $this->view->errores = $errors;
        $this->view->render("perfil/imagen");
    }
    
    function editarPerfil ()
    {
        $archivosHelper = new Archivos();
        $errors = [];
        $intereses = [];
        session_start();
        
        if(!empty($_POST["telefono"])) {
            if(!Validaciones::validarTelefono($_POST["telefono"]))
                $errors["telefono"] = "El valor ingresado no es un telefono";
        }
        if(!empty($_POST["antecedentes"]))
        {
            if(!Validaciones::validarAntecedentes($_POST["antecedentes"]))
                $errors["antecedentes"] = "Los antecedentes deben ser menor a 255 caracteres";
        }
        if(!empty($_POST["fecha_nacimiento"]))
        {
            if(!Validaciones::validarFechaNacimiento($_POST["fecha_nacimiento"]))
                $errors["fecha_nacimiento"] = "La fecha ingresada no es válida";
        }
        
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
        $usuario = new Usuario();
        $usuario->email = $_SESSION["email"];
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

    function cambiarContrasena ()
    {
        if(!isset($_SESSION)) session_start();
        $usuario = $this->model->getUser($_SESSION["id"]);
        $errors = [];
        if(!Validaciones::validarContrasena($_POST["contrasena_actual"]))
            $errors["contrasena_actual"] = "La contraseña no es válida";
        if(!Validaciones::validarContrasena($_POST["contrasena"]))
            $errors["contrasena"] = "la contraseña tiene que ser mayor a 8 caracteres";
        else if(!Validaciones::validarContrasena($_POST["confirmar_contrasena"]))
            $errors["confirmar_contrasena"] = "la contraseña tiene que ser mayor a 8 caracteres";
            else if($_POST["contrasena"] !== $_POST["confirmar_contrasena"])
                $errors["confirmar_contrasena"] = "Las contraseñas ingresadas son diferentes";

        if(!password_verify($_POST["contrasena_actual"], $usuario["contrasena"]))
            $errors["contrasena_actual"] = "La contraseña no es válida";
        
        if(!empty($errors))
        {
            $this->view->errores = $errors;
            $this->contrasena($errors);
            return false;
        }
        
        if($this->model->updatePassword($_SESSION["id"], password_hash($_POST["contrasena"], PASSWORD_DEFAULT)))
        {
            header("Location:". constant('URL')."/perfil");
        }
    }

    function cambiarImagen()
    {
        $archivosHelper = new Archivos();
        session_start();
        $errors = [];
        if(empty($_FILES["imagen"]["tmp_name"])){
            $errors ["imagen"] = "Debe seleccionar una imagen";
            $this->imagen($errors);
            return;
        }
        $imagen = $archivosHelper->subirImagen($_FILES, $_SESSION["nombre"]);
        if($imagen)
        {
            if($this->model->updateImage($imagen, $_SESSION["id"]))
            {
                header("Location:". constant('URL')."/perfil");
            } 
        }
    }
}

?>