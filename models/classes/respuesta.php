<?php 

class Respuesta {
    
    private $id;
    private $contenido;
    private $es_destacado;
    private $fecha_creacion;
    private $creador_id;
    private $preguntas_id;
    private $respuesta_citada_id;
    
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