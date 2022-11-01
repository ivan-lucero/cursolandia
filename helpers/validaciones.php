<?php

class Validaciones {

    static function validarNombre($nombre)
    {
        return (!preg_match(
            "/^[a-zA-Z0-9]+$/",
             $nombre
            ))
            ? false : true;
    }
    static function validarEmail($email)
    {
        return (!preg_match(
            "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",
             $email
            ))
            ? false : true;
    }
    static function validarContrasena($contrasena)
    {
        return strlen($contrasena) >= 8;
    }
    static function validarTelefono($telefono)
    {
        return is_numeric($telefono) && strlen($telefono) === 10;
    }
    static function validarAntecedentes($antecedentes)
    {
        return strlen($antecedentes) <= 255;
    }
    static function validarFechaNacimiento($fecha_nacimiento)
    {
        $fecha_actual = date("Y-m-d");
        return $fecha_actual > $fecha_nacimiento;
    }
    static function validarFechaInicio($fecha_inicio)
    {
        $fecha_actual = date("Y-m-d");
        return $fecha_inicio >= $fecha_actual;
    }
    static function validarFechaFin($fecha_inicio, $fecha_fin)
    {
        return $fecha_fin >= $fecha_inicio;
    }
    static function validarTitulo($titulo)
    {
        return strlen($titulo) <= 45;
    }
}

?>








