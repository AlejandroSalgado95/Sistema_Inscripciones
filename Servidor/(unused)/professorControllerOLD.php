<?php
	
	$conn= DBConnection::conexion();
	
	require_once("../models/ProfessorModel.php");
	require_once("../models/CourseModel.php");

	$professor = new ProfessorModel($conn);
	$course = new CourseModel($conn);


	if ($type == "Chargepage" || $action == "Ingresar"){

		header('content-type: text/html');

		$schedules = $course -> getSchedules();

		$allProfessors = $professor -> getProfessors();

		mysqli_close($con);

		require_once("../views/professorView.php");

	} else if ($type == "Reporte"){

		$reportInfo = array();
		$tipoReporte = $_POST["tiporeporte"];
		$schedule = $_POST["horario"];

		if ($tipoReporte == "sincurso")
			$reportInfo = $professor -> getProfessorsWithoutSchedule($schedule);

		else if ($tipoReporte == "concurso")
			$reportInfo = $professor -> getProfessorsWithSchedule($schedule);

		require_once("downloadService.php");


	} else if ($type == "ModificarBD"){

		
		$modificationType = $_POST["modificationType"];

		if ($modificationType == "Editar"){

			 $id = $_POST["id"];
			 $name = $_POST["name"];
			 $lastname = $_POST["lastname"];
			 $phone = $_POST["phone"];
			 $email = $_POST["email"];

			 $modifiedRows = 0;

			 
			 for($i= 0; $i < count($id); $i++) {

			 	$modifiedRows = $modifiedRows + ($professor -> updateTable($id[$i], $name[$i], $lastname[$i], $phone[$i], $email[$i]) );
			 }

			 echo ($modifiedRows);


		} else if ($modificationType == "Borrar"){

			$id = $_POST["id"];
			$modifiedRows = $professor -> deleteFromTable($id);
			echo ($modifiedRows);


		} else if ($modificationType == "Agregar"){

			 $id = $_POST["id"];
			 $name = $_POST["name"];
			 $lastname = $_POST["lastname"];
			 $phone = $_POST["phone"];
			 $email = $_POST["email"];

			$modifiedRows = $professor -> insertIntoTable($id, $name, $lastname, $phone, $email);

			echo ($modifiedRows);

		}
	}

	


?>
