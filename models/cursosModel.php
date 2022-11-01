<?php

include_once "models/classes/curso.php";

class CursosModel extends Model {

    function getLast ()
    {
        $lastItem = $this->db->connect()->query("select *
        from cursos
       order by id desc
       limit 1;");
       if($row = $lastItem->fetch())
       {
           $item = new Curso();
           $item->titulo = $row["titulo"];
           $item->descripcion = $row["descripcion"];
           $items[] = $item;
       }
       return $items;
    }

    function getAll ()
    {
        // $query = $this->db->connect()->query()
    }

    function getAllByUser ($user_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM cursos
            WHERE dueño_id = :id 
        ");
        try{
            $items = [];
            if($query->execute(["id" => $user_id]))
            {
                while($row = $query->fetch())
                {
                    $item = new Curso();
                    $item->titulo = $row["titulo"];
                    $item->descripcion = $row["descripcion"];
                    $item->costo = $row["costo"];
                    $item->cupo = $row["cupo"];
                    $item->fecha_inicio = $row["fecha_inicio"];
                    $item->fecha_fin = $row["fecha_fin"];
                    $item->temario = $row["temario"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->dueno_id = $row["dueno_id"];
                    $items [] = $item;
                }
                return $items;
            }
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function getById ($id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM cursos
            WHERE id = :id 
        ");
        try{
            if($query->execute(["id" => $id]))
            {
                if($row = $query->fetch())
                {
                    $item = new Curso();
                    $item->id = $row["id"];
                    $item->titulo = $row["titulo"];
                    $item->descripcion = $row["descripcion"];
                    $item->costo = $row["costo"];
                    $item->cupo = $row["cupo"];
                    $item->fecha_inicio = $row["fecha_inicio"];
                    $item->fecha_fin = $row["fecha_fin"];
                    $item->temario = $row["temario"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->dueno_id = $row["dueno_id"];
                    return $item;
                }
            }
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function create ($curso)
    {
        var_dump($curso);
        echo "CREATE";
        $query = $this->db->connect()->prepare(
            "INSERT INTO cursos
                (titulo,descripcion,costo,cupo,fecha_inicio,fecha_fin,temario,dueno_id)
            VALUES (:titulo,:descripcion,:costo,:cupo,:fecha_inicio,:fecha_fin,:temario,:dueno_id)"
        );
        try{
            if($query->execute([
                "titulo" => $curso->titulo,
                "descripcion" => $curso->descripcion,
                "costo" => $curso->costo,
                "cupo" => $curso->cupo,
                "fecha_inicio" => $curso->fecha_inicio,
                "fecha_fin" => $curso->fecha_fin,
                "temario" => $curso->temario,
                "dueno_id" => $curso->dueno_id,
            ]))
            {
                $query_last_item = $this->db->connect()->query(
                    "SELECT *
                    FROM cursos
                    ORDER BY id DESC
                    LIMIT 1");
                if($row = $query_last_item->fetch())
                {
                    $item = new Curso();
                    $item->id = $row["id"];
                    $item->titulo = $row["titulo"];
                    $item->descripcion = $row["descripcion"];
                    $item->costo = $row["costo"];
                    $item->cupo = $row["cupo"];
                    $item->fecha_inicio = $row["fecha_inicio"];
                    $item->fecha_fin = $row["fecha_fin"];
                    $item->temario = $row["temario"];
                    $item->fecha_creacion = $row["fecha_creacion"];
                    $item->dueno_id = $row["dueno_id"];
                    return $item;
                }
            }
            else return false;
        }
        catch(Exception $ex)
        {
            echo "Catch";
            var_dump($ex);
            return $ex->getMessage();
        }
    }

    function update ($curso)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE cursos
            SET titulo=:titulo,descripcion=:descripcion,costo=:costo,cupo=:cupo,fecha_inicio=:fecha_inicio,fecha_fin=:fecha_fin,temario=:temario,fecha_creacion=:fecha_creacion,dueno_id=:dueno_id
            WHERE id=:id
        ");
        if($query->execute([
            "titulo" => $curso->titulo,
            "descripcion" => $curso->descripcion,
            "costo" => $curso->costo,
            "cupo" => $curso->cupo,
            "fecha_inicio" => $curso->fecha_inicio,
            "fecha_fin" => $curso->fecha_fin,
            "temario" => $curso->temario,
            "fecha_creacion" => $curso->fecha_creacion,
            "dueno_id" => $curso->dueno_id,
            "id" => $curso->id,
        ]))
        return true;
        else return false;
    }
    function delete($id)
    {
        $query= $this->db->connect()->prepare(
            "DELETE FROM cursos
            WHERE id = :id
            ");
        try
        {
            if($query->execute(["id" => $id]))
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