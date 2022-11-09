<?php

include_once "models/classes/curso.php";
include_once "models/cursosModel.php";
include_once "models/classes/usuario.php";
include_once "models/usuariosModel.php";
include_once "models/etiquetasModel.php";

class HomeController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render()
    {
        session_start();
        if(empty($_SESSION))
        {
            $this->view->render('home/invitado');
            return;
        }
        if($_SESSION["rol"] == 1)
        {
            $usuarios_model = new UsuariosModel;
            $etiquetas_model = new EtiquetasModel;
            $etiquetas_usuario = $usuarios_model->getUserTags($_SESSION["id"]);
            $cursos_model = new CursosModel;
            $cursos_recomendados = [];
            foreach($etiquetas_usuario as $etiqueta)
            {
                $etiqueta = $etiquetas_model->getById($etiqueta);
                $cursos_recomendados[$etiqueta->nombre] = $cursos_model->getByTag($etiqueta->id);
            }
            $this->view->cursos_recomendados = $cursos_recomendados;
            $this->view->render('home/usuario');
        }

        if($_SESSION["rol"] == 2)
        {
            $this->view->render('admin/index');
        }
        
    }
}

?>