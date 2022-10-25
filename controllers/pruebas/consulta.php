<?php

class Consulta extends Controller{
    function __construct()
    {
        parent::__construct();
        $this->view->datos = [];
        $this->view->mensaje = "";

    }
    
    function render(){
        $alumnos = $this->model->get();
        $this->view->datos = $alumnos;
        $this->view->render('consulta/index');
    }


    function verAlumno($params = null)
    {
        $matriculaAlumno = $params[0];
        $alumno = $this->model->getById($matriculaAlumno);

        session_start();
        $_SESSION['id_verAlumno'] = $alumno->matricula;
        $this->view->alumno = $alumno;
        $this->view->render('consulta/detalle');
    }
    function editarAlumno()
    {
        session_start();
        $matricula = $_SESSION['id_verAlumno'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        session_destroy();

        if ($this->model->update([
            'matricula' => $matricula,
            'nombre' => $nombre,
            'apellido' => $apellido
        ]))
        {
            $alumno = new Alumno();
            $alumno->matricula = $matricula;
            $alumno->nombre = $nombre;
            $alumno->apellido = $apellido;
            $this->view->alumno = $alumno;
            $this->view->mensaje = "Alumno actualizado correctamente";
        }
        else
        {
            $this->view->mensaje = "No se pudo actualizar el alumno";
        }
        $this->view->render('consulta/detalle');
    }

    function eliminarAlumno($param = null)
    {
        $matricula = $param[0];

        if ($this->model->delete($matricula))
            $this->view->mensaje = "Alumno eliminado correctamente";
        else 
            $this->view->mensaje = "No se pudo eliminar el alumno";
        $this->render();
    }

}

?>