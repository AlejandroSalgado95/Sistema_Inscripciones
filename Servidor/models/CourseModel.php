<?php
class CourseModel{
    private $db;
    private $Courses;
    private $Schedules;
    private $TopicCourses;
    private $TopicDatePlace;
 
    public function __construct($con){
        $this->db= $con;
        $this->Courses = array();
        $this->Schedules = array();
        $this->TopicCourses = array();
        $this->TopicDatePlace = array();
    }
    
    public function getCourses(){
        $consult=$this->db->query("SELECT materia.Nombre as  Materia, curso.Grupo, curso.Horario, materia.HorasLaboratorio, salon.Numero as Salon, maestro.Nombre, maestro.Apellido, maestro.Correo, curso.Idioma, curso.TipoGrupo
                                    FROM curso,cursomaestro,materia,maestro,salon
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina AND curso.NumeroSalon = salon.Numero AND 
                                     curso.ClaveMateria = materia.Clave");
        while($row=$consult->fetch_assoc()) {
            $this->Courses[]= array("materia" => $row[Materia], "grupo" => $row[Grupo], "horario" => $row[Horario], "horaslaboratorio" => $row[HorasLaboratorio], 
                                     "salon" => $row[Salon], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "correo" => $row[Correo], "idioma" => $row[Idioma], "tipogrupo" => $row[TipoGrupo]
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

    public function getTopicCourses($topicKey){

        $consult=$this->db->query(" SELECT curso.Grupo, maestro.Nomina, maestro.Nombre, maestro.Apellido,  curso.Horario, curso.NumeroSalon, curso.Idioma, curso.TipoGrupo, materia.Nombre as NombreMateria
                                    FROM curso,cursomaestro,maestro, materia
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina AND  curso.ClaveMateria = materia.Clave  AND curso.ClaveMateria = '$topicKey'
                                  ");
        while($row=$consult->fetch_assoc()) {
            $this->TopicCourses[]= array( "grupo" => $row[Grupo], "nomina" => $row[Nomina], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "horario" => $row[Horario], "numerosalon" => $row[NumeroSalon], "idioma" => $row[Idioma], "tipogrupo" => $row[TipoGrupo], "nombremateria" => $row[NombreMateria]);
        }
        return $this->TopicCourses;
    }

    public function getTopicDatePlace($substr,$salon){

         $consult=$this->db->query(" SELECT curso.Grupo, maestro.Nomina, maestro.Nombre, maestro.Apellido,  curso.Horario, curso.NumeroSalon, curso.Idioma, curso.TipoGrupo, materia.Nombre as NombreMateria
                                    FROM curso,cursomaestro,maestro, materia
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina AND  curso.ClaveMateria = materia.Clave  AND curso.NumeroSalon = '$salon' AND curso.Horario LIKE '%{$substr}%'
                                  ");
        while($row=$consult->fetch_assoc()) {
            $this->TopicDatePlace[]= array( "grupo" => $row[Grupo], "nomina" => $row[Nomina], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "horario" => $row[Horario], "numerosalon" => $row[NumeroSalon], "idioma" => $row[Idioma], "tipogrupo" => $row[TipoGrupo], "nombremateria" => $row[NombreMateria]);
        }
        return $this->TopicDatePlace;

    }

    public function insertIntoTable($topic,$schedule,$lab,$classroom,$language,$topicType){

        $check=$this->db->query("SELECT * 
                                 FROM curso
                                 WHERE curso.Horario = '$schedule' AND curso.NumeroSalon = '$classroom'
                                 ");

        $maxGroupRow = $this->db->query("SELECT curso.Grupo
                                         FROM curso
                                         WHERE curso.ClaveMateria = '$topic'
                                         ORDER BY curso.Grupo desc
                                         limit 1");

        if ($check -> num_rows == 0){

            $row= $maxGroupRow->fetch_assoc();
            $maxGroupValue = $row[Grupo] + 1 ;

            $insertion = $this->db->query("INSERT INTO curso (Grupo,Horario,Idioma,TipoGrupo,NumeroSalon,ClaveMateria) VALUES ('$maxGroupValue', '$schedule', '$language', '$topicType', '$classroom', '$topic') ");

            return 1;

        } else { 

            return 0;
        }


    }


}
?>