<?php

include_once "models/classes/material.php";

class MaterialesModel extends Model {

    function getById($material_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM materiales
            WHERE id = :id
        ");
        try
        {
            if($query->execute(["id" => $material_id]))
            {
                if($row = $query->fetch())
                {
                    $item = new Material;
                    $item->id = $row["id"];
                    $item->nombre = $row["nombre"];
                    $item->peso = $row["peso"];
                    $item->curso_id = $row["cursos_id"];
                }
                return $item;
            }
            else return false;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function getAllByCourse($curso_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM materiales WHERE cursos_id = :curso_id
        ");
        try
        {
            if($query->execute(["curso_id" => $curso_id]))
            {
                $items = [];
                while($row = $query->fetch())
                {
                    $item = new Material(); 
                    $item->id = $row["id"];
                    $item->nombre = $row["nombre"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->curso_id = $row["cursos_id"];
                    $items [] = $item;
                }
                return $items;
            }
            else echo "Error BD";
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function create($material)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO materiales
            (nombre, peso, cursos_id)
            VALUES (:nombre, :peso, :cursos_id)
        ");
        try
        {
            if($query->execute([
                "nombre" => $material->nombre,
                "peso" => intval($material->peso),
                "cursos_id" => intval($material->curso_id),
                ])){
                    $query_last_item = $this->db->connect()->query(
                        "SELECT *
                        FROM materiales
                        ORDER BY id DESC
                        LIMIT 1");
                    if($row = $query_last_item->fetch())
                    {
                        $item = new Material(); 
                        $item->id = $row["id"];
                        $item->nombre = $row["nombre"];
                        $item->fecha_creacion = $row["fecha_creacion"];
                        $item->curso_id = $row["cursos_id"];
                        return $item;
                    }
                }
                else echo "Error";
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function delete ($material_id)
    {
        $query = $this->db->connect()->prepare(
            "DELETE FROM materiales
            WHERE id = :id
        ");
        try
        {
            if($query->execute(["id" => $material_id]))
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