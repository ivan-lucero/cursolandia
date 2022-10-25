<?php

class CuentaProController extends Controller{
    function __construct()
    {
        parent::__construct();
    }
        
    function render(){
        $this->view->render('cuenta-pro/index');
    }
}

?>