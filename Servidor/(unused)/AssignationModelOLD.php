<?php
class AssignationModel{
    
    private $db;
    private $Assignations;
    private $Schedules;
    private $assignationNames;
    private $assignationClaves;
    private $groups;
 
    public function __construct($con){
        $this->db= $con;
        $this->Assignations = array();
        $this->Schedules = array();
        $this->assignationNames = array();
        $this->assignationClaves = array();
        $this->groups = array();
    }
    
    public function getAssignations(){
        $consult=$this->db->query("SELECT materia.Nombre as  Materia, curso.Grupo, curso.Horario, materia.HorasLaboratorio, salon.Numero as Salon, maestro.Nombre, maestro.Apellido, maestro.Correo, cursomaestro.Porcentaje
                                    FROM curso,cursomaestro,materia,maestro,salon
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina AND curso.NumeroSalon = salon.Numero AND 
                                     curso.ClaveMateria = materia.Clave");
        while($row=$consult->fetch_assoc()) {
            $this->Assignations[]= array("materia" => $row[Materia], "grupo" => $row[Grupo], "horario" => $row[Horario], "horaslaboratorio" => $row[HorasLaboratorio], 
                                     "salon" => $row[Salon], "nombre" => $row[Nombre], "apellido" => $row[Apellido], "correo" => $row[Correo],  "porcentaje" => $row[Porcentaje]
                                     );
        }
        return $this->Assignations;
    }

    public function getSchedules(){
        $consult=$this->db->query("SELECT DISTINCT Horario 
                                    FROM curso");
        while($row=$consult->fetch_assoc()) {
            $this->Schedules[]= array("horario"  => $row[Horario]);
        }
        return $this->Schedules;
    }
    
    public function getAssignationNames() {
        $consult=$this->db->query("SELECT DISTINCT ClaveMateria
                                   FROM curso");
        
        while($row=$consult->fetch_assoc()) {
            $this->assignationNames[] = array("materia" => $row[ClaveMateria]);
        }
        return $this->assignationNames;
    }
    
    public function updateTable($curso, $nomina, $porcentaje) {
        $consul=$this->db->query(" UPDATE cursomaestro
                                    SET cursomaestro.IdCurso = '$curso',
                                    cursomaestro.NominaMaestro = '$nomina',
                                    cursomaestro.Porcentaje = '$porcentaje'
                                ");
                                
        if(mysqli_affected_rows($this->db) > 0) 
            return 1;
        else
            return 0;
    }
    
    public function deleteFromTable($correo, $materia, $grupo){

        // $nomina=$this->db->query("SELECT Nomina FROM maestro
                                     // WHERE maestro.Correo = '$correo'");
                                     
        // $strings = $nomina                            
                                    
        // $claveMateria=$this->db->query("SELECT ClaveMateria FROM materia
                                        // WHERE materia.Nombre = '$materia'");
        
        
        
        // $id=$this->db->query("SELECT Id FROM curso
                              // WHERE curso.ClaveMateria = '$claveMateria'
                              // AND curso.Grupo = '$grupo'");
        
        
        
        $consult=$this->db->query(" DELETE FROM cursomaestro 
                                    WHERE cursomaestro.IdCurso = (SELECT Id FROM curso 
                                                                WHERE curso.ClaveMateria = 
                                                                    (SELECT Clave FROM materia 
                                                                    WHERE materia.Nombre = '$materia')
                                                                    AND curso.Grupo = '$grupo')
                                                                AND cursomaestro.NominaMaestro = 
                                                                    (SELECT Nomina FROM maestro 
                                                                    WHERE maestro.Correo = '$correo')
                                    
                                    ");
            
        if(mysqli_affected_rows($this->db) > 0)
            return 1;
        else 
            return 0;
    }
    
    public function insertIntoTable($clave, $grupo, $nomina) {
        
        
        $consult=$this->db->query("SELECT Id FROM curso 
                                          WHERE ClaveMateria = '$clave'
                                          AND Grupo = '$grupo'");
                                          
                                          
        if ($consult -> num_rows != 1) return 0;

         while($row=$consult->fetch_assoc()) {
            $this->assignationClaves[] = array("Id" => $row[Id]);
        }

            
            $newId = $this->assignationClaves[0]["Id"];
        
        $consultIfExist=$this->db->query("SELECT * 
                                          FROM cursomaestro 
                                          WHERE cursomaestro.IdCurso = '$newId' 
                                          AND cursomaestro.Nomina = '$nomina'
                                          ");
        
        if ($consultIfExist -> num_rows == 0){
            
            
            $consultAdd=$this->db->query("INSERT INTO cursomaestro 
                                          VALUES ('$newId', '$nomina', '100%')");
                                          
            return 1;
        } else {
            return 0;   
        }
    }

    public function getGroups($actualTopic) {

        $consult= $this->db->query("SELECT curso.Grupo
                                    FROM curso
                                    WHERE curso.ClaveMateria = '$actualTopic'
                                   ");

         while($row=$consult->fetch_row()) {
            $this->groups[]= $row[0];
        }

        return $this->groups;

    }
    
    
}
?>