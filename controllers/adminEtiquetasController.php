<?php

class AdminEtiquetasController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('admin/etiquetas/index');
    }
}

?>