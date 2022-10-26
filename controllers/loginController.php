<?php
include_once("helpers/validaciones.php");

class loginController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('login/index');
    }
    
    function iniciarSesion()
    {
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        $errors = [];
        
        if(!Validaciones::validarEmail($email))
            $errors["email"] = "El valor ingresado no es un email";
        if(!Validaciones::validarContrasena($contrasena))
            $errors["contrasena"] = "la contrasena tiene que ser mayor a 8 caracteres";
        if(!empty($errors))
        {
            $this->view->errores = $errors;
            $this->view->render('login/index');
            return false;
        }
        
        $usuario = $this->model->getUser($email, $contrasena);
        if(!$usuario)
        {
            $errors["email"] = "El email ingresado no existe";
            $this->view->errores = $errors;
            $this->view->render('login/index');
            return false;
        }
        
        if(!password_verify($contrasena, $usuario["contrasena"]))
        {
            $errors["contrasena"] = "La contraseña es incorrecta";
            $this->view->errores = $errors;
            $this->view->render('login/index');
            return false;
        }
        session_start();
        $_SESSION["id"] = $usuario["id"];
        $_SESSION["email"] = $usuario["email"];
        $_SESSION["nombre"] = $usuario["nombre"];
        $_SESSION["rol"] = $usuario["roles_id"];
        header("Location:". constant('URL'));
    }

    function cerrarSesion()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location:". constant('URL'));
    }
}

?>