<?php

class PreguntasModel extends Model {

    function getAllByCourse()
    {
    
    }

    function getById ()
    {

    }

    function create ($pregunta)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO preguntas
             (titulo, contenido, cursos_id, creador_id)
            VALUES (:titulo, :contenido, :cursos_id, :creador_id)
            ");
        try
        {
            if($query->execute([
                "titulo" => $pregunta->titulo,
                "contenido" => $pregunta->contenido,
                "cursos_id" => $pregunta->cursos_id,
                "creador_id" => $pregunta->creador_id,
            ]))
            {
                $query_last_item = $this->db->connect()->query(
                    "SELECT *
                    FROM preguntas
                    ORDER BY id DESC
                    LIMIT 1");
                if($row = $query_last_item->fetch())
                {
                    $item = new Pregunta(); 
                    $item->id = $row["id"];
                    $item->titulo = $row["titulo"];
                    $item->contenido = $row["contenido"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->curso_id = $row["cursos_id"];
                    $item->creador_id = $row["creador_id"];
                    return $item;
                }
            }
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function update ($pregunta)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE cursos
            SET titulo=:titulo,contenido=:contenido
            WHERE id=:id
        ");
        try
        {
            if($query->execute([
                "titulo" => $pregunta->titulo,
                "contenido" => $pregunta->contenido,
            ]))
            return $pregunta;
            else return false;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function delete ()
    {

    }
}

?>