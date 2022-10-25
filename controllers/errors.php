<?php

class Errors extends Controller{

    function __construct()
    {
        parent::__construct();
    }
    
    function error404 () 
    {
        $this->view->error = "404.php";
        $this->view->render('errors/index');
    }
}
