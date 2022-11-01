<?php

class Curso {
    private $id;
    private $titulo;
    private $descripcion;
    private $costo;
    private $cupo;
    private $fecha_inicio;
    private $fecha_fin;
    private $temario;
    private $fecha_creacion;
    private $dueno_id;
    private $etiqueta_id;

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