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
        $consult=$this->db->query("SELECT materia.Clave as Clave, materia.Nombre as  Materia, curso.Grupo, curso.Horario, materia.HorasLaboratorio, salon.Numero as Salon, maestro.Nombre, maestro.Apellido, maestro.Correo, cursomaestro.Porcentaje
                                    FROM curso,cursomaestro,materia,maestro,salon
                                    WHERE curso.Id = cursomaestro.IdCurso AND cursomaestro.NominaMaestro = maestro.Nomina AND curso.NumeroSalon = salon.Numero AND 
                                     curso.ClaveMateria = materia.Clave");
        while($row=$consult->fetch_assoc()) {
            $this->Assignations[]= array("clave" => $row[Clave], "materia" => $row[Materia], "grupo" => $row[Grupo], "horario" => $row[Horario], "horaslaboratorio" => $row[HorasLaboratorio], 
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
	
	public function getClassesForProfessor($nomina) {
		
		$consult=$this->db->query("SELECT curso.ClaveMateria, curso.Grupo, curso.Horario, curso.NumeroSalon, curso.Idioma, curso.TipoGrupo 
									FROM curso JOIN cursomaestro ON curso.Id = cursomaestro.IdCurso
									WHERE cursomaestro.NominaMaestro = '$nomina'");
		
		
		//clave, grupo, horario, salón, idioma, honors
		
		
		while($row=$consult->fetch_assoc()) {
            $this->professorsCourse[]= array("ClaveMateria" => $row[ClaveMateria], "grupo" => $row[Grupo], "salon" => $row[NumeroSalon], "idioma" => $row[Idioma], "honors" => $row[TipoGrupo]);
        }
        return $this->professorsCourse;
		
	}
    
    public function updateTable($clave, $grupo, $correo, $correoNew) {
		
		$sql = "UPDATE cursomaestro SET 
								   cursomaestro.NominaMaestro = (SELECT Nomina FROM maestro 
																 WHERE maestro.Correo = ?)
   								   WHERE cursomaestro.IdCurso = (SELECT Id FROM curso 
																WHERE curso.ClaveMateria = ?
																	AND curso.Grupo = ?)
									AND cursomaestro.NominaMaestro = (SELECT Nomina FROM maestro 
																 WHERE maestro.Correo = ?) ";
																 
		
		
		
		$update = $this->db->prepare($sql);
		
		$ret;
		
		for($i = 0; $i<sizeof($clave); $i++){
			$update->bind_param('ssss', $correoNew[$i], $clave[$i], $grupo[$i], $correo[$i]);
			$update->execute();
		}
		
		// $clave as $index_member => $val) {
			// $update->bind_param('ii', $val, $index_member);
			// $update->execute();
		// }
		
        // $consul=$this->db->query("UPDATE cursomaestro SET 
								   // cursomaestro.NominaMaestro = (SELECT Nomina FROM maestro 
																 // WHERE maestro.Correo = '$correoNew')
   								   // WHERE cursomaestro.IdCurso = (SELECT Id FROM curso 
																// WHERE curso.ClaveMateria = '$clave'
																	// AND curso.Grupo = '$grupo')
									// AND cursomaestro.NominaMaestro = (SELECT Nomina FROM maestro 
																 // WHERE maestro.Correo = '$correo') ");
		
		
                                
        return mysqli_affected_rows($this->db);

    }
    
    public function deleteFromTable($correo, $materia, $grupo){
        
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
										  
			if(mysqli_affected_rows($this->db) > 0)
				return 1;
			else 
				return 0;
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