<?php

class Archivos {

    private $directorio_imgs = "uploads/imgs/";
    private $directorio_materiales = "uploads/files/";

    function subirImagen ($archivo, $nombre_usuario)
    {
        if(empty($archivo["imagen"]["tmp_name"]))
        {
            return null;
        }
        $es_imagen = getimagesize($archivo["imagen"]["tmp_name"]);
        if(!$es_imagen)
            return false;
        
        $tamano = $archivo["imagen"]["size"];
        if($tamano > 500000)
            return false;
        
        $tipo_archivo = strtolower(pathinfo($archivo["imagen"]["name"], PATHINFO_EXTENSION));
        if(!($tipo_archivo == "jpg" || $tipo_archivo == "jpeg"))
            return false;
        
        $nombre_imagen = $nombre_usuario . "." . $tipo_archivo;
        $imagen = $this->directorio_imgs . $nombre_imagen;

        if(move_uploaded_file($archivo["imagen"]["tmp_name"], $imagen))
            return $nombre_imagen;
        else return false;
    }

    function subirMaterial ($archivo, $curso_id)
    {
        $tamano = $archivo["material"]["size"];
        var_dump($archivo);
        if($tamano > 2000000)
            return false;
        
        $nombre_archivo = $curso_id . "." . $archivo["material"]["name"];
        
        $material = $this->directorio_materiales . $nombre_archivo;

        if(move_uploaded_file($archivo["material"]["tmp_name"], $material))
            return true;
        else return false;
    }

    
}

?>