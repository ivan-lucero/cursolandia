<?php 

include_once "classes/etiqueta.php";

class EtiquetasModel extends Model 
{

    function getById($etiqueta_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM etiquetas
            WHERE id = :etiqueta_id
        ");
        try
        {
            if($query->execute(["etiqueta_id" => $etiqueta_id]))
            {
                if($row = $query->fetch())
                {
                    $item = new Etiqueta;
                    $item->id = $row["id"];
                    $item->nombre = $row["nombre"];
                    return $item;
                }
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

}


?>