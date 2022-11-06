<?php

include_once "models/solicitudesProModel.php";
include_once "models/usuariosModel.php";

class AdminUsuariosController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        
        $solicitudes_pro_model = new SolicitudesProModel;
        $usuarios_model = new UsuariosModel;
        $solicitudes = $solicitudes_pro_model->getAll(); 
        foreach ($solicitudes as $solicitud)
        {
            $usuario = $usuarios_model->getUser($solicitud->usuario_id);
            $solicitud->nombre = $usuario["nombre"];
        }
        $this->view->solicitudes = $solicitudes;

        $this->view->render('admin/usuarios/index');
    }

    function aceptarSolicitud ($param)
    {
        $usuario_id = $param[0];
        $usuarios_model = new UsuariosModel;
        $solicitudes_pro_model = new SolicitudesProModel;
        if($usuarios_model->updatePro($usuario_id)){
            $solicitudes_pro_model->delete($usuario_id);
            header("Location:". constant('URL')."adminusuarios");
        }
    }
    function rechazarSolicitud ($param)
    {
        echo "Rechazar solicitud";
        var_dump($param[0]);
        $usuario_id = $param[0];
        $usuarios_model = new UsuariosModel;
        $solicitudes_pro_model = new SolicitudesProModel;
        if($solicitudes_pro_model->delete($usuario_id))
            header("Location:". constant('URL')."adminusuarios");
    }
}

?>