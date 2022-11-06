<?php

class Pregunta {

    private $id;
    private $titulo;
    private $contenido;
    private $fecha_creacion;
    private $curso_id;
    private $creador_id;

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