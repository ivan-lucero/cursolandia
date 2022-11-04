<?php

class  Material {
    private $id;
    private $nombre;
    private $ruta;
    private $peso;
    private $unidad;
    private $fecha_creacion;
    private $curso_id;
    private $tipo_materiales_id;

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