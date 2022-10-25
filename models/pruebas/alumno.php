<?php

class Alumno {

    private $matricula;
    private $nombre;
    private $apellido;

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }
}

?>  