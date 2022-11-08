<?php

include_once "models/classes/pregunta.php";

class PreguntasModel extends Model {

    function getAllByCourse($curso_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM preguntas
            WHERE cursos_id = :curso_id
            ");
        try
        {
            if($query->execute(["curso_id" => $curso_id]))
            {
                $items = [];
                while($row = $query->fetch())
                {
                    $item = new Pregunta;
                    $item->id = $row["id"];
                    $item->titulo = $row["titulo"];
                    $item->contenido = $row["contenido"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->es_concluida = $row["es_concluida"];
                    $item->curso_id = $row["cursos_id"];
                    $item->creador_id = $row["creador_id"];
                    $items[] = $item;
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

    function getById ($pregunta_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM preguntas
            WHERE id = :id
            ");
        try
        {
            if($query->execute(["id" => $pregunta_id]))
            {
                if($row = $query->fetch())
                {
                    $item = new Pregunta;
                    $item->id = $row["id"];
                    $item->titulo = $row["titulo"];
                    $item->contenido = $row["contenido"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->es_concluida = $row["es_concluida"];
                    $item->curso_id = $row["cursos_id"];
                    $item->creador_id = $row["creador_id"];
                    return $item;
                }
            }
            else return false;
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
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
                    $item->es_concluida = $row["es_concluida"];
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
            "UPDATE preguntas
            SET titulo=:titulo,contenido=:contenido
            WHERE id=:id
        ");
        try
        {
            if($query->execute([
                "titulo" => $pregunta->titulo,
                "contenido" => $pregunta->contenido,
                "id" => $pregunta->id
            ]))
            return $pregunta;
            else return false;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updateConclude ($pregunta)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE preguntas
            SET es_concluida = 1
            WHERE id = :id
        ");
        try
        {
            if($query->execute([
                "id" => $pregunta->id,
            ]))
            return true;
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