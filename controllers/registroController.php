<?php
include_once("helpers/validaciones.php");

class RegistroController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('registro/index');
    }

    function roles ()
    {
        $roles = $this->model->prueba();
        var_dump($roles);
    }
    
    function registrarse()
    {
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];
        $confirmar_contrasena = $_POST["confirmar_contrasena"];
        
        $errors = [];
        
        if(!Validaciones::validarNombre($nombre))
            $errors["nombre"] = "El nombre solo debe contener letras y numeros";
        if(!Validaciones::validarEmail($email))
            $errors["email"] = "El valor ingresado no es un email";
        if(!Validaciones::validarContrasena($contrasena))
            $errors["contrasena"] = "la contraseña tiene que ser mayor a 8 caracteres";
        else if(!Validaciones::validarContrasena($confirmar_contrasena))
                $errors["confirmar_contrasena"] = "la contraseña tiene que ser mayor a 8 caracteres";
                else if($contrasena !== $confirmar_contrasena)
                    $errors["contrasena"] = "Las contraseñas ingresadas son diferentes";
        if(!empty($errors))
        {
            $this->view->errores = $errors;
            $this->view->render('registro/index');
            return false;
        }
        if($this->model->userNameExist($nombre))
            $errors["nombre"] = "El nombre ingresado ya existe";
        if($this->model->userEmailExist($email))
            $errors["email"] = "El email ingresado ya existe";
        if(!empty($errors))
        {
            $this->view->errores = $errors;
            $this->view->render('registro/index');
            return false;
        }
        
        $respuesta = $this->model->create([
            "nombre" => $nombre,
            "email" => $email,
            "contrasena" => password_hash($contrasena, PASSWORD_DEFAULT)
        ]);
        
        if($respuesta)
        {
            echo "Entra respuesta OK";
            session_start();
            $_SESSION["rol"] = 1;
            $_SESSION["email"] = $email;
            header("Location:". constant('URL'));

        }
        else echo "Error inesperado";
    }
}

?>