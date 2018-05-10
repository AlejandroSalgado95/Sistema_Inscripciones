<?php

	$conn= DBConnection::conexion();
	
	require_once("../models/CourseModel.php");
	require_once("../models/TopicModel.php");
	require_once("../models/ClassroomModel.php");

	$course = new CourseModel($conn);
	$topic = new TopicModel($conn);
	$classroom = new ClassroomModel($conn);



	

	if ($type == "Chargepage"){

		header('content-type: text/html');

		$allCourses = $course -> getCourses();
		$allClassrooms = $classroom -> getClassrooms(); 
		$allTopics = $topic -> getTopics();

		mysqli_close($conn);

		require_once("../views/courseView.php");

	} else if ($type == "Reporte"){

		$reportInfo = array();
		$tipoReporte = $_POST["tiporeporte"];
		$clavemateria = $_POST["clavemateria"];
		$dia = $_POST["dia"];
		$salon = $_POST["salon"];

		
		if ($tipoReporte == "enlugarfecha"){

			
			$str = "";

			if ($dia == "Lunes" || $dia == "Jueves")
				$str = "LuJu";

			else if ($dia == "Martes" || $dia == "Viernes")
				$str = "MaVi";

			else if ($dia == "Miercoles")
				$str = "Mi";

			$reportInfo =  $course -> getTopicDatePlace($str,$salon);

		} else if ($tipoReporte == "enmateria"){
			
			$reportInfo =  $course -> getTopicCourses($clavemateria);
			

		}
		
		require_once("downloadService.php");

	} else if ($type == "ModificarBD") {
		
		
		$modificationType = $_POST["modificationType"];
		
		if ($modificationType == "Agregar") {
			
			$topic = $_POST["topic"];
			$schedule = $_POST["schedule"];
			$lab = $_POST["lab"];
			$classroom = $_POST["classroom"];
			$language = $_POST["language"];
			$topicType = $_POST["topicType"];
			
			$modifiedRows = $course -> insertIntoTable($topic,$schedule,$lab,$classroom,$language,$topicType);
			
			echo($modifiedRows);
		} /*else if ($modificationType == "Borrar") {
			
			
			$correo = $_POST["correo"];
			$materia = $_POST["materia"];
			$grupo = $_POST["grupo"];
			

			$modifiedRows = $course -> deleteFromTable($correo, $materia, $grupo);
			//echo json_encode($modifiedRows);
			echo ($modifiedRows);
		}*/
	}


?>