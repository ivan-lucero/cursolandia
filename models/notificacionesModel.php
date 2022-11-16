<?php 

include_once "models/classes/notificacion.php";

class NotificacionesModel extends Model {
    
    function getAllByUser($usuario_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM notificaciones
            WHERE usuarios_id = :usuario_id
        ");
        try
        {
            if($query->execute(["usuario_id" => $usuario_id]))
            {
                $items = [];
                while($row = $query->fetch())
                {
                    $item = new Notificacion;
                    $item->id = $row["id"];
                    $item->contenido = $row["contenido"];
                    $item->es_leido = $row["es_leido"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->usuario_id = $row["usuarios_id"];
                    $items [] = $item;
                }
                return $items;
            }
            else return false;
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
        
    }

    function create ($notificacion)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO notificaciones
            (contenido, usuarios_id)
            VALUES (:contenido, :usuarios_id)
        ");
        try
        {
            if($query->execute([
                "contenido" => $notificacion->contenido,
                "usuarios_id" => $notificacion->usuario_id,
            ]))
            {
                $query_last_item = $this->db->connect()->query(
                    "SELECT *
                    FROM notificaciones
                    ORDER BY id DESC
                    LIMIT 1");
                if($row = $query_last_item->fetch())
                {
                    $item = new Notificacion(); 
                    $item->id = $row["id"];
                    $item->contenido = $row["contenido"];
                    $item->es_leido = $row["es_leido"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->usuario_id = $row["usuarios_id"];
                    return $item;
                }
                else echo "Error";
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updateRead($notificacion_id)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE notificaciones
            SET es_leido = 1
            WHERE id = :notificacion_id
            "
        );
        try
        {
            if($query->execute(["notificacion_id" => $notificacion_id]))
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