<?php

include_once "models/classes/usuariosCursos.php";

class UsuariosCursosModel extends Model {

    function getStudentsByCourse($id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT * FROM usuarios_cursos
            WHERE cursos_id = :curso_id
            AND pago_pendiente = 0 
        ");
        try
        {
            if($query->execute(["curso_id" => $id]))
            {   
                $items = [];
                while($row = $query->fetch())
                {
                    $item = $row["usuarios_id"];
                    $items[] = $item;
                }
            }
            return $items;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }
    
    function getStudentsPendingsToPayByCourse($id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT usuarios_id FROM usuarios_cursos
            WHERE cursos_id = :curso_id 
            AND pago_pendiente = 1
        ");
        try
        {
            if($query->execute(["curso_id" => $id]))
            {   
                $items = [];
                while($row = $query->fetch())
                {
                    $item = new UsuarioCurso;
                    $item->usuario_id = $row["usuarios_id"];
                    $items[] = $item;
                }
            }
            return $items;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }
    
    function getCantStudentByCourse($curso_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT COUNT(usuarios_id) FROM usuarios_cursos
            WHERE cursos_id = :id
        ");
        try
        {
            if($query->execute(["id" => $curso_id]))
            {
                if($row = $query->fetch())
                {
                    return $row[0];
                }
                else return false;
            }
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function getCoursesRegisteredByUser($usuario_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT cursos_id FROM usuarios_cursos
            WHERE usuarios_id = :id
        ");
        try
        {
            if($query->execute(["id" => $usuario_id]))
            {
                $items = [];
                while($row = $query->fetch())
                {
                    $items [] = $row["cursos_id"];
                }
                return $items;
            }
        }
        catch (PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function addStudentFree($curso_id, $alumno_id)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO usuarios_cursos
            (usuarios_id, cursos_id, pago_pendiente)
            VALUES (:usuarios_id, :cursos_id, :pago_pendiente)
        ");
        try{
            if($query->execute([
                "usuarios_id" => $alumno_id,
                "cursos_id" => $curso_id,
                "pago_pendiente" => 0,
            ])){
                return true;
        }
            else return false;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function addStudentPendingToPay($curso_id, $alumno_id)
    {
        $query = $this->db->connect()->prepare(
            "INSERT INTO usuarios_cursos
            (usuarios_id, cursos_id, pago_pendiente)
            VALUES (:usuarios_id, :cursos_id, :pago_pendiente)
        ");
        try{
            if($query->execute([
                "usuarios_id" => $alumno_id,
                "cursos_id" => $curso_id,
                "pago_pendiente" => 1,
            ])){
                return true;              
            }
            else return false;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function isStudent($curso_id, $alumno_id)
    {
        $query = $this->db->connect()->prepare(
            "SELECT usuarios_id, pago_pendiente FROM usuarios_cursos
            WHERE cursos_id = :cursos_id
            AND usuarios_id = :usuarios_id
        ");
        try{
            if($query->execute([
                "usuarios_id" => $alumno_id,
                "cursos_id" => $curso_id,
            ])){
                if($row = $query->fetch())
                {
                    $item = new UsuarioCurso;
                    $item->usuario_id = $row["usuarios_id"];
                    $item->pago_pendiente = $row["pago_pendiente"];
                    return $item;          
                }
            }
            else return false;
        }
        catch(PDOException $ex)
        {
            return $ex->getMessage();
        }
    }

    function deleteStudent($curso_id, $usuario_id)
    {
        $query = $this->db->connect()->prepare(
            "DELETE FROM usuarios_cursos
            WHERE usuarios_id = :usuario_id
            AND cursos_id = :curso_id
        ");
        try
        {
            if($query->execute([
                "usuario_id" => $usuario_id,
                "curso_id" => $curso_id,
                ]))
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

    function updateStudentPendingToPay($curso_id, $alumno_id)
    {
        $query = $this->db->connect()->prepare(
            "UPDATE usuarios_cursos
            SET pago_pendiente = 0
            WHERE usuarios_id = :usuarios_id
            AND cursos_id = :cursos_id
        ");
        try{
            if($query->execute([
                "usuarios_id" => $alumno_id,
                "cursos_id" => $curso_id,
            ])){
                echo "ASDSA";
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