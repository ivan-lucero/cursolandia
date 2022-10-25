<?php

class AdminMaterialesController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('admin/materiales/index');
    }
}

?>