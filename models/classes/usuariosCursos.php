<?php

class UsuarioCurso {
    private $curso_id;
    private $usuario_id;
    private $pago_pendiente;

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