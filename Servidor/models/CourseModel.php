<?php
class CourseModel{
    private $db;
    private $Courses;
    private $Schedules;
 
    public function __construct($con){
        $this->db= $con;
        $this->Courses = array();
        $this->Schedules = array();
    }
    
    public function getCourses(){
        $consult=$this->db->query("SELECT materia.Nombre as  Materia, curso.Grupo, curso.Horario, materia.HorasLaboratorio, salon.Numero as Salon, maestro.Nombre, maestro.Apellido, maestro.Correo
                                    FROM curso,cursomaestro,materia,maestro,salon
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina AND curso.NumeroSalon = salon.Numero AND 
                                     curso.ClaveMateria = materia.Clave");
        while($row=$consult->fetch_assoc()) {
            $this->Courses[]= array("materia" => $row[Materia], "grupo" => $row[Grupo], "horario" => $row[Horario], "horaslaboratorio" => $row[HorasLaboratorio], 
                                     "salon" => $row[Salon], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "correo" => $row[Correo]
                                     );
        }
        return $this->Courses;
    }

    public function getSchedules(){
        $consult=$this->db->query("SELECT DISTINCT Horario 
                                    FROM curso");
        while($row=$consult->fetch_assoc()) {
            $this->Schedules[]= array("horario"  => $row[Horario]);
        }
        return $this->Schedules;
    }
}
?>