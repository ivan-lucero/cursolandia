<?php

include_once "models/classes/solicitudPro.php";
include_once "models/classes/usuario.php";

class UsuariosModel extends Model {

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

}

?>