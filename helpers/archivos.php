<?php

class Archivos {

    private $directorio_imgs = "uploads/imgs/";

    function subirImagen ($archivo, $nombre_usuario)
    {
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
}

?>