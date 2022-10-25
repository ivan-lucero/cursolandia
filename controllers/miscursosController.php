<?php

class MisCursosController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('mis-cursos/index');
    }
}

?>