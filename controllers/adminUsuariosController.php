<?php

class AdminUsuariosController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('admin/usuarios/index');
    }
}

?>