<?php

include_once "models/classes/solicitudPro.php";
include_once "models/classes/usuario.php";

class UsuariosModel extends Model {

    function getUser ($id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM usuarios
            WHERE id = :id
        ");
        try
        {
            $item = new Usuario();
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

    function getUserTags($usuario_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT etiqueta_id FROM usuarios_etiquetas
            WHERE usuario_id = :usuario_id
        ");
        try
        {
            if($query->execute(["usuario_id" => $usuario_id]))
            {
                $items = [];
                while($row = $query->fetch())
                {
                    $items [] = $row["etiqueta_id"];
                }
                return $items;
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updatePro ($usuario_id)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE usuarios
            SET vencimiento_pro=:vencimiento_pro
            WHERE id=:usuario_id"
        );
        try
        {
            $fecha_actual = date("d-m-Y");
            if($query->execute([
                "vencimiento_pro" => date("Y-m-d",strtotime($fecha_actual."+ 1 year")),
                "usuario_id" => $usuario_id,
                ]))
            {
                return true;
            }
            else return false;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function getUserCourses($usuario_id)
    {
        // $query = $this->db->connect()->prepare(
        //     "SELECT COUNT()
        // ")
    }

}

?>