<?php

include_once "models/solicitudesProModel.php";
include_once "models/usuariosModel.php";


class CuentaProController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        session_start();
        $usuarios_model = new UsuariosModel;
        $usuario = $usuarios_model->getUser($_SESSION["id"]);
        $this->view->vencimiento_pro = NULL;
        $this->view->es_solicitado = NULL;
        if(!is_null($usuario["vencimiento_pro"]))
        {
            $this->view->vencimiento_pro = $usuario["vencimiento_pro"];
        }
        else 
        {
            $solicitudes_pro_model = new SolicitudesProModel;
            $this->view->es_solicitado = $solicitudes_pro_model->getById($usuario["id"]);
        }
        $this->view->render('cuenta-pro/index');
    }

    function solicitarCuentaPro()
    {
        session_start();
        $solicitudes_pro_model = new SolicitudesProModel;
        if($solicitudes_pro_model->create($_SESSION["id"]))
        {
            header("Location:". constant('URL')."cuentapro");
        }
        else echo "Error inesperado";

    }
}

?>