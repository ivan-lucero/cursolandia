<?php

include_once "models/alumno.php";

class NuevoModel extends Model {

    function __construct()
    {
        parent::__construct();
    }

    function insert ($datos)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO alumnos
            (matricula,nombre,apellido)
            VALUES (:matricula, :nombre, :apellido)"
        );
        
        if($query->execute([
            "matricula" => $datos["matricula"],
            "nombre" => $datos["nombre"],
            "apellido" => $datos["apellido"],
        ]))
            return true;
        else return false;
    }
}