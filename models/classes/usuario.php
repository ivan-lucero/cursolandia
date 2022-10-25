<?php

class Usuario {
    private $id;
    private $nombre;
    private $contraseña;
    private $email;
    private $telefono;
    private $fecha_nac;
    private $antecedentes;
    private $imagen;
    private $fecha_registro;
    private $rol;

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