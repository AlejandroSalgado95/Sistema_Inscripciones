<?php

	$conn= DBConnection::conexion();
	
	require_once("../models/AssignationModel.php");
	require_once("../models/ProfessorModel.php");

	$assignation = new AssignationModel($conn);
	$professor = new ProfessorModel($conn);


	

	if ($type == "Chargepage"){

		header('content-type: text/html');

		$allAssignations = $assignation -> getAssignations();
		$assignationNames = $assignation -> getAssignationNames();
		$nominas = $professor -> getProfessors();

		mysqli_close($conn);

		require_once("../views/assignationView.php");

	} else if ($type == "Reporte"){
		
		$reportInfo = array(); 	
		
		$profe = $_POST["professor"];
		
		$reportInfo = $assignation -> getClassesForProfessor($profe);

		require_once("downloadService.php");

	} else if ($type == "CargarGrupos"){

		$actualTopic = $_POST["actualTopic"];
		$groups = $assignation -> getGroups($actualTopic);

		echo json_encode ($groups);

	} else if ($type == "ModificarBD") {
		
		
		$modificationType = $_POST["modificationType"];
		
		if ($modificationType == "Agregar") {
			
			$clave = $_POST["clave"];
			$grupo = $_POST["grupo"];
			$professor = $_POST["professor"];
			
			$modifiedRows = $assignation -> insertIntoTable($clave, $grupo, $professor);
			
			echo($modifiedRows);
		} else if ($modificationType == "Borrar") {
			
			
			$correo = $_POST["correo"];
			$materia = $_POST["materia"];
			$grupo = $_POST["grupo"];
			

			$modifiedRows = $assignation -> deleteFromTable($correo, $materia, $grupo);
			//echo json_encode($modifiedRows);
			echo ($modifiedRows);
		} else if ($modificationType == "Editar") {
			
			$clave = $_POST["clave"];
			$grupo = $_POST["grupo"];
			$correo = $_POST["professor"];
			$newCorreo = $_POST["newProf"];
			$modifiedRows = $assignation -> updateTable($clave, $grupo, $correo, $newCorreo);
			
			echo json_encode($modifiedRows);
		}
	}


?>