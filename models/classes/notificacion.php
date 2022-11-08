<?php

class Notificacion {

    private $id;
    private $contenido;
    private $es_leido;
    private $fecha_creacion;
    private $usuarios_id;

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