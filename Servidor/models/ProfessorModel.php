<?php
class ProfessorModel{

    private $db;
    private $professors;
    private $professorsWithSchedule;
    private $professorsWithoutSchedule;
 
    public function __construct($con){
        $this->db= $con;
        $this->professors = array();
        $this->professorsWithSchedule = array();
        $this->professorsWithoutSchedule = array();
    }
    
    public function getProfessors(){
        $consult=$this->db->query("SELECT * FROM Maestro");
        while($row=$consult->fetch_assoc()) {
            $this->professors[]= array("nomina" => $row[Nomina], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "telefono" => $row[Telefono], "correo" => $row[Correo]);
        }
        return $this->professors;
    }

    
    public function getProfessorsWithSchedule($schedule){


        $consult=$this->db->query(" SELECT curso.ClaveMateria, curso.Grupo, curso.Horario, maestro.Nomina, maestro.Nombre, maestro.Apellido, maestro.Correo, maestro.Telefono
                                    FROM curso,cursomaestro,maestro
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina 
                                    GROUP BY maestro.Nomina
                                    HAVING max( CASE curso.Horario  WHEN '$schedule' THEN 1 ELSE 0 END ) = 1 ");
        while($row=$consult->fetch_assoc()) {
            $this->professorsWithSchedule[]= array("clavemateria" => $row[ClaveMateria], "grupo" => $row[Grupo], "horario" => $row[Horario], "nomina" => $row[Nomina], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "telefono" => $row[Telefono], "correo" => $row[Correo]);
        }
        return $this->professorsWithSchedule;

    }


    public function getProfessorsWithoutSchedule($schedule){


         $consult=$this->db->query("SELECT curso.ClaveMateria, curso.Grupo, curso.Horario, maestro.Nomina, maestro.Nombre, maestro.Apellido, maestro.Correo, maestro.Telefono
                                    FROM curso,cursomaestro,maestro
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina 
                                    GROUP BY maestro.Nomina
                                    HAVING max( CASE curso.Horario  WHEN '$schedule' THEN 1 ELSE 0 END ) = 0" );
        while($row=$consult->fetch_assoc()) {
            $this->professorsWithSchedule[]= array("clavemateria" => $row[ClaveMateria], "grupo" => $row[Grupo], "horario" => $row[Horario], "nomina" => $row[Nomina], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "telefono" => $row[Telefono], "correo" => $row[Correo]);
        }
        return $this->professorsWithSchedule;

    }

    
    public function updateTable($id, $name, $lastname, $phone, $email){

        $consult=$this->db->query(" UPDATE  maestro 
                                    SET maestro.Nombre = '$name' , maestro.Apellido = '$lastname', maestro.Telefono = '$phone' , maestro.Correo = '$email'
                                    WHERE maestro.Nomina = '$id' 
                                 ");

        if(mysqli_affected_rows($this->db) >0 )
            return 1;
        else
            return 0;
    }

    public function deleteFromTable($id){


         $consult=$this->db->query("DELETE FROM maestro
                                    WHERE maestro.Nomina = '$id'
                                        AND maestro.Nomina NOT IN (
                                                                    SELECT tNomina from (SELECT maestro.Nomina as tNomina
                                                                                         FROM curso,cursomaestro,maestro
                                                                                         WHERE maestro.Nomina = '$id' AND curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina
                                                                                         ) as c
                                                                    )" 
                                   
                                   );

          if(mysqli_affected_rows($this->db) > 0 )
            return 1;
          else
            return 0;

    }

    public function insertIntoTable($id, $name, $lastname, $phone, $email) {

        $consult1=$this->db->query("SELECT * 
                                    FROM maestro
                                    WHERE maestro.Nomina = '$id'"
                                   );

        if ($consult1 -> num_rows == 0){


            $consult2=$this->db->query("INSERT INTO maestro VALUES ('$id', '$name', '$lastname', '$phone', '$email') ");

            return 1;

        } else { 

            return 0;
        }
        

    }

}
?>