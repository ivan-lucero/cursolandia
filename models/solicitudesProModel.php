<?php

include_once "models/classes/solicitudPro.php";

class SolicitudesProModel extends Model {

    function getById($usuario_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM solicitudes_pro
            WHERE usuario_id = :usuario_id
        ");
        try{
            if($query->execute(["usuario_id" => $usuario_id]))
            {
                if($query->fetch())
                return true;
                else return false;
            }
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }
    function getAll()
    {
        $query = $this->db->connect()->query(
            "SELECT * FROM solicitudes_pro
        ");
        try{
            $items = [];
            while($row = $query->fetch())
            {
                $item = new SolicitudPro;
                $item->id = $row["id"];
                $item->usuario_id = $row["usuario_id"];
                $items[] = $item;
            }
            return $items;
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function create($usuario_id)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO solicitudes_pro
            (usuario_id)
            VALUES (:usuario_id)
            "
        );
        try
        {
            if($query->execute(["usuario_id" => $usuario_id]))
            {
                return true;
            }
            else return false;
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function delete($usuario_id)
    {
        echo "DELETE";
        $query = $this->db->connect()->prepare(
            "DELETE FROM solicitudes_pro
            WHERE usuario_id = :usuario_id
            "
        );
        try
        {
            if($query->execute(["usuario_id" => $usuario_id]))
            {
                return true;
            }
            else return false;
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }    
}

?>