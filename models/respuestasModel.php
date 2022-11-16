<?php

include_once "models/classes/respuesta.php";

class RespuestasModel extends Model {

    function getAllByQuestion ($pregunta_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM respuestas
            WHERE preguntas_id = :pregunta_id
            ");
        try
        {
            if($query->execute(["pregunta_id" => $pregunta_id]))
            {
                $items = [];
                while($row = $query->fetch())
                {
                    $item = new Respuesta;
                    $item->id = $row["id"];
                    $item->contenido = $row["contenido"];
                    $item->es_destacado = $row["es_destacado"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->preguntas_id = $row["preguntas_id"];
                    $item->creador_id = $row["creador_id"];
                    $item->respuesta_citada_id = $row["respuesta_citada_id"];
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

    function getById ($respuesta_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM respuestas
            WHERE id = :respuesta_id
            ");
        try
        {
            if($query->execute(["respuesta_id" => $respuesta_id]))
            {
                if($row = $query->fetch())
                {
                    $item = new Respuesta(); 
                    $item->id = $row["id"];
                    $item->contenido = $row["contenido"];
                    $item->es_destacado = $row["es_destacado"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->preguntas_id = $row["preguntas_id"];
                    $item->creador_id = $row["creador_id"];
                    $item->respuesta_citada_id = $row["respuesta_citada_id"];
                    return $item;
                }
                else return false;
            }
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function getLastAnswerByQuestion ($pregunta_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM respuestas
            WHERE preguntas_id = :id
            ORDER BY id DESC
            LIMIT 1
        ");
        try
        {
            if($query->execute(["id" => $pregunta_id]))
            {
                if($row = $query->fetch())
                {
                    $item = new Respuesta(); 
                    $item->id = $row["id"];
                    $item->contenido = $row["contenido"];
                    $item->es_destacado = $row["es_destacado"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->preguntas_id = $row["preguntas_id"];
                    $item->creador_id = $row["creador_id"];
                    $item->respuesta_citada_id = $row["respuesta_citada_id"];
                    return $item;
                }
                else return false;
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }

        
        
    }

    function create ($respuesta)
    {
        echo "asdasd";
        $query = $this->db->connect()->prepare(
            "INSERT INTO respuestas
             (contenido, preguntas_id, creador_id, respuesta_citada_id)
            VALUES (:contenido, :preguntas_id, :creador_id, :respuesta_citada_id)
            ");
        try
        {
            if($query->execute([
                "contenido" => $respuesta->contenido,
                "preguntas_id" => $respuesta->preguntas_id,
                "creador_id" => $respuesta->creador_id,
                "respuesta_citada_id" => $respuesta->respuesta_citada_id,
            ]))
            {
                $query_last_item = $this->db->connect()->query(
                    "SELECT *
                    FROM respuestas
                    ORDER BY id DESC
                    LIMIT 1");
                if($row = $query_last_item->fetch())
                {
                    $item = new Respuesta(); 
                    $item->id = $row["id"];
                    $item->contenido = $row["contenido"];
                    $item->es_destacado = $row["es_destacado"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->preguntas_id = $row["preguntas_id"];
                    $item->creador_id = $row["creador_id"];
                    $item->respuesta_citada_id = $row["respuesta_citada_id"];
                    return $item;
                }
            }
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function updateAccepted ($respuesta)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE respuestas
            SET es_destacado = 1
            WHERE id = :respuesta_id 
            ");
        try
        {
            if($query->execute(["respuesta_id" => $respuesta->id]))
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