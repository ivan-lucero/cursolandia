<?php

include_once "models/classes/usuario.php";

class loginModel extends Model {

    function __construct()
    {
        parent::__construct();
    }

    function getUser ($email)
    {
        $item = new Usuario();
        $query = $this->db->connect()->prepare(
        "SELECT * FROM usuarios
        WHERE email = :email
        ");
        try
        {
            if($query->execute(["email" => $email]))
            {
                $item = $query->fetch();
                return ($item);
            }
        }
        catch(PDOException $ex)
        {
            return null;
        }
    }

}