<?php 

include_once "models/classes/notificacion.php";

class NotificacionesModel extends Model {
    
    function getAllByUser($usuario)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM notificaciones
            WHERE id = :usuario_id
        ");
        try
        {
            if($query->execute(["usuario_id" => $usuario->id]))
            {
                $items = [];
                while($row = $query->fetch())
                {
                    $item = new Notificacion;
                    $item->id = $row["id"];
                    $item->contenido = $row["contenido"];
                    $item->es_leido = $row["es_leido"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->usuarios_id = $row["usuarios_id"];
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


}

?>