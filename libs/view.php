<?php

class View {

    function render($view) {
        require 'views/'.$view.".php";
    }
}

?>