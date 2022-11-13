<?php

include_once "models/classes/usuario.php";

class PerfilModel extends Model {

    function __construct()
    {
        parent::__construct();
    }

    function getUser ($id)
    {
        $item = new Usuario();
        $query = $this->db->connect()->prepare(
            "SELECT * FROM usuarios
            WHERE id = :id
        ");
        try
        {
            if($query->execute(["id" => $id]))
            {
                $item = $query->fetch();
                return ($item);
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updateUser ($usuario)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE usuarios
            SET telefono=:telefono, fecha_nacimiento=:fecha_nacimiento, antecedentes=:antecedentes
            WHERE email=:email"
        );
        try
        {
            if($query->execute([
                "telefono" => $usuario->telefono,
                "fecha_nacimiento" => $usuario->fecha_nacimiento,
                "antecedentes" => $usuario->antecedentes,
                "email" => $usuario->email,
                ]))
            {
                return true;
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updateImage ($imagen, $user_id)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE usuarios
            SET imagen=:imagen
            WHERE id=:id"
        );
        try
        {
            if($query->execute([
                "imagen" => $imagen,
                "id" => $user_id
                ]))
            {
                return $imagen;
            }
            else return false;
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updatePassword ($id, $password)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE usuarios
            SET contrasena=:contrasena
            WHERE id=:id"
        );
        try
        {
            if($query->execute([
                "contrasena" => $password,
                "id" => $id,
                ]))
            {
                return true;
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function getUserTags($user_id)
    {
        $intereses = [];
        $query = $this->db->connect()->prepare(
            "SELECT E.nombre as 'nombre_etiqueta' 
            FROM etiquetas E, usuarios_etiquetas UE
            WHERE UE.usuario_id = :usuario_id
            AND UE.etiqueta_id = E.id"
        );
        try
        {
            if($query->execute(["usuario_id" => $user_id]))
            {
                while($row = $query->fetch())
                {
                    $intereses [] = $row["nombre_etiqueta"];
                }
                return $intereses;
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updateUserTags ($user_id, $intereses = null)
    {
        var_dump($intereses);
        try
        {
            $query = $this->db->connect()->query(
                "DELETE FROM usuarios_etiquetas
                WHERE usuario_id = ".$user_id
            );
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }
        try
        {
            if(!is_null($intereses))
            {
                foreach($intereses as $interes)
                {
                    $query = $this->db->connect()->prepare(
                        "INSERT INTO usuarios_etiquetas
                        (usuario_id, etiqueta_id)
                        VALUES (:usuario_id, :etiqueta_id)"
                    );
                    $query->execute([
                        "usuario_id" => $user_id,
                        "etiqueta_id" => intval($interes)
                    ]);
                }
                return true;
            }
        }
        catch(Exception $ex)
        {
            return $ex->getMessage();
        }
        
    }
}