<?php

class Etiqueta {
    private $id;
    private $nombre;

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