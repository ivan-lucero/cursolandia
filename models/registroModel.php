<?php

include_once "models/classes/usuario.php";

class RegistroModel extends Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function userNameExist($nombre)
    {
        $item = new Usuario();
        $query = $this->db->connect()->prepare(
            "SELECT * FROM usuarios
            WHERE nombre = :nombre"
        );
        if($query->execute([
            "nombre" => $nombre,
        ]))
        {
            $item = $query->fetch();
            if($item) return true;
            else return false;
        }
    }

    function userEmailExist($email)
    {
        $item = new Usuario();
        $query = $this->db->connect()->prepare(
            "SELECT * FROM usuarios
            WHERE email = :email"
        );
        if($query->execute([
            "email" => $email,
        ]))
        {
            $item = $query->fetch();
            if($item) return true;
            else return false;
        }
    }

    function create ($datos)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO usuarios
            (nombre,email,contrasena)
            VALUES (:nombre,:email,:contrasena)"
        );
        if($query->execute([
            "nombre" => $datos["nombre"],
            "email" => $datos["email"],
            "contrasena" => $datos["contrasena"],
        ]))
            return true;
        else return false;
    }

}