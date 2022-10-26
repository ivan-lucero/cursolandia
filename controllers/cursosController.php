<?php

class CursosController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('cursos/index');
    }

}

?>