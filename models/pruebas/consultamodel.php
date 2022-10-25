<?php

include_once "models/alumno.php";

class ConsultaModel extends Model {

    function __construct()
    {
        parent::__construct();
    }

    function get ()
    {
        $items = [];

        try
        {
            $query = $this->db->connect()->query("SELECT * FROM alumnos");
            while ($row = $query->fetch())
            {
                $item = new Alumno();
                $item->matricula = $row["matricula"];
                $item->nombre = $row["nombre"];
                $item->apellido = $row["apellido"];
                $items[] = $item;
            }
            return $items;
        }
        catch(PDOException $ex)
        {
            return null;
        }
    }

    function getById ($id)
    {
        include_once "alumno.php";
        $item = new Alumno();
        $query = $this->db->connect()->prepare(
            "SELECT * FROM alumnos
            WHERE matricula = :matricula"
        );
        try
        {
            $query->execute(["matricula" => $id]);
            while($row = $query->fetch())
            {
                $item->matricula = $row['matricula'];
                $item->nombre = $row["nombre"];
                $item->apellido = $row["apellido"];
            }
            return $item;
        }
        catch(PDOException $ex)
        {
            return null;
        }
    }

    function update ($item)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE alumnos
            SET nombre = :nombre, apellido = :apellido
            WHERE matricula = :matricula
        ");
        if($query->execute([
            "matricula" => $item["matricula"],
            "nombre" => $item["nombre"],
            "apellido" => $item["apellido"],
        ]))
            return true;
        else return false;
    }

    function delete ($id)
    {
        $query = $this->db->connect()->prepare(
            "DELETE FROM alumnos
            WHERE matricula = :matricula
        ");
        if($query->execute([
            "matricula" => $id,
        ]))
            return true;
        else return false;
    }
}